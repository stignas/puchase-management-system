<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        if (isset($search)) {
            $suppliers = Suppliers::query()
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('id','LIKE','%' . $search . '%')
                ->orWhere('city','LIKE', '%' . $search . '%')
                ->orWhere('country','LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $suppliers = Suppliers::paginate(10);
        }

        return view('suppliers.index', ['suppliers' => $suppliers]);
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

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'address' => 'required|max:255',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            "email" => 'email:rfc'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $validated = $validator->validated();

        $supplier = new Suppliers();
        $supplier->name = $validated['name'];
        $supplier->address = $validated['address'];
        $supplier->city = $validated['city'];
        $supplier->country = $validated['country'];
        $supplier->email = $validated['email'];
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'address' => 'required|max:255',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            "email" => 'email:rfc'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $validated = $validator->validated();

        $supplier = Suppliers::findOrFail($id);
        $supplier->name = $validated['name'];
        $supplier->address = $validated['address'];
        $supplier->city = $validated['city'];
        $supplier->country = $validated['country'];
        $supplier->email = $validated['email'];
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
