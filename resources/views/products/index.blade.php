<x-app-layout>
    <div class="container-fluid shadow rounded bg-light py-3">
            <div class="py-3 float-start text-secondary">
                <h1 class="text-center text-secondary">Products</h1>
            </div>
            <div class="py-3 float-end">
                <a href="{{ route('products.create') }}" class="btn btn-danger">+ Create New</a>
            </div>
            <!-- List table -->
            <table class="table table-hover">
                <!-- Table headers -->
                <tr class="bg-dark-subtle">
                    <th class="scope-col col-1">Product #</th>
                    <th class="scope-col col-3">Name</th>
                    <th class="scope-col col-3">Description</th>
                    <th class="scope-col col-3">Supplier Code / Name</th>
                    <th class="scope-col col-1">Cost, €</th>
                    <th class="scope-col col-1">Action</th>
                </tr>
                <!-- Table records -->
                @foreach($products as $product)

                    <tr>
                        <td><a class="text-primary-emphasis text-decoration-none"
                               href="{{ route('products.edit', $product->id) }}">
                                {{ $product->id }}</a></td>
                        <td class="overflow-x-hidden text-truncate">{{ $product->name }}</td>
                        <td class="overflow-x-hidden text-truncate">{{ $product->description }}</td>
                        <td class="text-truncate">{{ $product->supplier->id }} / {{ $product->supplier->name }}</td>
                        <td>{{ $product->cost }}</td>

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
                                    <form method="post" action="{{ route('products.delete', $product->id) }}">
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
                                       href="{{ route('products.edit', $product->id) }}">
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
            Products
        @endsection
    </div>
</x-app-layout>
