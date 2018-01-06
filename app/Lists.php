<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = 'lists';
    protected $fillable = [
        'title', 'user_id',
    ];

    public function owner()
    {
      return $this->belongsTo('App\User');
    }

    public function items()
    {
      return $this->hasMany('App\Item','list_id');
    }
}
