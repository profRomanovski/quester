@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="test-content" class="w-3/5 min-h-screen bg-background_form p-5 rounded-xl">
            <div id="header" class="flex flex-row mb-2 items-center">
                <div class="bg-background_details px-2 py-1 rounded-xl">
                    <a href="{{route('home')}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                    </a>
                </div>
                <div class=" ml-10 p-1 text-xl mt-2 rounded-xl">
                    <span class="text-white">Моя статистика</span>
                </div>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
                    <a href="{{route('user.statistic.delete')}}" class="text-2xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/delete.svg') }}" alt="Add">
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="text-white text-3xl text-center">
                    {{auth()->user()->name}}
                </div>
                @foreach($results as $result)
                    <div class="flex flex-col px-3 py-2 rounded-xl my-3 bg-background_light_form">
                        <div class="flex flex-row items-center">
                            <div class="flex flex-col">
                                <span class="text-xl text-white">{{$result->getResult()}}/{{$helper->getTestQuestionCount($result->test)}}</span>
                                <span class="text text-white">{{$result->test->name}}</span>
                            </div>
                            <span class="text-white ml-10">{{$helper->getResultLabel($result->test, $result->getResult())}}</span>
                            <span class="text-white ml-auto">{{$result->created_at}}</span>
                        </div>
                    </div>
                @endforeach

@endsection
