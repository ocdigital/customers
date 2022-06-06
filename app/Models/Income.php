<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'customer_id',
        'description',
        'amount',
        'income_date',
        'tax_year',
        'income_file'
    ];

    public function customer()
    {       
        return $this->belongsTo('App\Models\Customer');
    }
}
