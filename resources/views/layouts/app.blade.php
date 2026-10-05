
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'PocketPilot')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark pp-navbar">

    <div class="container">

        {{-- Brand --}}
        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="{{ route('dashboard') }}"
        >

            <span class="pp-brand-icon">
                ₹
            </span>

            <span class="fw-bold">
                PocketPilot
            </span>

        </a>


        @auth

            {{-- Mobile Toggle --}}
            <button
                class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#pocketPilotNavbar"
                aria-controls="pocketPilotNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >

                <span class="navbar-toggler-icon"></span>

            </button>


            <div
                class="collapse navbar-collapse"
                id="pocketPilotNavbar"
            >

                <div
                    class="navbar-nav ms-auto align-items-lg-center gap-lg-2"
                >

                    {{-- Dashboard --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link pp-nav-link
                        {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    >
                        Dashboard
                    </a>


                    {{-- Expenses --}}
                    <a
                        href="{{ route('expenses.index') }}"
                        class="nav-link pp-nav-link
                        {{ request()->routeIs('expenses.*') ? 'active' : '' }}"
                    >
                        Expenses
                    </a>


                    {{-- Reports --}}
                    <a
                        href="{{ route('reports.index') }}"
                        class="nav-link pp-nav-link
                        {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                    >
                        Reports
                    </a>


                    {{-- User Menu --}}
                    <div
                        class="dropdown ms-lg-3 mt-3 mt-lg-0"
                    >

                        <button
                            class="btn pp-user-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >

                            <span class="pp-avatar">
                                {{ strtoupper(
                                    substr(auth()->user()->name, 0, 1)
                                ) }}
                            </span>

                            <span class="d-none d-sm-inline">
                                {{ auth()->user()->name }}
                            </span>

                        </button>


                        <ul
                            class="dropdown-menu dropdown-menu-end pp-dropdown"
                        >

                            {{-- User Information --}}
                            <li>

                                <span
                                    class="dropdown-item-text small text-muted"
                                >
                                    Signed in as
                                </span>

                            </li>

                            <li>

                                <span
                                    class="dropdown-item-text fw-semibold"
                                >
                                    {{ auth()->user()->email }}
                                </span>

                            </li>


                            <li>

                                <hr class="dropdown-divider">

                            </li>


                            {{-- Logout --}}
                            <li>

                                <form
                                    action="{{ route('logout') }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger"
                                    >
                                        Logout
                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        @endauth

    </div>

</nav>


<main class="pp-page">

    <div class="container py-4">

        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success pp-alert">

                {{ session('success') }}

            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger pp-alert">

                <div class="fw-semibold mb-1">
                    Please fix the following:
                </div>

                <ul class="mb-0 ps-3">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        @yield('content')

    </div>

</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>

