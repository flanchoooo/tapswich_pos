<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Log extends Authenticatable
{

    protected $fillable    =   [];
    protected $guarded      = [];
    protected $table        = 'logs';

}
