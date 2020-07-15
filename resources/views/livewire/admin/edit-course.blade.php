<div>
    
    @if (session()->has('msg') and $showFlashMsg)
        <div class="absolute top-0 right-0 p-4 bg-yellow-500 rounded z-50 font-bold text-lg cursor-pointer text-white" wire:click="removeFlashMsg">
            {{ session('msg') }}
            <i class="fa fa-window-close absolute top-1 right-1 text-gray-900 text-sm cursor-pointer hover:text-red-800" wire:click="removeFlashMsg"></i>
        </div>
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
                <input type="text" wire:model="newChapterNumber" placeholder="N°" class="bg-dark form-control py-8 text-xl font-bold rounded text-center" value="{{ end($chapters)['number'] + 1 }}">
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
    @else
        <div class="sticky top-14 mb-3 p-2 bg-cool-gray-500 rounded border">
            <h2 class="text-xl font-bold py-3 text-center bg-dark px-2">
                {{ $courseTitle }}
            </h2>
            <i class="fas fa-edit fa-2x absolute top-2 right-2 text-green-500 cursor-pointer hover:text-red-600" wire:click="showEditCourseTitleForm"></i>
        </div>
    @endif

    <table class="table-auto w-full mb-4">
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
    </table>

</div>
