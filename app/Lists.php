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
      $this->belongsTo('App\User');
    }
}
