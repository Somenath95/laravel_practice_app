<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    // Table name
    protected $table = 'posts';

    // Primary key
    public $primaryKey = 'id';

    //Timestamps
    public $timeStamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
