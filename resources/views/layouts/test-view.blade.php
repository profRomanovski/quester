@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
    <div id="test-content" class="w-3/5 min-h-screen bg-background_form p-5 rounded-xl">
        <div id="header" class="flex flex-row mb-2">
            <div class="bg-background_details px-2 py-1 rounded-xl">
                <a href="{{route('home')}}" class="text-xl">
                    <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                </a>
            </div>
            <div class=" ml-10 p-1 text-xl mt-2 rounded-xl">
                <span class="text-white">Перегляд тестування</span>
            </div>
        </div>

        <div class="main-content">
            <div class="text-white text-3xl text-center">
                {{$test->getName()}}
            </div>
            @foreach($questions as $question)
                <div class="flex flex-col px-3 py-2 rounded-xl my-3 bg-background_light_form">
                <span class="text-xl text-white">{{$question->getValue()}}</span>
                    @foreach($question->answers()->get() as $answer)
                        <div class="flex flex-col ml-11 px-2 py-1 border-b border-l rounded-xl my-1 bg-background_light_form">
                            <div class="flex flex-row">
                            <span class="text-xl text-white ">{{$answer->getValue()}}</span>
                            @if($answer->getIsCorrect())
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/check.svg') }}" alt="Add">
                            @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
    </div>
    </div>
@endsection
