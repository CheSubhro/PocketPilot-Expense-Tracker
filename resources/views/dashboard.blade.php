@extends('layouts.app')

@section('title', 'Dashboard - PocketPilot')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Dashboard</h2>

        <p class="text-muted mb-0">
            Welcome back, {{ auth()->user()->name }}!
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

<div class="row g-3">

    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="text-muted">
                    Total Expense
                </h6>

                <h3>
                    ₹0.00
                </h3>

            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="text-muted">
                    This Month
                </h6>

                <h3>
                    ₹0.00
                </h3>

            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="text-muted">
                    Today
                </h6>

                <h3>
                    ₹0.00
                </h3>

            </div>
        </div>

    </div>

</div>

<div class="card shadow-sm mt-4">

    <div class="card-body">

        <h5>
            Recent Expenses
        </h5>

        <p class="text-muted mb-0">
            No expenses added yet.
        </p>

    </div>

</div>

@endsection