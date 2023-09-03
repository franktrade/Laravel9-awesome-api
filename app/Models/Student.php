<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // Use 'students' (plural) as the table name, not 'Student' (singular).

    protected $fillable = [
        'name', 'course', 'email', 'phone'
    ];
}
