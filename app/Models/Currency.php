<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currencies';
    protected $fillable = ['name', 'exchange_rate', 'currency_code'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
