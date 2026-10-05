<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Expense extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'expenses';

    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'category',
        'expense_date',
        'note',
    ];

    protected $casts = [
        'amount' => 'float',
        'expense_date' => 'date',
    ];
}