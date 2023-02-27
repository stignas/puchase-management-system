<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
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
    public function show(products $products): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products): RedirectResponse
    {
        //
    }
}
