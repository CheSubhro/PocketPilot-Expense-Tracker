
@extends('layouts.app')

@section('title', 'Create Account - PocketPilot')

@section('content')

<div class="min-vh-100 d-flex align-items-center"
     style="background: #f5f7fb; margin-top: -24px; margin-bottom: -24px;">

    <div class="container">

        <div class="row justify-content-center align-items-center g-5">

            {{-- Left Branding --}}
            <div class="col-lg-5 d-none d-lg-block">

                <div class="pe-lg-5">

                    <div class="mb-4">

                        <span
                            class="d-inline-flex align-items-center justify-content-center rounded-3"
                            style="
                                width: 52px;
                                height: 52px;
                                background: #111827;
                                color: white;
                                font-size: 24px;
                            "
                        >
                            ₹
                        </span>

                    </div>

                    <h1 class="fw-bold display-5 mb-3"
                        style="color: #111827;">

                        Start your
                        <span style="color: #6366f1;">
                            financial journey.
                        </span>

                    </h1>

                    <p class="text-secondary fs-5 mb-4">

                        Create your PocketPilot account and
                        start tracking where your money goes.

                    </p>


                    <div class="d-flex flex-column gap-3">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="
                                    width: 36px;
                                    height: 36px;
                                    background: #eef2ff;
                                    color: #6366f1;
                                "
                            >
                                ✓
                            </div>

                            <span class="text-secondary">
                                Track every expense
                            </span>

                        </div>


                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="
                                    width: 36px;
                                    height: 36px;
                                    background: #eef2ff;
                                    color: #6366f1;
                                "
                            >
                                ✓
                            </div>

                            <span class="text-secondary">
                                Understand your spending
                            </span>

                        </div>


                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="
                                    width: 36px;
                                    height: 36px;
                                    background: #eef2ff;
                                    color: #6366f1;
                                "
                            >
                                ✓
                            </div>

                            <span class="text-secondary">
                                Keep your finances organized
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Register Card --}}
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">

                <div
                    class="card border-0 shadow-lg"
                    style="
                        border-radius: 20px;
                        overflow: hidden;
                    "
                >

                    <div class="card-body p-4 p-md-5">


                        {{-- Mobile Logo --}}
                        <div class="d-lg-none text-center mb-4">

                            <div
                                class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
                                style="
                                    width: 52px;
                                    height: 52px;
                                    background: #111827;
                                    color: white;
                                    font-size: 24px;
                                "
                            >
                                ₹
                            </div>

                            <h3 class="fw-bold mb-1">
                                PocketPilot
                            </h3>

                        </div>


                        {{-- Heading --}}
                        <div class="mb-4">

                            <h2 class="fw-bold mb-2">
                                Create your account
                            </h2>

                            <p class="text-secondary mb-0">
                                It only takes a minute to get started.
                            </p>

                        </div>


                        {{-- Validation Errors --}}
                        @if($errors->any())

                            <div class="alert alert-danger border-0 rounded-3">

                                @foreach($errors->all() as $error)

                                    <div>
                                        {{ $error }}
                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- Register Form --}}
                        <form
                            method="POST"
                            action="{{ route('register.store') }}"
                        >

                            @csrf


                            {{-- Name --}}
                            <div class="mb-3">

                                <label
                                    for="name"
                                    class="form-label fw-semibold"
                                >
                                    Full name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control form-control-lg"
                                    placeholder="Enter your name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                >

                            </div>


                            {{-- Email --}}
                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label fw-semibold"
                                >
                                    Email address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control form-control-lg"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    required
                                >

                            </div>


                            {{-- Password --}}
                            <div class="mb-3">

                                <label
                                    for="password"
                                    class="form-label fw-semibold"
                                >
                                    Password
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control form-control-lg"
                                    placeholder="Minimum 6 characters"
                                    required
                                >

                            </div>


                            {{-- Confirm Password --}}
                            <div class="mb-4">

                                <label
                                    for="password_confirmation"
                                    class="form-label fw-semibold"
                                >
                                    Confirm password
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control form-control-lg"
                                    placeholder="Re-enter your password"
                                    required
                                >

                            </div>


                            {{-- Register Button --}}
                            <button
                                type="submit"
                                class="btn w-100 py-3 fw-semibold text-white"
                                style="
                                    background: #6366f1;
                                    border-radius: 10px;
                                "
                            >
                                Create Account
                            </button>

                        </form>


                        {{-- Login Link --}}
                        <div class="text-center mt-4">

                            <span class="text-secondary">
                                Already have an account?
                            </span>

                            <a
                                href="{{ route('login') }}"
                                class="text-decoration-none fw-semibold ms-1"
                                style="color: #6366f1;"
                            >
                                Sign in
                            </a>

                        </div>

                    </div>

                </div>


                <div class="text-center mt-4">

                    <small class="text-secondary">
                        © {{ date('Y') }} PocketPilot
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

