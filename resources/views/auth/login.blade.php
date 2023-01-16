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
                <h1 class="auth-title fs-4">Login </h1>
                <p class="auth-subtitle mb-5 fs-5">Masuk dengan data Anda yang Anda masukkan saat pendaftaran.</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg" name="email" placeholder="Email"
                            value="{{ old('email') }}" required autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-lg" name="password"
                            placeholder="Password" name="password" required autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            ingat Saya
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-5">Login</button>
                </form>
                <div class="text-center mt-5 text-lg fs-6">
                    <p class="text-gray-600">Tidak Punya Akun ? <a href="{{ route('register') }}"
                            class="font-bold">Register</a>.</p>
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
