        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Test</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-start my-2 gap-1">
                                @if ($isEdit)
                                    <button class="btn btn-success" wire:click="setEdit(false)">Done</button>
                                @else
                                    <button class="btn btn-success" wire:click="setEdit(true)">Edit</button>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <div class="position-relative">
                                    <p class="h5">Title :</p>
                                    @if($isEdit)
                                        <div class="row" >
                                            <div class="col-10">
                                                <input class="form-control" wire:model="name" type="text" value="{{$test->name }}">
                                            </div>
                                            <div class="col-2">
                                                <button wire:click="updateName" class="btn btn-primary">save</button>
                                            </div>
                                        </div>
                                    @else
                                    <p><strong>{{ $test->name }}</strong></p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="position-relative">

                                    <p class="h5">Durasi :</p>
                                <p><strong>{{ $test->duration }} Menit</strong></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="position-relative p-2">
                                    <p><strong>List Soal</strong></p>
                                    @forelse($test->testQuestions as $testQuestion)
                                        <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                                            <div class="d-flex justify-content-end">
                                                <button wire:click="deleteQuestion({{ $testQuestion->id }})"
                                                    class="btn btn-danger">hapus
                                                    soal</button>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="position-relative">
                                                    <p>Soal :</p>
                                                    <p><strong>{!! $testQuestion->question->title !!}</strong></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="position-relative">
                                                    <p>Pilihan</p>
                                                    @foreach ($testQuestion->question->choices as $choice)
                                                        <p>
                                                            <span
                                                                class="badge  {{ $testQuestion->question->correct_choice == $choice->key ? 'bg-success' : 'bg-light-secondary' }}">{{ $choice->key }}</span>
                                                            {!! $choice->choice !!}
                                                        </p>
                                                    @endforeach
                                                </div>
                                                <div class="position-relative">
                                                    <p>Alasan terhadap pilihan jawaban : </p>
                                                    @foreach ($testQuestion->question->answerReasons as $answerReason)
                                                        <p>
                                                            <span
                                                                class="badge {{ $testQuestion->question->correct_answer_reason == $answerReason->key ? 'bg-success' : 'bg-light-secondary' }}">{{ $answerReason->key }}</span>
                                                            {!! $answerReason->reason !!}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                                            <div class="col-sm-12 text-center">
                                                <p>
                                                    <strong>
                                                        Soal Belum Ada..
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List Soal</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($questions as $question)
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button wire:click="addQuestion({{ $question->id }})"
                                            class="btn btn-success">Tambah
                                            soal</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="position-relative">
                                            <p>Soal :</p>
                                            <p><strong>{!! $question->title !!}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                                    <div class="col-sm-12 text-center">
                                        <p>
                                            <strong>
                                                Soal Belum Ada..
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
