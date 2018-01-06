<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;

class LoginTest extends TestCase
{

    use DatabaseMigrations;

    protected $faker;

    public function setUp()
    {
      parent::setUp();
      $this->faker = Faker::create();
    }

    public function test_wrong_username_or_password()
    {

      $wrongInfo = [
        'username' => 'simple wrong',
        'password' => $this->faker->randomNumber(6)
      ];

      $this->json('post', '/api/login', $wrongInfo)
          ->assertStatus(400)
          ->assertJson([
            'message' => 'Wrong Credentials'
          ]);

    }

    public function test_login_is_successful()
    {
      $user = factory('App\User')->create([
          'username' => 'ahmed',
          'password' => bcrypt('123456'),
      ]);

      $info = ['username' => 'ahmed', 'password' => '123456'];
      $this->json('post', '/api/login', $info)
          ->assertStatus(200)
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
