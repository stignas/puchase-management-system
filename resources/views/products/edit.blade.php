<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Edit Supplier</h1>
        <!-- Supplier Edit Form-->
        <form class="text-primary w-50 m-auto" method="POST" action="{{ route('products.update', $product->id) }}"
              id="supplier-create-form">
            @csrf
            @method('put')
            <!-- Name -->
            <div class="form-group row">
                <label for="prod-name">Product Name</label>
                <input class="form-control" id="prod-name" type="text" name="name" required
                       autofocus autocomplete="name" size="40" maxlength="40" value="{{ $product->name }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Product attributes -->
            <div class="border p-3 my-3 row">
                <div class="form-group">
                    <label for="prod-description">Description</label>
                    <textarea class="form-control" id="prod-description" type="text" name="description"
                              autocomplete="description" maxlength="255">{{ $product->description }}</textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="supp-id">Supplier Id</label>
                    <input class="form-control" id="supp-id" type="text" name="supp_id" required
                           autocomplete="supp_id" size="100" maxlength="100" value="{{ $product->supp_id }}">
                    @error('supp_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="prod-cost">Cost</label>
                    <input class="form-control" id="prod-cost" type="number" name="cost" required
                           autocomplete="cost" size="6" min="0" step="0.01" value="{{ $product->cost }}">
                    @error('cost')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="prod-vat">VAT</label>
                    <input class="form-control" id="prod-vat" type="number" name="VAT"
                           autocomplete="vat" size="3" min="0" value="{{ $product->VAT }}">
                    @error('VAT')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Buttons  -->
            <div class="row">
                <a href="{{ route('products.index') }}" class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                <button class="d-block btn btn-info w-25 my-3 m-auto" type="submit">Save</button>
            </div>
        </form>
        <!-- Location Info -->
        @section('current-page')
            Products/Edit
        @endsection
    </div>
</x-app-layout>
