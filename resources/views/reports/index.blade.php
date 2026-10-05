
@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <h3 class="fw-bold mb-0">
                    Reports
                </h3>

                <span
                    class="d-inline-flex align-items-center"
                    style="
                        width: 9px;
                        height: 9px;
                        background: #22c55e;
                        border-radius: 50%;
                    "
                ></span>

            </div>

            <p class="text-muted mb-0">
                Understand where your money is going.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('expenses.index') }}"
                class="btn btn-light border"
            >
                View Expenses
            </a>

            <a
                href="{{ route('expenses.create') }}"
                class="btn text-white"
                style="background: #6366f1;"
            >
                + Add Expense
            </a>

        </div>

    </div>


    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-md-6 col-xl-3">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted small mb-2">
                                Total Expense
                            </p>

                            <h4 class="fw-bold mb-0">
                                ₹{{ number_format($totalExpense, 2) }}
                            </h4>

                        </div>

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="
                                width: 42px;
                                height: 42px;
                                background: #eef2ff;
                                color: #6366f1;
                                font-weight: 700;
                            "
                        >
                            ₹
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-md-6 col-xl-3">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted small mb-2">
                                Expenses
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ $expenseCount }}
                            </h4>

                        </div>

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="
                                width: 42px;
                                height: 42px;
                                background: #eff6ff;
                                color: #3b82f6;
                                font-weight: 700;
                            "
                        >
                            #
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-md-6 col-xl-3">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted small mb-2">
                                Average Expense
                            </p>

                            <h4 class="fw-bold mb-0">
                                ₹{{ number_format($averageExpense, 2) }}
                            </h4>

                        </div>

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="
                                width: 42px;
                                height: 42px;
                                background: #ecfdf5;
                                color: #10b981;
                                font-weight: 700;
                            "
                        >
                            ≈
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-md-6 col-xl-3">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted small mb-2">
                                Highest Expense
                            </p>

                            @if($highestExpense)

                                <h4 class="fw-bold mb-1">
                                    ₹{{ number_format((float) $highestExpense->amount, 2) }}
                                </h4>

                                <small class="text-muted">
                                    {{ $highestExpense->title }}
                                </small>

                            @else

                                <h4 class="fw-bold mb-0">
                                    ₹0.00
                                </h4>

                            @endif

                        </div>

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="
                                width: 42px;
                                height: 42px;
                                background: #fff7ed;
                                color: #f59e0b;
                                font-weight: 700;
                            "
                        >
                            ↑
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Filters --}}
    <div
        class="card border-0 shadow-sm mb-4"
        style="border-radius: 16px;"
    >

        <div class="card-body p-4">

            <div class="d-flex align-items-center gap-2 mb-3">

                <div
                    class="d-flex align-items-center justify-content-center rounded-3"
                    style="
                        width: 38px;
                        height: 38px;
                        background: #f5f3ff;
                        color: #6366f1;
                    "
                >
                    ⚙
                </div>

                <div>

                    <h6 class="fw-bold mb-0">
                        Report Filters
                    </h6>

                    <small class="text-muted">
                        Narrow down your expense analysis.
                    </small>

                </div>

            </div>


            <form
                method="GET"
                action="{{ route('reports.index') }}"
            >

                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-4">

                        <label
                            for="category"
                            class="form-label small fw-semibold"
                        >
                            Category
                        </label>

                        <select
                            name="category"
                            id="category"
                            class="form-select"
                        >

                            <option value="">
                                All Categories
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category }}"
                                    @selected(request('category') === $category)
                                >
                                    {{ $category }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-12 col-md-3">

                        <label
                            for="from_date"
                            class="form-label small fw-semibold"
                        >
                            From Date
                        </label>

                        <input
                            type="date"
                            name="from_date"
                            id="from_date"
                            value="{{ request('from_date') }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12 col-md-3">

                        <label
                            for="to_date"
                            class="form-label small fw-semibold"
                        >
                            To Date
                        </label>

                        <input
                            type="date"
                            name="to_date"
                            id="to_date"
                            value="{{ request('to_date') }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12 col-md-2">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn text-white flex-grow-1"
                                style="background: #6366f1;"
                            >
                                Filter
                            </button>

                            @if(request()->hasAny([
                                'category',
                                'from_date',
                                'to_date'
                            ]))

                                <a
                                    href="{{ route('reports.index') }}"
                                    class="btn btn-light border"
                                    title="Clear filters"
                                >
                                    ×
                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Charts --}}
    <div class="row g-4 mb-4">

        {{-- Category Chart --}}
        <div class="col-12 col-lg-5">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="mb-3">

                        <h5 class="fw-bold mb-1">
                            Spending by Category
                        </h5>

                        <p class="text-muted small mb-0">
                            See which categories consume most of your money.
                        </p>

                    </div>

                    @if($categorySummary->count())

                        <div style="height: 300px;">
                            <canvas id="categoryReportChart"></canvas>
                        </div>

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center text-center text-muted"
                            style="height: 300px;"
                        >
                            No expense data available.
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Monthly Chart --}}
        <div class="col-12 col-lg-7">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="mb-3">

                        <h5 class="fw-bold mb-1">
                            Monthly Spending
                        </h5>

                        <p class="text-muted small mb-0">
                            Your expense trend over the last six months.
                        </p>

                    </div>

                    <div style="height: 300px;">
                        <canvas id="monthlyReportChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Bottom Section --}}
    <div class="row g-4">

        {{-- Category Breakdown --}}
        <div class="col-12 col-lg-6">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Category Breakdown
                            </h5>

                            <p class="text-muted small mb-0">
                                Detailed spending distribution.
                            </p>

                        </div>

                        <span
                            class="badge rounded-pill"
                            style="
                                background: #eef2ff;
                                color: #6366f1;
                            "
                        >
                            {{ $categorySummary->count() }} categories
                        </span>

                    </div>


                    @forelse($categorySummary as $category => $amount)

                        @php
                            $percentage = $totalExpense > 0
                                ? ($amount / $totalExpense) * 100
                                : 0;
                        @endphp

                        <div class="mb-3">

                            <div class="d-flex justify-content-between mb-1">

                                <span class="small fw-semibold">
                                    {{ $category }}
                                </span>

                                <span class="small text-muted">
                                    ₹{{ number_format($amount, 2) }}
                                    ·
                                    {{ number_format($percentage, 1) }}%
                                </span>

                            </div>

                            <div
                                class="progress"
                                style="
                                    height: 7px;
                                    background: #f1f5f9;
                                    border-radius: 10px;
                                "
                            >

                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="
                                        width: {{ $percentage }}%;
                                        background: #6366f1;
                                        border-radius: 10px;
                                    "
                                ></div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">
                            No category data available.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- Top Expenses --}}
        <div class="col-12 col-lg-6">

            <div
                class="card border-0 shadow-sm h-100"
                style="border-radius: 16px;"
            >

                <div class="card-body p-4">

                    <div class="mb-4">

                        <h5 class="fw-bold mb-1">
                            Top Expenses
                        </h5>

                        <p class="text-muted small mb-0">
                            Your five highest expenses in this report.
                        </p>

                    </div>


                    @forelse($topExpenses as $expense)

                        <div
                            class="d-flex align-items-center justify-content-between gap-3 py-3"
                            style="border-bottom: 1px solid #f1f5f9;"
                        >

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-3"
                                    style="
                                        width: 40px;
                                        height: 40px;
                                        background: #eef2ff;
                                        color: #6366f1;
                                        font-weight: 700;
                                    "
                                >
                                    {{ strtoupper(substr($expense->title, 0, 1)) }}
                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        {{ $expense->title }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $expense->category }}

                                        @if($expense->expense_date)
                                            ·
                                            {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="fw-bold">
                                ₹{{ number_format((float) $expense->amount, 2) }}
                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">
                            No expenses found.
                        </div>

                    @endforelse

                </div>

            </div>

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

    const categoryLabels = @json(
        $categorySummary->keys()->values()
    );

    const categoryData = @json(
        $categorySummary->values()->values()
    );

    const categoryColors = [
        '#6366f1',
        '#3b82f6',
        '#10b981',
        '#f59e0b',
        '#ef4444',
        '#8b5cf6',
        '#06b6d4',
        '#f97316'
    ];


    if (
        categoryLabels.length > 0 &&
        document.getElementById('categoryReportChart')
    ) {

        new Chart(
            document.getElementById('categoryReportChart'),
            {
                type: 'doughnut',

                data: {
                    labels: categoryLabels,

                    datasets: [{
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
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    cutout: '68%',

                    plugins: {
                        legend: {
                            position: 'bottom',

                            labels: {
                                usePointStyle: true,
                                padding: 18
                            }
                        },

                        tooltip: {
                            callbacks: {
                                label: function(context) {

                                    return ' ₹' +
                                        Number(
                                            context.raw
                                        ).toLocaleString(
                                            'en-IN',
                                            {
                                                minimumFractionDigits: 2
                                            }
                                        );

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
        $monthlySummary->pluck('label')
    );

    const monthlyData = @json(
        $monthlySummary->pluck('amount')
    );


    if (document.getElementById('monthlyReportChart')) {

        new Chart(
            document.getElementById('monthlyReportChart'),
            {
                type: 'bar',

                data: {
                    labels: monthlyLabels,

                    datasets: [{
                        label: 'Expense',

                        data: monthlyData,

                        backgroundColor: '#6366f1',
                        hoverBackgroundColor: '#4f46e5',

                        borderColor: '#6366f1',
                        borderWidth: 1,

                        borderRadius: 7,
                        borderSkipped: false,

                        maxBarThickness: 42
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        },

                        tooltip: {
                            callbacks: {
                                label: function(context) {

                                    return ' ₹' +
                                        Number(
                                            context.raw
                                        ).toLocaleString(
                                            'en-IN',
                                            {
                                                minimumFractionDigits: 2
                                            }
                                        );

                                }
                            }
                        }
                    },

                    scales: {

                        y: {
                            beginAtZero: true,

                            grid: {
                                color: '#f1f5f9'
                            },

                            ticks: {
                                callback: function(value) {
                                    return '₹' +
                                        Number(value)
                                            .toLocaleString('en-IN');
                                }
                            }
                        },

                        x: {
                            grid: {
                                display: false
                            }
                        }

                    }
                }
            }
        );

    }

</script>

@endsection

