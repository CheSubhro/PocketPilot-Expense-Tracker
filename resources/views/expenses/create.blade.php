@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <x-ui.page-header
                title="Add Expense"
                description="Record a new expense to keep your finances organized."
                :back-url="route('expenses.index')"
                back-text="Back to Expenses"
            />

            <x-ui.card>

                <div class="mb-4">
                    <h5 class="fw-bold mb-1">
                        Expense Details
                    </h5>

                    <p class="text-muted small mb-0">
                        Enter the details of your expense.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('expenses.store') }}">

                    @csrf

                    <x-form.input
                        name="title"
                        label="Expense Title"
                        placeholder="e.g. Lunch, Grocery, Bus Ticket"
                        required
                    />

                    <div class="row">

                        <div class="col-md-6">

                            <x-form.money
                                name="amount"
                                label="Amount"
                                placeholder="0.00"
                                required
                            />

                        </div>

                        <div class="col-md-6">

                            <x-form.select
                                name="category"
                                label="Category"
                                :options="[
                                    'Food',
                                    'Transport',
                                    'Shopping',
                                    'Bills',
                                    'Health',
                                    'Entertainment',
                                    'Education',
                                    'Other'
                                ]"
                                placeholder="Select category"
                                required
                            />

                        </div>

                    </div>

                    <x-form.date
                        name="expense_date"
                        label="Date"
                        :value="date('Y-m-d')"
                        required
                    />

                    <x-form.textarea
                        name="note"
                        label="Note"
                        placeholder="Add a note about this expense..."
                        :rows="4"
                    />

                    <x-form.actions
                        :cancel-url="route('expenses.index')"
                        submit-text="Save Expense"
                    />

                </form>

            </x-ui.card>

        </div>

    </div>

</div>

@endsection