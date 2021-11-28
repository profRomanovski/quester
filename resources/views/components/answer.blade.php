@props(['name', 'q', 'value', 'checked'])

<div class="answer-container mb-2">
    <label class="flex items-center">
        <input type="radio" class="w-9 h border-20" {{$checked}} required name="radio-{{$q}}" value="{{$name}}">
        <span class="checkmark"></span>
        <input type="text" name="{{$name}}" value="{{$value}}" class="rounded-sm py-2 px-1 w-full" required>
        <img class="deleteAnswer h-6 w-6 ml-1" src="{{secure_asset('img/delete.svg') }}" alt="Add">
    </label>
</div>
