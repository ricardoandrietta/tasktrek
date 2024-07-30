<?php

namespace TaskTrek\Application\Services;

interface ServiceBagInterface {

    public function getConfigurationService(): ConfigurationServiceInterface;
    public function getEmailService(): EmailServiceInterface;
    public function getCacheService(): CacheServiceInterface;

}
