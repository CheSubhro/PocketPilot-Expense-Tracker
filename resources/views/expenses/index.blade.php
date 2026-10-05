@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">Expenses</h3>

            <p class="text-muted mb-0">
                Manage your expenses.
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


    {{-- Expenses Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            @if($expenses->count())

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="px-4">Expense</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end px-4">Action</th>
                            </tr>

                        </thead>


                        <tbody>

                        @foreach($expenses as $expense)

                            <tr>

                                {{-- Expense --}}
                                <td class="px-4">

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
                                <td class="text-end px-4">

                                    <div class="d-flex justify-content-end gap-2">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('expenses.edit', $expense->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Edit
                                        </a>


                                        {{-- Delete --}}
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

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <div class="mb-3" style="font-size: 40px;">
                        💸
                    </div>

                    <h5 class="fw-bold">
                        No expenses yet
                    </h5>

                    <p class="text-muted mb-3">
                        Start tracking your expenses today.
                    </p>

                    <a
                        href="{{ route('expenses.create') }}"
                        class="btn btn-primary"
                    >
                        Add Your First Expense
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection