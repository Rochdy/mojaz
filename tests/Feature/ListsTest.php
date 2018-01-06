<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListsTest extends TestCase
{
  use DatabaseMigrations;

  public function test_lists_listed_successfully()
  {
     $user = factory('App\User')->create();
     $lists = factory('App\Lists', 10)->create(['user_id' => $user->id]);
     $info = [
       'api_token' => $user->api_token,
     ];
     $this->json('post', 'api/list', $info)
         ->assertJson($lists->toArray());
  }

  public function test_list_created_successfully()
  {
    $user = factory('App\User')->create();
    $info = [
      'api_token' => $user->api_token,
      'title' => 'new list test'
    ];
    $this->json('post', 'api/list/create', $info)
        ->assertJson(['id' => 1, 'title' => 'new list test'])
        ->assertStatus(201);
  }

  public function test_single_list_items_shown_successfully()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $items = factory('App\Item', 10)->create(['list_id' => $list->id]);

    $info = [
      'api_token' => $user->api_token,
    ];
    $this->json('post', "api/list/{$list->id}", $info)
        ->assertJson($items->toArray());
  }

  public function test_list_edited_successfully()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $list->update([
      'title' => 'edited title'
    ]);
    $info = [
      'api_token' => $user->api_token,
    ];
    $this->json('put', "api/list/{$list->id}/edit", $info)
        ->assertJson([
          'title' => 'edited title',
        ])
        ->assertStatus(200);
  }

  public function test_list_deleted_successfully()
  {
    $user = factory('App\User')->create();
    $list = factory('App\Lists')->create(['user_id' => $user->id]);
    $info = [
      'api_token' => $user->api_token,
    ];
    $this->json('delete', "api/list/{$list->id}/delete", $info)
        ->assertStatus(204);
  }

}
