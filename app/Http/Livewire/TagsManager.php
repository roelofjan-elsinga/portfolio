<?php

namespace Main\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class TagsManager extends Component
{
    public array $tags;
    public string $tag_string = '';

    public function mount(array $tags)
    {
        $this->tags = $tags;
    }

    public function checkTag()
    {
        if (substr($this->tag_string, -1, 1) === ',') {
            $this->tags[] = substr($this->tag_string, 0, strlen($this->tag_string) - 1);
            $this->tag_string = '';
        }
    }

    public function removeTag(string $tag)
    {
        $this->tags = Collection::make($this->tags)
            ->filter(fn ($added_tag) => $added_tag !== $tag)
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.tags-manager');
    }
}
