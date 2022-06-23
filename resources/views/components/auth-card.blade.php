<div 
    class="h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-6 "
    style="background: linear-gradient(to bottom, #c5eaf9, white)"
>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <br><br>
</div>
