<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\ProjectController;


class Project extends Model
{
    //use HasFactory;

    protected $table = 'projects';
    
    public $primaryKey = 'id';
    protected $fillable =
    [
        'name',
        'description'
    ];
    public $timestamps = true;
}
