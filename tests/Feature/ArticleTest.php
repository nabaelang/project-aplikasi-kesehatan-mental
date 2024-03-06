<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $admin = Admin::first();
    //     $this->actingAs($admin);
    // }

    public function test_article_get_index(): void
    {
        $response = $this->get(route('admin.article.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.article.index');
    }

    public function test_article_get_create(): void
    {
        $response = $this->get(route('admin.article.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.article.create');
    }
}
