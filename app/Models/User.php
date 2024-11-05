<?php

namespace App\Models;



use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
 * This class is dedicated to be used as Admin on Filament Panel
 */
class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
