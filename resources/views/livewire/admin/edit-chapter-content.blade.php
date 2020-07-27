<div>

    <div class="fixed bottom-2 right-2" style="z-index: 1000">
        <a href="{{ route('admin.course.edit', $chapter->course->id) }}" class="px-2 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 font-bold text-white">Edit Course Owner</a>
    </div>
    
    <form action="{{ $alreadyExists ? 
        route('admin.course.chapter.update-content', $chapterId) : 
        route('admin.course.chapter.store-content', $chapterId)}}" 
        method="POST"
    >
        @csrf
        @if ($alreadyExists) @method('PUT') @endif
        <textarea name="courseContent" id="text-content" hidden>
            {!! $chapterContent !!}
        </textarea>
        <div class="flex justify-center">
            <button class="my-4 font-bold px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded mx-auto">S U B M I T</button>
        </div>
        
    </form>
</div>

@section('title')
    {{ $pageTitle }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endpush

@push('js')
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        Laraberg.init('text-content', { laravelFilemanager: {
            prefix: '/lti-course-filemanager'
        }, sidebar: true });
    </script>
@endpush