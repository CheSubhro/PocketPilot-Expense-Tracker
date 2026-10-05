<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Expense::where('user_id', $userId);

        // Search by expense title
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(
                'title',
                'regex',
                '/' . preg_quote($search, '/') . '/i'
            );
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('expense_date', $request->date);
        }

        $expenses = $query
            ->orderBy('expense_date', 'desc')
            ->get();

        $categories = [
            'Food',
            'Transport',
            'Shopping',
            'Bills',
            'Health',
            'Entertainment',
            'Education',
            'Other',
        ];

        return view('expenses.index', compact(
            'expenses',
            'categories'
        ));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:50',
            'expense_date' => 'required|date',
            'note' => 'nullable|string|max:500',
        ]);

        Expense::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'category' => $validated['category'],
            'expense_date' => $validated['expense_date'],
            'note' => $validated['note'] ?? null,
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id != auth()->id()) {
            abort(403);
        }

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id != auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:50',
            'expense_date' => 'required|date',
            'note' => 'nullable|string|max:500',
        ]);

        $expense->update([
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'category' => $validated['category'],
            'expense_date' => $validated['expense_date'],
            'note' => $validated['note'] ?? null,
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id != auth()->id()) {
            abort(403);
        }

        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}