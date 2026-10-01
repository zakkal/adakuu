<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Category::create([
            'name' => 'Test',
            'slug' => 'test',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
