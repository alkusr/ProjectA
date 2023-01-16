<x-app-layout>
    <x-slot name="css">
        {{-- sweatalert2 --}}
        <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title">Petunjuk</h4>
                </div>
                <div class="card-body">
                    <div id="instruction"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Data Siswa</h4>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm float-right">Logout</button>
                    </form>
                </div>
                <div class="card-body">
                    <!-- data siswa -->
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
                    <div class="mt-3">
                        <p class="fs-4">
                            Kelas
                        </p>
                        <p class="fs-5">
                            <strong>
                                {{ auth()->user()->participant->class }}
                            </strong>
                        </p>
                    </div>
                    <div class="mt-3">
                        <p class="fs-4">
                            Email
                        </p>
                        <p class="fs-5">
                            <strong>
                                {{ auth()->user()->email }}
                            </strong>
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                            </h4>
                            @if (is_null(auth()->user()->participant->participantTest))
                                <h4 class="card-title">
                                    <span class="badge bg-light-warning">Belum Mengerjakan</span>
                                </h4>
                            @else
                                <h4 class="card-title">
                                    <span class="badge bg-light-success">Sudah Mengerjakan</span>
                                </h4>
                            @endif
                        </div>
                        <div class="card-body">
                            @if (is_null(auth()->user()->participant->participantTest))
                                <a href="#" data-url="{{ route('participant.test') }}" id="start"
                                    class="btn btn-primary w-100">MULAI</a>
                            @else
                                <a href="{{ route('participant.preview') }}" class="btn btn-success w-100">LIHAT
                                    HASIL</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="js">
        {{-- sweatalert2 --}}
        <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
        <script>
            @if (session('warning'))
                Swal.fire({
                title: '{{ session('warning') }}',
                icon: 'warning',
                confirmButtonText: 'OK'
                })
            @endif
            $(document).on('click', '#start', function(e) {
                e.preventDefault();
                warning = `
                    Anda akan memulai Test!
                    Test tidak dapat diulang
                    pastikan anda telah membaca petunjuk
                `
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: warning,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, mulai!'
                }).then((result) => {
                    if (result.value) {
                        // get url
                        url = $(this).data('url');
                        // redirect
                        window.location.href = url;
                    }
                })
            });
            $(document).ready(function() {
                // get the instruction element
                let instruction = document.getElementById('instruction');
                const dataInstruction = [{
                        text: "Alokasi waktu test adalah 60 menit",
                        hasChild: false
                    },
                    {
                        text: "Waktu pengerjaan tes dimulai setelah siswa mengklik MULAI",
                        hasChild: false
                    },
                    {
                        text: "Baca dengan teliti soal tes yang ada dan tentukan pilihan yang menurut Anda sesuai",
                        hasChild: false
                    },
                    {
                        text: "Soal tes terdiri dari {{$question_count}} soal dan masing-masing terdiri dari pilihan: ",
                        hasChild: true,
                        child: [
                            "jawaban", "keyakinan jawaban", 'alasan', 'keyakinan alasan'
                        ]
                    },
                    {
                        text: "Berikut cara pengerjaan soal ",
                        hasChild: true,
                        child: [
                            "Tentukan jawaban", "Tentukan keyakinan atas jawaban tersebut"
                        ]
                    },
                ]
                // each dataInstruction
                dataInstruction.forEach((data, index) => {
                    // create a div
                    let a = document.createElement('a');

                    a.classList.add('btn', 'alert-light-success', 'w-100', 'text-start', 'mt-1');
                    a.setAttribute('data-bs-toggle', 'collapse');
                    a.setAttribute('href', `#instruction${index}`);
                    a.setAttribute('role', 'button');
                    a.setAttribute('aria-expanded', 'false');
                    a.setAttribute('aria-controls', `instruction${index}`);
                    a.textContent = data.text;
                    // append to instruction
                    instruction.appendChild(a);
                    // if has child
                    if (data.hasChild) {
                        let div = document.createElement('div');
                        div.classList.add('collapse', 'mt-1', 'show');
                        div.setAttribute('id', `instruction${index}`);
                        // creat div
                        let child = document.createElement('div');
                        child.classList.add('card', 'card-body');
                        // create ul
                        let ul = document.createElement('ul');
                        // each child
                        data.child.forEach((dataChild, indexChild) => {
                            // create li
                            let li = document.createElement('li');
                            li.textContent = dataChild;
                            // append to ul
                            ul.appendChild(li);
                        })

                        // append to child
                        child.appendChild(ul);
                        // append to div
                        div.appendChild(child);
                        // append to instruction
                        instruction.appendChild(div);
                    }
                })

            });
        </script>
    </x-slot>
</x-app-layout>
