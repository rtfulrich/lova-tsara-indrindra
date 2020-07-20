@extends('layouts.base')

@section('body')

    <livewire:website.includes.header />
    <div class="flex">
        <livewire:website.includes.right-sidebar />
        <div class="ml-0 lg:ml-72 min-h-screen text-white pt-12 md:pt-16 w-full bg-black" {{--style="background: url({{ asset('images/front/coding_background.jpg')}}); background-position: center; background-size: cover"--}}>
            @yield('content')
        </div>
    </div>
@endsection
