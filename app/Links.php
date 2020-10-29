<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $fillable = [
        'links_start',
        'links_finish',
        'count'
    ];
}
