<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;

class DashboardController
{
    public function index()
    {
        $userId = auth()->id();

        // Get all expenses of logged-in user
        $expenses = Expense::where('user_id', $userId)
            ->orderBy('expense_date', 'desc')
            ->get();

        // Total expense
        $totalExpense = $expenses->sum(function ($expense) {
            return (float) $expense->amount;
        });

        // Current month expense
        $thisMonthExpense = $expenses
            ->filter(function ($expense) {
                return $expense->expense_date
                    && Carbon::parse($expense->expense_date)->isCurrentMonth();
            })
            ->sum(function ($expense) {
                return (float) $expense->amount;
            });

        // Today's expense
        $todayExpense = $expenses
            ->filter(function ($expense) {
                return $expense->expense_date
                    && Carbon::parse($expense->expense_date)->isToday();
            })
            ->sum(function ($expense) {
                return (float) $expense->amount;
            });

        // Expense count
        $expenseCount = $expenses->count();

        // Recent 5 expenses
        $recentExpenses = $expenses->take(5);

        return view('dashboard', compact(
            'totalExpense',
            'thisMonthExpense',
            'todayExpense',
            'expenseCount',
            'recentExpenses'
        ));
    }
}