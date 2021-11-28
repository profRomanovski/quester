@props(['name', 'value', 'eq', 'less', 'more', 'mark', 'number'])

<div class="answer-container mt-5 p-2 bg-background_light_form rounded-xl">
    <label class="flex items-center">
        <select name="condition-{{$name}}" class="text-xl rounded-sm bg-background_details p-2">
            <option value="0" {{$eq}}>=</option>
            <option value="1" {{$more}}>></option>
            <option value="2" {{$less}}><</option>
        </select>
        <select name="mark-{{$name}}" class="text-xl ml-1 rounded-sm bg-background_details p-2">
        @for ($i = 0; $i<=$mark; $i++)
            @if($number == $i)
                <option value="{{$i}}" selected>{{$i}}</option>
            @else
            <option value="{{$i}}">{{$i}}</option>
            @endif
        @endfor
        </select>
        <input type="text" name="{{$name}}" value="{{$value}}" class="rounded-sm py-2 px-1 w-full ml-1" required>
        <img class="deleteResult h-6 w-6 ml-1" src="{{secure_asset('img/delete.svg') }}" alt="Add">
    </label>
</div>

