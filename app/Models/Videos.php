<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Cursos
{
    use HasFactory;

    protected $hidden = ['direccion','pass','updated_at'];	
}
