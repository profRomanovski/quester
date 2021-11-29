<div id="header" class="flex flex-row mb-2">
    <div class="bg-background_details px-2 py-1 rounded-xl">
        <a href="{{route('general')}}" class="text-xl">
            <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
        </a>
    </div>
    <div class=" ml-10 p-1 text-xl mt-2 rounded-xl">
        <span class="text-white">Вітаємо, {{auth()->user()->name}}</span>
    </div>
    <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
        <a href="{{route('user.statistic')}}" class="text-2xl">
            <img class="h-8 w-8" src="{{secure_asset('img/user-statistic.svg') }}" alt="Add">
        </a>
    </div>
    <div class="bg-background_details px-2 py-1 rounded-xl ml-10">
        <a href="{{route('test.create')}}" class="text-2xl">
            <img class="h-8 w-8" src="{{secure_asset('img/add.svg') }}" alt="Add">
        </a>
    </div>
    <div class="bg-background_details px-2 py-1 rounded-xl ml-10" >
        <a href="{{route('login')}}" class="text-xl">
            <img class="h-8 w-8" src="{{secure_asset('img/logout.svg') }}" alt="Add">
        </a>
    </div>
</div>
