<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
     protected $fillable = [
        'project_name',
        'client_name',
        'project_leader',
        'email' ,
        'photo',
        'start_date',
        'end_date',
        'progress'
     ];

}
