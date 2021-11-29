@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="home-content" class="w-3/5 h-screen bg-background_form p-5 rounded-xl">
            @include('components.header')
            <div class="main-content">
                <div class="text-white text-3xl text-center">
                    Мої тести
                </div>
                @isset($tests)
                    @foreach($tests as $test)
                        <div class="flex flex-row my-3 py-5 px-3 rounded-xl bg-background_light_form">
                            <div class="text-xl text-white">
                                {{$test->getName()}}
                            </div>
                            <div class="ml-auto flex flex-row">
                                <span class="text-white mr-1 text-2xl">{{$test->getCompleted()}}</span>
                                <img class="h-8 mr-4 w-8" src="{{secure_asset('img/check.svg') }}" alt="Add">
                                <a href="{{route('test.statistic', ['id'=>$test->getId()])}}">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/statistic.svg') }}" alt="Add">
                                </a>
                                <a href="{{route('test.view', ['id'=>$test->getId()])}}">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/view.svg') }}" alt="Add">
                                </a>
                                <a href="{{route('test.edit', ['id'=>$test->getId()])}}">
                                <img class="h-8 ml-2 w-8" src="{{secure_asset('img/edit.svg') }}" alt="Add">
                                </a>
                                <a href="{{route('test.delete', ['id'=>$test->getId()])}}">
                                    <img class="h-8 ml-2 w-8" src="{{secure_asset('img/delete.svg') }}" alt="Add">
                                </a>
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
