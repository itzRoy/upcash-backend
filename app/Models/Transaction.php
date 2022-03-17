<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['title', 'amount', 'note', 'category_id', 'currency_id', 'recurring_id'];
    public function categories()
    {
        return $this->belongsTo('App\Category');
    }
    public function recuring()
    {
        return $this->belongsTo('App\Recuring');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    use HasFactory;
}
