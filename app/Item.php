<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

  protected $fillable = [
      'body', 'list_id',
  ];

  public function list()
  {
    return $this->belongsTo('App\Lists');
  }
}
