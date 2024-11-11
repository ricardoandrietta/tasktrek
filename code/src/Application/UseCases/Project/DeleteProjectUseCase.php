<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\Project;

use TaskTrek\Core\Infra\Repositories\ProjectRepositoryInterface;

class DeleteProjectUseCase
{
    /**
     * @param ProjectRepositoryInterface $projectRepository
     */
    public function __construct(protected readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    public function execute(int $projectId): void
    {
        try {
            $this->projectRepository->delete($projectId);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
