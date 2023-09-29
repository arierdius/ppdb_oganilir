<div>

    <div class="wrap-login100">
        <form wire:submit.prevent="loginAttemp()" class="login100-form validate-form">
            <span class="login100-form-logo">
                <img src="{{ asset('assets_umum/images/logo-oi.png') }}" width="100" alt="">
            </span>

            <span class="login100-form-title p-b-34 p-t-27" style="font-weight:700;">
                Masuk Akun
            </span>
            <p class="mb-5 text-dark fw-800 text-center" style="font-weight:700;">Bagi peserta didik yang telah terdaftar, silahkan masuk
                mengunakan akun yang telah di daftarkan.</p>

            <p class="text-danger text-center mb-3">{{ $keterangan_login }}</p>

            <div class="wrap-input100 validate-input" data-validate="Enter username">
                <input class="input100" wire:model="email" type="text" placeholder="NIK">
                <span class="focus-input100" data-placeholder="NIK"></span>
            </div>

            <div class="wrap-input100 validate-input mb-0" data-validate="Enter password">
                <input class="input100" type="password" wire:model="password" placeholder="password" id="myInput">
                <span class="focus-input100" data-placeholder="Password"></span>
            </div>
            <!-- An element to toggle between password visibility -->
            <input type="checkbox" onclick="myFunction()"> Show Password

            <div class="mx-2 text-center">
                <i wire:click="reloadCaptcha()" class="fas fa-sync-alt fa-2x mx-auto"></i>
                {!! $captchaImg !!}
            </div>
            <input id="captcha" type="text" class="input100 mb-3 mt-3" placeholder="Masukkan Captcha"
                wire:model.defer="captcha">
            @error('captcha')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror



            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>
            <div class="footer-log">
                <!-- <div class="text-center mt-2">
                <a class="txt1" href="#">
                    Forgot Password?
                </a>
            </div> -->
                <div class="text-center mt-3">
                    <p>Belum Punya Akun? <a href="{{ route('auth.register.index') }}" class="linked">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

@endpush
