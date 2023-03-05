<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Purchase Order Header</h1>
        <!-- Create Purchase Order Header -->

        <!-- Form to get supplier parameters and update inputs -->
        <form class="text-primary w-50 m-auto form-group" method="post"
              action="{{ route('suppliers.get') }}" id="get-supp">
            @csrf
            <label for="supp-id">Supplier</label>
            <div class="border p-3 my-3 row d-flex align-items-center">
                <div class="form-group col-md-3">
                    <input name="suppId" class="form-control" id="suppId" type="number" required
                           autofocus autocomplete="suppId" size="7" maxlength="7" value="{{ old('suppId') }}"
                           placeholder="Enter code.."
                           onchange="document.getElementById('get-supp').submit()">
                </div>
                @error('supp_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group col-md-9">
                    <input name="supp_name" class="form-control my-2" value="{{ old('supp_name') }}" disabled>
                </div>
            </div>
        </form>
        @if(old('valid') === 'true')
            <div class="text-primary w-50 m-auto form-group">
                <div class="border p-3 my-3 row">
                    <div class="form-group">
                        <label for="supp_address">Street Address</label>
                        <input name="supp_address" class="form-control" id="supp_address"
                               value="{{ old('supp_address') }}"
                               disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="supp_city">City</label>
                        <input name="supp_city" class="form-control" id="supp_city" value="{{ old('supp_city') }}"
                               disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="supp_country">Country</label>
                        <input name="supp_country" class="form-control" id="supp_country"
                               value="{{ old('supp_country') }}"
                               disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="supp_email">E-mail</label>
                        <input name="supp_email" class="form-control" id="supp_email" value="{{ old('supp_email') }}"
                               disabled>
                    </div>
                </div>
            </div>

            <!-- Purchase Order Attributes / Submit form -->
            <form class="text-primary w-50 m-auto" method="POST" action="{{ route('purchase_orders.store') }}"
                  id="supplier-create-form">
                @csrf
                <!-- Supplier ID -->
                <input type="hidden" name="supp_id" value="{{ old('suppId') }}">
                <!-- Order Date -->
                <div class="border p-3 my-3 row">
                    <div class="form-group col-md-4">
                        <label for="order_date">Order Date</label>
                        <input name="order_date" class="form-control" id="order_date" type="date"
                               value="{{ old('order_date') }}">
                    </div>
                    @error('order_date')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <!-- Requested (delivery) Date -->
                    <div class="form-group col-md-4">
                        <label for="requested_date">Requested Date</label>
                        <input name="requested_date" class="form-control" id="order_date" type="date"
                               value="{{ old('requested_date') }}">
                    </div>
                    @error('requested_date')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <!-- Payment terms, default = 0 -->
                    <div class="form-group col-md-4">
                        <label for="payment_terms">Payment Term</label>
                        <input name="payment_terms" class="form-control" id="payment_terms" type="number"
                               min="0"
                               value="{{ old('payment_terms', 0) }}">
                    </div>
                    @error('payment_terms')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Buttons -->
                <div class="row">
                    <a href="{{ route('purchase_orders.index') }}"
                       class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                    <button class="d-block btn btn-info w-25 my-3 m-auto" type="submit">Next</button>
                </div>
            </form>
        @else
            <div class="m-auto text-center w-50">
                <a href="{{ route('purchase_orders.index') }}" class="btn btn-success m-1 w-25">Back to
                    List</a>
            </div>
        @endif
        <!-- Location Info -->
        @section('current-page')
            @if(session()->has('error') || session()->has('success'))
                <p class="alert alert-danger">{{ session()->pull('error') }} / {{ session()->pull('success') }}</p>
            @endif
            Purchase Orders / Create
        @endsection
    </div>
</x-app-layout>
