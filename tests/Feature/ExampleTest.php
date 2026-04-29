<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExampleTest extends TestCase
{   
    use RefreshDatabase;

    public function test_root_redirects_to_todos(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('todos.index'));
    }

    public function test_todos_page_loads_successfully(): void
    {
        $response = $this->get('/todos');

        $response->assertStatus(200);
    }
}