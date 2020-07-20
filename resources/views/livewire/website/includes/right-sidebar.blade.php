<nav
    id="nav-menu"
    class="fixed w-72 text-white pt-12 md:pt-16 h-screen overflow-y-auto hide-sidebar-menu"
    style="background: #242424;"
>
    <ul>
        <div class="mb-1">
            <li class="hover:bg-transparent pl-3 py-2 cursor-pointer transition-colors duration-200" style="background: transparent" wire:click="toHome">
                <i class="fa fa-home mr-2"></i> Home <span class="inline-block float-right px-2 bg-blue-600 rounded-full mx-2 text-xs font-semibold py-0 relative top-1">new</span>
            </li>
            <li class="pl-3 py-2 cursor-pointer menu-item">
                <i class="fa fa-code mr-2"></i> Web Development
            </li>
            <li class="menu-item pl-3 py-2 cursor-pointer transition-colors duration-200">
                <i class="fa fa-graduation-cap mr-2"></i> Mathematics
            </li>
        </div>
    </ul>
</nav>

@section('js')
    <script>
        (function() {
            const menuControl = document.getElementById('menu-control');
            const navMenu = document.getElementById('nav-menu');
            menuControl.addEventListener('click', function(element, event) {
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
@endsection