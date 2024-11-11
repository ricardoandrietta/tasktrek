<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\DTOs;

class ProjectDTO
{
    public ?int $project_id = null;
    public ?string $description = null;
    public ?string $due_date = null;
    public function __construct(public string $uuid, public int $user_id, public string $name)
    {
    }

    /**
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    /**
     * @param int|null $project_id
     *
     * @return ProjectDTO
     */
    public function setProjectId(?int $project_id): ProjectDTO
    {
        $this->project_id = $project_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDueDate(): ?string
    {
        return $this->due_date;
    }

    /**
     * @param string|null $due_date
     *
     * @return ProjectDTO
     */
    public function setDueDate(?string $due_date): ProjectDTO
    {
        $this->due_date = $due_date;
        return $this;
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
     * @return ProjectDTO
     */
    public function setDescription(?string $description): ProjectDTO
    {
        $this->description = $description;
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
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
