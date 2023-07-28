<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhap extends Model
{
    use HasFactory;

    protected $table = 'nhap';

    protected $primaryKey = 'id';

    public $timestamps =true;
}
