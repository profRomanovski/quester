@extends('layouts.main')
@section('content')
<div class="min-h-screen flex flex-col items-center">
    <div id="test-content" class="w-3/5 min-h-screen bg-background_form p-5 rounded-xl">

        <div id="header" class="flex flex-row mb-2">
            <div class="bg-background_details px-2 py-1 rounded-xl">
                <a href="{{url()->previous()}}" class="text-xl">
                    <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                </a>
            </div>
            <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
                <a href="{{route('test.result', ['id'=>$test->getId()])}}" class="text-2xl">
                    <img class="h-8 w-8" src="{{secure_asset('img/results.svg') }}" alt="Add">
                </a>
            </div>
            <div class="bg-background_details px-2 py-1 rounded-xl ml-10" >
                <a href="{{route('home')}}" class="text-xl">
                    <img class="h-8 w-8" src="{{secure_asset('img/home.svg') }}" alt="Add">
                </a>
            </div>
        </div>

        <form class="main-content" action="{{route('test.edit.action')}}" method="POST">
            @csrf
            <input name="test-id" type="text" value="{{$test->getId()}}" class="hidden">
            <div class="flex justify-start w-full bg-background_light_form p-2 pb-4 rounded-xl">
            <input class="flex text-xl text-center w-full rounded-sm mt-2" required type="text" name="test-name"
            placeholder="Введіть назву тестування" value="{{$test->getName()}}">
                <div class="bg-background_details px-2 py-1 rounded-xl ml-2" >
                    <button type="submit" class="">
                        <img class="h-8 w-8" src="{{secure_asset('img/save.svg') }}" alt="Add">
                    </button>
                </div>
            </div>
            @php
            $q = 0;
            $a = 0;
            $a_final = 0;
            @endphp
            @foreach($questions as $question)
                @php
                $q = $q+1;
                @endphp
                <x-question name="q-{{$q}}" value="{{$question->getValue()}}">
                @foreach($question->answers()->get() as $answer)
                        @php
                            $a = $a+1;
                            $checked = "";
                            if($answer->getIsCorrect()){
                                $checked = "checked";
                            }
                        @endphp
                    <x-answer name="a-{{$q}}-{{$a}}" q="{{$q}}" value="{{$answer->getValue()}}" checked="{{$checked}}"></x-answer>
                @endforeach
                    @php
                        $a_final = $a;
                        $a = 0;
                    @endphp
                </x-question>
            @endforeach
        </form>
        <div class="text-white text-3xl text-start mt-auto flex-col">
            <button id="addNewQuestion" class="text-2xl" type="button">
                <img class="h-8 w-8" src="https://quester.dev/img/add.svg" alt="Add">
            </button>

        </div>
    </div>
</div>

<script>
    var q = {{$q}};
    var a = {{$a_final+1}};
    $(document).ready(() => {
        $('#addNewQuestion').click(() => {
            q = q + 1;
            $('.main-content').append(`
                <x-question name="q-${q}" value=""></x-question>
            `)
            $('.addNewAnswer').last().click(elem => {
                $(elem.currentTarget)
                    .parent('.question')
                    .find('.question-content')
                    .append(`
                    <x-answer name="a-${q}-${a}" q="${q}" value="" checked=""></x-answer>
                    `)
                $('.deleteAnswer').click(elem => {
                    $(elem.currentTarget).parent().remove();
                })
                a = a+1;
            })
            a = 1;
            $('.deleteQuestion').click(elem => {
                $(elem.currentTarget).parent().remove();
            })
        })
        $('.addNewAnswer').click(elem => {
            $(elem.currentTarget)
                .parent('.question')
                .find('.question-content')
                .append(`
                    <x-answer name="a-${q}-${a}" q="${q}" value="" checked=""></x-answer>
                    `)
            $('.deleteAnswer').click(elem => {
                $(elem.currentTarget).parent().remove();
            })
            a = a+1;
        })
    })
</script>

@endsection
