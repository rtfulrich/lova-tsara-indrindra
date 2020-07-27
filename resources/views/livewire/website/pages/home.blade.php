<div>
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 grid grid-cols-12 gap-4">
        <div class="col-start-1 col-end-13 md:col-end-10">
            
            <h1 class="font-bold text-2xl mb-4">Tongasoa eto amy Lova Tsara Indrindra</h1>

            {{-- Principal Languages / Frameworks --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
                <div class="h-40 rounded-lg p-4 hover:shadow-outline-gray transition-shadow ease-in-out duration-200" style="background: #181818">
                    <a href="{{ route('specific-hashtag', 'html-css') }}">
                        <div class="rounded-lg h-full cursor-pointer" style="background: #272727">
                            <div class="h-full rounded-lg" style="background: url({{ asset('images/front/html_css.png') }}) center/cover">
                                <h2 class="font-bold text-xl hidden">HTML CSS</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="h-40 rounded-lg p-4 hover:shadow-outline-gray transition-shadow ease-in-out duration-200" style="background: #181818">
                    <a href="{{ route('specific-hashtag', 'javascript') }}">
                        <div class="rounded-lg h-full cursor-pointer" style="background: #272727">
                            <div class="h-full rounded-lg" style="background: url({{ asset('images/front/javascript.jpg') }}) center/cover">
                                <h2 class="font-bold text-xl hidden">JavaScript</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="h-40 rounded-lg p-4 hover:shadow-outline-gray transition-shadow ease-in-out duration-200" style="background: #181818">
                    <a href="{{ route('specific-hashtag', 'php') }}">
                        <div class="rounded-lg h-full cursor-pointer" style="background: #272727">
                            <div class="h-full rounded-lg" style="background: url({{ asset('images/front/php.png') }}) center/cover">
                                <h2 class="font-bold text-xl hidden">PHP</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="h-40 rounded-lg p-4 hover:shadow-outline-gray transition-shadow ease-in-out duration-200" style="background: #181818">
                    <a href="{{ route('specific-hashtag', 'laravel') }}">
                        <div class="rounded-lg h-full cursor-pointer" style="background: #272727">
                            <div class="h-full rounded-lg" style="background: url({{ asset('images/front/laravel.png') }}) center/cover">
                                <h2 class="font-bold text-xl hidden">Laravel</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            {{-- Latest Formations / Practices --}}
            <div>
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg mb-4">Fampianarana nivoaka farany</h2>
                    <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">
                        <a href="{{ route('latest-courses') }}">Jerena aby</a>
                        
                    </p>
                </div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($formations as $course)
                            <div class="p-4 rounded-lg swiper-slide" style="background: #333">
                                <div class="course-item-presentation">
                                    <a href="{{ route('course.content', [$course->hashTags()->first()->name, $course->slug]) }}">
                                        <div class="relative h-56 sm:h-40 rounded-lg" 
                                            style="background: url({{ asset('storage/course_images/'.$course->image) }}) center/cover"
                                        >
                                            <span class="absolute top-0 right-0 -mt-2 -mr-2 px-3 py-1 bg-red-600 rounded-full text-sm font-bold">
                                                {{ $loop->index + 1 }}
                                            </span>
                                            {{-- <span class="absolute top-4 left-4 px-3 py-1 bg-green-500 rounded-full text-sm font-bold">
                                                <i class="fas fa-thumbs-up mx-1"></i> 50
                                            </span> --}}
                                        </div>
                                    </a>
                                    <div class="">
                                        {{-- <p class="text-xs my-2">109k jery <span class="mx-2 font-bold">|</span>15 andro izay</p> --}}
                                        <h2 class="font-bold my-2 hover:text-gray-200">
                                            <a href="{{ route('course.content', [$course->hashTags()->first()->name, $course->slug]) }}">
                                                {{ $course->title }}
                                            </a>
                                        </h2>
                                        <p class="text-xs mb-3">
                                            Dev Web <span class="mx-2 font-bold">|</span>
                                            @foreach ($course->hashTags as $hashTag)
                                                <span class="px-2 rounded-full bg-black text-white font-bold py-1 mr-1">#{{ $hashTag->name }}</span>
                                            @endforeach
                                        </p>
                                        <div class="flex justify-between">
                                            <p class="text-sm">By 
                                                <span class="font-bold">
                                                    {{ $course->owner->first_name ? ($course->owner->first_name . ' ' . $course->owner->last_name) : $course->owner->username }}
                                                </span>
                                            </p>
                                            <p class="font-bold">5.000 Ar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next font-bold text-red-600"></div>
                    <div class="swiper-button-prev"></div>

                </div> {{-- End Swiper Container --}}
            </div> 

            {{-- Latest Tutorials --}}
            <div class="my-4">
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg mb-4">Tuto nivoaka farany</h2>
                    <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">
                        <a href="{{ route('latest-tutorials') }}">Jerena aby</a>
                    </p>
                </div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($tutos as $course)
                            <div class="p-4 rounded-lg swiper-slide" style="background: #333">
                                <div class="course-item-presentation">
                                    <a href="{{ route('course.content', [$course->hashTags()->first()->name, $course->slug]) }}">
                                        <div class="relative h-56 sm:h-40 rounded-lg" 
                                            style="background: url({{ asset('storage/course_images/'.$course->image) }}) center/cover"
                                        >
                                            <span class="absolute top-0 right-0 -mt-2 -mr-2 px-3 py-1 bg-red-600 rounded-full text-sm font-bold">
                                                {{ $loop->index + 1 }}
                                            </span>
                                            {{-- <span class="absolute top-4 left-4 px-3 py-1 bg-green-500 rounded-full text-sm font-bold">
                                                <i class="fas fa-thumbs-up mx-1"></i> 50
                                            </span> --}}
                                        </div>
                                    </a>
                                    <div class="">
                                        {{-- <p class="text-xs my-2">109k jery <span class="mx-2 font-bold">|</span>15 andro izay</p> --}}
                                        <h2 class="font-bold my-2 hover:text-gray-200">
                                            <a href="{{ route('course.content', [$course->hashTags()->first()->name, $course->slug]) }}">
                                                {{ $course->title }}
                                            </a>
                                        </h2>
                                        <p class="text-xs mb-3">
                                            Dev Web <span class="mx-2 font-bold">|</span>
                                            @foreach ($course->hashTags as $hashTag)
                                                <span class="px-2 rounded-full bg-black text-white font-bold py-1 mr-1">#{{ $hashTag->name }}</span>
                                            @endforeach
                                        </p>
                                        <div class="flex justify-between">
                                            <p class="text-sm">By 
                                                <span class="font-bold">
                                                    {{ $course->owner->first_name ? ($course->owner->first_name . ' ' . $course->owner->last_name) : $course->owner->username }}
                                                </span>
                                            </p>
                                            <p class="font-bold">5.000 Ar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next font-bold text-red-600"></div>
                    <div class="swiper-button-prev"></div>

                </div> {{-- End Swiper Container --}}
            </div> 

            {{-- Blogs --}}
            <!--<div class="mb-4">
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg mb-4">Blog</h2>
                    <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">Jerena aby</p>
                </div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($tutos as $course)
                            <div class="p-4 rounded-lg swiper-slide" style="background: #333">
                                <div class="course-item-presentation">
                                    <div class="relative h-56 sm:h-40 rounded-lg" 
                                        style="background: url({{ asset('storage/course_images/'.$course->image) }}) center/cover"
                                    >
                                        <span class="absolute top-0 right-0 -mt-2 -mr-2 px-3 py-1 bg-red-600 rounded-full text-sm font-bold">
                                            {{ $loop->index + 1 }}
                                        </span>
                                        {{-- <span class="absolute top-4 left-4 px-3 py-1 bg-green-500 rounded-full text-sm font-bold">
                                            <i class="fas fa-thumbs-up mx-1"></i> 50
                                        </span> --}}
                                    </div>
                                    <div class="">
                                        {{-- <p class="text-xs my-2">109k jery <span class="mx-2 font-bold">|</span>15 andro izay</p> --}}
                                        <h2 class="font-bold my-2">{{ $course->title }}</h2>
                                        <p class="text-xs mb-3">
                                            Dev Web <span class="mx-2 font-bold">|</span>
                                            @foreach ($course->hashTags as $hashTag)
                                                <span class="px-2 rounded-full bg-black text-white font-bold py-1 mr-1">#{{ $hashTag->name }}</span>
                                            @endforeach
                                        </p>
                                        <div class="flex justify-between">
                                            <p class="text-sm">By 
                                                <span class="font-bold">
                                                    {{ $course->owner->first_name ? ($course->owner->first_name . ' ' . $course->owner->last_name) : $course->owner->username }}
                                                </span>
                                            </p>
                                            <p class="font-bold">5.000 Ar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- <!-- Add Pagination --> --}}
                    <div class="swiper-pagination"></div>
                    {{-- <!-- Add Arrows --> --}}
                    <div class="swiper-button-next font-bold text-red-600"></div>
                    <div class="swiper-button-prev"></div>

                </div> {{-- End Swiper Container --}}
            </div> -->

        </div>
        
        <div class="hidden md:block md:col-start-10 md:col-end-13">
            <livewire:website.includes.aside-right />
        </div>
    </div>

    {{-- <div class="px-2 sm:px-4 md:px-8 mb-8">
        <h2 class="font-bold text-lg mb-4">Hevitra tsara avy amy mpianatra momban' Lova Tsara Indrindra</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="p-4 pr-1 rounded-lg" style="background: #333">
                <p class="max-h-96 overflow-y-auto pr-1 text-sm">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe, et nemo. Sapiente commodi officia eaque nostrum provident ea atque, fugiat maxime tempora est natus. Doloremque unde asperiores voluptas impedit fugit, ullam cupiditate velit repellendus hic eius officia? Atque fug
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse voluptate rerum possimus quas suscipit repellat, perspiciatis eius magni necessitatibus laudantium?Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil voluptate, accusamus inventore in rerum possimus excepturi non asperiores sint, aperiam distinctio optio obcaecati quisquam iusto quam temporibus! Quod, quas in.
                </p>
                <div class="flex items-center">
                    <p class="py-3 pr-3"><img src="{{ asset('images/front/profile.jpeg') }}" alt="User Profile" width="50"></p>
                    <h3 class="font-semibold">Tahirintsoa Ulrich</h3>
                </div>
            </div>
            <div class="p-4 pr-1 rounded-lg" style="background: #333">
                <p class="max-h-96 overflow-y-auto pr-1 text-sm">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint corporis, iure quasi ut quas ad quos dolore minus reprehenderit possimus.
                </p>
                <div class="flex items-center">
                    <p class="py-3 pr-3"><img src="{{ asset('images/front/profile.jpeg') }}" alt="User Profile" width="50"></p>
                    <h3 class="font-semibold">Tahirintsoa Ulrich</h3>
                </div>
            </div>
            <div class="p-4 pr-1 rounded-lg" style="background: #333">
                <p class="max-h-96 overflow-y-auto pr-1 text-sm">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga consectetur laboriosam dolor culpa corrupti rem, odio iste cumque minima natus deserunt tempora commodi, harum sunt, velit magnam expedita inventore pariatur.
                </p>
                <div class="flex items-center">
                    <p class="py-3 pr-3"><img src="{{ asset('images/front/profile.jpeg') }}" alt="User Profile" width="50"></p>
                    <h3 class="font-semibold">Tahirintsoa Ulrich</h3>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="">
        <livewire:website.includes.footer />
    </div>

</div>

@section('title')
    Lova Tsara Indrindra - Tongasoa
@endsection

@prepend('css')
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
@endprepend

@push('js')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script>
        (function () {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 15,
                slidesPerGroup: 1,
                loop: true,
                loopFillGroupWithBlank: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    // sm
                    640: {
                        slidesPerView: 2,
                    },
                    // md
                    768: {
                        slidesPerView: 2,
                    },
                    // lg
                    992: {
                        slidesPerView: 2,
                    },
                    // xl
                    1024: {
                        slidesPerView: 2,
                    },
                }
            });
        }) ();
    </script>
@endpush