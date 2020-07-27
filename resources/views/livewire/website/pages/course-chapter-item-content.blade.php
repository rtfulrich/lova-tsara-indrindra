<div>
    
    {{-- Row : Main Content + Right Aside --}}
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 grid grid-cols-12 gap-4">
        
        {{-- Main Content --}}
        <div class="col-start-1 col-end-13 md:col-end-10 py-4">
            <h1 class="text-2xl font-bold underline text-center mb-4">{{ $chapter->title }}</h1>
            {!! $chapterContent !!}
        </div>
        {{-- End Main Content --}}

        {{-- ____________________________________________________________________ --}}

        {{-- Right Aside --}}
        <div class="hidden md:block md:col-start-10 md:col-end-13">

        </div>
        {{-- End Right Aside --}}

    </div>
    {{-- End Row : Main Content + Aside --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Optional Above Footer With Full Width --}}
    <div>

    </div>
    {{-- End Optional Above Footer With Full Width --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Footer --}}
    <livewire:website.includes.footer />
    {{-- End Footer --}}

</div>

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endsection