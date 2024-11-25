<?php

use TaskTrek\Core\Domain\Auth\UserRegistrationServiceInterface;
use TaskTrek\Core\Infra\Adapters\LaravelAuthAdapter;

require __DIR__ . '/../vendor/autoload.php';
class UserSeeder
{
    private \TaskTrek\Core\Domain\Auth\UserRegistrationServiceInterface $registrationService;

    public function __construct(UserRegistrationServiceInterface $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function seed(): void
    {
        $users = [
            ['email' => 'user1@example.com', 'password' => 'password123'],
            ['email' => 'user2@example.com', 'password' => 'password456'],
        ];

        foreach ($users as $userData) {
            try {
                $user = $this->registrationService->register(
                    $userData['email'],
                    $userData['password']
                );
                echo "Created user: " . $user->getEmail()->getValue() . "\n";
            } catch (\Exception $e) {
                echo "Failed to create user: " . $userData['email'] . "\n";
                echo $e->getMessage() . "\n";
            }
        }
    }
}

echo "<pre />";
// Usage:
$authAdapter = new LaravelAuthAdapter();
$user = $authAdapter->authenticate('user1@example.com', 'password123');
var_dump($user);
//$seeder = new UserSeeder($authAdapter);
//$seeder->seed();
