<header 
    style="background: #242424"
    class="fixed w-full z-50 md:pr-8 md:pl-8 px-4 md:h-16 h-12 flex justify-between items-center text-white"
>
    <div class="flex items-center">
        <span id="menu-control" class="lg:hidden" {{--wire:click="$emitTo('website.includes.right-sidebar', 'showSideBarMenu')"--}}><i class="fa fa-bars text-xl mr-4 cursor-pointer"></i></span>
        <h1 
            style="
                height: 33px;
                width: 132px;
                background-image: url('{{ asset('images/logo.png') }}');
                background-size:cover;
                background-position: center; 
                background-repeat: no-repeat" 
            class="cursor-pointer"
        ></h1>
    </div>

    <div class="">
        @guest
            <span 
                class="px-3 py-1 inline-block w-24 font-semibold text-center rounded-full cursor-pointer shadow-outline-blue hover:shadow-none transition-all hover:bg-blue-700 ease-in-out duration-300"
                wire:click="showRegisterForm"
            >Hisoratra</span>
            <span  
                class="px-3 py-1 inline-block font-semibold text-center w-24 rounded-full ml-2 cursor-pointer bg-blue-600 transition-colors hover:bg-blue-700 ease-in-out duration-300"
                wire:click="showLoginForm"
            >Hisera</span>
        @endguest
        @auth
            <span  
                class="px-3 py-1 inline-block font-semibold text-center w-36 rounded-full ml-2 cursor-pointer bg-red-600 transition-colors hover:bg-red-700 ease-in-out duration-300"
                wire:click="logout"
            ><i class="fa fa-power-off mr-2"></i> Hiala Sera</span>
        @endauth
    </div>

</header>
