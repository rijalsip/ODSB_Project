<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sales Monitoring')
    </title>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- AdminLTE -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"
    >

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    role="button"
                >
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

    <li class="nav-item d-flex align-items-center">

        <span class="mr-3 text-dark">
            <i class="fas fa-user-circle text-primary mr-1"></i>
            <strong>{{ Auth::user()->name }}</strong>
        </span>

        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf

            <button
                type="submit"
                class="btn btn-danger btn-sm"
            >
                <i class="fas fa-sign-out-alt mr-1"></i>
                Logout
            </button>
        </form>

    </li>

</ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="{{ route('dashboard') }}" class="brand-link">
            <i class="fas fa-chart-line ml-3 mr-2"></i>

            <span class="brand-text font-weight-light">
                Sales Monitoring
            </span>
        </a>

        <div class="sidebar">
            @php
    $role = Auth::user()->role->name;
@endphp
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >

                                                            @if($role !== 'Direct Sales')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="nav-link {{
                                request()->routeIs('dashboard')
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <i class="nav-icon fas fa-home"></i>

                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Master Data -->
                    <li class="nav-header">
                        MASTER DATA
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('roles.index') }}"
                            class="nav-link {{
                                request()->routeIs('roles.*')
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <i class="nav-icon fas fa-user-shield"></i>

                            <p>Role</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('users.index') }}"
                            class="nav-link {{
                                request()->routeIs('users.*')
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <i class="nav-icon fas fa-users"></i>

                            <p>User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('sites.index') }}"
                            class="nav-link {{
                                request()->routeIs('sites.*')
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <i class="nav-icon fas fa-tower-cell"></i>

                            <p>Site</p>
                        </a>
                    </li>
                    @endif

                    <!-- Monitoring -->
                    <li class="nav-header">
                        MONITORING
                    </li>

                    <li class="nav-item">
    <a
        href="{{ route('report-sales.index') }}"
        class="nav-link {{
            request()->routeIs('report-sales.*') ? 'active' : ''
        }}"
    >
        <i class="nav-icon fas fa-chart-column"></i>

        <p>Selling</p>
    </a>
</li>

                </ul>
            </nav>

        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @yield('page-title', 'Dashboard')
                        </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>

            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                @if (session('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <i class="fas fa-check-circle mr-1"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert"
                    >
                        <i class="fas fa-exclamation-circle mr-1"></i>

                        {{ session('error') }}

                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')

            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>
            Sales Monitoring System
        </strong>

        <div class="float-right d-none d-sm-inline-block">
            Laravel
        </div>
    </footer>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stack('scripts')

</body>
</html>