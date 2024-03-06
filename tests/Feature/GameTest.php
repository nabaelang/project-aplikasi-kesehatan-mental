<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_game_get_index(): void
    {
        $response = $this->get(route('admin.game.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.game.index');
    }

    public function test_game_create(): void
    {
        $response = $this->get(route('admin.game.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.game.create');
    }
}
