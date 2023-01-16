@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Soal</h4>
                    </div>
                    <div class="card-content">
                        {{-- showw all error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form id="form" class="form form-vertical" action="{{ route('admin.question.store') }}"
                                method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Soal</label>

                                                <textarea id="question" name="question"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Pilihan Soal</label>
                                                <div id="choice">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Alasan Terhadapan jawaban</label>
                                                <div id="choice_reason">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Pilihan Benar</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-select" name="choice_correct">
                                                            @foreach (['a', 'b', 'c', 'd', 'e'] as $value)
                                                                <option
                                                                    {{ ($loop->iteration == 1 && is_null(old('choice_correct'))) ||(!is_null(old('choice_correct')) && old('choice_correct') == $value)? 'selected': '' }}
                                                                    value="{{ $value }}">{{ Str::upper($value) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Pilihan Alasan</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-select" name="choice_reason_correct">
                                                            @foreach (['a', 'b', 'c', 'd', 'e'] as $value)
                                                                <option
                                                                    {{ ($loop->iteration == 1 && is_null(old('choice_reason_correct'))) ||(!is_null(old('choice_reason_correct')) && old('choice_reason_correct') == $value)? 'selected': '' }}
                                                                    value="{{ $value }}">{{ Str::upper($value) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    {{-- <script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <script>
        // get elemet by id question
        // var question = document.getElementById('question');
        // ClassicEditor
        //     .create(question)
        //     .catch(error => {
        //         console.log(error);
        //     });
        $('#question').summernote()
        let pilihan = ['a', 'b', 'c', 'd', 'e'];
        pilihan.forEach(function(option) {
            // get element by id choice
            let choice = document.getElementById('choice');
            // create div
            let div = document.createElement('div');
            // create label for inside div with value uppercase option
            let label = document.createElement('label');
            label.innerHTML = option.toUpperCase();
            // append label to div
            div.appendChild(label);
            // textarea
            let textarea = document.createElement('textarea');
            textarea.setAttribute('name', 'choice["' + option + '"]');
            // set id for textarea
            textarea.setAttribute('id', 'choice-' + option);
            // set inner html for textarea
            let old_choice = @json(old('choice'));
            if (old_choice) {
                textarea.innerHTML = old_choice['"' + option + '"'];
            }

            // textarea.innerHTML = '{{ old('choice')['+option+'] ?? '' }}';
            // append textarea to div
            div.appendChild(textarea);
            // append div to choice
            choice.appendChild(div);
            $('#choice-' + option).summernote()
            // ClassicEditor
            //     .create(document.querySelector('#choice-' + option))
            //     .catch(error => {
            //         console.error(error);
            //     });
        })
        let pilihan_alasan = ['a', 'b', 'c', 'd', 'e'];
        pilihan_alasan.forEach(function(option) {
            // get element by id choice
            let choice_reason = document.getElementById('choice_reason');
            // create div
            let div = document.createElement('div');
            // create label for inside div with value uppercase option
            let label = document.createElement('label');
            label.innerHTML = option.toUpperCase();
            // append label to div
            div.appendChild(label);
            // textarea
            let textarea = document.createElement('textarea');
            textarea.setAttribute('name', 'choice_reason["' + option + '"]');
            // set id for textarea
            textarea.setAttribute('id', 'choice_reason-' + option);
            let old_choice_reason = @json(old('choice_reason'));
            if (old_choice_reason) {
                textarea.innerHTML = old_choice_reason['"' + option + '"'];
            }

            // append textarea to div
            div.appendChild(textarea);
            // append div to choice
            choice_reason.appendChild(div);
            $('#choice_reason-' + option).summernote()

            // ClassicEditor
            //     .create(document.querySelector('#choice_reason-' + option))
            //     .catch(error => {
            //         console.error(error);
            //     });
        })
    </script>
@endsection
