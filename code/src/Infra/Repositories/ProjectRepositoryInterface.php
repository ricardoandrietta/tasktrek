<?php

namespace TaskTrek\Core\Infra\Repositories;

use TaskTrek\Core\Domain\Project\ProjectEntity;

interface ProjectRepositoryInterface
{
    public function create(ProjectEntity $project): int;
    public function update(ProjectEntity $project): void;
    public function delete(int $projectId): void;
    public function findById(int $projectId): ?ProjectEntity;
}
