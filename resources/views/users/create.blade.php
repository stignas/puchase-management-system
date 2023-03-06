<x-app-layout>
    <div class="container shadow rounded bg-light py-3">
        <h1 class="text-center text-secondary">Register User</h1>
        <form class="text-primary w-50 m-auto" method="POST" action="{{ route('users.store') }}">
            @csrf
            <!-- Name -->
            <div class="border p-3 my-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="name"
                           required autofocus autocomplete="off" value="{{ old('name') }}" aria-describedby="nameHelp"
                           placeholder="Enter First Name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email-register">Email address</label>
                    <input class="form-control" id="email-register" type="email" name="email"
                           required autofocus autocomplete="off" value=" {{ old('email') }}"
                           aria-describedby="emailHelp"
                           placeholder="Enter email">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" required
                           autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password" placeholder="Password">
                    @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <a href="{{ route('users.index') }}" class="btn btn-warning d-block w-25 my-3 m-auto">Back</a>
                    <button class="btn btn-info w-25 m-auto" type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
