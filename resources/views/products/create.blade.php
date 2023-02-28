<x-app-layout>
    <div class="container-fluid shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Create Product</h1>
        <!-- Supplier Create Form-->
        <form class="text-primary w-50 m-auto" method="POST" action="{{ route('products.store') }}"
              id="product-create-form">
            @csrf
            <!-- Name -->
            <div class="form-group row">
                <label for="prod-name">Product Name</label>
                <input class="form-control" id="prod-name" type="text" name="name" required
                       autofocus autocomplete="name" size="40" maxlength="40" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Product attributes -->
            <div class="border p-3 my-3 row">
                <div class="form-group">
                    <label for="prod-description">Description</label>
                    <textarea rows="4" class="form-control" id="prod-description" type="text" name="description"
                              autocomplete="description" maxlength="255">{{ old('description') }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="supp-id">Supplier Id</label>
                    <input class="form-control" id="supp-id" type="number" name="supp_id" required
                           autocomplete="supp_id" size="5" maxlength="5" value="{{ old('supp_id') }}">
                    @error('supp_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="prod-cost">Cost</label>
                    <input class="form-control" id="prod-cost" type="number" name="cost" required
                           autocomplete="cost" size="10" min="0" step="0.01" value="{{ old('cost') }}">
                    @error('cost')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="prod-vat">VAT</label>
                    <input class="form-control" id="prod-vat" type="number" name="VAT"
                           autocomplete="vat" size="3" min="0" value="{{ old('VAT', '21') }}">
                    @error('VAT')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="row">
                <a href="{{ route('products.index') }}" class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                <button class="d-block btn btn-info w-25 my-3 m-auto" type="submit">Save</button>
            </div>
        </form>
        <!-- Location Info -->
        @section('current-page')
            Products/Create
        @endsection
    </div>
</x-app-layout>
