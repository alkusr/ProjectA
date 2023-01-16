<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
        <style>
            input[type="radio"] {
                display: none;
            }

            input[type="radio"],
            input[type="radio"]+div label.badge {
                cursor: pointer;
                transition: .2s;
            }


            input[type="radio"]:checked+div label.badge {
                background-color: rgb(106, 171, 201);
                color: white;
            }

            .active {
                background-color: rgb(106, 171, 201);
                color: white;
            }

        </style>
    </x-slot>
    <div id="app">
        <div class="d-flex flex-column justify-content-center align-items-center" v-if="loading"
            style="position: absolute;z-index:9999;background-color:white;left:0;right:0;top:0;bottom:0;">
            <img src="assets/vendors/svg-loaders/circles.svg" class="me-4" style="width: 10rem" alt="audio">
            <div class="mt-4">
                <h3>Soal sedang diload...</h3>
            </div>
        </div>
        <div v-else>
            <template v-if="isPreview">
                <div class="row">
                    <div class="card mt-3">
                        <div class="card-body">
                            <template v-for="(question,parent_index) in baseSoal">
                                <div class="mt-4" style="min-height: 600px;">
                                    <p class="h5">
                                        Soal No. @{{ parent_index + 1 }}
                                    </p>
                                    <p class="h6" v-html="question.question.title">
                                    </p>
                                    <div>
                                        <template v-for="(choice ,index) in question.question.choices" :key="choice.id +index+ (new Date()).getTime()">
                                            <div class="mt-2">
                                                <input type="radio"
                                                    :checked="(question.participant_test_question_answer.answer == choice.key)"
                                                    :name="'choice'+parent_index">
                                                <div class="d-flex">
                                                    <div>
                                                        <label class="label_key badge bg-light-secondary fs-6">
                                                            @{{ choice.key }}
                                                        </label>
                                                    </div>
                                                    <label class="label_text fs-6">
                                                        <strong v-html="choice.choice">
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <p class="h6 mt-4">
                                        Tingkat Keyakinan Terhadap Jawaban
                                    </p>
                                    <div>
                                        <template v-for="(choice ,index) in keyakinan" :key="index+23+(new Date()).getTime()">
                                            <div class="mt-2">
                                                <input
                                                    :checked="question.participant_test_question_answer.confidence_answer != null && (question.participant_test_question_answer.confidence_answer && choice.key == 'A' || !question.participant_test_question_answer.confidence_answer &&  choice.key == 'B') "
                                                    type="radio" :name="'choice_confidence'+parent_index">
                                                <div class="d-flex">
                                                    <div>
                                                        <label class="label_key badge bg-light-secondary fs-6">
                                                            @{{ choice.key }}
                                                        </label>
                                                    </div>
                                                    <label class="label_text fs-6">
                                                        <strong v-html="choice.choice">
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <p class="h6 mt-4">
                                        Alasan Terhadap Pilihan Jawaban:
                                    </p>
                                    <div>
                                        <template v-for="(choice ,index) in question.question.answer_reasons"
                                            :key="choice.id+ index + 256 + (new Date()).getTime()">
                                            <div class="mt-2">
                                                <input type="radio"
                                                    :checked="(question.participant_test_question_answer.answer_reason == choice.key)"
                                                    :name="'answer_reason'+parent_index">
                                                <div class="d-flex">
                                                    <div>
                                                        <label class="label_key badge bg-light-secondary fs-6">
                                                            @{{ choice.key }}
                                                        </label>
                                                    </div>
                                                    <label class="label_text fs-6">
                                                        <strong v-html="choice.reason">
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <p class="h6 mt-4">
                                        Tingkat keyakinan terhadap pilihan alasan:
                                    </p>
                                    <div>
                                        <template v-for="(choice ,index) in keyakinan" :key="index+24+(new Date()).getTime()">
                                            <div class="mt-2">
                                                <input
                                                    :checked="question.participant_test_question_answer.confidence_answer_reason != null && (question.participant_test_question_answer.confidence_answer_reason && choice.key == 'A' || !question.participant_test_question_answer.confidence_answer_reason &&  choice.key == 'B') "
                                                    type="radio"
                                                    :name="'choice_confidence_reason'+parent_index">
                                                <div class="d-flex">
                                                    <div>
                                                        <label class="label_key badge bg-light-secondary fs-6">
                                                            @{{ choice.key }}
                                                        </label>
                                                    </div>
                                                    <label class="label_text fs-6">
                                                        <strong v-html="choice.choice">
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </template>
                            <div class="mt-4 d-flex flex-wrap justify-content-end">
                                <button id="btnControl" @click="backToQuestion"
                                    class="btn btn-primary btn-sm me-2 d-flex justify-content-between align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    <small>
                                        Kembali
                                    </small>
                                </button>
                                <button
                                    class="btn btn-primary btn-sm d-flex justify-content-between  align-items-center"
                                    @click="sendResult" id="end-test">
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
            </template>
            <template v-else>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <span class="h4">Soal No @{{ page }}</span>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 text-end">
                                        {{-- badge time left --}}
                                        <span class="badge bg-light-success fs-4" wire:ignore>
                                            <span id="timeLeft">
                                                <vue-countdown :time="1000 * 60 * 60" @end="onCountdownEnd"
                                                    v-slot="{ minutes, seconds }">
                                                    @{{ minutes.toString().padStart(2, '0') }} : @{{ seconds.toString().padStart(2, '0') }}
                                                </vue-countdown>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-4" style="min-height: 600px;">
                                        <p class="h6" id="title_soal" v-html="soal.question.title">
                                        </p>
                                        <div id="pilihan_soal">
                                            <template v-for="(choice ,index) in soal.question.choices" :key="choice.id">
                                                <div class="mt-2">
                                                    <input type="radio"
                                                        :checked="(soal.participant_test_question_answer.answer == choice.key)"
                                                        :id="'choice'+index" name="choice">
                                                    <div class="d-flex">
                                                        <div>
                                                            <label @click="setAnswer(choice.key)" :for="'choice'+index"
                                                                class="label_key badge bg-light-secondary fs-6">
                                                                @{{ choice.key }}
                                                            </label>
                                                        </div>
                                                        <label @click="setAnswer(choice.key)" class="label_text fs-6"
                                                            :for="'choice'+index">
                                                            <strong v-html="choice.choice">
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <p class="h6 mt-4">
                                            Tingkat Keyakinan Terhadap Jawaban
                                        </p>
                                        <div id="tingkat_keyakinan_pilihan">
                                            <template v-for="(choice ,index) in keyakinan" :key="index+page">
                                                <div class="mt-2">
                                                    <input
                                                        :checked="soal.participant_test_question_answer.confidence_answer != null && (soal.participant_test_question_answer.confidence_answer && choice.key == 'A' || !soal.participant_test_question_answer.confidence_answer &&  choice.key == 'B') "
                                                        type="radio" :id="'choice_confidence'+index"
                                                        name="choice_confidence">
                                                    <div class="d-flex">
                                                        <div>
                                                            <label @click="setAnswerConfidence(choice.key)"
                                                                :for="'choice_confidence'+index"
                                                                class="label_key badge bg-light-secondary fs-6">
                                                                @{{ choice.key }}
                                                            </label>
                                                        </div>
                                                        <label @click="setAnswerConfidence(choice.key)"
                                                            class="label_text fs-6" :for="'choice_confidence'+index">
                                                            <strong v-html="choice.choice">
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <p class="h6 mt-4">
                                            Alasan Terhadap Pilihan Jawaban:
                                        </p>
                                        <div id="alasan_terhadap_pilihan">
                                            <template v-for="(choice ,index) in soal.question.answer_reasons"
                                                :key="choice.id">
                                                <div class="mt-2">
                                                    <input type="radio"
                                                        :checked="(soal.participant_test_question_answer.answer_reason == choice.key)"
                                                        :id="'answer_reason'+index" name="answer_reason">
                                                    <div class="d-flex">
                                                        <div>
                                                            <label @click="setAnswerReason(choice.key)"
                                                                :for="'answer_reason'+index"
                                                                class="label_key badge bg-light-secondary fs-6">
                                                                @{{ choice.key }}
                                                            </label>
                                                        </div>
                                                        <label @click="setAnswerReason(choice.key)"
                                                            class="label_text fs-6" :for="'answer_reason'+index">
                                                            <strong v-html="choice.reason">
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                        <p class="h6 mt-4">
                                            Tingkat keyakinan terhadap pilihan alasan:
                                        </p>
                                        <div id="tingkat_keyakinan_alasan">
                                            <template v-for="(choice ,index) in keyakinan" :key="index+index+page">
                                                <div class="mt-2">
                                                    <input
                                                        :checked="soal.participant_test_question_answer.confidence_answer_reason != null && (soal.participant_test_question_answer.confidence_answer_reason && choice.key == 'A' || !soal.participant_test_question_answer.confidence_answer_reason &&  choice.key == 'B') "
                                                        type="radio" :id="'choice_confidence_reason'+index"
                                                        name="choice_confidence_reason">
                                                    <div class="d-flex">
                                                        <div>
                                                            <label @click="setAnswerConfidenceReason(choice.key)"
                                                                :for="'choice_confidence_reason'+index"
                                                                class="label_key badge bg-light-secondary fs-6">
                                                                @{{ choice.key }}
                                                            </label>
                                                        </div>
                                                        <label @click="setAnswerConfidenceReason(choice.key)"
                                                            class="label_text fs-6"
                                                            :for="'choice_confidence_reason'+index">
                                                            <strong v-html="choice.choice">
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-12 col-sm-2 col-md-2">
                                                <button id="btnControl" :disabled="page != lastPage"
                                                    @click="isPreview = true"
                                                    class="btn btn-primary btn-sm d-flex justify-content-between align-items-center">
                                                    <small>
                                                        selesai
                                                    </small>
                                                    <i class="bi bi-box-arrow-in-right ms-2"></i>
                                                </button>
                                            </div>
                                            <div class="col-12 col-sm-10 col-md-10">
                                                <div class="d-flex flex-wrap justify-content-end">
                                                    <button id="next" @click="prevSoal" :disabled="page <= 1"
                                                        class="btn btn-primary btn-sm me-2 d-flex justify-content-between align-items-center">
                                                        <i class="bi bi-arrow-left me-2"></i>
                                                        <small>
                                                            Soal Sebelumnya
                                                        </small>
                                                    </button>
                                                    <button id="prev" @click="nextSoal" :disabled="page >= lastPage"
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
                                        {{-- @foreach ($baseQuestions as $item) --}}
                                        <template v-for="(item,index) in baseSoal">
                                            <div class="col-3 col-md-3 mt-2" @click="setPage(index)">
                                                <div class="w-100 badge"
                                                    :class="getMap(item.participant_test_question_answer) && 'bg-primary' || 'bg-light-secondary'"
                                                    style="cursor: pointer;">
                                                    @{{ index + 1 }}</div>
                                            </div>
                                        </template>
                                        {{-- @endforeach --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <x-slot name="js">
        {{-- sweatalert2 --}}
        <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/easytimerjs/easytimer.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue@3.2.33/dist/vue.global.prod.js"></script>
        <script src="https://unpkg.com/@chenfengyuan/vue-countdown@2"></script>
        <script>
            Vue.createApp({
                components: {
                    VueCountdown
                },
                data() {
                    return {
                        baseSoal: @js($test_question),
                        isPreview: false,
                        isTimeOver: false,
                        soal: @js($test_question)[0],
                        page: 1,
                        lastPage: @js($test_question).length,
                        keyakinan: [{
                                key: 'A',
                                choice: 'Yakin'
                            },
                            {
                                key: 'B',
                                choice: 'Tidak Yakin'
                            },
                        ]
                    }
                },
                methods: {
                    sendResult() {
                        // get elemet by id send-form check if is not null
                        let form = document.getElementById('send-form');
                        if (form != null) {
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
                                    form.submit();
                                }
                            })
                        }
                    },
                    onCountdownEnd() {
                        this.isPreview = true;
                        this.isTimeOver = true;
                        Swal.fire({
                            title: 'Waktu Habis',
                            text: 'Anda akan diarahkan ke halaman hasil',
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        })
                    },
                    backToQuestion() {
                        if (this.isTimeOver) return
                        this.isPreview = false;
                    },
                    getMap(item) {
                        return item.answer != null && item.answer_reason != null && item.confidence_answer != null &&
                            item.confidence_answer_reason != null;
                    },

                    nextSoal() {
                        // if page is last page
                        if (this.page >= this.lastPage) return
                        this.page++
                        this.setSoal()
                    },
                    prevSoal() {
                        // if page is first page
                        if (this.page <= 1) return
                        this.page--
                        this.setSoal()
                    },
                    setPage(index) {
                        if (index < 0 && index > lastPage - 1) return
                        this.page = index + 1
                        this.setSoal()
                    },
                    setSoal() {
                        this.soal = this.baseSoal[this.page - 1]
                        this.setScroll()
                    },
                    setScroll() {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        })
                    },
                    setAnswer(answer) {
                        if (['A', 'B', 'C', 'D', 'E'].includes(answer)) {
                            let page = this.page - 1
                            axios.post('{{ route('participant.api.set-answer') }}', {
                                test_question_id: this.soal.id,
                                answer: answer
                            }).then(res => {
                                if (res.data.status == 'success') {
                                    this.baseSoal[page].participant_test_question_answer.answer =
                                        answer
                                }
                            }).catch(err => {
                                console.log(err)
                            })

                        }
                    },
                    setAnswerConfidence(answer) {
                        if (['A', 'B'].includes(answer)) {
                            answer = answer == 'A' ? true : false
                            let page = this.page - 1
                            axios.post('{{ route('participant.api.set-answer-confidence') }}', {
                                test_question_id: this.soal.id,
                                answer: answer
                            }).then(res => {
                                if (res.data.status == 'success') {
                                    this.baseSoal[page].participant_test_question_answer
                                        .confidence_answer =
                                        answer
                                }
                            }).catch(err => {
                                console.log(err)
                            })
                        }
                    },
                    setAnswerReason(answer) {
                        if (['A', 'B', 'C', 'D', 'E'].includes(answer)) {
                            let page = this.page - 1
                            axios.post('{{ route('participant.api.set-answer-reason') }}', {
                                test_question_id: this.soal.id,
                                answer: answer
                            }).then(res => {
                                if (res.data.status == 'success') {
                                    this.baseSoal[page].participant_test_question_answer
                                        .answer_reason =
                                        answer
                                }
                            }).catch(err => {
                                console.log(err)
                            })
                        }
                    },
                    setAnswerConfidenceReason(answer) {
                        if (['A', 'B'].includes(answer)) {
                            answer = answer == 'A' ? true : false
                            let page = this.page - 1
                            axios.post('{{ route('participant.api.set-answer-reason-confidence') }}', {
                                test_question_id: this.soal.id,
                                answer: answer
                            }).then(res => {
                                if (res.data.status == 'success') {
                                    this.baseSoal[page].participant_test_question_answer
                                        .confidence_answer_reason =
                                        answer
                                }
                            }).catch(err => {
                                console.log(err)
                            })
                        }
                    },
                }
            }).mount('#app')
        </script>
    </x-slot>
</x-app-layout>
