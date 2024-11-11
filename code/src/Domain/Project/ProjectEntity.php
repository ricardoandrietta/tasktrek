<?php

declare(strict_types=1);

namespace TaskTrek\Core\Domain\Project;

use DateTime;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;

class ProjectEntity
{
    protected ?int $projectId = null;
    protected ?string $description;
    protected ?DateTime $dueDate = null;

    public function __construct(protected UUIDv4 $uuid, protected int $userId, protected string $name)
    {
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return ProjectEntity
     */
    public function setDescription(?string $description): ProjectEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDueDate(): ?DateTime
    {
        return $this->dueDate;
    }

    /**
     * @param DateTime|null $dueDate
     *
     * @return ProjectEntity
     */
    public function setDueDate(?DateTime $dueDate): ProjectEntity
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int|null $projectId
     *
     * @return ProjectEntity
     */
    public function setProjectId(?int $projectId): ProjectEntity
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return UUIDv4
     */
    public function getUuid(): UUIDv4
    {
        return $this->uuid;
    }
}
