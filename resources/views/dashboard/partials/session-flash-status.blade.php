        
<center>
    @if (session('status'))
        <div class="text-green-700 font-bold uppercase rounded-lg">
            
        </div>
        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif
</center>