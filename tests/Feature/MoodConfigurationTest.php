<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoodConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_mood_configuration_get_index(): void
    {
        $response = $this->get(route('admin.mood_configurations.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.mood_configurations.index');
    }

    public function test_mood_configuration_create(): void
    {
        $response = $this->get(route('admin.mood_configurations.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.mood_configurations.create');
    }
}
