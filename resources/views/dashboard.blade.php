<x-app-layout>
    <div class="py-12">
        <div class="">
            <div class="">
                <div class="text-primary">
                    Welcome, {{ Auth::user()->name }}.
                </div>
            </div>
        </div>
    </div>

    @section('current-page')
        Dashboard
    @endsection
</x-app-layout>
