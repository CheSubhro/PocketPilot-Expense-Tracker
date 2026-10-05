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

        // Recent expenses
        $recentExpenses = $expenses->take(5);

        /*
        |--------------------------------------------------------------------------
        | Category Summary
        |--------------------------------------------------------------------------
        */

        $categorySummary = $expenses
            ->groupBy('category')
            ->map(function ($categoryExpenses) {
                return $categoryExpenses->sum(function ($expense) {
                    return (float) $expense->amount;
                });
            })
            ->sortDesc();

        /*
        |--------------------------------------------------------------------------
        | Monthly Summary - Last 6 Months
        |--------------------------------------------------------------------------
        */

        $monthlySummary = collect();

        for ($i = 5; $i >= 0; $i--) {

            $month = Carbon::now()
                ->startOfMonth()
                ->subMonths($i);

            $monthKey = $month->format('Y-m');

            $amount = $expenses
                ->filter(function ($expense) use ($month) {
                    if (!$expense->expense_date) {
                        return false;
                    }

                    return Carbon::parse($expense->expense_date)
                        ->isSameMonth($month);
                })
                ->sum(function ($expense) {
                    return (float) $expense->amount;
                });

            $monthlySummary->push([
                'label' => $month->format('M Y'),
                'month' => $monthKey,
                'amount' => $amount,
            ]);
        }

        return view('dashboard', compact(
            'totalExpense',
            'thisMonthExpense',
            'todayExpense',
            'expenseCount',
            'recentExpenses',
            'categorySummary',
            'monthlySummary'
        ));
    }
}