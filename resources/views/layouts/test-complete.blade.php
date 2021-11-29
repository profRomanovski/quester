@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="home-content" class="w-3/5 h-full bg-background_form p-5 rounded-xl">
            @include('components.header')
            <div class="main-content">
                <div class="text-white text-3xl text-center">
                    {{$test->getName()}}
                </div>
                <form action="{{route('test.complete.action')}}" method="POST">
                    @csrf
                    <input name="test-id" type="text" value="{{$test->getId()}}" class="hidden">
                @foreach($questions as $question)
                <div class="flex flex-col my-3 py-5 px-3 rounded-xl bg-background_light_form">
                    <div class="text-xl text-white">
                        {{$question->getValue()}}
                    </div>
                    @foreach($question->answers()->get() as $answer)
                        <div class="answer-container ml-12 mb-2">
                        <label class="flex items-center">
                                <input type="radio" class="w-9 h border-20" required name="radio-{{$question->getId()}}" value="{{$answer->getId()}}">
                                <span class="checkmark"></span>
                                <span class="text-white rounded-sm py-2 px-1 w-full">{{$answer->getValue()}}</span>
                            </label>
                        </div>
                    @endforeach
                        </div>
                @endforeach
                    <div class="text-center">
                        <button type="submit" class="mx-auto rounded-xl text-white bg-background_details p-2">Завершити тестування</button>
                    </div>
        </form>
    </div>
@endsection
