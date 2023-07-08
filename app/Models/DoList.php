<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoList extends Model
{
    protected $fillable=['name','time','id_user','status'];
    use HasFactory;
}
