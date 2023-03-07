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
    <form class="text-primary form-group"
          action="{{ route('purchase_orders.destroy', $purchaseOrder) }}" method="POST" id="delete-po">
        @csrf
        @method('DELETE')
    </form>
    <div class="text-center w-25 d-flex flex-column">
        <div>
            <button class="btn btn-danger m-1 mb-5 w-100" type="submit" form="delete-po">Delete</button>
        </div>
        <div>
            <a class="btn btn-secondary m-1 w-100 d-block" id="po-btn">Import XLS</a>
            <div class="modal hide" id="po-modal">
                @include('purchase-orders.import')
            </div>
            <a href="{{ route('po-pdf', $purchaseOrder) }}" class="btn btn-primary m-1 w-100 d-block">Download
                PDF</a>
        </div>
        <div>
            <a href="#" class="btn btn-warning m-1 w-100 d-block disabled">Receive</a>
            <a href="{{ route('purchase_orders.index') }}" class="btn btn-success m-1 w-100 d-block">Back to
                List</a>
        </div>
    </div>
</div>
</div>
