<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoodRangeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_mood_range_get_index(): void
    {
        $response = $this->get(route('admin.mood_range.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.mood_range.index');
    }

    public function test_mood_range_create(): void
    {
        $response = $this->get(route('admin.mood_range.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.mood_range.create');
    }
}
