<!-- Login form -->
<form class="text-light" method="POST" action="{{ route('login') }}" id="login-form">
    @csrf
    <!-- Email Address -->
    <div class="form-group">
        <label for="email-login">Email address</label>
        <input class="form-control" id="email-login" type="email" name="email"
               required autofocus autocomplete="username" aria-describedby="emailHelp"
               placeholder="Enter email">
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" type="password" name="password" required
               autocomplete="current-password" placeholder="Password">
    </div>
    <!-- Remember Me -->
    <div class="form-check py-3">
        <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
        <label class="form-check-label" for="remember_me">Remember me</label>
    </div>
    <button class="btn btn-info w-100" type="submit">Log In</button>
</form>

<!-- Password reset / Register -->
<div class="p-3 d-flex flex-column">
    @if (Route::has('password.request'))
        {{--            {{ route('password.request') }}--}}
        <a href class="link-info" id="forgot-pass">
            {{ __('Forgot your password?') }}
        </a>
        <a href class="link-info hide" id="login-link">
            {{ __('Login') }}
        </a>
    @endif
    <x-input-error :messages="$errors->get('email')"/>
</div>
