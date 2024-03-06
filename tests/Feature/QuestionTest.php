<?php

namespace Tests\Feature;

use App\Models\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User; // Pastikan mengimpor model yang dibutuhkan
use Database\Factories\AdminFactory;
use Illuminate\Support\Facades\Hash;

class QuestionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_question_index(): void
    {
        // $user = AdminFactory::new()->create();

        // Menggunakan method actingAs untuk mengautentikasi pengguna
        // $response = $this->actingAs($user)->get(route('admin.questions.index'));

        $response = $this->get(route('admin.questions.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.questions.index');
        // $response->assertSee('Question Index Page');
    }

    public function test_question_create(): void
    {
        $response = $this->get(route('admin.questions.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.questions.create');
    }
}
