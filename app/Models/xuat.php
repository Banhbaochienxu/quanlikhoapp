<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuat extends Model
{
    use HasFactory;

    protected $table ='xuat';

    protected $primaryKey = 'id';

    public $timestamps =true;
}
