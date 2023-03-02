<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transactions extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'cost',
    ];

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): hasOne
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    public function supplier(): hasOne
    {
        return $this->hasOne(Suppliers::class, 'supplier_id');
    }
}
