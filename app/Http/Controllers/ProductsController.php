<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObj;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $products = $this->search($search);

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
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
        Products::create(array_merge($validated, $request->only('description')));

        return Redirect::route('products.index')->with('success', 'Product successfully created!');
    }

    /**
     * Get the specified resource to update inputs.
     */
    public function get(Request $request): RedirectResponse
    {
        try {
            $product = Products::findOrFail($request->prodId);
        } catch (ModelNotFoundException $exception) {
            $message = "Product doesn't exist";
        }

        return Redirect::back()->withInput([
            'prodId' => $product->id ?? $request->suppId,
            'prod_name' => $product->name ?? $message,
            'prod_cost' => $product->cost ?? '',
            'prod_VAT' => $product->VAT ?? '',
            'prod_supp' => $product->supplier->id ?? '',
            'valid' => isset($message) ? 'false' : 'true',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product): View
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();
        $product->update(array_merge($validated, $request->only('description')));

        return Redirect::route('products.index')->with('success', 'Product successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product): RedirectResponse
    {
        try {
            $product->delete();
            $msg = ['success' => 'Supplier successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete'];
        }
        return Redirect::route('products.index')->with($msg);
    }

    /**
     * Validate input for store and update.
     */
    private function getValidator(Request $request): ValidatorObj
    {

        return Validator::make($request->all(), [
            'name' => 'required|max:40',
            'supp_id' => Rule::exists('suppliers', 'id'),
            'cost' => 'required|numeric',
            'VAT' => 'required|numeric|integer',
        ], [
            'name' => 'Name is required.',
            'supp_id' => "Supplier doesn't exist",
            'cost.required' => 'Cost is required',
            'cost.decimal:2' => 'Must be decimal.',
            'VAT.required' => 'VAT is required',
        ]);
    }

    /**
     * Return search results
     */
    public function search(?string $search): LengthAwarePaginator
    {
        if (!empty($search)) {
            $products = Products::query()
                ->whereHas('supplier', function (Builder $query) use ($search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
        } else {
            $products = Products::orderBy('updated_at', 'DESC')->paginate(10);
        }

        return $products;
    }
}
