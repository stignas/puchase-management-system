<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Create Supplier</h1>
        <!-- Supplier Create Form-->
        <form class="text-primary w-50 m-auto" method="POST" action="{{ route('suppliers.store') }}"
              id="supplier-create-form">
            @csrf
            <!-- Name -->
            <div class="form-group row">
                <label for="supp-name">Supplier Name</label>
                <input class="form-control" id="supp-name" type="text" name="name" required
                       autofocus autocomplete="name" size="50" maxlength="50" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Address -->
            <div class="border p-3 my-3 row">
                <div class="form-group">
                    <label for="supp-address">Street Address</label>
                    <input class="form-control" id="supp-address" type="text" name="address" required
                           autocomplete="address" size="255" maxlength="255" value="{{ old('address') }}">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="supp-city">City</label>
                    <input class="form-control" id="supp-city" type="text" name="city" required
                           autocomplete="city" size="100" maxlength="100" value="{{ old('city') }}">
                    @error('city')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="supp-country">Country</label>
                    <input class="form-control" id="supp-country" type="text" name="country" required
                           autocomplete="country" size="100" maxlength="100" value="{{ old('country') }}">
                    @error('country')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <!-- E-mail -->
            <div class="border p-3 my-3 row">
                <div class="form-group col-md-6">
                    <label for="supp-email">E-mail</label>
                    <input class="form-control" id="supp-email" type="email" name="email" required
                           autocomplete="email" size="100" maxlength="320" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Buttons -->
            <div class="row">
                <a href="{{ route('suppliers.index') }}" class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                <button class="d-block btn btn-info w-25 my-3 m-auto" type="submit">Save</button>
            </div>
        </form>
        <!-- Location Info -->
        @section('current-page')
            Suppliers / Create
        @endsection
    </div>
</x-app-layout>
