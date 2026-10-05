
@extends('layouts.app')

@section('title', 'Add Expense - PocketPilot')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="mb-4">

            <a
                href="{{ route('expenses.index') }}"
                class="text-decoration-none text-secondary"
            >
                ← Back to Expenses
            </a>

            <h2 class="fw-bold mt-3 mb-1">
                Add Expense
            </h2>

            <p class="text-secondary">
                Record where your money went.
            </p>

        </div>


        <div
            class="card border-0 shadow-sm"
            style="border-radius: 18px;"
        >

            <div class="card-body p-4 p-md-5">

                @if($errors->any())

                    <div class="alert alert-danger border-0 rounded-3">

                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('expenses.store') }}"
                >

                    @csrf


                    {{-- Title --}}
                    <div class="mb-4">

                        <label
                            for="title"
                            class="form-label fw-semibold"
                        >
                            Expense title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control form-control-lg"
                            placeholder="e.g. Lunch, Bus fare, Shopping"
                            value="{{ old('title') }}"
                            required
                        >

                    </div>


                    <div class="row">

                        {{-- Amount --}}
                        <div class="col-md-6 mb-4">

                            <label
                                for="amount"
                                class="form-label fw-semibold"
                            >
                                Amount
                            </label>

                            <div class="input-group input-group-lg">

                                <span class="input-group-text">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    id="amount"
                                    name="amount"
                                    class="form-control"
                                    placeholder="0.00"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('amount') }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- Date --}}
                        <div class="col-md-6 mb-4">

                            <label
                                for="expense_date"
                                class="form-label fw-semibold"
                            >
                                Date
                            </label>

                            <input
                                type="date"
                                id="expense_date"
                                name="expense_date"
                                class="form-control form-control-lg"
                                value="{{ old('expense_date', date('Y-m-d')) }}"
                                required
                            >

                        </div>

                    </div>


                    {{-- Category --}}
                    <div class="mb-4">

                        <label
                            for="category"
                            class="form-label fw-semibold"
                        >
                            Category
                        </label>

                        <select
                            id="category"
                            name="category"
                            class="form-select form-select-lg"
                            required
                        >

                            <option value="">
                                Select category
                            </option>

                            @foreach([
                                'Food',
                                'Transport',
                                'Shopping',
                                'Bills',
                                'Health',
                                'Entertainment',
                                'Education',
                                'Other'
                            ] as $category)

                                <option
                                    value="{{ $category }}"
                                    @selected(old('category') === $category)
                                >
                                    {{ $category }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Note --}}
                    <div class="mb-4">

                        <label
                            for="note"
                            class="form-label fw-semibold"
                        >
                            Note
                            <span class="text-secondary fw-normal">
                                (optional)
                            </span>
                        </label>

                        <textarea
                            id="note"
                            name="note"
                            class="form-control"
                            rows="4"
                            placeholder="Add a short note..."
                        >{{ old('note') }}</textarea>

                    </div>


                    {{-- Buttons --}}
                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('expenses.index') }}"
                            class="btn btn-light px-4 py-2"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn text-white px-4 py-2"
                            style="
                                background: #6366f1;
                                border-radius: 9px;
                            "
                        >
                            Save Expense
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

