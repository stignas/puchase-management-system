<div>
    <nav class="nav nav-fill flex-column">
        <a class="nav-link d-flex btn my-2 link-warning nav-item
        {{ (str_contains(Route::currentRouteName(), 'dashboard')) ? 'active' : '' }}"
           href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/icons/chart-line-solid.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="chart">
            <span class="mx-2">Dashboard</span>
        </a>

        <a class="nav-link d-flex btn my-2 link-warning nav-item
        {{ (str_contains(Route::currentRouteName(), 'purchase_orders')) ? 'active' : '' }}"
           href="{{ route('purchase_orders.index') }}">
            <img src="{{ asset('assets/img/icons/file-lines-regular.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="file">
            <span class="mx-2">Purchase</span>
        </a>

        <a class="nav-link d-flex btn my-2 link-warning nav-item disabled
        {{ (str_contains(Route::currentRouteName(), 'receiving_orders')) ? 'active' : '' }}"
           href="{{ route('receiving_orders.index') }}">
            <img src="{{ asset('assets/img/icons/boxes-packing-solid.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="boxes">
            <span class="mx-2">Receiving</span>
        </a>

        <a class="nav-link d-flex btn my-2 link-warning nav-item disabled" href="#">
            <img src="{{ asset('assets/img/icons/clock-rotate-left-solid.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="clock">
            <span class="mx-2">Backorder</span>
        </a>

        <a class="nav-link d-flex btn my-2 link-warning nav-item disabled" href="#">
            <img src="{{ asset('assets/img/icons/receipt-solid.svg') }}" width="20px" height="20px" class="svg-warning"
                 alt="receipt">
            <span class="mx-2">Complaints</span>
        </a>
    </nav>
</div>
<hr>
<div>
    <nav class="nav nav-fill flex-column">
        <a class="nav-link d-flex btn my-2 link-warning nav-item
        {{ (str_contains(Route::currentRouteName(), 'suppliers.')) ? 'active' : '' }}"
           href="{{ route('suppliers.index') }}">
            <img src="{{ asset('assets/img/icons/warehouse-solid.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="warehouse">
            <span class="mx-2">Suppliers</span>
        </a>
        <a class="nav-link d-flex btn my-2 link-warning nav-item
        {{ (str_contains(Route::currentRouteName(), 'products.')) ? 'active' : '' }}"
           href="{{ route('products.index') }}">
            <img src="{{ asset('assets/img/icons/table-list-solid.svg') }}" width="20px" height="20px"
                 class="svg-warning" alt="table">
            <span class="mx-2">Products</span>
        </a>
        <a class="nav-link d-flex btn my-2 link-warning nav-item disabled" href="#">
            <img src="{{ asset('assets/img/icons/users-solid.svg') }}" width="20px" height="20px" class="svg-warning"
                 alt="users">
            <span class="mx-2">Users</span>
        </a>
    </nav>
</div>
