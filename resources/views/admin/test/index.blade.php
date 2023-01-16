@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    @livewireStyles
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Diagnostic Test</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.test.index') }}">Diagnostic Test</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        @livewire('admin.test.test-show')
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    @livewireScripts
    <script>
        window.addEventListener('success', event => {
            // toastr.success(event.detail.message);
            Toastify({
                text: event.detail.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast();
        })
        window.addEventListener('success-delete', event => {
            // red toas
            Toastify({
                text: event.detail.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336",
            }).showToast();
        })
    </script>
@endsection
