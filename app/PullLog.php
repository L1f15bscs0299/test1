<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PullLog extends Model
{
    protected $fillable = [
        'server', 'repo', 'branch', 'prefix', 'log', 'status', 'date_time'
    ];
}
