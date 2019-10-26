<?php

namespace Tests;

use Illuminate\Support\Facades\Storage;

class PublicTest extends TestCase
{
    public function test_atom_feed_can_be_viewed()
    {
        Storage::fake('atom');

        file_put_contents(storage_path('framework/testing/disks/atom/atom.xml'), 'test');

        $this
            ->get(route('feed'))
            ->assertSee('testing')
            ->assertOk();
    }
}
