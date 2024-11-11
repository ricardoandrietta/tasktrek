<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\Project;

use DateMalformedStringException;
use DateTime;
use Exception;
use RuntimeException;
use TaskTrek\Core\Application\DTOs\ProjectDTO;
use TaskTrek\Core\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Core\Domain\Project\ProjectEntity;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Core\Infra\Repositories\ProjectRepositoryInterface;

class UpdateProjectUseCase
{
    /**
     * @param ProjectRepositoryInterface $projectRepository
     */
    public function __construct(protected readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    /**
     * @throws DateMalformedStringException
     * @throws ResourceNotFountException
     */
    public function execute(ProjectDTO $project)
    {
        if ($project->getProjectId() === null) {
            throw new \InvalidArgumentException('Id is required');
        }

        $uuid = new UUIDv4($project->getUuid());
        if (!$uuid->isValid()) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        $projectEntity = $this->projectRepository->findById($project->getProjectId());
        if (!$projectEntity) {
            throw new ResourceNotFountException("Project not found [{$project->getProjectId()}]");
        }

        $updatedProject = (new ProjectEntity($uuid, $project->getUserId(), $project->getName()))
            ->setProjectId($projectEntity->getProjectId());
        if (!empty($project->getDescription())) {
            $updatedProject->setDescription($project->getDescription());
        }
        if (!empty($project->getDueDate())) {
            $dueDate = new DateTime($project->getDueDate());
            $updatedProject->setDueDate($dueDate);
        }

        try {
            $this->projectRepository->update($updatedProject);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }
}
