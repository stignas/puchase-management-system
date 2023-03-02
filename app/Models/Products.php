<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Products extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description',
      'supp_id',
      'cost',
      'VAT'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supp_id');
    }
}
