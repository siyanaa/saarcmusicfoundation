<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'from_date', 'to_date','vacancy', 'content','image'];

    // Define relationship with Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
