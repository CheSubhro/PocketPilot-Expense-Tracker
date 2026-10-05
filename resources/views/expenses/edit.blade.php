@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit Expense</h3>
        <p class="text-muted mb-0">
            Update your expense details.
        </p>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <form method="POST"
                          action="{{ route('expenses.update', $expense->id) }}">

                        @csrf
                        @method('PUT')

                        {{-- Expense Title --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Expense Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $expense->title) }}"
                                placeholder="e.g. Lunch, Grocery, Bus Ticket"
                                required
                            >

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Amount --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Amount
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="amount"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    value="{{ old('amount', $expense->amount) }}"
                                    step="0.01"
                                    min="0"
                                    placeholder="0.00"
                                    required
                                >

                            </div>

                            @error('amount')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Date --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Date
                            </label>

                            <input
                                type="date"
                                name="expense_date"
                                class="form-control @error('expense_date') is-invalid @enderror"
                                value="{{ old(
                                    'expense_date',
                                    $expense->expense_date
                                        ? $expense->expense_date->format('Y-m-d')
                                        : ''
                                ) }}"
                                required
                            >

                            @error('expense_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Category --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select
                                name="category"
                                class="form-select @error('category') is-invalid @enderror"
                                required
                            >

                                @php
                                    $categories = [
                                        'Food',
                                        'Transport',
                                        'Shopping',
                                        'Bills',
                                        'Health',
                                        'Entertainment',
                                        'Education',
                                        'Other'
                                    ];
                                @endphp

                                <option value="">
                                    Select category
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category }}"
                                        {{ old('category', $expense->category) === $category ? 'selected' : '' }}
                                    >
                                        {{ $category }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Note --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Note
                                <span class="text-muted fw-normal">
                                    (Optional)
                                </span>
                            </label>

                            <textarea
                                name="note"
                                rows="4"
                                class="form-control @error('note') is-invalid @enderror"
                                placeholder="Add a note about this expense..."
                            >{{ old('note', $expense->note) }}</textarea>

                            @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('expenses.index') }}"
                                class="btn btn-light px-4"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                            >
                                Update Expense
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection