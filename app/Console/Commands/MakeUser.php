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
    protected $signature = 'make:admin {name?} {login?} {email?} {password?}';

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
//            $userId = $this->option('id');
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
        $this->createAdmin(
                $this->argument('name') ?? $this->ask('What is your name?', 'admin'),
                $this->argument('login') ?? $this->ask('Login', 'admin'),
                $this->argument('email') ?? $this->ask('What is your email?', 'admin@admin.com'),
                $this->argument('password') ?? $this->secret('What is the password?')
            );

        $this->info('User created successfully.');
    }

    /**
     * Throw an exception if email already exists, create admin user.
     *
     * @throws \Throwable
     */
    public function createAdmin(string $name, string $login, string $email, string $password): void
    {
        $data = [
            'name'        => $name,
            'login'       => $login,
            'email'       => $email,
            'password'    => Hash::make($password),
            'permissions' => Dashboard::getAllowAllPermission(),
        ];
//        dd($data);

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
