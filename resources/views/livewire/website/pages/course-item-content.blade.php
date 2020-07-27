<div>

    <div style="background: #333" class="grid grid-cols-1 md:grid-cols-12 p-4 md:p-8 gap-4 lg:gap-8">
        <div class="col-start-1 col-end-13 md:col-end-7 lg:col-end-5">
            <div class="relative">
                <img src="{{ asset('storage/course_images/'. ($course->image ?? 'default_course_image.png') ) }}" alt="Course Image" class="w-full rounded-t-lg">
                <div class="absolute bottom-0 py-1 w-full text-center" style="background: rgba(51, 51, 51, 0.9); z-index: 60">
                    
                </div>
            </div>
        </div>
        <div class="col-start-1 col-end-13 md:col-start-7 lg:col-start-5">
            <h1 class="font-bold text-xl mb-2">{{ $course->title }}</h1>
            <p class="text-sm mb-4">
                {{ $course->pre_description }}
            </p>
            <p class="text-sm">
                Update farany : {{ $course->updated_at->format('d / m / Y') }}
            </p>
            @auth
                <div class="text-sm my-8 md:mb-0 font-semibold">
                    <span class="px-4 py-2 border-2 border-red-700 bg-red-700 hover:bg-red-800 rounded-full transition-colors ease-in-out duration-300 cursor-pointer mr-4">Ampiana amy karatra</span>
                    <span class="px-4 py-2 border-2 border-red-700 hover:bg-red-800 transition-colors ease-in-out duration-300 rounded-full cursor-pointer">Vidiana</span>
                </div>
            @endauth
        </div>
    </div>
    
    {{-- Row : Main Content + Right Aside --}}
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 md:pr-4 grid grid-cols-12 gap-4 mb-4">
        
        {{-- Main Content --}}
        <div class="col-start-1 col-end-13 md:col-end-9">
            <div class="flex justify-center text-sm md:text-base font-bold mb-8">
                <span class="px-4 pb-2 cursor-pointer @if ($showCourseAbout) text-blue-500 border-b-2 border-blue-700 @endif" wire:click="changeShowCourseAbout">
                    Momba
                </span>
                <span class="px-4 pb-2 cursor-pointer @if (!$showCourseAbout) text-blue-500 border-b-2 border-blue-700 @endif" wire:click="changeShowCourseAbout">
                    Kontenan' fampianarana
                </span>
            </div>

            <div class="text-sm">
                @if ($showCourseAbout) 
                    {!! $course->description !!}
                @else

                    <div class="">
                            @foreach ($course->groupChapters()->get() as $group)
                                @if ($course->use_group_chapters)
                                    <div class="px-4 py-2 flex items-center justify-between rounded-lg cursor-pointer my-2 {{ $groupChaptersToShow === $group->id ? 'bg-333-inverse' : 'bg-333' }}" wire:click="setGroupChapterToShow( {{ $group->id }} )">
                                        <h3 class="text-lg font-bold flex items-center px-2">
                                            <span class="w-13 text-center flex justify-between items-center mr-8">
                                                <span>{{ $group->number }}</span>
                                                <i class="fa fa-angle-right ml-2"></i>
                                            </span> 
                                            {{ $group->title }}
                                        </h3>
                                        <span><i class="fa fa-angle-{{ $groupChaptersToShow == $group->id ? 'up' : 'down' }} fa-2x"></i></span>
                                    </div>
                                @endif
                                
                                @if (!$course->use_group_chapters)
                                    <ul class="ml-8 font-semibold">
                                        @foreach ($group->courseChapters()->get() as $chapter)
                                            <li class="my-2">
                                                <a 
                                                    href="{{ route('course.chapter.content', [
                                                        'hashTag' => $courseFirstHashTag,
                                                        'courseSlug' => $course->slug, 
                                                        'chapterSlug' => $chapter->slug
                                                    ]) }}" 
                                                    class="hover:text-gray-400 transition-colors ease-in-out duration-200"
                                                >
                                                    <span class="inline-block w-6 text-center">{{ $chapter->number }}.</span>
                                                    {{ $chapter->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    @if ($groupChaptersToShow and $groupChaptersToShow === $group->id)
                                        <ul class="ml-8 font-semibold">
                                            @foreach ($group->courseChapters()->get() as $chapter)
                                                <li class="my-2">
                                                    <a 
                                                        href="{{ route('course.chapter.content', [
                                                            'hashTag' => $courseFirstHashTag,
                                                            'courseSlug' => $course->slug, 
                                                            'chapterSlug' => $chapter->slug
                                                        ]) }}" 
                                                        class="hover:text-gray-400 transition-colors ease-in-out duration-200"
                                                    >
                                                        <span class="inline-block w-6 text-center">{{ $chapter->number }}.</span>
                                                        {{ $chapter->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            @endforeach
                    </div>

                @endif
            </div>
        </div>
        {{-- End Main Content --}}

        {{-- ____________________________________________________________________ --}}

        {{-- Right Aside --}}
            <!-- Tolokevitra fampianarana hafa -->
        <div class="hidden md:block md:col-start-9 md:col-end-13">
            <livewire:website.includes.aside-right :courseId="$course->id" />
        </div>
            <!-- End Tolokevitra fampianarana hafa -->
        {{-- End Right Aside --}}

    </div>
    {{-- End Row : Main Content + Aside --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Optional Above Footer With Full Width --}}
    <div class="pb-4 grid grid-cols-12 gap-4 px-8">
        <div class="min-h-48 col-start-1 col-end-13 md:col-end-6">
            <h3 class="font-bold text-lg mb-2">Tsikera</h3>
            <div class="">
                <textarea class="w-full rounded-lg bg-gray-200 focus:bg-white p-2 text-black mb-2" rows="5" wire:model.lazy="newCourseComment"></textarea>
                <button class="px-2 py-1 text-sm rounded-lg font-semibold bg-blue-600 hover:bg-blue-700 float-right focus:outline-none" wire:click="addCourseComment">Itsikera</button>
            </div>
        </div>
        <div class="max-h-96 col-start-1 md:col-start-6 col-end-13 text-xs overflow-y-auto">
            @foreach ($courseComments as $comment)
                <div class="mb-4">
                    <p>
                        <i class="font-bold">.</i>
                        <span class="font-semibold mr-2">
                            <i class="underline">{{ ($comment->owner->first_name and $comment->owner->last_name) ? ($comment->owner->first_name . ' ' . $comment->owner->last_name) : $comment->owner->username }}</i>
                            <i class="fa fa-angle-right ml-2 hover:text-blue-600 cursor-pointer" wire:click="toggleCommentReplies( {{ $comment->id }} )"></i>
                        </span>
                        {{ $comment->content }}
                        @if ($commentIdToReply !== $comment->id)
                            <i wire:click="showReplyCommentForm( {{ $comment->id }} )" class="text-blue-500 hover:text-blue-600 underline font-bold px-2 rounded cursor-pointer">Valiana</i>
                            @if ($commentIdToShowReplies !== $comment->id and $comment->replies()->count() > 0)
                                <span>(valiny {{ $comment->replies()->count() }})</span>
                            @endif
                        @endif
                    </p>
                    @if ($commentIdToReply === $comment->id)
                        <span class="italic hover:text-cool-gray-200 text-xs ml-6 cursor-pointer">
                            <textarea class="text-sm rounded-lg text-black px-2 mt-2 bg-gray-200 focus:bg-white" rows="1" style="width: calc(100% - 1.5rem)" wire:model.lazy="newCommentReply"></textarea>
                            <button class="px-2 py-1 rounded font-bold bg-red-600 hover:bg-red-700 float-right mx-2" wire:click="cancelReply">Foanana</button>
                            <button class="px-2 py-1 rounded font-bold bg-blue-600 hover:bg-blue-700 float-right" wire:click="replyComment( {{ $comment->id }} )">Valiana</button>
                        </span> 
                    @endif
                    @if ($commentIdToShowReplies === $comment->id)
                        @foreach ($comment->replies()->latest()->get() as $reply)
                            <p class="ml-6 my-2">
                                <span class="font-semibold mr-2 italic">
                                    {{ ($reply->owner->first_name and $reply->owner->last_name) ? ($reply->owner->first_name . ' ' . $reply->owner->last_name) : $reply->owner->username }} 
                                    <i class="fa fa-angle-right ml-2 hover:underline"></i>
                                </span>
                                {{ $reply->content }}
                            </p>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    {{-- End Optional Above Footer With Full Width --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Footer --}}
    <livewire:website.includes.footer />
    {{-- End Footer --}}

</div>

@section('title') {{ $course->title }} @stop