@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="home-content" class="w-3/5 h-screen bg-background_form p-5 rounded-xl">

            <div id="header" class="flex flex-row mb-2 items-center">
                <form  action="{{route('test.search')}}" method="POST"
                       class="ml-10 rounded-xl flex mt-2 flex-row bg-white">
                    @csrf
                    @isset($search)
                    <input type="text" name="search" value="{{$search}}" placeholder="Тест..." class="rounded-xl pl-2">
                    @else
                        <input type="text" name="search" placeholder="Тест..." class="rounded-xl pl-2">
                    @endif
                    <button type="submit" class="pr-1">
                        <img class="h-8 w-8" src="{{secure_asset('img/search.svg') }}" alt="Add">
                    </button>
                </form>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
                    <a href="{{route('home')}}" class="text-2xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/home.svg') }}" alt="Add">
                    </a>
                </div>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-10" >
                    <a href="{{route('login')}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/logout.svg') }}" alt="Add">
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="text-white text-3xl text-center">
                     Тести
                </div>
                @isset($tests)
                    @foreach($tests as $test)
                        <div class="flex flex-row my-3 py-5 px-3 rounded-xl bg-background_light_form">
                            <div class="text-xl text-white">
                                {{$test->getName()}}
                            </div>
                            <div class="ml-auto flex flex-row justify-center">
                                <span class="text-white text-2xl">{{$test->getCompleted()}}</span>
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/check.svg') }}" alt="Add">
                                <span class="mx-5 text-white text-xl">{{\App\Models\User::query()->find($test->getUserId())->name}}</span>
                                <a href="{{route('test.complete', ['id'=>$test->getId()])}}" class="bg-background_details p-1 rounded-xl">
                                    <img class="h-8 w-8" src="{{secure_asset('img/play.svg') }}" alt="Add">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-xl text-white">На даний момент немає тестів</div>
                @endif
            </div>
        </div>
    </div>
@endsection
