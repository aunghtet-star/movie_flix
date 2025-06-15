<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1e293b;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('admin.layouts.side')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header -->
       @include('admin.layouts.header')
        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
            <div id="content-area">
                <!-- Dashboard Section (Default) -->
                @yield('content')

                <!-- Admin User Section -->


                <!-- Users Section -->

                <!-- Movies Section -->
                <div id="movies-section" class="content-section hidden">
                    <h2 class="text-2xl font-semibold mb-6">Movie Management</h2>

                    <!-- Movies Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                                    <i class="fas fa-film"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-500 text-sm">Total Movies</p>
                                    <h3 class="text-xl font-semibold">1,254</h3>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-500 text-sm">New Movies (This Month)</p>
                                    <h3 class="text-xl font-semibold">42</h3>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 text-white p-3 rounded-lg">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-500 text-sm">Avg. Rating</p>
                                    <h3 class="text-xl font-semibold">4.2/5</h3>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-500 text-sm">Total Views</p>
                                    <h3 class="text-xl font-semibold">245K</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Movies Table -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Movies</h3>
                            <div class="flex space-x-2">
                                <div class="relative">
                                    <input type="text" placeholder="Search movies..." class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="absolute left-3 top-2.5 text-gray-400">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                    <i class="fas fa-plus mr-2"></i> Add Movie
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-14 bg-gray-200 rounded"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Dune</div>
                                                    <div class="text-xs text-gray-500">Sci-Fi/Adventure</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Sci-Fi</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2021</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">4.8/5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">45.2K</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Published
                                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-14 bg-gray-200 rounded"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">The Batman</div>
                                                    <div class="text-xs text-gray-500">Action/Crime</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Action</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2022</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">4.7/5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">42.8K</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Published
                                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-14 bg-gray-200 rounded"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Spider-Man: No Way Home</div>
                                                    <div class="text-xs text-gray-500">Action/Adventure</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Action</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2021</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">4.9/5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">67.3K</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Published
                                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-14 bg-gray-200 rounded"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Oppenheimer</div>
                                                    <div class="text-xs text-gray-500">Drama/History</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Drama</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2023</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">4.8/5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">38.1K</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Published
                                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-14 bg-gray-200 rounded"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Barbie</div>
                                                    <div class="text-xs text-gray-500">Comedy/Fantasy</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Comedy</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2023</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">4.5/5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">41.7K</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Draft
                                                    </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="text-sm text-gray-500">
                                    Showing 1 to 5 of 100 entries
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">Previous</button>
                                    <button class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">1</button>
                                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">2</button>
                                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">3</button>
                                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div id="settings-section" class="content-section hidden">
                    <h2 class="text-2xl font-semibold mb-6">Settings</h2>

                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">General Settings</h3>
                        </div>
                        <div class="p-4">
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="site-name" class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                                        <input type="text" id="site-name" name="site-name" value="Movie Admin Dashboard" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="site-url" class="block text-sm font-medium text-gray-700 mb-1">Site URL</label>
                                        <input type="text" id="site-url" name="site-url" value="https://movies.example.com" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="admin-email" class="block text-sm font-medium text-gray-700 mb-1">Admin Email</label>
                                        <input type="email" id="admin-email" name="admin-email" value="admin@example.com" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="timezone" class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                                        <select id="timezone" name="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="UTC">UTC</option>
                                            <option value="EST" selected>Eastern Standard Time (EST)</option>
                                            <option value="CST">Central Standard Time (CST)</option>
                                            <option value="PST">Pacific Standard Time (PST)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="date-format" class="block text-sm font-medium text-gray-700 mb-1">Date Format</label>
                                        <select id="date-format" name="date-format" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                                            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="time-format" class="block text-sm font-medium text-gray-700 mb-1">Time Format</label>
                                        <select id="time-format" name="time-format" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="12" selected>12-hour format</option>
                                            <option value="24">24-hour format</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-md font-medium text-gray-700 mb-2">Site Logo</h4>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-film text-2xl text-gray-500"></i>
                                        </div>
                                        <div>
                                            <label for="logo-upload" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm cursor-pointer">
                                                Upload New Logo
                                            </label>
                                            <input id="logo-upload" type="file" class="hidden">
                                            <p class="text-xs text-gray-500 mt-1">Recommended size: 200x200px. Max file size: 2MB.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-md font-medium text-gray-700 mb-2">Email Notifications</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input id="notify-new-user" name="notify-new-user" type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="notify-new-user" class="ml-2 block text-sm text-gray-700">New user registration</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="notify-new-movie" name="notify-new-movie" type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="notify-new-movie" class="ml-2 block text-sm text-gray-700">New movie submission</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="notify-review" name="notify-review" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="notify-review" class="ml-2 block text-sm text-gray-700">New movie review</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="notify-report" name="notify-report" type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="notify-report" class="ml-2 block text-sm text-gray-700">Content reports</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm mr-2">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Toggle sidebar
    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('md:block');
    });

    // Navigation
    // const navLinks = document.querySelectorAll('.nav-link');
    // const contentSections = document.querySelectorAll('.content-section');
    //
    // navLinks.forEach(link => {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();
    //
    //         // Remove active class from all links
    //         navLinks.forEach(link => {
    //             link.classList.remove('bg-slate-700', 'text-white');
    //             link.classList.add('text-slate-300');
    //         });
    //
    //         // Add active class to clicked link
    //         this.classList.remove('text-slate-300');
    //         this.classList.add('bg-slate-700', 'text-white');
    //
    //         // Hide all content sections
    //         contentSections.forEach(section => {
    //             section.classList.add('hidden');
    //         });
    //
    //         // Show the corresponding content section
    //         const sectionId = this.getAttribute('data-section');
    //         document.getElementById(sectionId + '-section').classList.remove('hidden');
    //
    //         // On mobile, close the sidebar after navigation
    //         if (window.innerWidth < 768) {
    //             document.getElementById('sidebar').classList.add('hidden');
    //         }
    //     });
    // });
    //
    // // Set default active section
    // document.querySelector('.nav-link[data-section="dashboard"]').classList.add('bg-slate-700', 'text-white');
    // document.querySelector('.nav-link[data-section="dashboard"]').classList.remove('text-slate-300');

    // Responsive behavior
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            document.getElementById('sidebar').classList.remove('hidden');
        } else {
            document.getElementById('sidebar').classList.add('hidden');
        }
    });

    // Initialize for current window size
    if (window.innerWidth < 768) {
        document.getElementById('sidebar').classList.add('hidden');
    }
</script>
</body>
</html>
