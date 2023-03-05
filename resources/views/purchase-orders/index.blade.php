<x-app-layout>
    <div class="container-xl shadow rounded bg-light py-3 my-2">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Title -->
            <div class="py-3 text-secondary">
                <h1 class="text-center text-secondary">Purchase Orders</h1>
            </div>
            <!-- Search -->
            <div class="py-3">
                <form method="get" action="{{ route('purchase_orders.index') }}" role="search"
                      class="d-flex justify-content-around" id="search-form">
                    @csrf
                    <a class="btn btn-danger m-1" href="{{ route('purchase_orders.index') }}">
                        <img class="svg-light" src="{{ asset('/assets/img/icons/arrow-rotate-left-solid.svg') }}"
                             width="16px" height="16px" alt="arrow">
                    </a>
                    <input class="form-control d-inline-block m-1" name='search'
                           placeholder="Search by name or id.." value="{{ old('search') }}"
                           onchange="document.getElementById('search-form').submit()">
                    <button type="submit" class="btn btn-secondary d-inline-block m-1">Search</button>
                </form>
            </div>
            <!-- Create New -->
            <div class="py-3">
                <a href="{{ route('purchase_orders.create') }}" class="btn btn-danger">+ Create New</a>
            </div>
        </div>
        <!-- List table -->
        <table class="table table-hover fixed">
            <!-- Table headers -->
            <tr class="bg-dark-subtle">
                <th class="scope-col col-1 text-center">PO #</th>
                <th class="scope-col col-1 text-center">Order date</th>
                <th class="scope-col col-1 text-center">Requested date</th>
                <th class="scope-col col-3">Supplier # / Name</th>
                <th class="scope-col col-1 text-center">VAT, €</th>
                <th class="scope-col col-1 text-center">Amount, €</th>
                <th class="scope-col col-1 text-center">Action</th>
            </tr>
            <!-- Table records -->
            @foreach($purchaseOrders as $purchaseOrder)
                <tr>
                    <td class="text-center"><a class="text-primary-emphasis text-decoration-none"
                           href="{{ route('purchase_orders.edit', $purchaseOrder->id) }}">
                            {{ $purchaseOrder->id }}</a></td>
                    <td class="text-center">{{ $purchaseOrder->order_date }}</td>
                    <td class="text-center">{{ $purchaseOrder->requested_date }}</td>
                    <td>{{ $purchaseOrder->supplier->id }} // {{ $purchaseOrder->supplier->name }}</td>
                    <td class="text-end">{{ $purchaseOrder->totalVAT }}</td>
                    <td class="text-end">{{ $purchaseOrder->total }}</td>
                    <!-- Action button -->
                    <td class="text-center">
                        <div class="btn-group dropup">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-dark">
                                <!-- Delete action -->
                                <form method="post" action="{{ route('purchase_orders.destroy', $purchaseOrder->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link link-danger dropdown-item">
                                        <img src="{{ asset('assets/img/icons/trash-can-solid.svg') }}" width="20px"
                                             height="20px" alt="trash-can"
                                             class="p-1 svg-danger">Delete
                                    </button>
                                </form>
                                <!-- Edit action -->
                                <a class="dropdown-item link-warning"
                                   href="{{ route('purchase_orders.edit', $purchaseOrder->id) }}">
                                    <img src="{{ asset('assets/img/icons/pen-to-square-solid.svg') }}" width="20px"
                                         height="20px" alt="pen"
                                         class="p-1 svg-warning">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <!-- Paginator links -->
        {{ $purchaseOrders->onEachSide(1)->links() }}
    </div>
    <!-- Location Info send to App-layout footer -->
    @section('current-page')
        @if(session()->has('success'))
            <span class="text-success">{{ session()->pull('success') }} /</span>
        @endif
        <span>Purchase Orders</span>
    @endsection
</x-app-layout>
