@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    @livewireStyles
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="ocl-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User</h4>
                    </div>
                    <div class="card-body px-3 py-4-5">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <a href="{{ route('admin.user.export') }}" class="btn btn-primary">
                                    Export to Excel
                                </a>
                            </div>
                            <div>
                                <form action="{{ route('admin.user.reset') }}" method="post">
                                    @csrf
                                    <button onclick="return confirm('apakah anda yakin untuk reset user ?')"
                                        class="btn btn-danger">Reset User</button>
                                </form>
                            </div>
                        </div>
                        @livewire('admin.user-table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    @livewireScripts
    <script>
        @if (session('success'))
            Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4fbe87",
            }).showToast();
        @endif
    </script>
@endsection
