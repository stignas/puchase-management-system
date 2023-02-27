<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <div class="container shadow rounded bg-light py-3">
            <div class="py-3 float-start text-secondary">
                <h1 class="text-center text-secondary">Suppliers</h1>
            </div>
            <div class="py-3 float-end">
                <a href="{{ route('suppliers.create') }}" class="btn btn-danger">+ Create New</a>
            </div>
            <!-- List table -->
            <table class="table table-striped">
                <!-- Table headers -->
                <tr>
                    <th class="scope-col">Supplier #</th>
                    <th class="scope-col">Name</th>
                    <th class="scope-col">E-Mail</th>
                    <th class="scope-col">Action</th>
                </tr>
                <!-- Table records -->
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
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
        </div>
        <!-- Location Info -->
        @section('current-page')
            Suppliers
        @endsection
    </div>
</x-app-layout>
