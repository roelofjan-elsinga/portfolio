<div class="my-4">
    <h4 class="mb-2">Tags</h4>
    <input type="text" class="border border-gray-400 rounded px-4 py-2 w-full md:w-1/2"
           placeholder="Tags: Separate by a comma to add to list" wire:model="tag_string" wire:keyup="checkTag($event.target.value)">

    <ul class="mt-2">
        @foreach($tags as $tag)
            <li class="mb-2">
                {{$tag}}
                <button wire:click="removeTag('{{$tag}}')" type="button"
                        class="border bg-red-200 text-red-600 border-red-600 px-2 rounded">X</button>
            </li>
        @endforeach
    </ul>

    <input type="hidden" name="tags" value="{{json_encode($tags)}}">

</div>
