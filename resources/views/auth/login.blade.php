@extends('layouts.app')

@section('title', 'Login - PocketPilot')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card shadow-sm">

            <div class="card-body">

                <h3 class="mb-4">
                    Login
                </h3>

                <form
                    method="POST"
                    action="{{ route('login.store') }}"
                >

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                    </div>

                    <button class="btn btn-dark w-100">
                        Login
                    </button>

                </form>

                <div class="text-center mt-3">

                    Don't have an account?

                    <a href="{{ route('register') }}">
                        Register
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection