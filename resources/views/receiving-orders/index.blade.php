<x-app-layout>
    <div class="container-xl shadow rounded bg-light py-3 my-2">
        <div class="d-flex justify-content-between align-items-center">
            <div class="py-3 text-secondary">
                <h1 class="text-center text-secondary">Purchase Orders</h1>
            </div>
            <div class="py-3">
                <form method="get" action="{{ route('receiving_orders.index') }}" role="search"
                      class="d-flex justify-content-around" id="search-form">
                    @csrf
                    <a class="btn btn-danger m-1" href="{{ route('receiving_orders.index') }}">
                        <img class="svg-light" src="{{ asset('/assets/img/icons/arrow-rotate-left-solid.svg') }}"
                             width="16px" height="16px" alt="arrow">
                    </a>
                    <input class="form-control d-inline-block m-1" name='search'
                           placeholder="Search by name or id.." value="{{ old('search') }}"
                           onchange="document.getElementById('search-form').submit()">
                    <button type="submit" class="btn btn-secondary d-inline-block m-1">Search</button>
                </form>
            </div>
            <div class="py-3">
                <a href="{{ route('receiving_orders.create') }}" class="btn btn-danger disabled">+ Create New</a>
            </div>
        </div>
        <!-- List table -->
        <table class="table table-hover">
            <!-- Table headers -->
            <tr class="bg-dark-subtle">
                <th class="scope-col col-1">RO #</th>
                <th class="scope-col col-1">PO Reference</th>
                <th class="scope-col col-1">Order date</th>
                <th class="scope-col col-1">Actual date</th>
                <th class="scope-col col-3">Supplier Code / Name</th>
                <th class="scope-col col-1">Action</th>
            </tr>
            <!-- Table records -->
            @foreach($receivingOrders as $receivingOrder)
                <tr>
                    <td><a class="text-primary-emphasis text-decoration-none"
                           href="{{ route('receiving_orders.edit', $receivingOrder->id) }}">
                            {{ $receivingOrder->id }}</a></td>
                    <td><a class="text-primary-emphasis text-decoration-none"
                           href="{{ route('purchase_orders.edit', $receivingOrder->po_reference) }}">
                            {{ $receivingOrder->id }}</a></td>
                    <td>{{ $receivingOrder->order_date }}</td>
                    <td>{{ $receivingOrder->actual_date }}</td>
                    <td>{{ $receivingOrder->supplier->id }} // {{ $receivingOrder->supplier->name }}</td>
                    <!-- Action button -->
                    <td>
                        <div class="btn-group dropup">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-dark">
                                <!-- Delete action -->
                                <form method="post" action="{{ route('receiving_orders.destroy', $receivingOrder->id) }}">
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
                                   href="{{ route('receiving_orders.edit', $receivingOrder->id) }}">
                                    <img src="{{ asset('assets/img/icons/pen-to-square-solid.svg') }}" width="20px"
                                         height="20px" alt="pen"
                                         class="p-1 svg-warning">Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $receivingOrders->onEachSide(1)->links() }}
    </div>
    <!-- Location Info -->
    @section('current-page')
        @if(session()->has('success'))
            <span class="text-success">{{ session()->pull('success') }} /</span>
        @endif
        <span>Receiving Orders</span>
    @endsection
</x-app-layout>
