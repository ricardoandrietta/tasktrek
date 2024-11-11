<?php

declare(strict_types=1);

namespace TaskTrek\Tests\TestRepositories;

use TaskTrek\Core\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Core\Domain\Project\ProjectEntity;
use TaskTrek\Core\Infra\Repositories\ProjectRepositoryInterface;

class ProjectTestRepository implements ProjectRepositoryInterface
{
    public array $projects = [];
    public function create(ProjectEntity $project): int
    {
        $i = count($this->projects);
        $project->setProjectId($i);
        $this->projects[$i] = $project;
        return $i;
    }

    /**
     * @throws ResourceNotFountException
     */
    public function update(ProjectEntity $project): void
    {
        if (isset($this->projects[$project->getProjectId()])) {
            $this->projects[$project->getProjectId()] = $project;
            return;
        }

        $errorMessage = "Project not found [{$project->getProjectId()}] - " . json_encode($this->projects);
        throw new ResourceNotFountException($errorMessage);
    }

    public function delete(int $projectId): void
    {
        if (isset($this->projects[$projectId])) {
            unset($this->projects[$projectId]);
        }
    }

    public function findById(int $projectId): ?ProjectEntity
    {
        if (isset($this->projects[$projectId])) {
            return $this->projects[$projectId];
        }

        throw new ResourceNotFountException("Project not found [{$projectId}]");
    }
}
