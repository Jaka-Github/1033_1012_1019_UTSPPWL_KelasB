@extends('layouts.app')


@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h2 class="mb-0 text-primary">
                        <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
                    </h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="welcome-section text-center mb-4">
                    <h3 class="text-muted">{{ __('Welcome, ') }} {{ auth()->user()->name }}!</h3>
                    </div>

                    <div class="dashboard-actions d-flex justify-content-center gap-3">
                        @canany(['create-role', 'edit-role', 'delete-role'])
                            <a class="btn btn-outline-primary btn-lg d-flex align-items-center" href="{{ route('roles.index') }}">
                                <i class="bi bi-person-fill-gear me-2"></i> Kelola Roles
                            </a>
                        @endcanany
                        
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <a class="btn btn-outline-success btn-lg d-flex align-items-center" href="{{ route('users.index') }}">
                                <i class="bi bi-people me-2"></i> Kelola Users
                            </a>
                        @endcanany

                        @canany(['create-book', 'edit-book', 'delete-book'])
                            <a class="btn btn-outline-warning btn-lg d-flex align-items-center btn-book" href="{{ route('books.index') }}" style="border-color: #FF7F3F; color: orange;">
                                <i class="bi bi-bag me-2"></i> Kelola Buku
                            </a>
                        @endcanany
                    </div>


                    <div class="text-center mt-4">
                        <small class="text-muted">© Mantaka Dashboard</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f4f6f9;
    }
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .dashboard-actions .btn {
        min-width: 200px;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .dashboard-actions .btn:hover {
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-book:hover {
    background-color: #FF7F3F;
    color: black !important;
}
</style>
@endsection
