<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivingOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'supp_id',
        'order_date',
        'actual_date',
        'po_reference',
        'supplier_so',
    ];

    public function supplier(): HasOne
    {
        return $this->hasOne(Suppliers::class, 'id', 'supp_id');
    }

    public function purchaseOrder(): HasOne
    {
    return $this->hasOne(PurchaseOrders::class,'id','po_reference');
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transactions::class, 'transactionable');
    }
}
