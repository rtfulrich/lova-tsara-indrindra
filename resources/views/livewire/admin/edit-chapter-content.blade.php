<div>

    {{-- @if (!$showAddContentForm)
        <i class="fa fa-plus fa-2x bg-green hover:bg-green-600 cursor-pointer p-2 px-3 rounded absolute top-0 right-0 z-30" title="Add a Content" wire:click="showAddContentForm"></i>
    @else 
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border">
            <div class="col-start-1 col-end-3">
                <select wire:model="newContentType" class="bg-dark form-control h-full font-bold rounded text-center">
                    <option class="text-lg">Content Type</option>
                    <option value="title1">Title 1</option>
                    <option value="title2">Title 2</option>
                    <option value="title3">Title 3</option>
                    <option value="paragraph">Paragraph</option>
                    <option value="image">Image</option>
                </select>
            </div>
            <div class="col-start-3 col-end-11">
                <input type="text" wire:model.lazy="newChapterTitle" placeholder="Chapter Title" class="bg-dark form-control text-xl py-8 text-center px-2 rounded font-bold" autofocus>
            </div>
            <div class="col-start-11 col-end-13 flex justify-between align-items-center">
                <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" title="Save" wire:click="addChapter">
                    <i class="fas fa-save fa-2x"></i>
                </button>
                <button class="px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" wire:click="cancelAddNewChapter" title="Cancel">
                    <i class="far fa-window-close fa-2x"></i>
                </button>
            </div>
        </div>
    @endif --}}
    
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