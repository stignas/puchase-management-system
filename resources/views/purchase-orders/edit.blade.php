<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <!-- Purchase Order parameters update -->
        <div class="d-flex align-items-center w-75 justify-content-between m-auto h-100">
            <div class="flex-grow-1">
                <form class="text-primary form-group mx-5" method="post"
                      action="{{ route('purchase_orders.update', $purchaseOrder) }}" id="po-update-form">
                    @csrf
                    @method('PUT')
                    <div class="border p-3 my-3 row d-flex align-items-center">
                        <h1 class="text-center text-secondary">PO #{{ $purchaseOrder->id }}</h1>
                        <div class="form-group col-md-4">
                            <label for="poDate">Order date</label>
                            <input name="order_date" class="form-control" id="poDate"
                                   value="{{ $purchaseOrder->order_date }}"
                                   onchange="document.getElementById('po-update-form').submit()">
                        </div>
                        @error('order_date')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group col-md-4">
                            <label for="requestedDate">Requested date</label>
                            <input name="requested_date" class="form-control" id="requestedDate"
                                   value="{{ $purchaseOrder->requested_date }}"
                                   onchange="document.getElementById('po-update-form').submit()">
                        </div>
                        @error('requested_date')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group col-md-4">
                            <label for="paymentTerms">Payment terms, days</label>
                            <input name="payment_terms" class="form-control" id="paymentTerms"
                                   value="{{ $purchaseOrder->payment_terms }}"
                                   onchange="document.getElementById('po-update-form').submit()">
                        </div>
                        @error('payment_terms')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
                <!-- Supplier Info -->
                <div class="text-primary mx-5 form-group">
                    <div class="border p-3 my-3 row d-flex align-items-center">
                        <div class="form-group col-md-3">
                            <label for="supp_id">Supplier #</label>
                            <input name="supp_id" class="form-control my-2" value="{{ $purchaseOrder->supplier->id }}"
                                   disabled id="supp_id">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="supp_name">Supplier Name</label>
                            <input name="supp_name" class="form-control my-2"
                                   value="{{ $purchaseOrder->supplier->name }}"
                                   disabled id="supp_name">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button area -->
            <div class="text-center">
                <form class="text-primary form-group"
                      action="{{ route('purchase_orders.destroy', $purchaseOrder) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-block m-1 w-100" type="submit">Delete</button>
                </form>
                <a href="{{ route('generate-pdf', $purchaseOrder) }}" class="btn btn-primary btn-block m-1 w-100">Print</a>
                <a href="{{ route('purchase_orders.index') }}" class="btn btn-success btn-block m-1 w-100">Save</a>
            </div>
        </div>
    </div>
    <hr>
    <!-- Transactions -->
    <div class="container shadow rounded bg-light py-3">
        <div class="border w-80 m-auto p-3 my-3 row">
            <table>
                <tr class="row bg-dark-subtle p-2">
                    <th class="scope-col col-md-2">Product #</th>
                    <th class="scope-col col-md-4">Name</th>
                    <th class="scope-col col-md-1">Cost, €</th>
                    <th class="scope-col col-md-1">VAT</th>
                    <th class="scope-col col-md-1">Default Supplier #</th>
                    <th class="scope-col col-md-1">Quantity</th>
                    <th class="scope-col col-md-1">Delete</th>
                </tr>
                <!-- Populate existing transactions in PO -->
                @if(!empty($purchaseOrder->transactions))

                    @foreach($purchaseOrder->transactions as $transaction)
                        <tr class="row d-flex align-items-center">
                            <td class="scope-col col-md-2">
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
                                    <input name="prod_cost" class="form-control my-2" value="{{ $transaction->cost }}"
                                           disabled>
                                </div>
                            </td>
                            <td class="scope-col col-md-1">
                                <div class="form-group">
                                    <input name="prod_vat" class="form-control my-2"
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
                                    <input name="quantity" class="form-control" id="quantity" type="number"
                                           size="7" maxlength="7"
                                           value="{{ $transaction->quantity }}"
                                           onchange="document.getElementById('{{$transaction->id}}').submit()">
                                </form>
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
                    <td class="col-md-2">
                        <!-- Get Product Parameters Form -->
                        <form class="text-primary"
                              method="post" action="{{ route('products.get', $purchaseOrder) }}" id="get-prod">
                            @csrf
                            <div class="form-group ">
                                <input name="prodId" class="form-control" id="prodId" type="number" required
                                       autocomplete="prodId" size="7" maxlength="7"
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
                            <input name="prod_cost" class="form-control my-2" value="{{ old('prod_cost') }}"
                                   disabled>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <div class="form-group">
                            <input name="prod_vat" class="form-control my-2" value="{{ old('prod_VAT') }}"
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
                            <input name="quantity" class="form-control" id="quantity" type="number" required
                                   autofocus autocomplete="prodId" size="7" maxlength="7"
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
        Purchase Orders >> Transactions / Create
    @endsection
</x-app-layout>

