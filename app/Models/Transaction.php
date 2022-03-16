<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
