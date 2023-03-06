<x-app-layout>
    <div class="container-xxl shadow rounded bg-light py-3  my-2">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Title -->
            <div class="py-3 text-secondary">
                <h1 class="text-center text-secondary">Users</h1>
            </div>
            <!-- Search -->
            <div class="py-3">
                <form method="get" action="{{ route('users.index') }}" role="search"
                      class="d-flex justify-content-around">
                    @csrf
                    <a class="btn btn-danger m-1" href="{{ route('users.index') }}">
                        <img class="svg-light" src="{{ asset('/assets/img/icons/arrow-rotate-left-solid.svg') }}"
                             width="16px" height="16px" alt="arrow">
                    </a>
                    <input class="form-control d-inline-block m-1" name='search'
                           placeholder="Search by name or id.." value="{{ old('search') }}">
                    <button type="submit" class="btn btn-secondary d-inline-block m-1">Search</button>
                </form>
            </div>
            <!-- Create New -->
            <div class="py-3">
                <a href="{{ route('users.create') }}" class="btn btn-danger">+ Create New</a>
            </div>
        </div>
        <!-- List table -->
        <table class="table table-hover">
            <!-- Table headers -->
            <tr class="bg-dark-subtle">
                <th class="scope-col col-6">Name</th>
                <th class="scope-col col-6">E-mail</th>
                <th class="scope-col col-3 text-center">Created @</th>
                <th class="scope-col col-3 text-center">Delete</th>
            </tr>
            <!-- Table records -->
            @foreach($users as $user)
                <tr>
                    <td class="text-truncate">{{ $user->name }}</a></td>
                    <td class="overflow-x-hidden text-truncate">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->created_at }}</td>
                    <!-- Action button -->
                    <td>
                        <div class="text-center">
                            <!-- Delete action -->
                            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn p-0 m-0 float-right">
                                    <img src="{{ asset('assets/img/icons/trash-can-solid.svg') }}" width="20px"
                                         height="20px" alt="trash"
                                         class="p-1 svg-danger"></button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </table>
        <!-- Paginator links -->
        {{ $users->onEachSide(1)->links() }}
    </div>
    <!-- Location Info send to App-layout footer -->
    @section('current-page')
        @if(session()->has('success'))
            <span class="text-success">{{ session()->pull('success') }}</span> /
        @elseif(session()->has('error'))
            <span class="text-danger">  {{  session()->pull('error') }}</span> /
        @endif
        <span>Users</span>
    @endsection
</x-app-layout>
