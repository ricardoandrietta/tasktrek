<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Services;

use TaskTrek\Application\Services\ConfigurationServiceInterface;

class ConfigurationService implements ConfigurationServiceInterface
{
    private array $sections = [];
    protected string $prefix = self::ENV_PREFIX;

    public function getEnvVariablePrefix(): string
    {
        return $this->prefix;
    }

    public function setEnvVariablePrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    protected function getSection(string $sectionName): array
    {
        if (isset($this->sections[$sectionName])) {
            return $this->sections[$sectionName];
        }

        $fromCache = $this->cacheSearch($sectionName);
        if (!empty($fromCache)) {
            $this->sections[$sectionName] = $fromCache;
            return $fromCache;
        }

        $fromDb = $this->dbSearch($sectionName);
        if (!empty($fromDb)) {
            $this->sections[$sectionName] = $fromDb;
            return $fromDb;
        }

        return [];
    }

    public function get(string $sectionName, string $key): mixed
    {
        $sectionData = $this->getSection($sectionName);
        $value = (new DotNotationExtractor())->extract($sectionData, $key);
        if (is_string($value) && str_starts_with($value, $this->getEnvVariablePrefix())) {
            return getenv($value);
        }
        return $value;
    }

    public function getAsBoolean(string $sectionName, string $key): bool
    {
        $value = $this->get($sectionName, $key);
        if (is_bool($value)) {
            return $value;
        }

        if (is_null($value)) {
            return false;
        }

        if (is_int($value)) {
            return ($value === 1);
        }

        return ($value === 'true' || $value === '1');
    }

    public function getAsInt(string $sectionName, string $key): int
    {
        $value = $this->get($sectionName, $key);
        if (is_int($value)) {
            return $value;
        }

        if (is_null($value)) {
            return 0;
        }

        if (is_bool($value)) {
            return ($value ? 1 : 0);
        }

        if ($value === 'true' || $value === '1') {
            return 1;
        }

        if (is_string($value)) {
            return (int) $value;
        }

        return 0;
    }

    /**
     * Searches the database for a specific section and returns the corresponding data.
     *
     * @param string $section The section to search for in the database.
     *
     * @return array An associative array containing the section, metadata, and defaults for the given section.
     * If no data is found, an empty array is returned.
     */
    protected function dbSearch(string $section): array
    {
        $host = getenv($this->getEnvVariablePrefix() . 'MYSQL_HOST');
        $username = getenv($this->getEnvVariablePrefix() . 'MYSQL_USER');
        $password = getenv($this->getEnvVariablePrefix() . 'MYSQL_PASSWORD');
        $dbname = getenv($this->getEnvVariablePrefix() . 'MYSQL_DATABASE');
        $options = [
            \PDO::ATTR_STRINGIFY_FETCHES => false,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
            $sql = "SELECT section, metadata, defaults FROM configurations c WHERE section = :section";
            $prepared = $pdo->prepare($sql);
            $prepared->execute(['section' => $section]);
            return $prepared->fetch(\PDO::FETCH_ASSOC) ?: [];
        } catch (\PDOException $e) {
            return [];
        }
    }

    /**
     * Retrieves the cached search results for a given section.
     *
     * @param string $section The section for which to retrieve the cached search results.
     *
     * @return array The cached search results for the given section, or an empty array if not found.
     */
    protected function cacheSearch(string $section): array
    {
        return [];
        //        $client = $this->getCacheClient();
        //        if (is_null($client)) {
        //            return [];
        //        }
        //
        //        $key = self::CACHE_PREFIX . $section;
        //
        //        try {
        //            $cached = $client->get($key);
        //            if (empty($cached)) {
        //                return [];
        //            }
        //
        //            return json_decode($cached, true);
        //        } catch (\Exception $e) {
        //            return [];
        //        }
    }
}
