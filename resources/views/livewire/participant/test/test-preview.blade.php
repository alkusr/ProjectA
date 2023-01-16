<div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3">
                        <p class="fs-4">
                            Nama
                        </p>
                        <p class="fs-5">
                            <strong>
                                {{ auth()->user()->participant->name }}
                            </strong>
                        </p>
                    </div>
                    <div class="mt-3">
                        <p class="fs-4">
                            Asal Sekolah
                        </p>
                        <p class="fs-5">
                            <strong>
                                {{ auth()->user()->participant->school_origin }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($show)
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h1 class="h1 text-center mb-3 text-uppercase">
                        Persentase Hasil Test
                    </h1>
                    <hr>
                    <div class="row justify-content-center align-items-cente">
                        <div class="col-md-9">
                            <table class="table table-responsive">
                                <thead>
                                    <tr class="text-center text-white">
                                        <th class="bg-primary">Kategori</th>
                                        <th class="bg-primary">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participant_test->participantTestResult->participantTestResultDetails as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->testResultCategory->name }}</td>
                                            <td>{{ round($item->percent) }} %</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-center h5 my-4">
                                Hasil uji miskonsepsi pada materi ikatan kimia yang telah dilakukan, akan dikirim ke
                                alamat email Anda (dalam bentuk file pdf). Silakan tekan tombol log out untuk
                                meninggalkan laman web ini. Terimakasih
                            </p>
                            <div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h1 class="h1 text-center mb-3 text-uppercase">
                        HASIL TES DIAGNOSTIC
                    </h1>
                    <hr>
                    @foreach ($baseQuestions as $quest)
                        <div class="mt-4" style="min-height: 600px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="h5">
                                        Soal No. {{ $loop->iteration }}
                                    </p>
                                    <p class="h6">
                                        {!! $quest->question->title !!}
                                    </p>
                                    <div>
                                        @foreach ($quest->question->choices as $choice)
                                            <div class="mt-2">
                                                <div class="d-flex">
                                                    <div>
                                                        <label
                                                            class="badge fs-6 {{ $quest->participantTestQuestionAnswer->answer == $choice->key ? 'active' : 'bg-light-secondary' }}">
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
                                        Tingkat Keyakinan Terhadap Jawaban
                                    </p>
                                    <div>
                                        @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                            <div class="mt-2">
                                                <div>
                                                    <label
                                                        class="badge  {{ (($quest->participantTestQuestionAnswer->confidence_answer == 1 && $key == 'A') ||($quest->participantTestQuestionAnswer->confidence_answer == 0 && $key == 'B')) &&!is_null($quest->participantTestQuestionAnswer->confidence_answer)? 'active': 'bg-light-secondary fs-6 ' }}">
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
                                        @foreach ($quest->question->answerReasons as $answer_reasons)
                                            <div class="mt-2">
                                                <div class="d-flex">
                                                    <div>

                                                        <label
                                                            class="badge  fs-6 flex-grow-0 {{ $quest->participantTestQuestionAnswer->answer_reason == $answer_reasons->key? 'active': 'bg-light-secondary' }}">
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
                                    <p class="h6 mt-4">
                                        Tingkat keyakinan terhadap pilihan alasan:
                                    </p>
                                    <div>
                                        @foreach (['A' => 'Yakin', 'B' => 'Tidak Yakin'] as $key => $choice)
                                            <div class="mt-2">
                                                <div>
                                                    <label
                                                        class="badge fs-6 {{ (($quest->participantTestQuestionAnswer->confidence_answer_reason == 1 && $key == 'A') ||($quest->participantTestQuestionAnswer->confidence_answer_reason == 0 && $key == 'B')) &&!is_null($quest->participantTestQuestionAnswer->confidence_answer_reason)? 'active': 'bg-light-secondary ' }}">
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
                                <div class="col-md-4">
                                    <div class="card mt-4">
                                        <ul class="list-group">
                                            <li class="list-group-item active" aria-current="true">Kategori</li>

                                            <li class="list-group-item">
                                                {{ $quest->participantTestQuestionAnswer->testResultCategory->name ?? '' }}
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="mt-4 d-flex flex-wrap justify-content-end">
                        <button wire:click="showpreview"
                            class="btn btn-primary btn-xl d-flex justify-content-between align-items-center">
                            <small>
                                Lihat Precentase Hasil Test
                            </small>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
