<div class="wrap-login100">
    <form class="login100-form" wire:submit.prevent="store" method="" action="">
        <span class="login100-form-logo">
            <img src="{{ asset ('assets_umum/images/logo-oi.png') }}" width="100" alt="">
        </span>

        <span class="login100-form-title p-b-34 p-t-27" style="font-weight:700;">
            Pendaftaran
        </span>
        <p class="mb-5 text-dark fw-800 text-center" style="font-weight:700;">Bagi peserta didik yang belum terdaftar, silahkan buat akun terlebih dahulu.</p>

        @if ($status_pendaftaran == '1')
        @else
            @if ($show_message == 'username telah digunakan')
                <b style="color: red">{{ $show_message }}</b>
            @else
                <b style="color: green; font-weight:400; font-size: 13px;">{{ $show_message }}</b>
            @endif
        @endif
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input class="input100" form__input @error('email') is-invalid @enderror" wire:model="email" type="number"
            placeholder="NIK">
            <span class="focus-input100" data-placeholder="NIK"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" class="form__input @error('password') is-invalid @enderror" type="password" wire:model="password"
                    placeholder="Password">
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>

        <p class="text-success text-center mb-3">
            @php
                if ($status_pendaftaran == '1') {
                    echo ' Pendaftaran Berhasil, Silahkan Login';
                }
            @endphp
        </p>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror


        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Daftar
            </button>
        </div>
        <div class="footer-log">
            <!-- <div class="text-center mt-2">
                <a class="txt1" href="#">
                    Forgot Password?
                </a>
            </div> -->
            <div class="text-center mt-3">
                <p>Sudah Punya Akun? <a href="{{ route('auth.login.index') }}" class="linked">Masuk di sini</a></p>
            </div>
        </div>
    </form>
</div>
