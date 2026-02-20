<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nombre de la tabla existente
    protected $table = 'users';

    // Columnas que se pueden llenar masivamente
    protected $fillable = [
        'document_type_id',
        'document_number',
        'name',
        'lastname',
        'phone',
        'email',
        'rol_id',
        'status',
        'password',
    ];

    // Ocultar campos sensibles en JSON
    protected $hidden = [
        'password',
    ];
}