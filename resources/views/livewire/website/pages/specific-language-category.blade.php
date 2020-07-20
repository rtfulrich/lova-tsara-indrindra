<div>
    
    {{-- Row : Main Content + Right Aside --}}
    <div class="px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 grid grid-cols-12 gap-4">
        
        {{-- Main Content --}}
        <div class="col-start-1 col-end-13 md:col-end-10">
            <h1 class="font-bold text-2xl mb-4">Ny contena rehetra momba an JAVASCRIPT</h1>

            <div>
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg mb-4">Fampianarana</h2>
                    <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">Jerena aby</p>
                </div>

                <div>
                    {{-- foreach --}}
                    <div class="grid grid-cols-12 h:24 md:h-36 gap-3 md:gap-4 rounded-lg p-2 md:py-2 md:px-4 mb-4 hover:shadow-outline-blue transition-shadow ease-in-out duration-200 cursor-pointer" wire:click="block" style="background: #333">
                        <div class="col-start-1 col-end-5">
                            <img src="{{ asset('images/front/javascript_course.jpg') }}" alt="Course Image" class="h-full rounded-lg">
                        </div>
                        <div class="col-start-5 col-end-13">
                            <div class="flex flex-col justify-between h-full py-2 sm:py-4 text-sm">
                                <h2 class="font-semibold sm:font-bold">Bootcamp Javascript feno : miainga aotra hatramy herô amy Javascript</h2>
                                <div class="flex justify-between" wire:click="abc">
                                    fgds
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- endforeach --}}
                </div>
            </div>

            <div>
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg mb-4">Tuto</h2>
                    <p class="text-sm text-gray-500 mr-4 hover:text-gray-400 cursor-pointer transition-colors ease-in-out duration-300">Jerena aby</p>
                </div>

                <div>
                    {{-- foreach --}}
                    <div class="grid grid-cols-12 h:24 md:h-36 gap-3 md:gap-4 rounded-lg p-2 md:py-2 md:px-4 mb-4 hover:shadow-outline-blue transition-shadow ease-in-out duration-200 cursor-pointer" wire:click="block" style="background: #333">
                        <div class="col-start-1 col-end-5">
                            <img src="{{ asset('images/front/javascript_course.jpg') }}" alt="Course Image" class="h-full rounded-lg">
                        </div>
                        <div class="col-start-5 col-end-13">
                            <div class="flex flex-col justify-between h-full py-2 sm:py-4 text-sm">
                                <h2 class="font-semibold sm:font-bold">Bootcamp Javascript feno : miainga aotra hatramy herô amy Javascript</h2>
                                <div class="flex justify-between" wire:click="abc">
                                    fgds
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- endforeach --}}
                </div>
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
        optional above footer
    </div>
    {{-- End Optional Above Footer With Full Width --}}

    {{-- ____________________________________________________________________ --}}

    {{-- Footer --}}
    <livewire:website.includes.footer />
    {{-- End Footer --}}

</div>