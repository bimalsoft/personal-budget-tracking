<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable =[
        'name',
        'user_id',
        'amount',
        'description',
        'date',
        'receipt'
    ];
}
