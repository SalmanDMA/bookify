<body>
    <nav
        class="flex justify-between items-center gap-4 fixed top-0 left-0 w-full z-10 shadow-xl py-4 px-4 sm:px-8 bg-white">
        <button type="button" class="lg:hidden" id="sidebar-toggle-hamburger">
            <i class="fa-solid fa-bars text-xl text-slate-900"></i>
        </button>
        <div class="flex items-center w-48">
            <a href="{{ route('home') }}" class="flex items-center w-full h-full">
                <img src="{{ asset('images/white-bookify-removebg.png') }}" alt="logo">
            </a>
        </div>

        <div class="sidebar" id="sidebar">
            <a href="{{ route('home') }}"
                class="text-lg font-poppins text-slate-900 hover:bg-gray-100 lg:hover:bg-transparent px-4 py-2 rounded-xl lg:px-0 lg:py-0 lg:rounded-none hover:underline hover:transform hover:scale-105 transition-all duration-300">Home</a>
            <a href="{{ route('home') }}"
                class="text-lg font-poppins text-slate-900 hover:bg-gray-100 lg:hover:bg-transparent px-4 py-2 rounded-xl lg:px-0 lg:py-0 lg:rounded-none hover:underline hover:transform hover:scale-105 transition-all duration-300">All
                Category</a>
            <a href="{{ route('home') }}"
                class="text-lg font-poppins text-slate-900 hover:bg-gray-100 lg:hover:bg-transparent px-4 py-2 rounded-xl lg:px-0 lg:py-0 lg:rounded-none hover:underline hover:transform hover:scale-105 transition-all duration-300">All
                books</a>
            <i class="fa-solid fa-xmark absolute top-4 right-4 text-xl text-slate-900 cursor-pointer visible lg:invisible"
                id="sidebar-toggle-close"></i>
        </div>

        {{-- component overlay --}}
        <div class="overlay" id="overlay"></div>


        @auth
            <div class="flex items-center gap-4">
                <div class="w-full max-w-md">
                    <div class="flex w-full">
                        <input type="text" name="search" id="search" placeholder="Search books here..."
                            class="w-full py-2 px-4 border rounded-l-xl border-blue-500 focus:outline-none hidden lg:block">
                        <button type="submit" id="search-button"
                            class="rounded-r-xl lg:bg-blue-500 lg:hover:bg-blue-600 lg:py-2 lg:px-4 hover:bg-transparent">
                            <i class="fa-solid fa-magnifying-glass text-slate-900 lg:text-white text-xl lg:text-base"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#"
                        class="text-xl font-poppins text-blue-500 hover:transform hover:scale-105 transition-all duration-300">
                        <i
                            class="fa-solid fa-cart-shopping text-slate-900 hover:text-slate-800 transition-all duration-300 relative">
                            {{-- <span class="absolute -top-2 -right-2 text-white bg-blue-500 text-xs px-1 rounded-full">0</span> --}}
                        </i>
                    </a>
                    <div class="relative">
                        <button type="button"
                            class="text-lg font-poppins flex items-center gap-2 hover:transform hover:scale-105 transition-all duration-300"
                            id="dropdown-button-profile">
                            <i
                                class="fa-solid fa-user text-xl text-slate-900 hover:text-slate-800 transition-all duration-300"></i>
                        </button>
                        <div class="dropdown-profile" id="dropdown-profile">
                            <div class="border-b border-gray-200 px-4 pb-2">
                                <h3 class="text-sm text-gray-700">Signed in as</h3>
                                <p class="text-sm text-gray-700 font-bold">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="flex gap-2 items-center mt-2 px-4 py-2 hover:bg-gray-100">
                                <i class="fa-solid fa-address-card text-slate-900"></i>
                                <a href="{{ route('profile') }}" class="block text-sm text-gray-700 w-full">Profile</a>
                            </div>
                            <div class="flex gap-2 items-center px-4 py-2 hover:bg-gray-100">
                                <i class="fa-solid fa-heart text-slate-900"></i>
                                <a href="{{ route('profile') }}" class="block text-sm text-gray-700 w-full">Whishlist</a>
                            </div>
                            <form action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex gap-2 items-center">
                                    <i class="fa-solid fa-right-from-bracket text-slate-900">
                                    </i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="text-lg font-poppins bg-blue-500 text-white px-4 py-2 rounded-md sm:py-0 sm:px-0 sm:rounded-none sm:text-blue-500  hover:bg-blue-600 hover:underline sm:hover:transform sm:hover:scale-105 transition-all duration-300 sm:bg-transparent sm:hover:bg-transparent">Login</a>
                <a href="{{ route('register') }}"
                    class="text-lg font-poppins bg-blue-500 text-white px-4 py-2 rounded-md hover:underline hover:bg-blue-600 transition-all duration-300 hidden sm:block">Register</a>
            </div>
        @endauth
    </nav>

    {{-- component search --}}
    <div class="search-component" id="search-component">
        <div class="flex w-full bg-white shadow-xl">
            <input type="text" name="search" id="search" placeholder="Search books here..."
                class="w-full py-2 px-4 border border-blue-500 focus:outline-none">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 py-2 px-4">
                <i class="fa-solid fa-magnifying-glass text-white text-base"></i>
            </button>
        </div>
    </div>

    {{ $slot }}

    <footer class="bg-white px-8 py-4 shadow-xl flex flex-col gap-4">
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 border-b pb-4 border-t border-gray-200 pt-4 place-items-center sm:place-items-start">
            <div class="w-full h-full flex flex-col justify-start items-center lg:items-start">
                <div class="w-40 bg-white mx-auto sm:mx-0">
                    <img src="{{ asset('images/white-bookify-removebg.png') }}" alt="logo" class="w-full">
                </div>
                <p class="mt-4 font-gelasio text-gray-400 text-center lg:text-start">
                    Bookify is an online bookstore platform that offers a wide range of books. With Bookify, users can
                    explore and purchase the latest books from various categories, as well as sell their own books.
                </p>
            </div>
            <div class="w-full h-full flex flex-col justify-start items-center">
                <h3 class="text-lg font-semibold mb-2 font-poppins text-blue-500 text-center sm:text-start">Quick Links
                </h3>
                <ul>
                    <li class="group">
                        <div
                            class="flex items-center gap-2 group-hover:transform group-hover:translate-x-3 transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                            </div>
                            <a href="#" class="text-slate-900 group-hover:underline font-gelasio">Home</a>
                        </div>
                    </li>
                    <li class="group">
                        <div
                            class="flex items-center gap-2 group-hover:transform group-hover:translate-x-3 transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                            </div>
                            <a href="#" class="text-slate-900 group-hover:underline font-gelasio">All Books</a>
                        </div>
                    </li>
                    <li class="group">
                        <div
                            class="flex items-center gap-2 group-hover:transform group-hover:translate-x-3 transition-all duration-300">
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                                <i class="fa-solid fa-chevron-right text-slate-900 text-sm"></i>
                            </div>
                            <a href="#" class="text-slate-900 group-hover:underline font-gelasio">All
                                Categories</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="w-full h-full flex flex-col justify-start items-center">
                <h3 class="text-lg font-semibold mb-2 font-poppins text-blue-500 text-center sm:text-start">Follow Us
                </h3>
                <ul>
                    <li>
                        <a href="#" class="font-gelasio hover:underline">
                            <i class="fab fa-facebook mr-2"></i>
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a href="#" class="font-gelasio hover:underline">
                            <i class="fab fa-twitter mr-2"></i>
                            Twitter
                        </a>
                    </li>
                    <li>
                        <a href="#" class="font-gelasio hover:underline">
                            <i class="fab fa-instagram mr-2"></i>
                            Instagram
                        </a>
                    </li>
                    <li>
                        <a href="#" class="font-gelasio hover:underline">
                            <i class="fab fa-linkedin mr-2"></i>
                            LinkedIn
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-full h-full flex flex-col justify-start items-center">
                <h3 class="text-lg font-semibold mb-2 font-poppins text-blue-500 text-center sm:text-start">Contact
                </h3>
                <p>
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    123 Bookify Street
                </p>
                <p>
                    <i class="far fa-envelope mr-2"></i>
                    info@bookify.com
                </p>
                <p>
                    <i class="fas fa-phone mr-2"></i>
                    +123 456 7890
                </p>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <p class="text-slate-900">&copy; {{ date('Y') }} <span class="font-semibold">Bookify</span>. All
                rights reserved.</p>
        </div>
    </footer>

</body>

<script>
    $(document).ready(function() {
        const dropdown = $('#dropdown-profile');
        const sidebar = $('#sidebar');
        const overlay = $('#overlay');
        const searchComponent = $('#search-component');
        const searchButton = $('#search-button');

        function toggleDropdown() {
            dropdown.toggleClass('dropdown-active');
            sidebar.removeClass('sidebar-open');
            overlay.removeClass('overlay-active');
            searchComponent.removeClass('search-active');
        }

        function toggleSidebar() {
            sidebar.toggleClass('sidebar-open');
            dropdown.removeClass('dropdown-active');
            overlay.toggleClass('overlay-active');
            searchComponent.removeClass('search-active');
        }

        function toggleSearch() {
            searchComponent.toggleClass('search-active');
            dropdown.removeClass('dropdown-active');
            sidebar.removeClass('sidebar-open');
            overlay.removeClass('overlay-active');
        }

        function setSearchButtonType() {
            if ($(window).width() < 1024) {
                searchButton.attr('type', 'button');
            } else {
                searchButton.attr('type', 'submit');
            }
        }

        setSearchButtonType();

        $(window).resize(function() {
            setSearchButtonType();
        });

        $('#dropdown-button-profile').click(toggleDropdown);
        $('#sidebar-toggle-hamburger').click(toggleSidebar);
        $('#sidebar-toggle-close').click(toggleSidebar);
        $('#overlay').click(toggleSidebar);
        $('#search-button').click(toggleSearch);
    });
</script>
