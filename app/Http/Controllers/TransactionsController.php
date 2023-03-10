<?php

namespace App\Http\Controllers;

use App\Imports\PoTransactionsImport;
use App\Models\PurchaseOrders;
use App\Models\Transactions;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator as ValidatorObj;
use Maatwebsite\Excel\Facades\Excel;

class TransactionsController extends Controller
{

    public function import(Request $request, PurchaseOrders $purchaseOrder): RedirectResponse
    {
        $import = new PoTransactionsImport($purchaseOrder);

        try {
            Excel::import($import, $request->file('file'));
            $msg = ['success' => 'Uploaded'];
        } catch (\Exception $e) {
            $msg = ['error' => 'Upload failed'];
        }

        return Redirect::back()->with($msg);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PurchaseOrders $purchaseOrder): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::route('purchase_orders.edit', $purchaseOrder)->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();

        $purchaseOrder
            ->transactions()
            ->create(array_merge([
                'supplier_id' => $purchaseOrder->supplier->id,
                'transactionable_id' => $purchaseOrder->id,
                'transactionable_type' => 'App\Models\PurchaseOrders',
            ], $validated));

        return Redirect::route('purchase_orders.edit', $purchaseOrder)
            ->with('success', 'Product added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseOrders $purchaseOrder, Transactions $transaction, Request $request): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();
        $transaction->updateOrFail($validated);

        return Redirect::back()->with(['success' => 'Transaction updated!', 'purchaseOrder' => $purchaseOrder]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($orderId, Transactions $transaction): RedirectResponse
    {

        try {
            $transaction->delete();
            $msg = ['success' => 'Transaction successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete.'];
        }
        return Redirect::back()->with($msg);
    }


    public function getValidator(Request $request): ValidatorObj
    {
        return Validator::make($request->all(), [
            'product_id' => Rule::exists('products', 'id'),
            'quantity' => 'required|numeric|integer|min:1',
            'cost' => 'required|decimal:2'

        ], [
            'product_id' => "Product doesn't exist",
            'quantity' => "Must be integer",
            'cost.required' => 'Cost is required',
            'cost.decimal:2' => 'Must be decimal.',
        ]);
    }
}
