<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\ShowPosts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowPostsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ShowPosts::class);

        $component->assertStatus(200);
    }
}
