<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
 * This class is dedicated to be used as Admin on Filament Panel
 */
class User extends Authenticatable
{
    use Notifiable;
}
