<?php

namespace App\Http\Controllers;

use App\Models\ReceivingOrders;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator as ValidatorObj;
use Illuminate\View\View;

class ReceivingOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        if (isset($search)) {
            $receivingOrders = ReceivingOrders::query()
                ->whereHas('purchase_order', function (Builder $query) use ($search) {
                    return $query
                        ->Where('id', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('supplier', function (Builder $query) use ($search) {
                    return $query
                        ->Where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhere('order_date', 'LIKE', '%' . $search . '%')
                ->orWhere('actual_date', 'LIKE', '%' . $search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $receivingOrders = ReceivingOrders::paginate(10);
        }
        return view('receiving-orders.index', ['receivingOrders' => $receivingOrders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceivingOrders $receivingOrder): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReceivingOrders $receivingOrder): View
    {
        return view('receiving_orders.edit', $receivingOrder, ['receivingOrder' => $receivingOrder]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceivingOrders $receivingOrder): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $validated = $validator->validated();

        $receivingOrder->update($validated);

        return Redirect::route('receiving_orders.edit', $receivingOrder)->with('success', 'Receiving successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceivingOrders $receivingOrder): RedirectResponse
    {
        try {
            $receivingOrder->transactions()->delete();
            $receivingOrder->delete();
            $msg = ['success' => 'Supplier successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete'];
        }
        return Redirect::route('receiving_orders.index')->with($msg);
    }

    private function getValidator(Request $request): ValidatorObj
    {
        return Validator::make($request->all(), [
            'supp_id' => Rule::exists('suppliers', 'id'),
            'order_date' => 'required|date',
            'actual_date' => 'required|date',
            'po_reference' => Rule::exists('purchase_orders', 'id'),
        ], [
            'supp_id' => "Supplier doesn't exist",
            'order_date' => "Order date is required",
            'actual_date' => "Actual receive date required",
            'po_reference' => "Purchase Order doesn't exist",
        ]);
    }

//    public function generatePDF(ReceivingOrders $receivingOrder): Response
//    {
//        $transactions = [];
//        $products = [];
//        foreach ($receivingOrder->transactions as $transaction) {
//            $transactions[] = $transaction;
//            $products[] = $transaction->product;
//        }
//
//        $data = array_merge($receivingOrder->toArray());
//        $data = view()->share('data', $data);
//
//        $pdf = PDF::loadView('ro-pdf', $data);
//
//        return $pdf->download('ro' . $receivingOrder->id . '.pdf');
//    }
}
