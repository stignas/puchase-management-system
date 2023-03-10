<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Edit Supplier</h1>
        <!-- Supplier Edit Form-->
        <form class="text-primary w-50 m-auto" method="POST" action="{{ route('suppliers.update', $supplier->id) }}"
              id="supplier-create-form">
            @csrf
            @method('put')
            <!-- Name -->
            <div class="form-group row">
                <label for="supp-name">Supplier Name</label>
                <input class="form-control" id="supp-name" type="text" name="name" required
                       autofocus autocomplete="name" size="50" maxlength="50" value="{{ $supplier->name }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- Address -->
            <div class="border p-3 my-3 row">
                <div class="form-group">
                    <label for="supp-address">Street Address</label>
                    <input class="form-control" id="supp-address" type="text" name="address" required
                           autocomplete="address" size="255" maxlength="255" value="{{ $supplier->address }}">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="supp-city">City</label>
                    <input class="form-control" id="supp-city" type="text" name="city" required
                           autocomplete="city" size="100" maxlength="100" value="{{ $supplier->city }}">
                    @error('city')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="supp-country">Country</label>
                    <input class="form-control" id="supp-country" type="text" name="country" required
                           autocomplete="country" size="100" maxlength="100" value="{{ $supplier->country }}">
                    @error('country')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Email -->
            <div class="border p-3 my-3 row">
                <div class="form-group col-md-6">
                    <label for="supp-email">E-mail</label>
                    <input class="form-control" id="supp-email" type="email" name="email" required
                           autocomplete="email" size="100" maxlength="320" value="{{ $supplier->email }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Buttons  -->
            <div class="row">
                <a href="{{ route('suppliers.index') }}" class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                <button class="d-block btn btn-info w-25 my-3 m-auto" type="submit">Save</button>
            </div>
        </form>
        <!-- Location Info -->
        @section('current-page')
            @if(session()->has('success'))
                <span class="text-success">{{ session()->pull('success') }}</span> /
            @elseif(session()->has('error'))
                <span class="text-danger">  {{  session()->pull('error') }}</span> /
            @endif
            Suppliers / Edit
        @endsection
    </div>
</x-app-layout>
