<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('suppliers.index', ['suppliers' => Suppliers::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:255',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            "email" => 'required|max:320'
        ]);

        $supplier = new Suppliers();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->city = $request->city;
        $supplier->country = $request->country;
        $supplier->email = $request->email;
        $supplier->save();

        return Redirect::route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('suppliers.edit', ['supplier' => Suppliers::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:255',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            "email" => 'required|max:320'
        ]);

        $supplier = Suppliers::findOrFail($id);

        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->city = $request->city;
        $supplier->country = $request->country;
        $supplier->email = $request->email;
        $supplier->save();

        return Redirect::route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Suppliers::findOrFail($id)->delete();
        return Redirect::route('suppliers.index');
    }
}
