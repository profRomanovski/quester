@extends('layouts.main')
@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="logo flex justify-center mb-6 bg-white rounded-xl p-1">
            <img class="h-36 w-36" src="{{secure_asset('img/logo.png') }}" alt="Logo">
        </div>
        <form class="max-w-[500px] bg-background_form p-5 rounded-xl" action="{{route('login.action')}}" method="POST">
            @csrf
            <div class="form-items">
                <div class="flex justify-between items-center mb-2">
                    <label for="name" class="block mr-5 text-xl text-gray-800">
                        Email:
                    </label>
                    <input id="name" name="email" type="text" class="rounded p-2" placeholder="Введіть email">
                </div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block mr-5 text-xl text-gray-800">
                        Пароль:
                    </label>
                    <input id="password" name="password" type="password" class="rounded p-2" placeholder="Введіть пароль">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-2 py-1 mt-1 bg-background_details rounded-xl text-white min-w-full hover:bg-orange-lighter outline-none tablet:min-w-1/2 tablet: ">Ввійти</button>
                </div>
            </div>
        </form>
    </div>
@endsection
