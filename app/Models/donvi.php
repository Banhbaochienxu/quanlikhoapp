<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donvi extends Model
{
    use HasFactory;

    protected $table = 'donvi';

    protected $primaryKey = 'id';

    public $timestamps =true;
}
