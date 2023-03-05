<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
    <x-po-header :purchaseOrder="$purchaseOrder"/>
    <hr>
    <!-- Transactions ----------------------------------------->
    <div class="container shadow rounded bg-light py-3">
        <div class="border w-80 m-auto p-3 my-3 row">
            <table>
                <tr class="row bg-dark-subtle p-2">
                    <th class="scope-col col-md-1">Product #</th>
                    <th class="scope-col col-md-4">Name</th>
                    <th class="scope-col col-md-1">Cost, €</th>
                    <th class="scope-col col-md-1">VAT</th>
                    <th class="scope-col col-md-1">Default Supplier #</th>
                    <th class="scope-col col-md-1">Quantity</th>
                    <th class="scope-col col-md-1">Amount, €</th>
                    <th class="scope-col col-md-1">Delete</th>
                </tr>
                <!-- Populate existing transactions in PO -->
                @if(!empty($purchaseOrder->transactions))

                    @foreach($purchaseOrder->transactions as $transaction)
                        <tr class="row d-flex align-items-center">
                            <td class="scope-col col-md-1">
                                <div class="form-group">
                                    <input name="prod_id" class="form-control my-2"
                                           value="{{ $transaction->product->id }}"
                                           disabled>
                                </div>
                            </td>
                            <td class="scope-col col-md-4">
                                <div class="form-group">
                                    <input name="prod_name" class="form-control my-2"
                                           value="{{ $transaction->product->name }}"
                                           disabled>
                                </div>
                            </td>
                            <td class="scope-col col-md-1">
                                <div class="form-group">
                                    <input name="prod_cost" class="form-control my-2 text-end"
                                           value="{{ $transaction->cost }}"
                                           disabled>
                                </div>
                            </td>
                            <td class="scope-col col-md-1">
                                <div class="form-group">
                                    <input name="prod_vat" class="form-control my-2 text-end"
                                           value="{{ $transaction->product->VAT }}"
                                           disabled>
                                </div>
                            </td>
                            <td class="scope-col col-md-1">
                                <div class="form-group">
                                    <input name="prod_name" class="form-control my-2"
                                           value="{{ $transaction->product->supp_id }}"
                                           disabled>
                                </div>
                            </td>
                            <!-- Transaction Update Form -->
                            <td class="scope-col col-md-1">
                                <form method="post"
                                      action="{{ route('purchase_orders.transactions.update', [$purchaseOrder, $transaction->id]) }}"
                                      id="{{ $transaction->id }}">
                                    @csrf
                                    @method('put')
                                    <input name="product_id" value="{{ $transaction->product->id }}" hidden>
                                    <input name="cost" value="{{ $transaction->cost }}" hidden>
                                    <input name="quantity" class="form-control text-end" id="quantity" type="number"
                                           size="7" maxlength="7"
                                           value="{{ $transaction->quantity }}"
                                           onchange="document.getElementById('{{$transaction->id}}').submit()">
                                </form>
                            </td>
                            <td class="scope-col col-md-1">
                                <input class="form-control text-end"
                                       value="{{ number_format($transaction->cost * $transaction->quantity,2,'.','') }}"
                                       disabled>
                            </td>
                            <!-- Transaction Delete Form -->
                            <td class="scope-col col-md-1">
                                <form class="text-center" method="post"
                                      action="{{ route('purchase_orders.transactions.destroy', [$transaction->transactionable_id, $transaction]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn p-0 m-0 float-right">
                                        <img src="{{ asset('assets/img/icons/trash-can-solid.svg') }}" width="20px"
                                             height="20px" alt="trash"
                                             class="p-1 svg-danger"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <!-- Transaction Create Form -->

                <tr class="row d-flex align-items-center">
                    <td class="col-md-1">
                        <!-- Get Product Parameters Form -->
                        <form class="text-primary"
                              method="post" action="{{ route('products.get') }}" id="get-prod">
                            @csrf
                            <div class="form-group ">
                                <input name="prodId" class="form-control" id="prodId" type="number" required
                                       autocomplete="prodId" size="7" maxlength="7" tabindex="0" autofocus
                                       value="{{ old('prodId') }}"
                                       onchange="document.getElementById('get-prod').submit()">
                            </div>
                            @error('prodId')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </form>
                    </td>
                    <td class="col-md-4">
                        <div class="form-group">
                            <input name="prod_name" class="form-control my-2" value="{{ old('prod_name') }}"
                                   disabled>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <div class="form-group">
                            <input name="prod_cost" class="form-control my-2 text-end" value="{{ old('prod_cost') }}"
                                   disabled>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <div class="form-group">
                            <input name="prod_vat" class="form-control my-2 text-end" value="{{ old('prod_VAT') }}"
                                   disabled>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <div class="form-group">
                            <input name="prod_cost" class="form-control my-2" value="{{ old('prod_supp') }}"
                                   disabled>
                        </div>
                    </td>
                    <!-- Transaction Store Form -->
                    <td class="col-md-1">
                        <form action="{{ route('purchase_orders.transactions.store', $purchaseOrder) }}"
                              method="post"
                              id="create-trans">
                            @csrf
                            <input name="product_id" value="{{ old('prodId') }}" hidden>
                            <input name="quantity" class="form-control text-end" id="quantity" type="number" required
                                   autocomplete="prodId" size="7" maxlength="7" tabindex="0"
                                   onchange="document.getElementById('create-trans').submit()">
                            <input name="cost" value="{{ old('prod_cost') }}" hidden>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @section('current-page')
        @if(session()->has('success'))
            <span class="text-success">{{ session()->pull('success') }}</span> /
        @elseif(session()->has('error'))
            <span class="text-danger">  {{  session()->pull('error') }}</span> /
        @endif
        Purchase Order / Edit
    @endsection
</x-app-layout>

