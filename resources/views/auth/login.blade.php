
@extends('layouts.app')

@section('title', 'Login - PocketPilot')

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
                        Take control of<br>
                        your <span style="color: #6366f1;">money.</span>
                    </h1>

                    <p class="text-secondary fs-5 mb-4">
                        Track your expenses, understand your spending
                        and keep your finances organized with PocketPilot.
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
                                Simple expense tracking
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
                                Clear spending overview
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
                                Your finances, your way
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Login Card --}}
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


                        <div class="mb-4">

                            <h2 class="fw-bold mb-2">
                                Welcome back 👋
                            </h2>

                            <p class="text-secondary mb-0">
                                Sign in to continue to PocketPilot.
                            </p>

                        </div>


                        {{-- Error --}}
                        @if($errors->any())

                            <div class="alert alert-danger border-0 rounded-3">

                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach

                            </div>

                        @endif


                        {{-- Login Form --}}
                        <form
                            method="POST"
                            action="{{ route('login.store') }}"
                        >

                            @csrf


                            {{-- Email --}}
                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label fw-semibold"
                                >
                                    Email address
                                </label>

                                <div class="input-group">

                                    <span
                                        class="input-group-text bg-light border-end-0"
                                    >
                                        @
                                    </span>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control bg-light border-start-0"
                                        placeholder="you@example.com"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                    >

                                </div>

                            </div>


                            {{-- Password --}}
                            <div class="mb-4">

                                <div class="d-flex justify-content-between">

                                    <label
                                        for="password"
                                        class="form-label fw-semibold"
                                    >
                                        Password
                                    </label>

                                </div>

                                <div class="input-group">

                                    <span
                                        class="input-group-text bg-light border-end-0"
                                    >
                                        🔒
                                    </span>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control bg-light border-start-0"
                                        placeholder="Enter your password"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- Login Button --}}
                            <button
                                type="submit"
                                class="btn pp-loader-btn w-100"
                                data-loader-button
                                data-loading-text="Signing in..."
                            >
                                <span class="pp-loader-btn-content">
                                    Sign In
                                </span>

                                <span
                                    class="pp-loader-spinner d-none"
                                    aria-hidden="true"
                                ></span>
                            </button>

                        </form>


                        {{-- Register --}}
                        <div class="text-center mt-4">

                            <span class="text-secondary">
                                Don't have an account?
                            </span>

                            <a
                                href="{{ route('register') }}"
                                class="text-decoration-none fw-semibold ms-1"
                                style="color: #6366f1;"
                            >
                                Create account
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

