<footer class="p-4 md:px-8" style="background: #333">
    <div class="flex justify-between items-center">
        <div class="flex-1">
            <i class="fa fa-copyright mr-3"></i>
            <span id="current-year"></span>
        </div>
        <div class="flex flex-col items-end flex-wrap" style="flex: 2">
            <div class="">
                <h1 class="font-bold tracking-widest text-xl">Tahirintsoa Ulrich</h1>
            </div>
            <div class="flex justify-center">
                <div class="w-9 h-9 rounded-full mx-2 text-center flex items-center justify-center">
                    <a href="https://web.facebook.com/rtfulrich/" target="_blank" class="focus:outline-none social-link facebook">
                        <i class="fab fa-facebook text-xl lg:text-2xl"></i>
                    </a>
                </div>
                <div class="w-9 h-9 rounded-full mx-2 text-center flex items-center justify-center">
                    <a href="#" class="focus:outline-none social-link youtube">
                        <i class="fab fa-youtube text-xl lg:text-2xl"></i>
                    </a>
                </div>
                <div class="w-9 h-9 rounded-full mx-2 text-center flex items-center justify-center">
                <a href="#" onclick="event.preventDefault()" title="034 25 374 74" class="focus:outline-none social-link phone">
                        <i class="fa fa-phone text-xl lg:text-2xl"></i>
                    </a>
                </div>
                <div class="w-9 h-9 rounded-full mx-2 text-center flex items-center justify-center">
                    <a href="mailto:rtfulrich@gmail.com" target="_blank" class="focus:outline-none social-link google">
                        <i class="fab fa-google text-xl lg:text-2xl"></i>
                    </a>
                </div>
                <div class="w-9 h-9 rounded-full text-center mx-2 flex items-center justify-center">
                    <a href="https://github.com/tahirintsoa-ulrich" target="_blank" class="focus:outline-none social-link github">
                        <i class="fab fa-github text-xl lg:text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('js')
    <script>
        (function() {
            const year = (new Date()).getFullYear();
            const currentYearElement = document.getElementById('current-year');
            currentYearElement.innerHTML = year.toString();
        }) ();
    </script>
@endpush