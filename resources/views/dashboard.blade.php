@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Dashboard
            </h3>

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

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        Total Expense
                    </p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($totalExpense, 2) }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        This Month
                    </p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($thisMonthExpense, 2) }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        Today
                    </p>

                    <h3 class="fw-bold mb-0">
                        ₹{{ number_format($todayExpense, 2) }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <p class="text-muted mb-2">
                        Expense Count
                    </p>

                    <h3 class="fw-bold mb-0">
                        {{ $expenseCount }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- Charts --}}
    <div class="row g-4 mb-4">

        {{-- Category Chart --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="mb-4">

                        <h5 class="fw-bold mb-1">
                            Expense by Category
                        </h5>

                        <p class="text-muted small mb-0">
                            See where your money is going.
                        </p>

                    </div>

                    @if($categorySummary->count())

                        <div style="height: 300px;">
                            <canvas id="categoryChart"></canvas>
                        </div>

                    @else

                        <div class="text-center py-5">

                            <div style="font-size: 40px;">
                                📊
                            </div>

                            <p class="text-muted mb-0 mt-2">
                                No category data available yet.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Monthly Chart --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="mb-4">

                        <h5 class="fw-bold mb-1">
                            Monthly Expenses
                        </h5>

                        <p class="text-muted small mb-0">
                            Your expense trend over the last 6 months.
                        </p>

                    </div>

                    <div style="height: 300px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>

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

                    <p class="text-muted small mb-0">
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

                                    {{ $expense->expense_date
                                        ? $expense->expense_date->format('d M Y')
                                        : '-' }}

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


{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | Category Chart
    |--------------------------------------------------------------------------
    */

    const categoryLabels = @json($categorySummary->keys()->values());

    const categoryData = @json($categorySummary->values()->values());


    if (categoryLabels.length > 0) {

        new Chart(
            document.getElementById('categoryChart'),
            {
                type: 'doughnut',

                data: {
                    labels: categoryLabels,

                    datasets: [
                        {
                            data: categoryData
                        }
                    ]
                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            position: 'bottom'
                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return ' ₹' +
                                        Number(context.raw)
                                            .toLocaleString('en-IN', {
                                                minimumFractionDigits: 2
                                            });

                                }

                            }

                        }

                    }

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Monthly Chart
    |--------------------------------------------------------------------------
    */

    const monthlyLabels = @json(
        $monthlySummary->pluck('label')->values()
    );

    const monthlyData = @json(
        $monthlySummary->pluck('amount')->values()
    );


    new Chart(
        document.getElementById('monthlyChart'),
        {
            type: 'bar',

            data: {

                labels: monthlyLabels,

                datasets: [
                    {
                        label: 'Expenses',

                        data: monthlyData
                    }
                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            callback: function(value) {

                                return '₹' +
                                    Number(value)
                                        .toLocaleString('en-IN');

                            }

                        }

                    }

                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                return ' ₹' +
                                    Number(context.raw)
                                        .toLocaleString('en-IN', {
                                            minimumFractionDigits: 2
                                        });

                            }

                        }

                    }

                }

            }

        }
    );

</script>

@endsection