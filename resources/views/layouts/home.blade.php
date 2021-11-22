@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="home-content" class="w-3/5 h-screen bg-background_form p-5 rounded-xl">
            <div id="header" class="flex flex-row mb-2">
                <div class="bg-background_details px-2 py-1 rounded-xl">
                    <a href="{{route('login')}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                    </a>
                </div>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
                    <a href="{{route('login')}}" class="text-2xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/add.svg') }}" alt="Add">
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
                    My tests
                </div>
                @isset($tests)
                    @foreach($tests as $test)
                        <div class="flex flex-row my-3 py-5 px-3 rounded-xl bg-background_light_form">
                            <div class="text-xl text-white">
                                {{$test->getName()}}
                            </div>
                            <div class="ml-10 flex flex-row">
                                <span class="text-white text-2xl">{{$test->getCompleted()}}</span>
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/check.svg') }}" alt="Add">
                            </div>
                            <div class="ml-auto flex flex-row">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/statistic.svg') }}" alt="Add">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/view.svg') }}" alt="Add">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/edit.svg') }}" alt="Add">
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-xl text-white">You haven't tests</div>
                @endif
            </div>
        </div>
    </div>
@endsection
