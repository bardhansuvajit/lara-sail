@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center min-vh-80">
        <div class="col-md-8 col-lg-6">
            <div class="text-center py-5">
                <!-- Icon -->
                <div class="mb-4">
                    <div class="display-1 text-warning">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                
                <!-- Title -->
                <h1 class="h2 text-gray-800 mb-3">403 - Access Forbidden</h1>
                
                <!-- Message -->
                <div class="alert alert-light border mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle text-warning me-3 fs-4"></i>
                        <div class="text-start">
                            <p class="mb-1 fw-semibold">Permission Required</p>
                            <p class="mb-0 text-muted small">
                                @if(session('message'))
                                    {{ session('message') }}
                                @else
                                    Your account does not have the necessary permissions to view this page.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Technical Details (for admins) -->
                @if(auth()->guard('admin')->user()->hasRole('Super Admin') && session('permission'))
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <h6 class="card-title">Technical Details</h6>
                        <div class="row text-start small">
                            <div class="col-md-6">
                                <strong>Required Permission:</strong><br>
                                <code>{{ session('permission') }}</code>
                            </div>
                            <div class="col-md-6">
                                <strong>Requested URL:</strong><br>
                                <span class="text-truncate">{{ session('intended_url') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Return Back
                    </a>
                    <a href="{{ route('admin.dashboard.index') }}" class="btn btn-lg btn-primary">
                        <i class="fas fa-home me-2"></i>Go to Dashboard
                    </a>
                </div>

                <!-- Support Information -->
                <div class="mt-5 pt-4 border-top">
                    <p class="text-muted small">
                        Need access? Contact your system administrator or 
                        <a href="mailto:admin@example.com" class="text-decoration-none">support team</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection