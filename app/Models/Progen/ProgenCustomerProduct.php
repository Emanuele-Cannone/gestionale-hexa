<?php

namespace App\Models\Progen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgenCustomerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'progen_customer_id'
    ];

    public function progenCustomer()
    {
        return $this->belongsToMany(ProgenCustomer::class);
    }
}
