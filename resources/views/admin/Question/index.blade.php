@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">

    @livewireStyles
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Soal</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.question.index') }}">Soal</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Soal</h4>
                    </div>
                    <div class="card-body px-3 py-4-5">
                        <div class="mb-4">
                            <a href="{{ route('admin.question.create') }}" class="btn btn-primary">Tambah Soal</a>
                        </div>
                        @livewire('admin.question-table')
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
