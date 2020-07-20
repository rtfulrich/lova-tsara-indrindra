<div class="mx-2 sm:mx-4 md:mx-0 px-2 pt-2 sm:px-4 sm:pt-4 md:px-8 md:pt-8 md:flex justify-between">

    <div class="sm:mx-auto sm:w-full sm:max-w-md rounded-lg mb-4">
        <h2 class="mt-6 text-6xl font-extrabold text-center tracking-widest text-yellow-300">
            Miserà amy kaonty' nao
        </h2>
        <p class="mt-2 text-center  leading-5 max-w">
            Na
            <a href="{{ route('register') }}" class="font-medium text-orange-500 hover:text-orange-600 focus:outline-none focus:underline transition ease-in-out duration-150" >
                mamoröna kaonty vaovao
            </a>
        </p>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 text-white shadow rounded-lg sm:px-10" style="background: #333">
            <form wire:submit.prevent="authenticate">
                <div>
                    <label for="email" class="block font-medium leading-5">
                        Adiresy Email
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input style="color: black" wire:model.lazy="email" id="email" name="email" type="email" required autocomplete="false" autofocus class="appearance-none font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm md:text-lg sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block font-medium leading-5">
                        Tenimiafina
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input  style="color: black" wire:model.lazy="password" id="password" type="password" required class="appearance-none text-lg font-semibold block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input wire:model.lazy="remember" id="remember" type="checkbox" class="form-checkbox w-4 h-4 text-indigo-600 transition duration-150 ease-in-out" />
                        <label for="remember" class="block ml-2 leading-5">
                            Tadidiana aho
                        </label>
                    </div>

                    <div class="leading-5">
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-500 hover:text-indigo-400 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Adino ny teny miafina ?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out font-bold">
                            H I S E R A
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
