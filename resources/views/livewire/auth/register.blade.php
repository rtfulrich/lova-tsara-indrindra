<div class="mx-2 sm:mx-4 md:mx-0 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 md:flex justify-between">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-white">
        <h2 class="mt-6 text-6xl font-extrabold mb-4 text-center leading-9 tracking-widest text-yellow-300">
            Hisoratra
        </h2>

        <p class="mt-2 text-center leading-5 max-w">
            Na
            <a href="{{ route('login') }}" class="font-medium text-orange-500 hover:text-orange-600 focus:outline-none focus:underline transition ease-in-out duration-150">
                miserà amy kaonty' nao
            </a>
        </p>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md mx-4">
        <div class="px-4 py-8 shadow rounded-lg sm:px-10" style="background: #333;">
            <form wire:submit.prevent="register">
                <div>
                    <label for="username" class="block font-medium leading-5">
                        Anarasafidy {{--<span class="text-green-400 text-sm">(azo dinganina)</span>--}}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input style="color: black" 
                            wire:model.lazy="username" 
                            id="username" type="text" 
                            class="appearance-none font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-lg sm:leading-5 @error('username') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" 
                            required autofocus
                        />
                    </div>

                    @error('username')
                        <p class="mt-2 text-sm text-red-500 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="email" class="block font-medium  leading-5">
                        Adiresy Email
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input style="color: black" wire:model.lazy="email" id="email" type="email" required class="appearance-none font-semibold  block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-lg sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-500 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block font-medium  leading-5">
                        Teny Miafina
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input style="color: black" wire:model.lazy="password" id="password" type="password" required class="appearance-none font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-lg sm:leading-5 
                        @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-500 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password_confirmation" class="block font-medium  leading-5">
                        Avereno ny tenimiafina
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input style="color: black" wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required class="block w-full px-3 py-2 placeholder-gray-400 border font-semibold border-gray-300 appearance-none rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-lg sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-lg font-bold text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            H I S O R A T R A
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
