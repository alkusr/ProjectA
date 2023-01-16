@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
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
                        <h4 class="card-title">Detail Soal</h4>
                    </div>
                    <div class="card-body px-3 py-4-5">
                        <div class="mb-4">
                            <a href="{{ route('admin.question.index') }}" class="btn btn-primary">kembali</a>
                        </div>
                        <div style="min-height: 600px;">
                            <h4 class="h4">soal</h4>
                            <p class="h6">
                                {!! $question->title !!}
                            </p>
                            <p class="h4 mt-4">
                                Pilihan Jawaban:
                            </p>
                            <div>
                                @foreach ($question->choices as $choice)
                                    {{-- @dump($question) --}}
                                    <div class="mt-2">
                                        <div class="d-flex">
                                            <div>
                                                <label
                                                    class="badge {{ $choice->key == $question->correct_choice ? 'bg-success' : 'bg-light-secondary' }} fs-6">
                                                    {{ $choice->key }}
                                                </label>
                                            </div>
                                            <label class="fs-6">
                                                <strong>{!! $choice->choice !!}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="h6 mt-4">
                                Alasan Terhadap Pilihan Jawaban:
                            </p>
                            <div>
                                @foreach ($question->answerReasons as $answer_reasons)
                                    <div class="mt-2">
                                        <div class="d-flex">
                                            <div>
                                                <label
                                                    class="badge {{ $answer_reasons->key == $question->correct_answer_reason ? 'bg-success' : 'bg-light-secondary' }}  fs-6">
                                                    {{ $answer_reasons->key }}
                                                </label>
                                            </div>
                                            <label class="fs-6">
                                                <strong>{!! $answer_reasons->reason !!}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
@endsection
