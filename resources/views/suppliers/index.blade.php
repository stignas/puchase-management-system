<x-app-layout>
    <div class="container-xxl shadow rounded bg-light py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="py-3 text-secondary">
                <h1 class="text-center text-secondary">Suppliers</h1>
            </div>
            <div class="py-3">
                <form method="get" action="{{ route('suppliers.index') }}" role="search" class="d-flex justify-contenct-around">
                    @csrf
                    <a class="btn btn-danger m-1" href="{{ route('suppliers.index') }}">
                        <img class="svg-light" src="{{ asset('/assets/img/icons/arrow-rotate-left-solid.svg') }}" width="16px" height="16px">
                    </a>
                    <input class="form-control d-inline-block m-1" name='search'
                           placeholder="Search by name or id.." value="{{ old('search') }}">
                    <button type="submit" class="btn btn-secondary d-inline-block m-1">Search</button>
                </form>
            </div>
            <div class="py-3">
                <a href="{{ route('suppliers.create') }}" class="btn btn-danger">+ Create New</a>
            </div>
        </div>
            <!-- List table -->
            <table class="table table-hover">
                <!-- Table headers -->
                <tr>
                    <th class="scope-col col-1">Supplier #</th>
                    <th class="scope-col col-6">Name</th>
                    <th class="scope-col col-3">Country</th>
                    <th class="scope-col col-3">E-Mail</th>
                    <th class="scope-col col-1">Action</th>
                </tr>
                <!-- Table records -->
                @foreach($suppliers as $supplier)
                    <tr>
                        <td><a class="text-primary-emphasis text-decoration-none"
                               href="{{ route('suppliers.edit', $supplier->id) }}">{{ $supplier->id }}</a></td>
                        <td class="overflow-x-hidden text-truncate">{{ $supplier->name }}</td>
                        <td class="overflow-x-hidden text-truncate">{{ $supplier->country }}</td>
                        <td class="overflow-x-hidden text-truncate">{{ $supplier->email }}</td>
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
                                    <form method="post" action="{{ route('suppliers.delete', $supplier->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link link-danger dropdown-item">
                                            <img src="../assets/img/icons/trash-can-solid.svg" width="20px"
                                                 height="20px"
                                                 class="p-1 svg-danger">Delete
                                        </button>
                                    </form>
                                    <!-- Edit action -->
                                    <a class="dropdown-item link-warning"
                                       href="{{ route('suppliers.edit', $supplier->id) }}">
                                        <img src="../assets/img/icons/pen-to-square-solid.svg" width="20px"
                                             height="20px"
                                             class="p-1 svg-warning">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        {{ $suppliers->links() }}
        </div>
        <!-- Location Info -->
        @section('current-page')
            Suppliers
        @endsection
    </div>
</x-app-layout>
