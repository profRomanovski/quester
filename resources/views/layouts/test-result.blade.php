@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="test-content" class="w-3/5 min-h-screen bg-background_form p-5 rounded-xl">

            <div id="header" class="flex flex-row mb-2">
                <div class="bg-background_details px-2 py-1 rounded-xl">
                    <a href="{{route('test.edit', ['id'=>$test->getId()])}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                    </a>
                </div>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-auto" >
                    <a href="{{route('home')}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/home.svg') }}" alt="Add">
                    </a>
                </div>
            </div>


            <form class="main-content" action="{{route('test.result.action')}}" method="POST">
                @csrf
                <input type="text" value="{{$test->getId()}}" name="test-id" class="hidden">
                <div class="flex justify-center w-full bg-background_light_form p-2 pb-4 rounded-xl">
                    <span class="text-white text-2xl">Результати</span>
                    <div class="bg-background_details px-2 py-1 rounded-xl ml-2" >
                        <button type="submit" class="">
                            <img class="h-8 w-8" src="{{secure_asset('img/save.svg') }}" alt="Add">
                        </button>
                    </div>
                </div>
                @php
                    $r=0;
                @endphp
                @foreach($results as $result)
                    @php
                        $r=$r+1;
                    @endphp
                    @if($result->getCondition() === 0)
                        <x-result name="r-{{$r}}" value="{{$result->getValue()}}" number="{{$result->getMark()}}" eq="selected" less="" more="" mark="{{$mark}}"></x-result>
                    @endif
                    @if($result->getCondition() === 1)
                        <x-result name="r-{{$r}}" value="{{$result->getValue()}}" number="{{$result->getMark()}}" eq="" less="" more="selected" mark="{{$mark}}"></x-result>
                    @endif
                    @if($result->getCondition() === 2)
                        <x-result name="r-{{$r}}" value="{{$result->getValue()}}" number="{{$result->getMark()}}" eq="" less="selected" more="" mark="{{$mark}}"></x-result>
                    @endif
                @endforeach
            </form>
            <div class="text-white text-3xl text-start mt-auto flex-col">
                <button id="addNewResult" class="text-2xl" type="button">
                    <img class="h-8 w-8" src="https://quester.dev/img/add.svg" alt="Add">
                </button>
            </div>
        </div>
    </div>
<script>
    var q = {{$r}};
    $(document).ready(() => {
        $('#addNewResult').click(() => {
            q = q + 1;
            $('.main-content').append(`
                <x-result name="r-${q}" value="" eq="" less="" more="" mark="{{$mark}}" number=""></x-result>
            `)
            $('.deleteResult').click(elem => {
                $(elem.currentTarget).parent().parent().remove();
            })
        })
    })
</script>
@endsection
