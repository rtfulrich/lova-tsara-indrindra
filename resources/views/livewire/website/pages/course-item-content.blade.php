<div>

    <div style="background: #333" class="grid grid-cols-1 md:grid-cols-12 p-4 md:p-8 gap-4 lg:gap-8">
        <div class="col-start-1 col-end-13 md:col-end-7 lg:col-end-5">
            <div class="relative">
                <img src="{{ asset('storage/course_images/'. ($course->image ?? 'default_course_image.png') ) }}" alt="Course Image" class="w-full rounded-t-lg">
                <div class="absolute bottom-0 py-1 w-full text-center" style="background: rgba(51, 51, 51, 0.9)">
                    
                </div>
            </div>
        </div>
        <div class="col-start-1 col-end-13 md:col-start-7 lg:col-start-5">
            <h1 class="font-bold text-xl mb-2">{{ $course->title }}</h1>
            <p class="text-sm mb-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur obcaecati sequi distinctio eius nemo iusto quod blanditiis. Officiis, unde incidunt dolorem itaque dolor quidem debitis sint asperiores mollitia illum vel explicabo recusandae placeat ex a animi consequuntur autem porro deserunt!
            </p>
            <p class="text-sm">
                Update farany : {{ $course->updated_at->format('d / m / Y') }}
            </p>
            <div class="text-sm my-8 md:mb-0 font-semibold">
                <span class="px-4 py-2 border-2 border-blue-700 bg-blue-700 hover:bg-blue-800 rounded-full transition-colors ease-in-out duration-300 cursor-pointer mr-4">Ampiana amy karatra</span>
                <span class="px-4 py-2 border-2 border-blue-700 hover:bg-blue-800 transition-colors ease-in-out duration-300 rounded-full cursor-pointer">Vidiana</span>
            </div>
        </div>
    </div>
    
    {{-- Row : Main Content + Right Aside --}}
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 md:pr-4 grid grid-cols-12 gap-4">
        
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
                        @if ($course->use_group_chapters)
                            @foreach ($course->groupChapters()->get() as $group)
                                <div class="px-4 py-2 flex items-center justify-between rounded-lg cursor-pointer {{ $groupChaptersToShow === $group->id ? 'bg-333-inverse mt-2' : 'bg-333' }}" wire:click="setGroupChapterToShow( {{ $group->id }} )">
                                    <h3 class="text-lg font-bold flex items-center px-2">
                                        <span class="w-13 text-center flex justify-between items-center mr-8">
                                            <span>{{ $group->number }}</span>
                                            <i class="fa fa-angle-right ml-2"></i>
                                        </span> 
                                        {{ $group->title }}
                                    </h3>
                                    <span><i class="fa fa-angle-{{ $groupChaptersToShow == $group->id ? 'up' : 'down' }} fa-2x"></i></span>
                                </div>
                                @if ($groupChaptersToShow and $groupChaptersToShow === $group->id)
                                    <ul class="ml-8 font-semibold">
                                        @foreach ($group->courseChapters()->get() as $chapter)
                                            <li class="my-2">
                                                <span class="inline-block w-6 text-center">{{ $chapter->number }}.</span>
                                                {{ $chapter->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        @endif
                    </div>

                @endif
            </div>
        </div>
        {{-- End Main Content --}}

        {{-- ____________________________________________________________________ --}}

        {{-- Right Aside --}}
            <!-- Tolokevitra fampianarana hafa -->
        <div class="hidden md:block md:col-start-9 md:col-end-13">
            <livewire:website.includes.aside-right />
        </div>
            <!-- End Tolokevitra fampianarana hafa -->
        {{-- End Right Aside --}}

    </div>
    {{-- End Row : Main Content + Aside --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Optional Above Footer With Full Width --}}
    <div>
        optional above footer
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit laborum veniam numquam quasi neque accusamus aspernatur dicta modi eligendi nemo! Quibusdam autem deleniti nostrum distinctio? Est veniam, deleniti distinctio sit voluptatem excepturi et consectetur ea nemo accusantium ipsum nobis aperiam fugit officiis dolore ut magni eius obcaecati tenetur error eligendi reiciendis vel cum saepe? Consequatur saepe temporibus ipsam alias libero officiis rerum fugiat quidem facere cupiditate porro optio tenetur dicta inventore reiciendis atque quisquam sint ipsa rem, aliquam culpa? In inventore quibusdam consequuntur aliquid sint! Doloribus soluta nam eos ea, veritatis natus facilis eligendi consequatur ipsam velit quae! Sunt, accusantium.
        </p>
    </div>
    {{-- End Optional Above Footer With Full Width --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Footer --}}
    <livewire:website.includes.footer />
    {{-- End Footer --}}

</div>