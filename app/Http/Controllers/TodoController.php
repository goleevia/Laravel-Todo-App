<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('Todos/Index', [
            'todos' => Todo::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Todos/Create');
    }

    public function store(StoreTodoRequest $request)
    {
        Todo::create($request->validated());

        return redirect()->route('todos.index')->with('success', 'Todo created successfully');
    }

    public function edit(Todo $todo)
    {
        return Inertia::render('Todos/Edit', [
            'todo' => $todo
        ]);
    }

   public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully');
    }
}