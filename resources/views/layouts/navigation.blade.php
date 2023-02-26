<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div>
        <div class="d-flex justify-content-between bg-primary align-items-center">
            <div>
                <!-- Logo -->
                <div>
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="logo-50 logo-light"/>
                    </a>
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li class="dropdown-divider"></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    this.closest('form').submit();">Logout</a></li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
