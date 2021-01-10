<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //use HasFactory;

    protected $table = 'teachers';
    
    public $primaryKey = 'id';
    protected $fillable =
    [
        'name',
        'surname',
        'subject'

    ];
    public $timestamps = true;
}
