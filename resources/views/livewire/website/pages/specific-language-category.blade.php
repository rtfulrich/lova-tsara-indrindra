<div>
    
    {{-- Row : Main Content + Right Aside --}}
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 grid grid-cols-12 gap-4">
        
        {{-- Main Content --}}
        <div class="col-start-1 col-end-13 md:col-end-10">
            <h1 class="font-bold text-2xl mb-4">Ny content rehetra momba an <span class="uppercase">{{ $hashTag }}</span></h1>

            <div>
                @if (count($courses) > 0)
                    <div class="flex justify-between">
                        <h2 class="font-bold text-lg mb-4">Fampianarana</h2>
                        @if (count($courses) > 3)
                            <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">Jerena aby</p>
                        @endif
                    </div>
                @endif

                <div>
                    @if (count($courses) > 0)
                        @foreach ($courses as $course)
                            <a href="{{ route('course.content', [$hashTag, $course->slug]) }}">
                                <div class="grid grid-cols-12 h:24 md:h-36 gap-3 md:gap-4 rounded-lg p-2 md:py-2 md:px-4 mb-4 hover:shadow-outline-blue transition-shadow ease-in-out duration-200 cursor-pointer" wire:click="block" style="background: #333">
                                    <div class="col-start-1 col-end-5">
                                        <img src="{{ asset('storage/course_images/'.$course->image) }}" alt="Course Image" class="h-full rounded-lg">
                                    </div>
                                    <div class="col-start-5 col-end-13">
                                        <div class="flex flex-col justify-between h-full py-2 sm:py-4 text-sm">
                                            <h2 class="font-semibold sm:font-bold">{{ $course->title }}</h2>
                                            <div class="flex justify-between">
                                                <span>
                                                    <span class="text-xs">{{ $course->level ? ($course->level . ' | ') : '' }}</span>
                                                    By <span class="font-bold">
                                                        {{ $course->owner->first_name ? ($course->owner->first_name . ' ' . $course->owner->last_name) : $course->owner->username }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else

                    @endif
                </div>
            </div>

            <div>
                @if (count($tutos) > 0)
                    <div class="flex justify-between">
                        <h2 class="font-bold text-lg mb-4">Tuto</h2>
                        @if (count($tutos) > 3)
                            <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">Jerena aby</p>
                        @endif
                    </div>
                @endif

                @if (count($tutos) > 0)
                    @foreach ($tutos as $course)
                        <a href="{{ route('course.content', [$hashTag, $course->slug]) }}">
                            <div class="grid grid-cols-12 h:24 md:h-36 gap-3 md:gap-4 rounded-lg p-2 md:py-2 md:px-4 mb-4 hover:shadow-outline-blue transition-shadow ease-in-out duration-200 cursor-pointer" style="background: #333">
                                <div class="col-start-1 col-end-5">
                                    <img src="{{ asset('storage/course_images/'.$course->image) }}" alt="Course Image" class="h-full rounded-lg">
                                </div>
                                <div class="col-start-5 col-end-13">
                                    <div class="flex flex-col justify-between h-full  text-sm">
                                        <h2 class="font-semibold sm:font-bold">{{ $course->title }}</h2>
                                        <p style="font-size: 0.80rem">
                                            {{ substr($course->pre_description, 0, 190) }} 
                                            {{ strlen($course->pre_description) > 190 ? '...' : '' }}
                                        </p>
                                        <div class="flex justify-between" wire:click="abc">
                                            <span>
                                                @if ($course->level)
                                                    <span class="text-blue-400 text-xs">
                                                        @if ($course->level === 'easy') Mora @endif 
                                                        @if ($course->level === 'average') Antonony @endif 
                                                        @if ($course->level === 'hard') Sarotra @endif |
                                                    </span>
                                                @endif
                                                By <span class="font-bold">
                                                    {{ $course->owner->first_name ? ($course->owner->first_name . ' ' . $course->owner->last_name) : $course->owner->username }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else

                @endif
            </div>

        </div>
        {{-- End Main Content --}}

        {{-- ____________________________________________________________________ --}}

        {{-- Right Aside --}}
        <div class="hidden md:block md:col-start-10 md:col-end-13">
            <livewire:website.includes.aside-right />
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
    <div class="flex flex-col justify-end" style="flex: 1">
        <livewire:website.includes.footer />
    </div>
    {{-- End Footer --}}

</div>

@section('title') {{ $pageTitle }} @endsection