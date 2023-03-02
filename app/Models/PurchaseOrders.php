<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrders extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'supp_id',
        'order_date',
        'requested_date',
        'payment_terms'
    ];

    public function supplier(): HasOne
    {
        return $this->hasOne(Suppliers::class, 'id', 'supp_id');
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transactions::class, 'transactionable');
    }
}
