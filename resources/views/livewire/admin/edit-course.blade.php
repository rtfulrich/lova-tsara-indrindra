<div>
    
    @if (session()->has('msg') and $showFlashMsg)
        <div class="absolute top-0 right-0 p-4 bg-yellow-500 rounded z-50 font-bold text-lg cursor-pointer text-white" wire:click="removeFlashMsg">
            {{ session('msg') }}
            <i class="fa fa-window-close absolute top-1 right-1 text-gray-900 text-sm cursor-pointer hover:text-red-800" wire:click="removeFlashMsg"></i>
        </div>
    @endif
    
    <div class="fixed bottom-2 left-64" style="z-index: 20000">
        @if ($showConfigs)
            <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" style="z-index: 10000" title="Hide Configs" wire:click="hideConfigs">
                <i class="fas fa-window-close fa-2x"></i>
            </button>

            <div class="relative">
                <div class="absolute bottom-0 bg-orange-500 rounded p-3 w-96 overflow-y-auto" style="left: 101%; max-height: 25rem">
                    
                    <div class="border-b pb-2 mb-2">
                        <label class="block uppercase tracking-wide font-bold mb-2" for="course-category">
                            Course Category
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 font-bold" id="course-category" wire:model="courseCategory">
                                <option value="formation" {{ $courseCategory === "formation" ? 'selected' : '' }}>
                                    Formation
                                </option>
                                <option value="tutorial" {{ $courseCategory === "tutorial" ? 'selected' : '' }}>
                                    Tutorial
                                </option>
                                <option value="practice" {{ $courseCategory === "practice" ? 'selected' : '' }}>
                                    Practice
                                </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
    
                    <div class="border-b pb-2 mb-2">
                        <input type="checkbox" {{ $isCoursePublished ? 'checked' : '' }} id="is_published" wire:model="isCoursePublished" class="mx-2">
                        <label for="is_published" class="text-md font-bold">Want to publish it ?</label>
                    </div>
    
                    <div class="border-b pb-2 mb-2">
                        <label class="block uppercase tracking-wide font-bold mb-2" for="course-level">
                            Course Level
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 font-bold" id="course-level" wire:model="courseLevel">
                                <option value="easy" {{ $courseLevel === "easy" ? 'selected' : '' }}>
                                    Easy
                                </option>
                                <option value="average" {{ $courseLevel === "average" ? 'selected' : '' }}>
                                    Average
                                </option>
                                <option value="hard" {{ $courseLevel === "hard" ? 'selected' : '' }}>
                                    Hard
                                </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
    
                    <div class="border-b pb-2 mb-2">
                        <input type="checkbox" {{ $useGroupOfChapters ? 'checked' : '' }} id="enable-group-of-chapters" wire:model="useGroupOfChapters" class="mx-2">
                        <label for="enable-group-of-chapters" class="text-md font-bold">Use Group Of Chapters ?</label>
                    </div>

                    <div class="border-b pb-2 mb-2">
                        <label class="block uppercase tracking-wide font-bold mb-2">
                            #Hash_Tags :
                        </label>
                        @if (count($course->hashTags) > 0)
                            <div class="p-1 rounded bg-gray-400 text-sm flex flex-wrap mb-1">
                                @foreach ($course->hashTags as $hashTag)
                                    <span class="px-2 bg-gray-700 mx-1 rounded-full font-bold text-white mb-1">
                                        {{ $hashTag->name }}
                                        <i class="fa fa-trash text-red-500 mx-1 hover:text-red-600 cursor-pointer" wire:click="removeHashTagFromCourse( {{ $hashTag->id }} )"></i>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        <div class="relative flex items-center justify-around">
                            <input type="text" 
                                class="block appearance-none bg-gray-100 border border-gray-200 text-black py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 font-bold" 
                                placeholder="Add new #tag" 
                                style="width: calc(100% - 4rem)"
                                wire:model="newHashTag"
                                wire:keydown.enter="addHashTag( {{ $course->id }} )"
                            />
                            <button class="px-1 rounded bg-cool-gray-500 hover:bg-gray-600" wire:click="addHashTag( {{ $course->id }} )">
                                <i class="fa fa-plus"></i>
                            </button>
                            
                            @if ($showTagSuggestions)
                            <div class="absolute left-4" style="bottom: 100%; width: calc(100% - 4.3rem)">
                                <ul class="relative bg-blue-500 w-full rounded-lg px-2 text-center font-semibold">
                                    @foreach ($hashTagSuggestions as $suggestion)
                                    <li class="hover:bg-cool-gray-500 px-2 border-t border-b border-black cursor-pointer" wire:click="addHashTagFromExisted( {{ $suggestion['id'] }} )">
                                        {{ $suggestion['name'] }}
                                    </li>
                                    @endforeach

                                    <i class="fa fa-window-close text-green-500 hover:text-green-600 absolute bottom-full right-0 cursor-pointer" wire:click="hideTagSuggestions"></i>
                                </ul>
                            </div>
                            @endif
                        </div>

                    </div>

                    <div class="pb-2">
                        <label class="block uppercase tracking-wide font-bold mb-2">
                            Course Image :
                        </label>
                        <div class="w-full h-40 bg-gray-300 rounded-lg mb-2">
                            @if ($newCourseImage and !$errors->has('newCourseImage'))
                                <img src="{{ $newCourseImage->temporaryUrl() }}" alt="Preview Course Image" class="w-full h-full rounded-lg">
                            @else
                                @if ($courseImage)
                                    <img src="{{ asset('storage/course_images/' . $courseImage) }}" alt="Course Image" class="w-full h-full rounded-lg">
                                @else
                                    <div class="w-full h-full flex justify-center items-center font-bold text-gray-900 text-lg">
                                        No Course Image Yet
                                    </div>
                                @endif 
                            @endif
                        </div>
                        <form class="text-center" wire:submit.prevent="changeCourseImage">
                            <div class="flex w-full items-center justify-center">
                                <label class="w-64 flex flex-col items-center px-4 py-3 bg-white text-blue-600 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-600 hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Select a file</span>
                                    <input type='file' class="hidden" wire:model="newCourseImage" />
                                </label>
                            </div>
                            {{-- <input type="file" wire:model="newCourseImage" class="mb-1"> --}}
                            @error('newCourseImage') <div class="font-bold mb-1">{{ $message }}</div> @enderror

                            @if ($newCourseImage)
                            <button class="px-2 py-1 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-bold">Update Course Image</button>
                            @endif
                        </form>    
                    </div>
    
                </div>
            </div>
        @else
            <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" style="z-index: 10000" title="See Configs" wire:click="showConfigs">
                <i class="fas fa-cog fa-2x"></i>
            </button>
        @endif
        
    </div>

    @if ($showConfirmDeleteGroupChapter)
        <div class="fixed rounded top-14 p-4 bg-red-600 right-0" style="z-index: 1000">
            <p class="text-lg font-bold text-white">Delete Chapter Group With id = {{ $groupChapterIdToBeRemoved }}</p>
            <div class="flex justify-center">
                <button class="px-3 py-2 rounded bg-yellow-200 hover:bg-yellow-300 mx-2" wire:click="deleteGroupChapter( {{ $groupChapterIdToBeRemoved }} )">
                    Yes
                </button>
                <button class="px-3 py-2 rounded bg-blue-500 hover:bg-blue-600 mx-2" wire:click="cancelDeleteGroupChapter">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    @if (!$showAddGroupChapterForm)
        <button class="fixed bottom-2 right-2 px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" title="Add a Chapter Group" style="z-index: 20000" wire:click="showAddGroupChapterForm">
            <i class="fas fa-plus fa-2x"></i>
        </button>
    @else
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border z-50">
            <div class="col-start-1 col-end-3">
                <input type="text" wire:model="newGroupOfChaptersNumber" placeholder="N°" class="bg-dark form-control py-8 text-xl font-bold rounded text-center">
            </div>
            <div class="col-start-3 col-end-11">
                <input type="text" wire:model.lazy="newGroupOfChaptersTitle" placeholder="Group Chapters Title" class="bg-dark form-control text-xl py-8 text-center px-2 rounded font-bold" autofocus>
            </div>
            <div class="col-start-11 col-end-13 flex justify-between align-items-center">
                <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" title="Add" wire:click.prevent="addGroupOfChapters">
                    <i class="fas fa-plus fa-2x"></i>
                </button>
                <button class="px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" wire:click.prevent="hideAddGroupChapterForm" title="Cancel">
                    <i class="far fa-window-close fa-2x"></i>
                </button>
            </div>
        </div>

        <button class="fixed bottom-2 right-2 px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" title="Cancel New Chapter Group" wire:click="hideAddGroupChapterForm">
            <i class="fas fa-window-close fa-2x"></i>
        </button>
    @endif

    @if ($showEditCourseTitleForm)
        <div class="sticky top-14 mb-3 p-2 bg-cool-gray-500 rounded border">
            <input type="text" placeholder="Course Title" class="text-xl font-bold text-center py-8 form-control bg-dark px-2" autofocus wire:model="courseTitle" value="{{ $courseTitle }}" />
            <div class="absolute top-2 right-2">
                @if ($newCourseTitleCanBeSaved)
                    <i class="fas fa-save fa-2x mr-2 text-blue-500 cursor-pointer hover:text-blue-600" wire:click="saveNewCourseTitle"></i>
                @endif
                <i class="fas fa-window-close fa-2x text-green-500 cursor-pointer hover:text-red-600" wire:click="showCourseTitleContent"></i>
            </div>
        </div>
    @elseif ($showAddChapterForm)
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border">
            <div class="col-start-1 col-end-3">
                <input type="text" wire:model="newChapterNumber" placeholder="N°" class="bg-dark form-control py-8 text-xl font-bold rounded text-center">
            </div>
            <div class="col-start-3 col-end-11">
                <input type="text" wire:model.lazy="newChapterTitle" placeholder="Chapter Title" class="bg-dark form-control text-xl py-8 text-center px-2 rounded font-bold" autofocus>
            </div>
            <div class="col-start-11 col-end-13 flex justify-between align-items-center">
                <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" title="Save" wire:click="addChapter({{ $groupChapterIdToBeAdded }})">
                    <i class="fas fa-save fa-2x"></i>
                </button>
                <button class="px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" wire:click="cancelAddNewChapter" title="Cancel">
                    <i class="far fa-window-close fa-2x"></i>
                </button>
            </div>
        </div>
    @else
        <div class="sticky top-14 mb-3 p-2 bg-cool-gray-500 rounded border">
            <h2 class="text-xl font-bold py-3 text-center bg-dark px-2">
                {{ $courseTitle }}
            </h2>
            <i class="fas fa-edit fa-2x absolute top-2 right-2 text-green-500 cursor-pointer hover:text-red-600" wire:click="showEditCourseTitleForm"></i>
        </div>
    @endif

    {{-- <table class="table-auto w-full mb-4 border-2 border-black">
        <thead>
            <tr class="border-b-2 border-t-2 border-black text-center pb-4 text-lg">
                <th class="w-1/4 border-l-2 border-r-2 border-black">Number</th>
                <th class="w-2/4 border-r-2 border-black">Title</th>
                <th class="w-48 border-r-2 border-black">Actions </th>
                @if (!$showAddChapterForm)
                    <th class="w-24"><i class="fas fa-plus font-bold rounded px-2 mx-2 mb-2 py-1 bg-yellow-300 hover:bg-yellow-400 cursor-pointer" wire:click="showAddChapterForm" title="Add New Chapter"></i></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($chapters as $chapter) 
            <tr class="hover:bg-cool-gray-300 text-center font-bold @if ($chapterToEditTitle === $chapter['title']) bg-gray-300 @endif">
                <td>
                    @if ($chapterToEditNumber === null)
                        {{ $chapter['number'] }}
                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterNumber({{ $chapter['id'] }})"></i>
                    @elseif ($chapterToEditNumber === $chapter['number'])
                        {{ $chapter['number'] }}
                        <input type="text" wire:model="newChapterNumber" class="bg-dark font-bold px-2 py-1 text-center rounded ml-2" autofocus>
                        <i class="fa fa-save text-blue-500 hover-text-blue-600 cursor-pointer mx-2" wire:click="handleUpdateChapterNumber({{ $chapter['id'] }})"></i>
                        <i class="fa fa-window-close text-red-500 hover-text-red-600 cursor-pointer mx-2" wire:click="cancelEditChapter"></i>
                    @else
                        {{ $chapter['number'] }}
                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterNumber({{ $chapter['id'] }})"></i>
                    @endif
                </td>
                <td>
                    @if ($chapterToEditTitle === null)
                        {{ $chapter['title'] }}
                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterTitle({{ $chapter['id'] }})"></i>
                    @elseif ($chapterToEditTitle === $chapter['title'])
                        <div class="mt-1 flex justify-center">
                            <input type="text" wire:model="newChapterTitle" class="w-3/4 bg-dark font-bold px-2 py-1 text-center rounded" value="{{ $chapter['title'] }}">
                            <i class="fa fa-save text-blue-500 hover-text-blue-600 cursor-pointer mx-2 mt-2" wire:click="handleUpdateChapterTitle({{ $chapter['id'] }})"></i>
                            <i class="fa fa-window-close text-red-500 hover-text-red-600 cursor-pointer mx-2 mt-2" wire:click="cancelEditChapter"></i>
                        </div>
                        <div>
                            {{ $chapter['title'] }}
                        </div>
                    @else
                        {{ $chapter['title'] }}
                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterTitle({{ $chapter['id'] }})"></i>
                    @endif
                </td>
                <td class="flex justify-center my-1">
                    <i class="fas fa-edit fa-2x text-green-500 cursor-pointer hover:text-green-600 mx-2" title="Edit Chapter Content" wire:click="editChapterContent({{ $chapter['id'] }})"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
    <div class="mb-20">
        @foreach ($groupOfChapters as $groupOfChapterItem)
            <table class="table-auto w-full mb-4 border-2 border-black">
                <thead>
                    <tr class="border-b-2 border-t-2 border-black text-center pb-4 text-lg">
                        <th class="w-1/4 border-l-2 border-r-2 border-black">
                            {{ $groupOfChapterItem['number'] }}
                        </th>
                        <th class="w-2/4 border-r-2 border-black">
                            {{ $groupOfChapterItem['title'] }}
                        </th>
                        <th class="w-32 border-r-2 border-black">Actions</th>
                        <th class="w-32">
                            @if (!$showAddChapterForm)
                                <i class="fas fa-plus font-bold rounded px-2 mx-2 mb-2 py-1 bg-yellow-300 hover:bg-yellow-400 cursor-pointer" wire:click="showAddChapterForm({{ $groupOfChapterItem['id'] }})" title="Add New Chapter"></i>
                            @endif
                            <i class="fas fa-trash font-bold rounded px-2 mx-2 mb-2 py-1 bg-red-600 hover:bg-red-700 cursor-pointer text-white" wire:click="confirmDeleteGroupChapter( {{ $groupOfChapterItem['id'] }} )" title="Delete this group of chapter with its subchapters ?"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($groupOfChapterItem))
                        @foreach ($groupOfChapterItem['chapters'] as $chapter) 
                            <tr class="hover:bg-cool-gray-300 text-center font-bold @if ($chapterToEditTitle === $chapter['title']) bg-gray-300 @endif">
                                <td>
                                    @if ($chapterToEditNumber === null)
                                        {{ $chapter['number'] }}
                                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterNumber({{ $chapter['id'] }})"></i>
                                    @elseif ($chapterToEditNumber === $chapter['number'])
                                        {{ $chapter['number'] }}
                                        <input type="text" wire:model="newChapterNumber" class="bg-dark font-bold px-2 py-1 text-center rounded ml-2" autofocus>
                                        <i class="fa fa-save text-blue-500 hover-text-blue-600 cursor-pointer mx-2" wire:click="handleUpdateChapterNumber({{ $chapter['id'] }})"></i>
                                        <i class="fa fa-window-close text-red-500 hover-text-red-600 cursor-pointer mx-2" wire:click="cancelEditChapter"></i>
                                    @else
                                        {{ $chapter['number'] }}
                                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterNumber({{ $chapter['id'] }})"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($chapterToEditTitle === null)
                                        {{ $chapter['title'] }}
                                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterTitle({{ $chapter['id'] }})"></i>
                                    @elseif ($chapterToEditTitle === $chapter['title'])
                                        <div class="mt-1 flex justify-center">
                                            <input type="text" wire:model="newChapterTitle" class="w-3/4 bg-dark font-bold px-2 py-1 text-center rounded" value="{{ $chapter['title'] }}">
                                            <i class="fa fa-save text-blue-500 hover-text-blue-600 cursor-pointer mx-2 mt-2" wire:click="handleUpdateChapterTitle({{ $chapter['id'] }})"></i>
                                            <i class="fa fa-window-close text-red-500 hover-text-red-600 cursor-pointer mx-2 mt-2" wire:click="cancelEditChapter"></i>
                                        </div>
                                        <div>
                                            {{ $chapter['title'] }}
                                        </div>
                                    @else
                                        {{ $chapter['title'] }}
                                        <i class="fa fa-edit text-blue-500 hover:text-blue-600 cursor-pointer mx-2" wire:click="editChapterTitle({{ $chapter['id'] }})"></i>
                                    @endif
                                </td>
                                <td class="flex justify-center my-1">
                                    <i class="fas fa-edit fa-2x text-green-500 cursor-pointer hover:text-green-600 mx-2" title="Edit Chapter Content" wire:click="editChapterContent({{ $chapter['id'] }})"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endforeach

        <div class="border-t-4 pt-3 border-black mt-6">
            <div class="flex justify-center">
                <h3 class="font-bold text-3xl tracking-widest underline">Edit Course Description</h3>
                <div class="mx-3">
                    <a href="{{ route('admin.course.showDescription', $course->id) }}"><i class="fa fa-eye fa-2x"></i></a>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.course.updateDescription', $course->id) }}">
                @csrf
                @method('PUT')
                <textarea name="courseDescription" id="course-description" hidden>
                    {!! $courseDescription !!}
                </textarea>
                <div class="flex justify-center">
                    <button class="my-4 font-bold px-4 py-2 bg-gray-700 hover:bg-gray-800 rounded mx-auto text-white tracking-widest">S U B M I T</button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('css')
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endpush

@push('js')
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        Laraberg.init('course-description', { laravelFilemanager: {
            prefix: '/lti-course-filemanager'
        }, sidebar: true });
    </script>
@endpush
