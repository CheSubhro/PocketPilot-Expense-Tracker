@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard</h3>
            <p class="text-muted mb-0">
                Here's your expense overview.
            </p>
        </div>

        <a href="{{ route('expenses.create') }}"
           class="btn btn-primary px-4">
            + Add Expense
        </a>
    </div>


    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Expense</p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($totalExpense, 2) }}
                    </h3>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">This Month</p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($thisMonthExpense, 2) }}
                    </h3>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Today</p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($todayExpense, 2) }}
                    </h3>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Expense Count</p>

                    <h3 class="fw-bold mb-0">
                        {{ $expenseCount }}
                    </h3>
                </div>
            </div>
        </div>

    </div>


    {{-- Recent Expenses --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h5 class="fw-bold mb-1">
                        Recent Expenses
                    </h5>

                    <p class="text-muted mb-0 small">
                        Your latest transactions
                    </p>
                </div>

                <a href="{{ route('expenses.index') }}"
                   class="btn btn-outline-secondary btn-sm">
                    View All
                </a>

            </div>


            @if($recentExpenses->count())

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>Expense</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($recentExpenses as $expense)

                            <tr>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $expense->title }}
                                    </div>

                                    @if($expense->note)
                                        <small class="text-muted">
                                            {{ $expense->note }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $expense->category }}
                                    </span>
                                </td>

                                <td>
                                    {{ $expense->expense_date->format('d M Y') }}
                                </td>

                                <td class="text-end fw-semibold">
                                    ₹{{ number_format($expense->amount, 2) }}
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <div class="mb-3" style="font-size: 40px;">
                        💸
                    </div>

                    <h6 class="fw-bold">
                        No expenses yet
                    </h6>

                    <p class="text-muted mb-3">
                        Start tracking your expenses today.
                    </p>

                    <a href="{{ route('expenses.create') }}"
                       class="btn btn-primary">
                        Add Your First Expense
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection