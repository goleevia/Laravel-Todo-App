<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_todo(): void
    {
        $response = $this->post('/todos', [
            'name' => 'Test Todo',
            'description' => 'Test Description',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('todos', [
            'name' => 'Test Todo',
        ]);
    }

    #[Test]
    public function it_can_update_todo(): void
    {
        $todo = Todo::create([
            'name' => 'Old Name',
            'description' => 'Old Desc',
        ]);

        $response = $this->put("/todos/{$todo->id}", [
            'name' => 'Updated Name',
            'description' => 'Updated Desc',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('todos', [
            'name' => 'Updated Name',
        ]);
    }

    #[Test]
    public function it_can_delete_todo(): void
    {
        $todo = Todo::create([
            'name' => 'Delete Me',
            'description' => 'Test',
        ]);

        $response = $this->delete("/todos/{$todo->id}");

        $response->assertRedirect();

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}