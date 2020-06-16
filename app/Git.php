<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Git extends Model
{
    protected $fillable = [
        'repo_url', 'repo_branch', 'prefix', 'secret_token', 'server_name', 'server_path'
    ];
}
