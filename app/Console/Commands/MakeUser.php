<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {name?} {login?} {email?} {password?} {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $this->info('creating...');

            empty($userId)
                ? $this->createNewUser()
                : $this->updateUserPermissions((string) $userId);
        } catch (Exception|QueryException $e) {
            $this->error($e->getMessage());
        }
    }

    protected function createNewUser(): void
    {
        $this->createUser(
                $this->argument('name') ?? $this->ask('Имя:', 'admin'),
                $this->argument('login') ?? $this->ask('Логин:', 'admin'),
                $this->argument('email') ?? $this->ask('Электронная почта:', 'admin@admin.com'),
                $this->argument('password') ?? $this->secret('Пароль:')
            );

        $this->info('User created successfully.');
    }

    /**
     * Throw an exception if email already exists, create admin user.
     *
     * @throws \Throwable
     */
    public function createUser(string $name, string $login, string $email, string $password): void
    {
        $data = [
            'name'        => $name,
            'login'       => $login,
            'email'       => $email,
            'password'    => Hash::make($password),
        ];

        if ($this->hasOption('admin') && $this->option('admin')) {
            $data['permissions'] = Dashboard::getAllowAllPermission();
        }

        User::query()->insert($data);

//        dd($user);
    }

    /**
     * Update the permissions of an existing user.
     *
     * @param string $id
     *
     * @return void
     */
    protected function updateUserPermissions(string $id): void
    {
        Dashboard::modelClass(User::class)
            ->findOrFail($id)
            ->forceFill([
                'permissions' => Dashboard::getAllowAllPermission(),
            ])
            ->save();

        $this->info('User permissions updated.');
    }
}
