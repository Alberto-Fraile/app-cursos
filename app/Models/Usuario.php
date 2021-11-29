<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $hidden = ['email'];

    public function curso(){
    	return $this->belongsTo(Curso::class)
    }
}
