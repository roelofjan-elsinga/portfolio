<?php

namespace Tests;

use Illuminate\Support\Facades\Storage;

class PublicTest extends TestCase
{
    public function test_atom_feed_can_be_viewed()
    {
        Storage::fake('atom');

        Storage::disk('atom')->put('atom.xml', 'test');

        $this
            ->get(route('feed'))
            ->assertSee('testing')
            ->assertOk();
    }
}
