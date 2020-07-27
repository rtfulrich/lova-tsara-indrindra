<nav
    id="nav-menu"
    class="fixed w-72 text-white pt-12 md:pt-16 h-screen hide-sidebar-menu"
    style="background: #333; z-index: 70"
>
    <ul>
        <div class="mb-1 text-sm">
            <a href="{{ route('home') }}">
                <li class="pl-3 py-2 mb-3 cursor-pointer menu-item flex items-center">
                    <span class="flex justify-center w-16">
                        <i class="fa fa-home" style="font-size: 1.5rem"></i> 
                    </span>
                    <span class="font-semibold" style="font-size: 1.05rem">Home</span>
                    {{-- <span class="absolute px-2 bg-blue-600 rounded-full mx-2 text-xs font-semibold py-0 right-0">new</span> --}}
                </li>
            </a>
            <div class="my-1 pb-3">
                <h3 class="font-bold py-2 flex items-center bg-gray-700 pl-3" style="font-size: 1.05rem">
                    <span class="w-16 flex justify-center">
                        <i class="fa fa-code" style="font-size: 1.5rem"></i>
                    </span>
                    Web Development
                </h3>
                <a href="{{ route('specific-hashtag', 'html-css') }}">
                    <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                        <span class="flex justify-center w-16">
                            <i class="fab fa-html5 text-orange-500" style="font-size: 1.5rem"></i> 
                            <i class="fab fa-css3-alt text-blue-500" style="font-size: 1.5rem"></i> 
                        </span>
                        <span class="font-semibold">HTML & CSS</span>
                    </li>
                </a>
                <a href="{{ route('specific-hashtag', 'php') }}">
                    <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                        <span class="flex justify-center w-16">
                            <i class="fab fa-php text-indigo-600" style="font-size: 1.5rem"></i> 
                        </span>
                        <span class="font-semibold">PHP</span>
                    </li>
                </a>
                <a href="{{ route('specific-hashtag', 'javascript') }}">
                    <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                        <span class="flex justify-center w-16">
                            <i class="fab fa-js text-yellow-300" style="font-size: 1.5rem"></i> 
                        </span>
                        <span class="font-semibold">Javascript</span>
                    </li>
                </a>
                <a href="{{ route('specific-hashtag', 'laravel') }}">
                    <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                        <span class="flex justify-center w-16">
                            <i class="fab fa-laravel text-red-600" style="font-size: 1.5rem"></i> 
                        </span>
                        <span class="font-semibold">Laravel</span>
                    </li>
                </a>
            </div>

            <div class="my-1 pb-3">
                <h3 class="font-bold py-2 flex items-center pl-3 bg-gray-700" style="font-size: 1.05rem">
                    <span class="flex justify-center w-16">
                        <i class="fa fa-blog" style="font-size: 1.5rem"></i>
                    </span>
                    Zara
                </h3>
                <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                    <span class="flex justify-center w-16">
                        <i class="fa fa-newspaper" style="font-size: 1.3rem"></i> 
                    </span>
                    <span class="font-semibold">Blog</span>
                </li>
            </div>

            <div class="my-1">
                <h3 class="font-bold py-2 flex items-center pl-3 bg-gray-700" style="font-size: 1.05rem">
                    <span class="flex justify-center w-16">
                        <i class="fa fa-square-root-alt" style="font-size: 1.5rem"></i>
                    </span>
                    Mathematika
                </h3>
                <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                    <span class="flex justify-center w-16">
                        <i class="fas fa-subscript" style="font-size: 1.3rem"></i> 
                    </span>
                    <span class="font-semibold">Kolejy</span>
                </li>
                <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                    <span class="flex justify-center w-16">
                        <i class="fas fa-infinity" style="font-size: 1.3rem"></i> 
                    </span>
                    <span class="font-semibold">Lyse</span>
                </li>
                <li class="pl-3 py-2 cursor-pointer menu-item flex items-center text-center">
                    <span class="flex justify-center w-16">
                        <i class="fa fa-graduation-cap" style="font-size: 1.3rem"></i> 
                    </span>
                    <span class="font-semibold">Oniversity</span>
                </li>
            </div>

        </div>
    </ul>
</nav>

@push('js')
    <script>
        (function() {
            const menuControl = document.getElementById('menu-control');
            const navMenu = document.getElementById('nav-menu');
            menuControl.addEventListener('click', function(element, event) { console.log('clicked');
                if (navMenu.classList.contains('show-sidebar-menu')) {
                    navMenu.classList.remove('show-sidebar-menu');
                    navMenu.classList.add('hide-sidebar-menu');
                } else if (navMenu.classList.contains('hide-sidebar-menu')) {
                    navMenu.classList.remove('hide-sidebar-menu');
                    navMenu.classList.add('show-sidebar-menu');
                }
            });
        }) ();
    </script>
@endpush