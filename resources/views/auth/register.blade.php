<x-guest-layout>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="mb-4">
                    <a href="{{ route('participant.dashboard') }}">
                        <img style="width: 50px;" src="assets/images/logo-app.png">
                        <span class="fs-4 font-bold">{{ env('APP_NAME') }}</span>
                    </a>
                </div>
                <h1 class="auth-title fs-4">Registrasi</h1>
                <p class="auth-subtitle mb-5 fs-5">Masukkan data Anda untuk mendaftar ke website kami.</p>
                {{-- show any eror --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg" name="name" autof placeholder="Nama"
                            value="{{ old('name') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg" name="school_origin"
                            value="{{ old('school_origin') }}" placeholder="Nama Sekolah">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg" name="class"
                            value="{{ old('class') }}" placeholder="Kelas">
                        <div class="form-control-icon">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-lg" name="password"
                            placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-lg" name="password_confirmation"
                            placeholder="Konfirmasi Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-3">Registrasi</button>
                </form>
                <div class="text-center mt-5 text-lg fs-6">
                    <p class='text-gray-600'>Sudah memiliki akun ? <a href="{{ route('login') }}"
                            class="font-bold">Login</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <img class="opacity-50" src="{{ asset('assets/images/wp.jpg') }}" alt="" srcset="">
            </div>
        </div>
    </div>

</x-guest-layout>
