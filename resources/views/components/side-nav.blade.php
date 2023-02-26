<div>
    <nav class="nav nav-fill flex-column">
        <a class="nav-link d-flex btn my-2 filter {{ (Route::currentRouteName() == 'dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <img src="./assets/img/icons/chart-line-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Dashboard</span>
        </a>

        <a class="nav-link d-flex btn my-2 filter" href="#">
            <img src="./assets/img/icons/file-lines-regular.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Purchase Order</span>
        </a>

        <a class="nav-link d-flex btn my-2 filter" href="#">
            <img src="./assets/img/icons/boxes-packing-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Receiving</span>
        </a>

        <a class="nav-link d-flex btn my-2 filter" href="#">
            <img src="./assets/img/icons/clock-rotate-left-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Backorder</span>
        </a>

        <a class="nav-link d-flex btn my-2 filter disabled" href="#">
            <img src="./assets/img/icons/receipt-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Complaints</span>
        </a>
    </nav>
</div>
<hr>
<div>
    <nav class="nav nav-fill flex-column">
        <a class="nav-link d-flex btn my-2 filter" href="#">
            <img src="./assets/img/icons/warehouse-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Supplier List</span>
        </a>
        <a class="nav-link d-flex btn my-2 filter" href="#">
            <img src="./assets/img/icons/table-list-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">Item List</span>
        </a>
        <a class="nav-link d-flex btn my-2 filter disabled" href="#">
            <img src="./assets/img/icons/users-solid.svg" width="20px" height="20px" class="svg">
            <span class="mx-2">User List</span>
        </a>
    </nav>
</div>
