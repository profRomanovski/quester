@props(['title', 'content'])

<div class="pop-up-message fixed left-0 right-0" id="pop-up-message">
    <div class="pop-up-message-image">
        <img class="h-12 w-12" src="{{secure_asset('img/logo.svg') }}" alt="ChitChat Logo">
    </div>
    <div>
        <div class="pop-up-message-title">{{$title}}</div>
        <div class="pop-up-message-text">{{$content}}</div>
    </div>
</div>

{{--<x-notification title="Hello" content="World"></x-notification>--}}
