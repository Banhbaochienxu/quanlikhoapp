<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hanghoa extends Model
{
    use HasFactory;

    protected $table='hanghoa';

    protected $primaryKey = 'id';

    public $timestamps =true;
}
