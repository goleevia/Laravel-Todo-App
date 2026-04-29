<?php

namespace Tests\Unit;

use App\Http\Requests\StoreTodoRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TodoValidationTest extends TestCase
{
    /**
     * Test: name is required
     */
    public function test_name_is_required(): void
    {
        $rules = (new StoreTodoRequest())->rules();

        $validator = Validator::make([
            'name' => '',
            'description' => 'Test description',
        ], $rules);

        $this->assertTrue(
            $validator->fails(),
            'Name field should be required'
        );
    }

    /**
     * Test: valid name should pass validation
     */
    public function test_valid_name_passes(): void
    {
        $rules = (new StoreTodoRequest())->rules();

        $validator = Validator::make([
            'name' => 'Buy groceries',
            'description' => 'Test description',
        ], $rules);

        $this->assertFalse(
            $validator->fails(),
            'Valid name should pass validation'
        );
    }

    /**
     * Test: name max length validation
     */
    public function test_name_max_length(): void
    {
        $rules = (new StoreTodoRequest())->rules();

        $validator = Validator::make([
            'name' => str_repeat('a', 300),
            'description' => 'Test description',
        ], $rules);

        $this->assertTrue(
            $validator->fails(),
            'Name should not exceed max length'
        );
    }
}