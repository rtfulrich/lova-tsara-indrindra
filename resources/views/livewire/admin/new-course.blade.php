<form wire:submit.prevent="submit">

    @if (session()->has('msg') and $showFlashMsg)
        <div class="absolute top-0 right-0 p-4 bg-yellow-500 rounded z-50 font-bold text-lg cursor-pointer text-white" wire:click="removeFlashMsg">
            {{ session('msg') }}
            <i class="fa fa-window-close absolute top-1 right-1 text-gray-900 text-sm cursor-pointer hover:text-red-800" wire:click="removeFlashMsg"></i>
        </div>
    @endif
    
    @if (!$showAddChapterForm)
        <div class="sticky top-14 mb-3 p-2 bg-cool-gray-500 rounded border">
            <input type="text" placeholder="Course Title" class="text-xl font-bold text-center py-8 form-control bg-dark px-2" autofocus wire:model.lazy="courseTitle" />
        </div>
    @else
        <div class="grid grid-cols-12 gap-4 mb-3 p-2 sticky top-14 bg-cool-gray-500 rounded border">
            <div class="col-start-1 col-end-3">
                <input type="text" wire:model="newChapterNumber" placeholder="N°" class="bg-dark form-control py-8 text-xl font-bold rounded text-center">
            </div>
            <div class="col-start-3 col-end-11">
                <input type="text" wire:model.lazy="newChapterTitle" placeholder="Chapter Title" class="bg-dark form-control text-xl py-8 text-center px-2 rounded font-bold" autofocus>
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
    
    @if (!empty($chapters))
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
    @endif

    <div class="fixed bottom-0 right-0 mb-3">
        <div class="flex">
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