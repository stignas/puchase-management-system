<form class="text-light" method="POST" action="{{ route('register') }}">
    @csrf
    <!-- Name -->
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" id="name" type="text" name="name"
               required autofocus autocomplete="name" :value="old('name')" aria-describedby="nameHelp"
               placeholder="Enter First Name">
        <x-input-error :messages="$errors->get('name')"/>

    </div>
    <!-- Email Address -->
    <div class="form-group">
        <label for="email-register">Email address</label>
        <input class="form-control" id="email-register" type="email" name="email"
               required autofocus autocomplete="username" :value="old('email')" aria-describedby="emailHelp"
               placeholder="Enter email">
        <x-input-error :messages="$errors->get('email')"/>
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" type="password" name="password" required
               autocomplete="new-password" placeholder="Password">
        <x-input-error :messages="$errors->get('password')"/>
    </div>
    <!-- Confirm Password -->
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required
               autocomplete="new-password" placeholder="Password">
        <x-input-error :messages="$errors->get('password_confirmation')"/>
    </div>

    <div class="d-flex flex-column items-center justify-end">
        <a class="link-info py-3"
           href="{{ route('home') }}">
            {{ __('Already registered?') }}
        </a>
        <button class="btn btn-info" type="submit">Register</button>
    </div>
</form>
