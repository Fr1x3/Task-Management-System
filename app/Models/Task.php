<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     *  The attributes are mass assignable
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date'
    ];


    /**
     *  set the default value of status
     */
    protected $attributes = [
        'status' => 'pending'
    ];
}
