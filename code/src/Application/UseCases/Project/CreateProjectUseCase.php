<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\Project;

use TaskTrek\Core\Application\DTOs\ProjectDTO;
use TaskTrek\Core\Domain\Project\ProjectEntity;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Core\Infra\Repositories\ProjectRepositoryInterface;

class CreateProjectUseCase
{
    public function __construct(protected readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    public function execute(ProjectDTO $project): ProjectEntity
    {
        $uuid = new UUIDv4($project->uuid);
        if (!$uuid->isValid()) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        $projectEntity = new ProjectEntity(
            uuid: $uuid,
            userId: $project->user_id,
            name: $project->name
        );

        if (!empty($project->getDescription())) {
            $projectEntity->setDescription($project->getDescription());
        }

        if (!empty($project->getDueDate())) {
            $pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
            if (preg_match($pattern, $project->getDueDate())) {
                $projectEntity->setDueDate($project->getDueDate());
            } else {
                throw new \InvalidArgumentException('Invalid due date format');
            }
        }

        $projectId = $this->projectRepository->create($projectEntity);
        $projectEntity->setProjectId($projectId);
        return $projectEntity;
    }
}
