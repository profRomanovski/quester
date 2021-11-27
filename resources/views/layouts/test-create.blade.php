@extends('layouts.main')
@section('content')
<div class="min-h-screen flex flex-col items-center">
    <div id="test-content" class="w-3/5 min-h-screen bg-background_form p-5 rounded-xl">
        @include('components.header')

        <form class="main-content" action="{{route('test.create.action')}}" method="POST">
            @csrf
            <div class="flex justify-start w-full bg-background_light_form p-2 pb-4 rounded-xl">
            <input class="flex text-xl text-center w-full rounded-sm mt-2" required type="text" name="test-name"
            placeholder="Введіть назву тестування">
                <div class="bg-background_details px-2 py-1 rounded-xl ml-2" >
                    <button type="submit" class="">
                        <img class="h-8 w-8" src="{{secure_asset('img/save.svg') }}" alt="Add">
                    </button>
                </div>
            </div>
        </form>
        <div class="text-white text-3xl text-start mt-auto flex-col">
            <button id="addNewQuestion" class="text-2xl" type="button">
                <img class="h-8 w-8" src="https://quester.dev/img/add.svg" alt="Add">
            </button>

        </div>
    </div>
</div>

<script>
    var q = 0;
    var a = 1;
    $(document).ready(() => {
        $('#addNewQuestion').click(() => {
            q = q + 1;
            $('.main-content').append(`
                <x-question name="q-${q}"></x-question>
            `)
            a = 1;
            $('.addNewAnswer').last().click(elem => {
                $(elem.currentTarget)
                    .parent('.question')
                    .find('.question-content')
                    .append(`
                    <x-answer name="a-${q}-${a}" q="${q}"></x-answer>
                    `)
                $('.deleteAnswer').click(elem => {
                    $(elem.currentTarget).parent().remove();
                })
                a = a+1;
            })
            $('.deleteQuestion').click(elem => {
                $(elem.currentTarget).parent().remove();
            })
        })

    })
</script>

@endsection
