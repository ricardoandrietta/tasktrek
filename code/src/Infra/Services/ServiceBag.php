<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Services;

use TaskTrek\Core\Application\Services\CacheServiceInterface;
use TaskTrek\Core\Application\Services\ConfigurationServiceInterface;
use TaskTrek\Core\Application\Services\EmailServiceInterface;
use TaskTrek\Core\Application\Services\ServiceBagInterface;

class ServiceBag implements ServiceBagInterface
{
    public function getConfigurationService(): ConfigurationServiceInterface
    {
        return new ConfigurationService();
    }

    public function getEmailService(): EmailServiceInterface
    {
        return new EmailService();
    }

    public function getCacheService(): CacheServiceInterface
    {
        return new CacheService();
    }
}
