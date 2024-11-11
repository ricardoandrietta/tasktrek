<?php

namespace TaskTrek\Core\Application\Services;

interface ConfigurationServiceInterface
{
    /**
     * The environment variable prefix
     * By default it is TASKTREK_, but can be changed
     */
    public const string ENV_PREFIX = 'TASKTREK_';

    /**
     * Sets the environment variable prefix
     * By default it is TASKTREK_, but can be changed
     *
     * @param string $prefix
     *
     * @return ConfigurationServiceInterface
     */
    public function setEnvVariablePrefix(string $prefix): self;

    /**
     * Gets a key from a section
     *
     * E.g.: Given the object: {'country' => ['name' => 'Canada', 'alfa2' => 'ca']}
     * - $key = 'country' returns an array['name' => 'Canada', 'alfa2' => 'ca']
     * - $key = 'country.name' returns Canada
     *
     * @param string $sectionName The name of the section
     * @param string $key Key of a value. It uses dot notation to get/set values in nested arrays
     *
     * @return mixed
     */
    public function get(string $sectionName, string $key): mixed;

    /**
     * Gets a key from a section as boolean
     *
     * E.g.: Given the object: {'data' => [
     * 'bool_true' => true,
     * 'bool_false' => false,
     * 'string_true' => 'true',
     * 'string_false' => 'false',
     * 'int_true' => 1,
     * 'int_false' => 0
     * ]}
     * - $key = 'data.bool_true' returns a boolean: TRUE in this case
     * - $key = 'data.bool_false' returns a boolean: FALSE in this case
     * - $key = 'data.string_true' returns a boolean: TRUE in this case
     * - $key = 'data.string_false' returns a boolean: FALSE in this case
     * - $key = 'data.int_true' returns a boolean: TRUE in this case
     * - $key = 'data.int_false' returns a boolean: FALSE in this case
     *
     * @param string $sectionName
     * @param string $key
     *
     * @return bool
     */
    public function getAsBoolean(string $sectionName, string $key): bool;

    /**
     * Gets a key from a section as integer
     *
     * E.g.: Given the object: {'data' => ['year' => '1981', 'population' => 40000, 'age' => null, 'is_cool' => true]}
     *  - $key = 'data.year' returns an integer: 1981 in this case
     *  - $key = 'data.population' returns an integer: 40000 in this case
     *  - $key = 'data.age' returns an integer: 0 in this case
     *  - $key = 'data.is_cool' returns an integer: 1 in this case
     *
     * @param string $sectionName
     * @param string $key
     *
     * @return int
     */
    public function getAsInt(string $sectionName, string $key): int;
}
