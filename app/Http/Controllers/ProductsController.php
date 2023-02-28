<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
        if (isset($search)) {
            $products = Products::query()
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $products = Products::paginate(10);
        }

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'supp_id' => Rule::exists('suppliers', 'id')->withoutTrashed(),
            'cost' => 'required',
            'VAT' => 'required',
        ], [
            'name' => 'Name is required.',
            'supp_id' => "Supplier doesn't exist",
            'cost' => 'Cost is required',
            'VAT' => 'VAT is required.',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $validated = $validator->validated();

        $product = new Products();
        $product->name = $validated['name'];
        $product->description = $request->description;
        $product->supp_id = $validated['supp_id'];
        $product->cost = number_format($validated['cost'], 2, '.', '');
        $product->VAT = $request->VAT;
        $product->save();

        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('products.edit', ['product' => Products::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'supp_id' => Rule::exists('suppliers', 'id')->withoutTrashed(),
            'cost' => 'required',
        ], [
            'name' => 'Name is required.',
            'supp_id' => "Supplier doesn't exist",
            'cost' => 'Cost is required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $validated = $validator->validated();

        $product = Products::findOrFail($id);
        $product->name = $validated['name'];
        $product->description = $request->description;
        $product->supp_id = $validated['supp_id'];
        $product->cost = number_format($validated['cost'], 2, '.', '');
        $product->VAT = $request->VAT;
        $product->save();

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Products::findOrFail($id)->delete();
        return Redirect::route('products.index');
    }
}
