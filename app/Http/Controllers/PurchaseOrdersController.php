<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrders;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObj;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $purchaseOrders = $this->search($search);
        foreach ($purchaseOrders as $purchaseOrder) {
            self::getPoTotals($purchaseOrder);
        }

        return view('purchase-orders.index', ['purchaseOrders' => $purchaseOrders]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('purchase-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();

        $purchaseOrder = PurchaseOrders::create(array_merge(['type' => 'PO'], $validated));

        return Redirect::route('purchase_orders.edit', $purchaseOrder);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrders $purchaseOrder): RedirectResponse
    {
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrders $purchaseOrder): View
    {
        return view('purchase-orders.edit', $purchaseOrder, ['purchaseOrder' => $purchaseOrder]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrders $purchaseOrder): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $validated = $validator->validated();

        $purchaseOrder->update($validated);

        return Redirect::route('purchase_orders.edit', $purchaseOrder)->with('success', 'Header successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrders $purchaseOrder): RedirectResponse
    {
        try {
            $purchaseOrder->transactions()->delete();
            $purchaseOrder->delete();
            $msg = ['success' => 'Purchase Order successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete'];
        }
        return Redirect::route('purchase_orders.index')->with($msg);
    }

    /**
     * Validate request inputs
     */

    private function getValidator(Request $request): ValidatorObj
    {
        return Validator::make($request->all(), [
            'supp_id' => Rule::exists('suppliers', 'id'),
            'order_date' => 'required|date',
            'requested_date' => 'required|date|after_or_equal:order_date',
            'payment_terms' => 'numeric|integer'
        ], [
            'supp_id' => "Supplier doesn't exist",
            'order_date' => 'Order date is required',
            'requested_date.after' => 'Must be later/equal to order date.'
        ]);
    }


    /**
     *  Genera and download PDF
     */
    public function generatePDF(PurchaseOrders $purchaseOrder): Response
    {

        $this->getPoTotals($purchaseOrder);
        $purchaseOrder->supplier->toArray();
        $data = array_merge($purchaseOrder->toArray());
        $data = view()->share('data', $data);

        $pdf = PDF::loadView('po-pdf', $data);

        return $pdf->download('po' . $purchaseOrder->id . '.pdf');
    }

    /**
     * Calculate specified PO amount, VAT, Totals.
     */

    private static function getPoTotals(PurchaseOrders $purchaseOrder): PurchaseOrders
    {
        foreach ($purchaseOrder->transactions as $transaction) {
            $amount = $transaction->quantity * $transaction->cost;
            $vatAmount = $amount * $transaction->product->VAT / 100;
            $transaction['amount'] = $amount;
            $transaction['amountVAT'] = $vatAmount;
            $purchaseOrder['total'] += $amount;
            $purchaseOrder['totalVAT'] += $vatAmount;
        }
        // Format to string for display
        $purchaseOrder->total = self::formatFloat($purchaseOrder->total);
        $purchaseOrder->totalVAT = self::formatFloat($purchaseOrder->totalVAT);

        return $purchaseOrder;
    }

    /**
     * Format float numbers properly for printing.
     */

    private static function formatFloat(?float $float): string
    {
        return number_format($float, 2, '.', '');
    }

    /**
     * Return search results
     */
    public function search(?string $search)
    {
        if (!empty($search)) {
            $purchaseOrders = PurchaseOrders::query()
                ->whereHas('supplier', function (Builder $query) use ($search) {
                    return $query
                        ->Where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhere('order_date', 'LIKE', '%' . $search . '%')
                ->orWhere('requested_date', 'LIKE', '%' . $search . '%')
                ->orderBy('order_date', 'DESC')
                ->paginate(10);
        } else {
            $purchaseOrders = PurchaseOrders::paginate(10);
        }
        return $purchaseOrders;
    }
}
