<form wire:submit.prevent="submit">

    @if (session()->has('msg') and $showFlashMsg)
        <div class="absolute top-0 right-0 p-4 bg-yellow-500 rounded z-50 font-bold text-lg cursor-pointer text-white" wire:click="removeFlashMsg">
            {{ session('msg') }}
            <i class="fa fa-window-close absolute top-1 right-1 text-gray-900 text-sm cursor-pointer hover:text-red-800" wire:click="removeFlashMsg"></i>
        </div>
    @endif
    
    @if ($showCourseTitleForm)
        <div class="sticky top-14 mb-3 p-2 bg-cool-gray-500 rounded border">
            <input type="text" placeholder="Course Title" class="text-xl font-bold text-center py-8 form-control bg-dark px-2" autofocus wire:model.lazy="courseTitle" />
        </div>
    @elseif ($showAddGroupOfChaptersForm)
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border">
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
                <button class="px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" wire:click.prevent="cancelAddGroupOfChapters" title="Cancel">
                    <i class="far fa-window-close fa-2x"></i>
                </button>
            </div>
        </div>
    @elseif ($showAddChapterForm)
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border">
            <div class="col-start-1 col-end-2">
                <input type="text" wire:model="newChapterNumber" placeholder="N°" class="bg-dark form-control py-8 text-xl font-bold rounded text-center">
            </div>
            <div class="col-start-2 col-end-3">
                <input type="text" wire:model="newChapterNumberInGroup" placeholder="N°g" class="bg-dark form-control py-8 text-xl font-bold rounded text-center">
            </div>
            <div class="col-start-3 col-end-11">
                <input type="text" wire:model.lazy="newChapterTitle" placeholder="Chapter Title" class="bg-dark form-control text-xl py-8 text-center px-2 rounded font-bold">
            </div>
            <div class="col-start-11 col-end-13 flex justify-between align-items-center">
                <button class="px-3 pt-3 pb-2 rounded bg-blue-600 hover:bg-blue-700" title="Add" wire:click.prevent="addChapter">
                    <i class="fas fa-plus fa-2x"></i>
                </button>
                <button class="px-3 pt-3 pb-2 rounded bg-red-600 hover:bg-red-700" wire:click.prevent="cancelAddNewChapter" title="Cancel">
                    <i class="far fa-window-close fa-2x"></i>
                </button>
            </div>
        </div>
    @endif

    @foreach ($chaptersWithParentGroup as $group)
        <hr>
        <table class="table-auto">
            <thead>
                <tr class="text-center text-lg border-b">
                    <th class="py-2 px-4">{{ $group['number'] }}</th>
                    <th class="py-2 px-4">{{ $group['title'] }}</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($group['chapters']))
                    @foreach ($group['chapters'] as $chapter)
                    <tr class="hover:bg-cool-gray-300 text-center">
                        <td class="border-2 py-2 px-4">{{ $chapter['number'] }}</td>
                        <td class="border-2 py-2 px-4">{{ $chapter['title'] }}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr class="text-center font-semibold italic">
                        <td colspan="2">No Chapter Yet !!!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr>
    @endforeach

    {{-- @if (!empty($chapters))
    <div class="flex justify-center">
        <table class="table-auto">
            <thead>
                <tr class="text-center">
                    <th class="py-2 px-4">Number</th>
                    <th class="py-2 px-4">Chapter Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chapters as $chapter)
                <tr class="hover:bg-cool-gray-300 text-center">
                    <td class="border-2 py-2 px-4">{{ $chapter['number'] }}</td>
                    <td class="border-2 py-2 px-4">{{ $chapter['title'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif --}}

    <div class="fixed bottom-0 right-0 mb-3">
        <div class="flex">
            @if (!$showAddGroupOfChaptersForm)
            <button class="py-2 px-4 bg-green-700 rounded-full hover:bg-green-800 text-bold text-white text-lg mx-3 w-60" wire:click.prevent="showAddGroupOfChaptersForm">
                Add a Group of Chapters
            </button>
            @else
            <button class="py-2 px-4 bg-red-700 rounded-full hover:bg-red-800 text-bold text-white text-lg mx-3 w-60" wire:click.prevent="cancelAddGroupOfChapters">
                Cancel New Group of Chapters
            </button>
            @endif

            @if (!$showAddChapterForm)
            <button class="py-2 px-4 bg-green-700 rounded-full hover:bg-green-800 text-bold text-white text-lg mx-3 w-60" wire:click.prevent="showAddChapterForm">
                Add a Chapter
            </button>
            @else
            <button class="py-2 px-4 bg-red-700 rounded-full hover:bg-red-800 text-bold text-white text-lg mx-3 w-60" wire:click.prevent="cancelAddNewChapter">
                Cancel New Chapter
            </button>
            @endif
            <button class="py-2 px-4 {{ $showAddChapterForm ? "bg-green-700" : "bg-green-600" }} rounded-full hover:bg-green-800 text-bold text-white text-lg mx-3 w-60" wire:click.prevent="submit">
                Submit
            </button>
        </div>
    </div>
    
</form>