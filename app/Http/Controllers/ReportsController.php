<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $expenses = Expense::where('user_id', $userId)
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

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $expenses = $expenses->filter(function ($expense) use ($request) {
                return $expense->category === $request->category;
            });
        }

        if ($request->filled('from_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();

            $expenses = $expenses->filter(function ($expense) use ($fromDate) {
                if (!$expense->expense_date) {
                    return false;
                }

                return Carbon::parse($expense->expense_date)
                    ->greaterThanOrEqualTo($fromDate);
            });
        }

        if ($request->filled('to_date')) {
            $toDate = Carbon::parse($request->to_date)->endOfDay();

            $expenses = $expenses->filter(function ($expense) use ($toDate) {
                if (!$expense->expense_date) {
                    return false;
                }

                return Carbon::parse($expense->expense_date)
                    ->lessThanOrEqualTo($toDate);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $totalExpense = $expenses->sum(function ($expense) {
            return (float) $expense->amount;
        });

        $expenseCount = $expenses->count();

        $averageExpense = $expenseCount > 0
            ? $totalExpense / $expenseCount
            : 0;

        $highestExpense = $expenses->sortByDesc(function ($expense) {
            return (float) $expense->amount;
        })->first();

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
        | Monthly Summary
        |--------------------------------------------------------------------------
        */

        $monthlySummary = collect();

        for ($i = 5; $i >= 0; $i--) {

            $month = Carbon::now()
                ->startOfMonth()
                ->subMonths($i);

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
                'amount' => $amount,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Top Expenses
        |--------------------------------------------------------------------------
        */

        $topExpenses = $expenses
            ->sortByDesc(function ($expense) {
                return (float) $expense->amount;
            })
            ->take(5);

        return view('reports.index', compact(
            'expenses',
            'categories',
            'totalExpense',
            'expenseCount',
            'averageExpense',
            'highestExpense',
            'categorySummary',
            'monthlySummary',
            'topExpenses'
        ));
    }
}

