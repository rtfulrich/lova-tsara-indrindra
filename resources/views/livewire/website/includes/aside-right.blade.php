<div class="text-white px-4 py-8 rounded-lg" style="background: #333">
    <div class="flex justify-center">
        <img src="{{ asset('images/front/profile.jpeg') }}" width="50" height="50" alt="Profile Picture" class="rounded-full border-2">
    </div>
    <div class="text-center">
        <h1 class="font-bold text-lg my-4 tracking-widest">{{ $websiteMaster ?? $courseAuthor }}</h1>
        <p class="text-sm mb-4 tracking-widest">Web Developer, Teacher</p>
        <div class="flex justify-around flex-wrap">
            <div class="w-9 h-9 rounded-full text-center flex items-center justify-center">
                <a href="https://web.facebook.com/rtfulrich/" target="_blank" class="focus:outline-none social-link facebook">
                    <i class="fab fa-facebook-square text-xl lg:text-2xl"></i>
                </a>
            </div>
            <div class="w-9 h-9 rounded-full text-center flex items-center justify-center">
                <a href="#" class="focus:outline-none social-link youtube">
                    <i class="fab fa-youtube text-xl lg:text-2xl"></i>
                </a>
            </div>
            <div class="w-9 h-9 rounded-full text-center flex items-center justify-center">
            <a href="#" onclick="event.preventDefault()" title="034 25 374 74" class="focus:outline-none social-link phone">
                    <i class="fa fa-phone text-xl lg:text-2xl"></i>
                </a>
            </div>
            <div class="w-9 h-9 rounded-full text-center flex items-center justify-center">
                <a href="mailto:rtfulrich@gmail.com" target="_blank" class="focus:outline-none social-link google">
                    <i class="fab fa-google text-xl lg:text-2xl"></i>
                </a>
            </div>
            <div class="w-9 h-9 rounded-full text-center flex items-center justify-center">
                <a href="https://github.com/tahirintsoa-ulrich" target="_blank" class="focus:outline-none social-link github">
                    <i class="fab fa-github text-xl lg:text-2xl"></i>
                </a>
            </div>
        </div>
    </div>
</div>
