<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    protected $faker;

    public function setUp()
    {
      parent::setUp();
      $this->faker = Faker::create();
    }

    public function test_params_is_empty()
    {
      $info = [
          'username' => '',
          'email' => '',
          'password' => '',
      ];

      $this->json('post', '/api/register', $info)
          ->assertStatus(422)
          ->assertJsonStructure([
            'message',
            'errors' => [
              'email',
              'username',
              'password'
            ]
          ]);
    }

    public function test_its_not_a_valid_email()
    {
      $info = [
          'username' => $this->faker->name,
          'email' => 'stringNotMail',
          'password' => '123456',
      ];

      $this->json('post', '/api/register', $info)
          ->assertStatus(422)
          ->assertJsonStructure([
            'message',
            'errors' => [
              'email',
            ]
          ]);
    }

    public function test_its_taken_email()
    {
      $user = factory('App\User')->create();
      $info = [
          'username' => $this->faker->name,
          'email' => $user->email,
          'password' => '123456',
      ];

      $this->json('post', '/api/register', $info)
        ->assertStatus(422)
        ->assertJsonStructure([
          'message',
          'errors' => [
            'email',
          ]
        ]);
    }

    public function test_register_successfully()
    {
        $info = [
            'username' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '123456',
        ];

        $this->json('post', '/api/register', $info)
            ->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                  'id',
                  'username',
                  'email',
                  'api_token'
                ]
            ]);
    }





}
