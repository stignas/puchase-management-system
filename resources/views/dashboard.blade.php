<x-app-layout>
    <div class="py-12">
        <div class="">
            <div class="container alert alert-success mx-auto my-3 rounded">
                <div class=" text-primary p-3">
                    Welcome, {{ Auth::user()->name }}.
                </div>
            </div>
        </div>
    </div>

    @section('current-page')
        Dashboard
    @endsection
</x-app-layout>
