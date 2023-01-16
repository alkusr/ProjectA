<div>
    @if ($preview)
        <div class="row">
            <div class="card mt-3">
                <div class="card-body">
                    @foreach ($baseQuestions as $quest)
                        <div class="mt-4" style="min-height: 600px;">
                            <p class="h5">
                                Soal No. {{ $loop->iteration }}
                            </p>
                            <p class="h6">
                                {!! $quest['question']['title'] !!}
                            </p>
                            <div>
                                @foreach ($quest['question']['choices'] as $choice)
                                    <div class="mt-2">
                                        <div class="d-flex">
                                            <div>
                                                <label
                                                    class="badge fs-6 {{ $quest['participant_test_question_answer']['answer'] == $choice['key'] ? 'active' : 'bg-light-secondary' }}">
                                                    {{ $choice['key'] }}
                                                </label>
                                            </div>
                                            <label class="fs-6">
                                                <strong>{!! $choice['choice'] !!}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="h6 mt-4">
                                Tingkat Keyakinan Terhadap Jawaban
                            </p>
                            <div>
                                @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                    <div class="mt-2">
                                        <div>
                                            <label
                                                class="badge  {{ (($quest['participant_test_question_answer']['confidence_answer'] == 1 && $key == 'A') ||($quest['participant_test_question_answer']['confidence_answer'] == 0 && $key == 'B')) &&!is_null($quest['participant_test_question_answer']['confidence_answer'])? 'active': 'bg-light-secondary fs-6 ' }}">
                                                {{ $key }}
                                            </label>
                                            <label class="fs-6">
                                                <strong>{{ $choice }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="h6 mt-4">
                                Alasan Terhadap Pilihan Jawaban:
                            </p>
                            <div>
                                @foreach ($quest['question']['answer_reasons'] as $answer_reasons)
                                    <div class="mt-2">
                                        <div class="d-flex">
                                            <div>

                                                <label
                                                    class="badge  fs-6 flex-grow-0 {{ $quest['participant_test_question_answer']['answer_reason'] == $answer_reasons['key']? 'active': 'bg-light-secondary' }}">
                                                    {{ $answer_reasons['key'] }}
                                                </label>
                                            </div>
                                            <label class="fs-6">
                                                <strong>{!! $answer_reasons['reason'] !!}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="h6 mt-4">
                                Tingkat keyakinan terhadap pilihan alasan:
                            </p>
                            <div>
                                @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                    <div class="mt-2">
                                        <div>
                                            <label
                                                class="badge fs-6 {{ (($quest['participant_test_question_answer']['confidence_answer_reason'] == 1 && $key == 'A') ||($quest['participant_test_question_answer']['confidence_answer_reason'] == 0 && $key == 'B')) &&!is_null($quest['participant_test_question_answer']['confidence_answer_reason'])? 'active': 'bg-light-secondary ' }}">
                                                {{ $key }}
                                            </label>
                                            <label class="fs-6">
                                                <strong>{{ $choice }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 d-flex flex-wrap justify-content-end">
                        <button wire:click="backToQuestion()" id="btnControl"
                            class="btn btn-primary btn-sm me-2 d-flex justify-content-between align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            <small>
                                Kembali
                            </small>
                        </button>
                        <button class="btn btn-primary btn-sm d-flex justify-content-between align-items-center"
                            id="end-test">
                            <small>
                                Kirim Jawaban
                            </small>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                        <form id="send-form" action="{{ route('participant.test.calculate') }}" method="post">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-6 col-sm-6 col-md-6">
                                    <span class="h4">Soal No {{ $page }}</span>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 text-end">
                                    {{-- badge time left --}}
                                    <span class="badge bg-light-success fs-4" wire:ignore>
                                        <span id="timeLeft"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mt-4" style="min-height: 600px;">
                                <p class="h6">
                                    {!! $question['question']['title'] !!}
                                </p>
                                <div>
                                    @foreach ($question['question']['choices'] as $choice)
                                        <div class="mt-2">
                                            <input type="radio" id="choice{{ $loop->iteration }}{{ $page }}"
                                                name="choice"
                                                {{ $question['participant_test_question_answer']['answer'] == $choice['key'] ? 'checked' : '' }}>
                                            <div class="d-flex">
                                                <div>
                                                    <label
                                                        wire:click="choice({{ $question['id'] }},'{{ $choice['key'] }}')"
                                                        for='choice{{ $loop->iteration }}{{ $page }}'
                                                        class="badge bg-light-secondary fs-6">
                                                        {{ $choice['key'] }}
                                                    </label>
                                                </div>
                                                <label
                                                    wire:click="choice({{ $question['id'] }},'{{ $choice['key'] }}')"
                                                    class="fs-6"
                                                    for='choice{{ $loop->iteration }}{{ $page }}'>
                                                    <strong>{!! $choice['choice'] !!}</strong>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="h6 mt-4">
                                    Tingkat Keyakinan Terhadap Jawaban
                                </p>
                                <div>
                                    @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                        <div class="mt-2">
                                            <input type="radio"
                                                id="confidence_answer{{ $loop->iteration }}{{ $page }}"
                                                {{ (($question['participant_test_question_answer']['confidence_answer'] == 1 && $key == 'A') ||($question['participant_test_question_answer']['confidence_answer'] == 0 && $key == 'B')) &&!is_null($question['participant_test_question_answer']['confidence_answer'])? 'checked': '' }}
                                                name="confidence_answer">
                                            <div>
                                                <label
                                                    wire:click="confidenceChoice({{ $question['id'] }},'{{ $key }}')"
                                                    for='confidence_answer{{ $loop->iteration }}{{ $page }}'
                                                    class="badge bg-light-secondary fs-6">
                                                    {{ $key }}
                                                </label>
                                                <label
                                                    wire:click="confidenceChoice({{ $question['id'] }},'{{ $key }}')"
                                                    class="fs-6"
                                                    for='confidence_answer{{ $loop->iteration }}{{ $page }}'>
                                                    <strong>{{ $choice }}</strong>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="h6 mt-4">
                                    Alasan Terhadap Pilihan Jawaban:
                                </p>
                                <div>
                                    @foreach ($question['question']['answer_reasons'] as $answer_reasons)
                                        <div class="mt-2">
                                            <input type="radio"
                                                id="answer_reasons{{ $loop->iteration }}{{ $page }}"
                                                {{ $question['participant_test_question_answer']['answer_reason'] == $answer_reasons['key'] ? 'checked' : '' }}
                                                name="answer_reasons">
                                            <div class="d-flex">
                                                <div>

                                                    <label
                                                        wire:click="reasonAnswer({{ $question['id'] }},'{{ $answer_reasons['key'] }}')"
                                                        for='answer_reasons{{ $loop->iteration }}{{ $page }}'
                                                        class="badge bg-light-secondary fs-6 flex-grow-0">
                                                        {{ $answer_reasons['key'] }}
                                                    </label>
                                                </div>
                                                <label
                                                    wire:click="reasonAnswer({{ $question['id'] }},'{{ $answer_reasons['key'] }}')"
                                                    class="fs-6"
                                                    for='answer_reasons{{ $loop->iteration }}{{ $page }}'>
                                                    <strong>{!! $answer_reasons['reason'] !!}</strong>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="h6 mt-4">
                                    Tingkat keyakinan terhadap pilihan alasan:
                                </p>
                                <div>
                                    @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                        <div class="mt-2">
                                            <input type="radio"
                                                id="confidence_answer_reason{{ $loop->iteration }}{{ $page }}"
                                                {{ (($question['participant_test_question_answer']['confidence_answer_reason'] == 1 && $key == 'A') ||($question['participant_test_question_answer']['confidence_answer_reason'] == 0 && $key == 'B')) &&!is_null($question['participant_test_question_answer']['confidence_answer_reason'])? 'checked': '' }}
                                                name="confidence_answer_reason">
                                            <div>
                                                <label
                                                    wire:click="confidenceReasonAnswer({{ $question['id'] }},'{{ $key }}')"
                                                    for='confidence_answer_reason{{ $loop->iteration }}{{ $page }}'
                                                    class="badge bg-light-secondary fs-6">
                                                    {{ $key }}
                                                </label>
                                                <label
                                                    wire:click="confidenceReasonAnswer({{ $question['id'] }},'{{ $key }}')"
                                                    class="fs-6"
                                                    for='confidence_answer_reason{{ $loop->iteration }}{{ $page }}'>
                                                    <strong>{{ $choice }}</strong>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-12 col-sm-2 col-md-2">
                                        <button wire:click="showPreview()" {{ $page == $lastPage ? '' : 'disabled' }}
                                            id="btnControl"
                                            class="btn btn-primary btn-sm d-flex justify-content-between align-items-center">
                                            <small>
                                                selesai
                                            </small>
                                            <i class="bi bi-box-arrow-in-right ms-2"></i>
                                        </button>
                                    </div>
                                    <div class="col-12 col-sm-10 col-md-10">
                                        <div class="d-flex flex-wrap justify-content-end">
                                            <button {{ $page == 1 ? 'disabled' : '' }} wire:click="previousPage"
                                                id="btnControl"
                                                class="btn btn-primary btn-sm me-2 d-flex justify-content-between align-items-center">
                                                <i class="bi bi-arrow-left me-2"></i>
                                                <small>
                                                    Soal Sebelumnya
                                                </small>
                                            </button>
                                            <button {{ $page == $lastPage ? 'disabled' : '' }} wire:click="nextPage"
                                                id="btnControl"
                                                class="btn btn-primary btn-sm d-flex justify-content-between align-items-center">
                                                <small>
                                                    Soal Berikutnya
                                                </small>
                                                <i class="bi bi-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- 1 to 18 --}}
                                @foreach ($baseQuestions as $item)
                                    <div class="col-3 col-md-3 mt-2">
                                        <div wire:click="page({{ $loop->iteration }})"
                                            class="w-100 badge {{ !is_null($item['participant_test_question_answer']['answer']) &&
                                            !is_null($item['participant_test_question_answer']['confidence_answer']) &&
                                            !is_null($item['participant_test_question_answer']['answer_reason']) &&
                                            !is_null($item['participant_test_question_answer']['confidence_answer_reason'])
                                                ? 'bg-success'
                                                : 'bg-light-secondary ' }}"
                                            style="cursor: pointer;">{{ $loop->iteration }}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('js')
        <script>
            $(document).ready(function() {
                const timer = new easytimer.Timer({
                    countdown: true,
                    startValues: {
                        seconds: {{ $duration * 60 }}
                    }
                });
                timer.start();
                $('#timeLeft').html(timer.getTimeValues().toString());

                timer.addEventListener('secondsUpdated', function(e) {
                    // set minute convert to string
                    let min = timer.getTimeValues().minutes.toString().padStart(2, '0');
                    // set second convert to string
                    let sec = timer.getTimeValues().seconds.toString().padStart(2, '0');

                    $('#timeLeft').html(`${min}:${sec}`);
                });

                timer.addEventListener('targetAchieved', function(e) {
                    // sweatalert redirect to result
                    @this.call('setTimeOut')
                    // show alert
                    Swal.fire({
                        title: 'Waktu Habis',
                        text: 'Anda akan diarahkan ke halaman hasil',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    })
                });
                // jquery window laod
                $(document).on('click', '#end-test', function() {
                    endTest();
                })
                $(document).on('click', '#btnControl', function() {
                    scrollto();
                })



                // scroll to top
                function scrollto() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }

                function endTest() {
                    // sweetalert2
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda tidak dapat mengulangi test setelah menyelesaikan test ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, saya yakin!'
                    }).then((result) => {
                        if (result.value) {
                            // send-form
                            $('#send-form').submit();
                        }
                    })
                }
            });
        </script>
    @endpush
</div>
