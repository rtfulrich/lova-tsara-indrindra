<div class="p-4 bg-cool-gray-300 border-2 border-gray-700 mb-4 rounded-lg">

    @if (session()->has('msg') and $showFlashMsg)
        <div class="absolute top-0 right-0 p-4 bg-yellow-500 rounded z-50 font-bold text-lg cursor-pointer text-white" wire:click="removeFlashMsg">
            {{ session('msg') }}
            <i class="fa fa-window-close absolute top-1 right-1 text-gray-900 text-sm cursor-pointer hover:text-red-800" wire:click="removeFlashMsg"></i>
        </div>
    @endif

    {!! $chapterContent !!}
</div>

@section('content_header')
    <h1 class="text-center font-bold text-xl">
        <span class="text-green-600">{{ $courseTitle }}</span> - 
        <span class="text-orange-500">{{ $chapterTitle }}</span>
    </h1>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endpush