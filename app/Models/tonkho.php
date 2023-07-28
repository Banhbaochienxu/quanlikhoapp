<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonkho extends Model
{
    use HasFactory;
    protected $table = 'tonkho';

    protected $primaryKey = 'id';

    public $timestamps =true;
}
