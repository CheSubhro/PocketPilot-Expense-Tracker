@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Expenses
            </h3>

            <p class="text-muted mb-0">
                Manage and track your expenses.
            </p>
        </div>

        <a href="{{ route('expenses.create') }}"
           class="btn btn-primary px-4">
            + Add Expense
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>

    @endif


    {{-- Search & Filter --}}
    <x-ui.card class="mb-4">

        <form method="GET"
              action="{{ route('expenses.index') }}">

            <div class="row g-3 align-items-end">

                {{-- Search --}}
                <div class="col-lg-4">

                    <label class="form-label fw-semibold">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search expense..."
                    >

                </div>


                {{-- Category --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select
                        name="category"
                        class="form-select"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category }}"
                                {{ request('category') === $category ? 'selected' : '' }}
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Date --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="form-control"
                    >

                </div>


                {{-- Buttons --}}
                <div class="col-lg-2 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-grow-1"
                    >
                        Filter
                    </button>

                    <a
                        href="{{ route('expenses.index') }}"
                        class="btn btn-light"
                        title="Clear filters"
                    >
                        ↻
                    </a>

                </div>

            </div>

        </form>

    </x-ui.card>


    {{-- Expenses Card --}}
    <x-ui.card>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h5 class="fw-bold mb-1">
                    Expense List
                </h5>

                <p class="text-muted small mb-0">
                    {{ $expenses->count() }}
                    {{ $expenses->count() === 1 ? 'expense' : 'expenses' }}
                    found
                </p>
            </div>

        </div>


        @if($expenses->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>Expense</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end">Action</th>
                        </tr>

                    </thead>


                    <tbody>

                    @foreach($expenses as $expense)

                        <tr>

                            {{-- Expense --}}
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


                            {{-- Category --}}
                            <td>

                                <span class="badge bg-light text-dark">
                                    {{ $expense->category }}
                                </span>

                            </td>


                            {{-- Date --}}
                            <td>

                                {{ $expense->expense_date
                                    ? $expense->expense_date->format('d M Y')
                                    : '-' }}

                            </td>


                            {{-- Amount --}}
                            <td class="text-end fw-semibold">

                                ₹{{ number_format($expense->amount, 2) }}

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="{{ route('expenses.edit', $expense->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('expenses.destroy', $expense->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this expense?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- No Result --}}
            <div class="text-center py-5">

                <div class="mb-3" style="font-size: 40px;">
                    🔍
                </div>

                <h5 class="fw-bold">
                    No expenses found
                </h5>

                <p class="text-muted mb-3">
                    Try changing your search or filter.
                </p>

                <a
                    href="{{ route('expenses.index') }}"
                    class="btn btn-light"
                >
                    Clear Filters
                </a>

            </div>

        @endif

    </x-ui.card>

</div>

@endsection