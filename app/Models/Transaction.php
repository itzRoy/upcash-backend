<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['title', 'amount', 'note', 'category_id', 'currency_id', 'recurring_id'];


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function recurring()
    {
        return $this->belongsTo('App\Models\Recurring');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }
    use HasFactory;
}
