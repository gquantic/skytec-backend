<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_auth(): void
    {
        $response = $this->post('/api/user/register', [
            'manager_id' => null,
            'department_id' => Department::all()->random()->id,
            'position' => 'Веб-разработчик',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'surname' => 'Отчество',
            'login' => 'user_login',
            'email' => 'email@email.email',
            'phone' => '899999999999',
            'birthdate' => Carbon::now()->format('Y-m-d'),
            'password' => 'password1234',
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('api.token')
        ]);

//        $response = $this->get('/api/news', ['Authorization' => 'Bearer ' . config('api.token'), 'Accept' => 'application/json']);

        print_r($response->content());

//            dd($response);
        $response->assertStatus(200);
    }
}
