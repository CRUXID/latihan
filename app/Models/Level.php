<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table = 'level';
    protected $primaryKey = 'id_level';

    public function user() {
        return $this->hasMany('App\Models\User', 'id_level');
    }
}
