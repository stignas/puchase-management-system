<x-app-layout>
    <div class="container shadow rounded bg-light py-3 my-2">
        <div  class="text-primary w-100 m-auto p-3">
            <div class="bg-light m-3">
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-light m-3">
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div  class="bg-light m-3">
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @section('current-page')
        Profile
    @endsection
</x-app-layout>
