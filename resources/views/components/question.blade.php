@props(['name', 'value'])
<div class="question flex flex-col px-4 py-2 rounded-xl my-3 bg-background_light_form">
    <input type="text" class="flex py-2 rounded-sm" name="{{$name}}" value="{{$value}}" required
           placeholder="insert your question here">
    <div class="flex flex-col ml-11 px-2 py-2 rounded-xl my-1 bg-background_light_form">
        <div class="question-content flex flex-col">
            {{$slot}}
        </div>
    </div>
    <button class="addNewAnswer text-2xl" type="button">
        <img class="h-8 w-8" src="https://quester.dev/img/add.svg" alt="Add">
    </button>
    <button type="button" class="deleteQuestion">Видалити</button>
</div>
