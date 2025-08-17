<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $income = Category::where('type', 'income')->orderBy('name')->get();
        $expense = Category::where('type', 'expense')->orderBy('name')->get();
        return view('categories.index', compact('income', 'expense'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:32'],
            'icon' => ['nullable', 'string', 'max:64'],
        ]);
        Category::create($validated);
        return redirect()->route('categories.index')->with('status', 'Category created');
    }

    public function edit(Category $category): View
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:32'],
            'icon' => ['nullable', 'string', 'max:64'],
        ]);
        $category->update($validated);
        return redirect()->route('categories.index')->with('status', 'Category updated');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category deleted');
    }
}


