<aside id="sidebar" class="bg-slate-800 text-white w-64 flex-shrink-0 transition-all duration-300 ease-in-out h-full">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-4 border-b border-slate-700">
            <h1 class="text-xl font-bold flex items-center">
                <i class="fas fa-film mr-2"></i>
                Movie Admin
            </h1>
        </div>

        <!-- Admin Profile -->
        <div class="p-4 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <p class="font-medium">Admin User</p>
                    <p class="text-xs text-slate-400">Super Admin</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar">
            <ul class="p-2">
                <li class="mb-1">
                    <p class="px-4 py-2 text-xs text-slate-400 uppercase font-semibold">Main</p>
                </li>
                <li class="mb-1">
                    <a href="{{route('admin.dashboard')}}" class="nav-link flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md" data-section="@yield('dashboard')">
                        <i class="fas fa-tachometer-alt w-5 mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="mb-1">
                    <p class="px-4 py-2 text-xs text-slate-400 uppercase font-semibold">Management</p>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admins.index') }}" class="nav-link flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md" data-section="admin">
                        <i class="fas fa-user-shield w-5 mr-2"></i>
                        Admin User
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{route('users.index')}}" class="nav-link flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md" data-section="users">
                        <i class="fas fa-users w-5 mr-2"></i>
                        Users
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{route('genres.index')}}" class="nav-link flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md" data-section="movies">
                        <i class="fas fa-theater-masks genre-drama w-5 mr-2"></i>
                        Genres
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{route('admin_movies.index')}}" class="nav-link flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 rounded-md" data-section="movies">
                        <i class="fas fa-film w-5 mr-2"></i>
                        Movies
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout -->

        <div class="p-4 border-t border-slate-700">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-slate-300 hover:text-white w-full">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
