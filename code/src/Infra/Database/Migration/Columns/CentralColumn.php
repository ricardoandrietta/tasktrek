<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Database\Migration\Columns;

class CentralColumn extends AbstractColumn
{
    protected string $createdAt = 'created_at';
    protected string $updatedAt = 'updated_at';
    protected string $deletedAt = 'deleted_at';
    protected string $createdBy = 'created_by';
    protected string $updatedBy = 'updated_by';
    protected string $deletedBy = 'deleted_by';

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     *
     * @return CentralColumn
     */
    public function setCreatedAt(string $createdAt): CentralColumn
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     *
     * @return CentralColumn
     */
    public function setCreatedBy(string $createdBy): CentralColumn
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }

    /**
     * @param string $deletedAt
     *
     * @return CentralColumn
     */
    public function setDeletedAt(string $deletedAt): CentralColumn
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeletedBy(): string
    {
        return $this->deletedBy;
    }

    /**
     * @param string $deletedBy
     *
     * @return CentralColumn
     */
    public function setDeletedBy(string $deletedBy): CentralColumn
    {
        $this->deletedBy = $deletedBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return CentralColumn
     */
    public function setUpdatedAt(string $updatedAt): CentralColumn
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): string
    {
        return $this->updatedBy;
    }

    /**
     * @param string $updatedBy
     *
     * @return CentralColumn
     */
    public function setUpdatedBy(string $updatedBy): CentralColumn
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}
