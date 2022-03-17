<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurring extends Model
{
    use HasFactory;
    protected $table = 'recurrences';
    protected $fillable = ['name', 'start_date', 'end_date'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    use HasFactory;
}
