
@extends('layouts.app')

@section('content')

<div class="container py-3 py-md-4">

    {{-- =========================================================
         Dashboard Header
         ========================================================= --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h3 class="fw-bold mb-0">
                    Dashboard
                </h3>

                <span class="pp-status-dot"></span>
            </div>

            <p class="text-muted mb-0">
                Here's your expense overview.
            </p>
        </div>


    </div>


    {{-- =========================================================
         Summary Cards
         ========================================================= --}}
    <div class="row g-3 g-lg-4 mb-4">

        {{-- Total Expense --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100 pp-stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <p class="text-muted small fw-medium mb-2">
                                Total Expense
                            </p>

                            <h3 class="fw-bold mb-0 pp-stat-value">
                                ₹{{ number_format($totalExpense, 2) }}
                            </h3>
                        </div>

                        <div class="pp-stat-icon pp-icon-purple">
                            ₹
                        </div>

                    </div>

                    <div class="mt-3">
                        <span class="small text-muted">
                            All recorded expenses
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- This Month --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100 pp-stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <p class="text-muted small fw-medium mb-2">
                                This Month
                            </p>

                            <h3 class="fw-bold mb-0 pp-stat-value">
                                ₹{{ number_format($thisMonthExpense, 2) }}
                            </h3>
                        </div>

                        <div class="pp-stat-icon pp-icon-blue">
                            M
                        </div>

                    </div>

                    <div class="mt-3">
                        <span class="small text-muted">
                            Current month spending
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- Today --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100 pp-stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <p class="text-muted small fw-medium mb-2">
                                Today
                            </p>

                            <h3 class="fw-bold mb-0 pp-stat-value">
                                ₹{{ number_format($todayExpense, 2) }}
                            </h3>
                        </div>

                        <div class="pp-stat-icon pp-icon-green">
                            T
                        </div>

                    </div>

                    <div class="mt-3">
                        <span class="small text-muted">
                            Today's spending
                        </span>
                    </div>

                </div>

            </div>

        </div>


        {{-- Expense Count --}}
        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100 pp-stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <p class="text-muted small fw-medium mb-2">
                                Expense Count
                            </p>

                            <h3 class="fw-bold mb-0 pp-stat-value">
                                {{ $expenseCount }}
                            </h3>
                        </div>

                        <div class="pp-stat-icon pp-icon-orange">
                            #
                        </div>

                    </div>

                    <div class="mt-3">
                        <span class="small text-muted">
                            Total transactions
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         Charts
         ========================================================= --}}
    <div class="row g-3 g-lg-4 mb-4">

        {{-- Category Chart --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm h-100 pp-dashboard-card">

                <div class="card-body p-4">

                    <div class="pp-section-header mb-4">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Expense by Category
                            </h5>

                            <p class="text-muted small mb-0">
                                See where your money is going.
                            </p>
                        </div>

                        <span class="pp-card-icon">
                            %
                        </span>

                    </div>


                    @if($categorySummary->count())

                        <div class="pp-chart-container pp-doughnut-container">
                            <canvas id="categoryChart"></canvas>
                        </div>

                    @else

                        <div class="pp-empty-chart">

                            <div class="pp-empty-icon">
                                📊
                            </div>

                            <h6 class="fw-semibold mt-3 mb-1">
                                No category data
                            </h6>

                            <p class="text-muted small mb-0">
                                Add an expense to see your spending breakdown.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Monthly Chart --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm h-100 pp-dashboard-card">

                <div class="card-body p-4">

                    <div class="pp-section-header mb-4">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Monthly Expenses
                            </h5>

                            <p class="text-muted small mb-0">
                                Your expense trend over the last 6 months.
                            </p>
                        </div>

                        <span class="pp-card-icon">
                            ↗
                        </span>

                    </div>


                    <div class="pp-chart-container pp-monthly-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         Recent Expenses
         ========================================================= --}}
    <div class="card border-0 shadow-sm pp-dashboard-card">

        <div class="card-body p-0">

            {{-- Section Header --}}
            <div class="p-4 border-bottom">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Recent Expenses
                        </h5>

                        <p class="text-muted small mb-0">
                            Your latest transactions.
                        </p>

                    </div>

                    <a
                        href="{{ route('expenses.index') }}"
                        class="btn btn-outline-secondary btn-sm pp-view-btn"
                    >
                        View All
                        <span class="ms-1">→</span>
                    </a>

                </div>

            </div>


            @if($recentExpenses->count())

                <div class="table-responsive">

                    <table class="table pp-dashboard-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="ps-4">
                                    Expense
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Date
                                </th>

                                <th class="text-end pe-4">
                                    Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                        @foreach($recentExpenses as $expense)

                            <tr>

                                {{-- Expense --}}
                                <td class="ps-4">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="pp-expense-avatar">
                                            {{ strtoupper(substr($expense->title, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $expense->title }}
                                            </div>

                                            @if($expense->note)

                                                <small class="text-muted d-block text-truncate pp-note">
                                                    {{ $expense->note }}
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Category --}}
                                <td>

                                    <span class="pp-category-badge">
                                        {{ $expense->category }}
                                    </span>

                                </td>


                                {{-- Date --}}
                                <td>

                                    <span class="text-muted small">
                                        {{ $expense->expense_date
                                            ? $expense->expense_date->format('d M Y')
                                            : '-' }}
                                    </span>

                                </td>


                                {{-- Amount --}}
                                <td class="text-end pe-4">

                                    <span class="fw-bold pp-expense-amount">
                                        ₹{{ number_format($expense->amount, 2) }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="pp-empty-state">

                    <div class="pp-empty-state-icon">
                        💸
                    </div>

                    <h6 class="fw-bold mb-1">
                        No expenses yet
                    </h6>

                    <p class="text-muted small mb-3">
                        Start tracking your expenses today.
                    </p>

                    <a
                        href="{{ route('expenses.create') }}"
                        class="btn btn-primary pp-primary-btn"
                    >
                        Add Your First Expense
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>



{{-- =========================================================
     Chart.js
     ========================================================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | Category Chart
    |--------------------------------------------------------------------------
    */

    const categoryLabels = @json(
        $categorySummary->keys()->values()
    );

    const categoryData = @json(
        $categorySummary->values()->values()
    );


    if (categoryLabels.length > 0) {

        const categoryColors = [
            '#6366f1', // Purple
            '#3b82f6', // Blue
            '#10b981', // Green
            '#f59e0b', // Amber
            '#ef4444', // Red
            '#8b5cf6', // Violet
            '#06b6d4', // Cyan
            '#f97316'  // Orange
        ];

        new Chart(
            document.getElementById('categoryChart'),
            {
                type: 'doughnut',

                data: {

                    labels: categoryLabels,

                    datasets: [
                        {
                            data: categoryData,

                            backgroundColor: categoryLabels.map(
                                (_, index) =>
                                    categoryColors[
                                        index % categoryColors.length
                                    ]
                            ),

                            borderColor: '#ffffff',

                            borderWidth: 3,

                            hoverOffset: 8
                        }
                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '68%',

                    animation: {
                        duration: 700
                    },

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                usePointStyle: true,

                                pointStyle: 'circle',

                                padding: 16,

                                boxWidth: 9,

                                boxHeight: 9,

                                color: '#4b5563',

                                font: {
                                    size: 12,
                                    weight: '500'
                                }

                            }

                        },

                        tooltip: {

                            displayColors: true,

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

                        data: monthlyData,

                        backgroundColor: '#6366f1',

                        hoverBackgroundColor: '#4f46e5',

                        borderColor: '#6366f1',

                        borderWidth: 1,

                        borderRadius: 7,

                        borderSkipped: false,

                        maxBarThickness: 42
                    }
                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                scales: {

                    x: {

                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {

                            color: '#6b7280',

                            font: {
                                size: 12
                            }

                        }

                    },

                    y: {

                        beginAtZero: true,

                        border: {
                            display: false
                        },

                        grid: {

                            color: '#e5e7eb',

                            drawTicks: false
                        },

                        ticks: {

                            color: '#6b7280',

                            padding: 8,

                            font: {
                                size: 11
                            },

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

                        displayColors: false,

                        backgroundColor: '#111827',

                        titleColor: '#ffffff',

                        bodyColor: '#ffffff',

                        padding: 12,

                        cornerRadius: 8,

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

