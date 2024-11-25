<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Adapters;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\DatabaseUserProvider;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connection;
use Illuminate\Hashing\HashManager;
use TaskTrek\Core\Domain\Auth\AuthenticationServiceInterface;
use TaskTrek\Core\Domain\Auth\UserRegistrationServiceInterface;
use TaskTrek\Core\Domain\User\UserEntity;
use TaskTrek\Core\Domain\ValueObjects\Email;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;

class LaravelAuthAdapter implements AuthenticationServiceInterface, UserRegistrationServiceInterface
{
    private AuthManager $authManager;
    private HashManager $hashManager;
    private Connection $connection;
    public function __construct()
    {
        // Create container
        $container = Container::getInstance();

        // Create config repository
        $config = new Repository();

        // Set necessary configs
        $config->set('auth', [
            'defaults' => [
                'guard' => 'web',
                'passwords' => 'users',
            ],
            'guards' => [
                'web' => [
                    'driver' => 'session',
                    'provider' => 'users',
                ],
            ],
            'providers' => [
                'users' => [
                    'driver' => 'database',
                    'table' => 'users',
                ],
            ],
        ]);
        $config->set('hashing', [
            'driver' => 'bcrypt',
            'bcrypt' => [
                'rounds' => 10,
            ],
        ]);

        // Bind config to container
        $container->instance('config', $config);

        // Set up database
        $capsule = new Capsule();
        $capsule->addConnection([
                                    'driver'    => 'mysql',
                                    'host'      => 'mysql',
                                    'database'  => 'tasktrek',
                                    'username'  => 'tasktrek',
                                    'password'  => 'tasktrek',
                                    'charset'   => 'utf8mb4',
                                    'collation' => 'utf8mb4_unicode_ci',
                                    'prefix'    => '',
                                ]);

        // Set the container instance
        $capsule->setAsGlobal();
        //        $capsule->bootEloquent();

        $authConfig = [
            'table' => 'users',
            'fields' => [
                'username' => 'email',
                'password' => 'password'
            ]
        ];

        // Create database connection
        $this->connection = $capsule->getConnection();

        // Create managers with container
        $this->authManager = new AuthManager($container);
        $this->hashManager = new HashManager($container);

        // Create user provider
        $userProvider = new DatabaseUserProvider(
            $this->connection,
            $this->hashManager,
            $authConfig['table']
        );

        // Set up auth manager
        $this->authManager->provider('database', function () use ($userProvider) {
            return $userProvider;
        });
    }

    public function register(string $email, string $password): UserEntity
    {
        $hashedPassword = $this->hashPassword($password);
        $uuid = UUIDv4::generate();
        $userId = $this->connection
            ->table('users')
            ->insertGetId(
                [
                'user_uuid' => $uuid,
                'name' => 'name',
                'email' => $email,
                'password' => $hashedPassword,
                'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                ]
            );

        return new UserEntity(new UUIDv4('uuid'), new Email($email), 'name'); // You'll create this DTO
    }

    public function authenticate(string $email, string $password): ?UserEntity
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if ($this->authManager->attempt($credentials)) {
            $user = $this->authManager->user();
            return new UserEntity(new UUIDv4('uuid'), new Email('email'), 'name'); // You'll create this DTO
        }

        return null;
    }

    public function hashPassword(string $password): string
    {
        return $this->hashManager->make($password);
    }

    public function verifyPassword(string $hashedPassword, string $password): bool
    {
        return $this->hashManager->check($password, $hashedPassword);
    }
}
