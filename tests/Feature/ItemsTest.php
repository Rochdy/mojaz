<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ItemsTest extends TestCase
{
  use DatabaseMigrations;

  public function test_user_can_add_item_list()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $info = [
      'api_token' => $user->api_token,
      'body' => 'new item'
    ];
    $this->json('post', "api/list/{$list->id}/item", $info)
        ->assertJson(['id' => 1, 'body' => 'new item'])
        ->assertStatus(201);
  }

  public function test_user_can_edit_item_list()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $item = factory('App\Item')->create(['list_id' => $list->id]);
    $info = [
      'api_token' => $user->api_token,
      'body' => 'edited item'
    ];
    $this->json('put', "api/list/{$list->id}/item/{$item->id}/edit", $info)
        ->assertJson(['id' => 1, 'body' => 'edited item'])
        ->assertStatus(200);
  }

  public function test_user_can_delete_item_list()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $item = factory('App\Item')->create(['list_id' => $list->id]);
    $info = [
      'api_token' => $user->api_token,
    ];
    $this->json('delete', "api/list/{$list->id}/item/{$item->id}/delete", $info)
        ->assertStatus(204);
  }

}
