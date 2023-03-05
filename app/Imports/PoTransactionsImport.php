<?php

namespace App\Imports;

use App\Models\Products;
use App\Models\PurchaseOrders;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class PoTransactionsImport implements ToCollection, WithValidation, SkipsEmptyRows
{
    use SkipsErrors;

    public function __construct(PurchaseOrders $purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $cost = Products::find($row[0])->cost ?? null;
            $this->purchaseOrder->transactions()
                ->create([
                    'supplier_id' => $this->purchaseOrder->supplier->id,
                    'product_id' => $row[0],
                    'quantity' => $row[1],
                    'cost' => $cost,
                    'transactionable_id' => $this->purchaseOrder->id,
                    'transactionable_type' => 'App\Models\PurchaseOrders',
                ]);
        }
    }

    public function rules(): array
    {
        return [
            '0' => Rule::exists('products', 'id'),
            '1' => 'required|numeric|integer|min:1',
        ];
    }

}
