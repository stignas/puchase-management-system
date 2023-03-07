<section class="bg-white shadow rounded p-3">
    <header>
        <h2 class="text-start text-secondary">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-start text-secondary">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    <a class="btn btn-danger d-block" id="po-btn" style="width: 15%">Delete Account</a>
    <div class="modal hide" id="po-modal">
        @include('profile.delete')
    </div>
</section>
