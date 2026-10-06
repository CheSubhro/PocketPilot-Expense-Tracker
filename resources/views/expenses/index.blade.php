
@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- =========================================================
         Header
         ========================================================= --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <div class="d-flex align-items-center gap-2 mb-1">

                <h3 class="fw-bold mb-0">
                    Expenses
                </h3>

                <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle"
                    style="
                        width: 8px;
                        height: 8px;
                        background: #10b981;
                    "
                ></span>

            </div>

            <p class="text-muted mb-0">
                Manage and track your expenses.
            </p>
        </div>

        <a
            href="{{ route('expenses.create') }}"
            class="btn btn-primary px-4"
        >
            <span class="me-1">+</span>
            Add Expense
        </a>

    </div>


    {{-- =========================================================
         Success Message
         ========================================================= --}}
    <x-ui.alert type="success" />


    {{-- =========================================================
         Search & Filter
         ========================================================= --}}
    <x-ui.card class="mb-4">

        <div class="d-flex align-items-center gap-2 mb-3">

            <div
                class="d-flex align-items-center justify-content-center rounded-3"
                style="
                    width: 38px;
                    height: 38px;
                    background: #eef2ff;
                    color: #6366f1;
                    font-size: 17px;
                "
            >
                ☰
            </div>

            <div>
                <h6 class="fw-bold mb-0">
                    Search & Filter
                </h6>

                <small class="text-muted">
                    Find your expenses quickly.
                </small>
            </div>

        </div>


        <form
            method="GET"
            action="{{ route('expenses.index') }}"
        >

            <div class="row g-3 align-items-end">

                {{-- Search --}}
                <div class="col-lg-4">

                    <label class="form-label fw-semibold small">
                        Search
                    </label>

                    <div class="position-relative">

                        <span
                            class="position-absolute top-50 translate-middle-y text-muted"
                            style="left: 13px;"
                        >
                            🔍
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            style="padding-left: 40px;"
                            placeholder="Search expense..."
                        >

                    </div>

                </div>


                {{-- Category --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold small">
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

                    <label class="form-label fw-semibold small">
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
                        class="btn btn-light px-3"
                        title="Clear filters"
                    >
                        ↻
                    </a>

                </div>

            </div>

        </form>

    </x-ui.card>


    {{-- =========================================================
         Expense List
         ========================================================= --}}
    <x-ui.card>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">

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


            {{-- Active filter indicator --}}
            @if(request()->filled('search') || request()->filled('category') || request()->filled('date'))

                <span
                    class="badge rounded-pill"
                    style="
                        background: #eef2ff;
                        color: #6366f1;
                        font-weight: 500;
                        padding: 8px 12px;
                    "
                >
                    Filters applied
                </span>

            @endif

        </div>


        @if($expenses->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr
                            style="
                                border-bottom: 1px solid #eef0f2;
                            "
                        >

                            <th
                                class="text-muted small fw-semibold border-0"
                            >
                                Expense
                            </th>

                            <th
                                class="text-muted small fw-semibold border-0"
                            >
                                Category
                            </th>

                            <th
                                class="text-muted small fw-semibold border-0"
                            >
                                Date
                            </th>

                            <th
                                class="text-muted small fw-semibold border-0 text-end"
                            >
                                Amount
                            </th>

                            <th
                                class="text-muted small fw-semibold border-0 text-end"
                            >
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($expenses as $expense)

                        <tr
                            style="
                                border-bottom: 1px solid #f3f4f6;
                            "
                        >

                            {{-- Expense --}}
                            <td class="py-3">

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-3"
                                        style="
                                            width: 42px;
                                            height: 42px;
                                            background: #f5f3ff;
                                            color: #6366f1;
                                            font-weight: 700;
                                            flex-shrink: 0;
                                        "
                                    >
                                        {{ strtoupper(substr($expense->title, 0, 1)) }}
                                    </div>


                                    <div>

                                        <div class="fw-semibold">

                                            {{ $expense->title }}

                                        </div>


                                        @if($expense->note)

                                            <small
                                                class="text-muted d-block"
                                                style="
                                                    max-width: 260px;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    white-space: nowrap;
                                                "
                                            >
                                                {{ $expense->note }}
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td class="py-3">

                                <span
                                    class="badge rounded-pill"
                                    style="
                                        background: #f3f4f6;
                                        color: #4b5563;
                                        font-weight: 500;
                                        padding: 7px 11px;
                                    "
                                >
                                    {{ $expense->category }}
                                </span>

                            </td>


                            {{-- Date --}}
                            <td class="py-3">

                                <span class="text-muted">

                                    {{ $expense->expense_date
                                        ? $expense->expense_date->format('d M Y')
                                        : '-' }}

                                </span>

                            </td>


                            {{-- Amount --}}
                            <td class="py-3 text-end">

                                <span
                                    class="fw-bold"
                                    style="color: #111827;"
                                >
                                    ₹{{ number_format($expense->amount, 2) }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="py-3">

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="{{ route('expenses.edit', $expense->id) }}"
                                        class="btn btn-sm btn-light"
                                        title="Edit expense"
                                        style="
                                            color: #6366f1;
                                            border: 1px solid #e5e7eb;
                                        "
                                    >
                                        Edit
                                    </a>
                                    
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light"
                                            title="Delete expense"
                                            style="
                                                color: #ef4444;
                                                border: 1px solid #e5e7eb;
                                            "
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteExpenseModal"
                                            data-expense-title="{{ $expense->title }}"
                                            data-delete-url="{{ route('expenses.destroy', $expense->id) }}"
                                        >
                                            Delete
                                        </button>



                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>


        @else

            {{-- =================================================
                 Empty State
                 ================================================= --}}
            <div class="text-center py-5">

                <div
                    class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                    style="
                        width: 64px;
                        height: 64px;
                        background: #f5f3ff;
                        color: #6366f1;
                        font-size: 25px;
                    "
                >
                    🔍
                </div>


                <h5 class="fw-bold mb-2">
                    No expenses found
                </h5>


                <p class="text-muted mb-4">

                    @if(request()->filled('search') ||
                        request()->filled('category') ||
                        request()->filled('date'))

                        Try changing your search or filter.

                    @else

                        You haven't added any expenses yet.

                    @endif

                </p>


                @if(request()->filled('search') ||
                    request()->filled('category') ||
                    request()->filled('date'))

                    <a
                        href="{{ route('expenses.index') }}"
                        class="btn btn-light px-4"
                    >
                        Clear Filters
                    </a>

                @else

                    <a
                        href="{{ route('expenses.create') }}"
                        class="btn btn-primary px-4"
                    >
                        + Add Your First Expense
                    </a>

                @endif

            </div>

        @endif

    </x-ui.card>

</div>

{{-- =========================================================
     Delete Expense Modal
     ========================================================= --}}
<div
    class="modal fade"
    id="deleteExpenseModal"
    tabindex="-1"
    aria-labelledby="deleteExpenseModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-body p-4">

                {{-- Icon --}}
                <div
                    class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                    style="
                        width: 58px;
                        height: 58px;
                        background: #fef2f2;
                        color: #ef4444;
                        font-size: 24px;
                    "
                >
                    🗑️
                </div>


                {{-- Title --}}
                <h5
                    class="fw-bold text-center mb-2"
                    id="deleteExpenseModalLabel"
                >
                    Delete expense?
                </h5>


                {{-- Message --}}
                <p class="text-muted text-center mb-4">

                    Are you sure you want to delete

                    <strong
                        id="deleteExpenseTitle"
                        class="text-dark"
                    ></strong>?

                    <br>

                    <small>
                        This action cannot be undone.
                    </small>

                </p>


                {{-- Actions --}}
                <div class="d-flex gap-2 justify-content-center">

                    <button
                        type="button"
                        class="btn btn-light px-4"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>


                    <form
                        id="deleteExpenseForm"
                        method="POST"
                        action=""
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger px-4 pp-loader-btn"
                            data-loader-button
                            data-loading-text="Deleting..."
                        >
                            <span class="pp-loader-btn-content">
                                Delete Expense
                            </span>

                            <span
                                class="pp-loader-spinner d-none"
                                aria-hidden="true"
                            ></span>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    const deleteExpenseModal =
        document.getElementById('deleteExpenseModal');

    deleteExpenseModal.addEventListener(
        'show.bs.modal',
        function (event) {

            const button = event.relatedTarget;

            const expenseTitle =
                button.getAttribute('data-expense-title');

            const deleteUrl =
                button.getAttribute('data-delete-url');


            /*
            |--------------------------------------------------------------------------
            | Set Expense Title
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'deleteExpenseTitle'
            ).textContent = expenseTitle;


            /*
            |--------------------------------------------------------------------------
            | Set Delete Form Action
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'deleteExpenseForm'
            ).setAttribute(
                'action',
                deleteUrl
            );

        }
    );

</script>



@endsection

