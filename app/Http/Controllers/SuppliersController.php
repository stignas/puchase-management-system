<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObj;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $suppliers = $this->search($search);

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
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();
        Suppliers::create($validated);

        return Redirect::route('suppliers.index')->with('success', 'Supplier successfully created!');
    }

    /**
     * Get the specified resource to update inputs.
     */
    public function get(Request $request): RedirectResponse
    {
        try {
            $supplier = Suppliers::findOrFail($request->suppId);

        } catch (ModelNotFoundException $exception) {
            $message = "Supplier doesn't exist";
        }

        return Redirect::back()->withInput([
            'suppId' => $supplier->id ?? $request->suppId,
            'supp_name' => $supplier->name ?? $message,
            'supp_address' => $supplier->address ?? '',
            'supp_city' => $supplier->city ?? '',
            'supp_country' => $supplier->country ?? '',
            'supp_email' => $supplier->email ?? '',
            'valid' => isset($message) ? 'false' : 'true',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suppliers $supplier): View
    {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suppliers $supplier): RedirectResponse
    {
        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();
        $supplier->update($validated);

        return Redirect::route('suppliers.index')->with('success', 'Supplier successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suppliers $supplier): RedirectResponse
    {
        try {
            $supplier->delete();
            $msg = ['success' => 'Supplier successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete'];
        }
        return Redirect::route('suppliers.index')->with($msg);
    }

    /**
     * Validate input for store and update.
     */
    private function getValidator(Request $request): ValidatorObj
    {
        return Validator::make($request->all(),
            [
                'name' => 'required|max:50',
                'address' => 'required|max:255',
                'city' => 'required|max:100',
                'country' => 'required|max:100',
                "email" => 'email:rfc'
            ]);
    }

    /**
     * Return search results
     */
    public function search(?string $search): LengthAwarePaginator
    {
        if (!empty($search)) {
            $suppliers = Suppliers::query()
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%')
                ->orWhere('country', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
        } else {
            $suppliers = Suppliers::orderBy('updated_at', 'DESC')->paginate(10);
        }

        return $suppliers;
    }
}
