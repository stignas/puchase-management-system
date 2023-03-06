<form action="{{ route('profile.destroy', $user) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-content">
        <div class="d-flex flex-column align-items-center ">
            <p class="text-danger">This will delete your account.</p>
            <p>Enter password to continue</p>
            <input class="form-control m-2" id="password" name="password" type="password">
            <div class="text-center w-100">
                <a class="btn btn-secondary w-25 m-auto block" id="close">Cancel</a>
                <button class="btn btn-danger w-25 m-auto" type="submit">Delete</button>
            </div>
        </div>
    </div>
</form>
