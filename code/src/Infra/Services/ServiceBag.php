<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Services;

use TaskTrek\Application\Services\CacheServiceInterface;
use TaskTrek\Application\Services\ConfigurationServiceInterface;
use TaskTrek\Application\Services\EmailServiceInterface;
use TaskTrek\Application\Services\ServiceBagInterface;

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
