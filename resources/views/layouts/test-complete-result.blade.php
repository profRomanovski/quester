@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col items-center">
        <div id="home-content" class="w-3/5 h-full bg-background_form p-5 rounded-xl">

            <div id="header" class="flex flex-row mb-2">
                <div class="bg-background_details px-2 py-1 rounded-xl">
                    <a href="{{route('general')}}" class="text-xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/main_page.svg') }}" alt="Add">
                    </a>
                </div>
                <div class="bg-background_details px-2 py-1 rounded-xl ml-auto">
                    <a href="{{route('home')}}" class="text-2xl">
                        <img class="h-8 w-8" src="{{secure_asset('img/home.svg') }}" alt="Add">
                    </a>
                </div>
            </div>

            <div class="main-content">
                <div class="text-white text-3xl text-center">
                    Результати
                </div>
                <div class="flex flex-col my-3 py-5 px-3 rounded-xl bg-background_light_form">
                    <div class="text-center text-2xl text-white">
                        <span>{{$resultMark}}/{{$questionCount}}</span>
                    </div>
                    <div class="text-center text-xl text-white">
                        <span>{{$resultLabel}}</span>
                    </div>
                </div>
@endsection
