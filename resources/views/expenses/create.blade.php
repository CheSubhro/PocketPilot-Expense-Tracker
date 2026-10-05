
@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-7 col-xl-6">

            {{-- =================================================
                 Page Header
                 ================================================= --}}
            <x-ui.page-header
                title="Add Expense"
                description="Record a new expense to keep your finances organized."
                :back-url="route('expenses.index')"
                back-text="Back to Expenses"
            />


            {{-- =================================================
                 Expense Card
                 ================================================= --}}
            <x-ui.card>

                {{-- Card Header --}}
                <div
                    class="d-flex align-items-center gap-3 mb-4 pb-3"
                    style="border-bottom: 1px solid #f0f1f3;"
                >

                    <div
                        class="d-flex align-items-center justify-content-center rounded-3"
                        style="
                            width: 44px;
                            height: 44px;
                            background: #eef2ff;
                            color: #6366f1;
                            font-size: 20px;
                            font-weight: 700;
                        "
                    >
                        ₹
                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Expense Details
                        </h5>

                        <p class="text-muted small mb-0">
                            Enter the details of your expense.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     Form
                     ================================================= --}}
                <form
                    method="POST"
                    action="{{ route('expenses.store') }}"
                >

                    @csrf


                    {{-- Expense Title --}}
                    <x-form.input
                        name="title"
                        label="Expense Title"
                        placeholder="e.g. Lunch, Grocery, Bus Ticket"
                        required
                    />


                    {{-- Amount + Category --}}
                    <div class="row g-3">

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


                    {{-- Date --}}
                    <x-form.date
                        name="expense_date"
                        label="Date"
                        :value="date('Y-m-d')"
                        required
                    />


                    {{-- Note --}}
                    <x-form.textarea
                        name="note"
                        label="Note"
                        placeholder="Add a note about this expense..."
                        :rows="4"
                    />


                    {{-- Actions --}}
                    <div
                        class="pt-2 mt-4"
                        style="border-top: 1px solid #f0f1f3;"
                    >

                        <x-form.actions
                            :cancel-url="route('expenses.index')"
                            submit-text="Save Expense"
                        />

                    </div>

                </form>

            </x-ui.card>

        </div>

    </div>

</div>

@endsection

