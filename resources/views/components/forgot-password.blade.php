<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')"/>
<!-- Forgot password form -->
<form class="text-light" method="POST" action="{{ route('password.email') }}">
    @csrf
    <!-- Email Address -->
    <div class="form-group pb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" class="form-control" name="email" aria-describedby="emailHelp" required
               autofocus placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-warning">Send Reset Link</button>
</form>
