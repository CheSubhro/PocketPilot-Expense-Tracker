
@extends('layouts.app')

@section('title', 'Expenses - PocketPilot')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">
            Expenses
        </h2>

        <p class="text-secondary mb-0">
            Keep track of your spending.
        </p>

    </div>

    <a
        href="{{ route('expenses.create') }}"
        class="btn text-white"
        style="
            background: #6366f1;
            border-radius: 9px;
        "
    >
        + Add Expense
    </a>

</div>


@if(session('success'))

    <div class="alert alert-success border-0 rounded-3">
        {{ session('success') }}
    </div>

@endif


<div
    class="card border-0 shadow-sm"
    style="border-radius: 18px;"
>

    <div class="card-body p-0">

        @if($expenses->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4 py-3">
                                Expense
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Date
                            </th>

                            <th class="text-end px-4">
                                Amount
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($expenses as $expense)

                            <tr>

                                <td class="px-4 py-3">

                                    <div class="fw-semibold">
                                        {{ $expense->title }}
                                    </div>

                                    @if($expense->note)

                                        <small class="text-secondary">
                                            {{ $expense->note }}
                                        </small>

                                    @endif

                                </td>


                                <td>

                                    <span class="badge text-bg-light">
                                        {{ $expense->category }}
                                    </span>

                                </td>


                                <td>

                                    {{ $expense->expense_date->format('d M Y') }}

                                </td>


                                <td class="text-end px-4">

                                    <span class="fw-bold">
                                        ₹{{ number_format($expense->amount, 2) }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center py-5 px-4">

                <div
                    class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center"
                    style="
                        width: 64px;
                        height: 64px;
                        background: #eef2ff;
                        font-size: 28px;
                    "
                >
                    ₹
                </div>

                <h5 class="fw-bold">
                    No expenses yet
                </h5>

                <p class="text-secondary">
                    Start tracking your spending by adding your first expense.
                </p>

                <a
                    href="{{ route('expenses.create') }}"
                    class="btn text-white"
                    style="
                        background: #6366f1;
                        border-radius: 9px;
                    "
                >
                    Add First Expense
                </a>

            </div>

        @endif

    </div>

</div>

@endsection

