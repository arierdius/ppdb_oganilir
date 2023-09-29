<div>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form wire:submit.prevent="store" class="form" id="a-form" method="" action="">
                <img src="{{ asset('assets_umum/images/logodaftar.png') }}" class="img-register" alt="">
                <h2 class="form_title title">Pendaftaran</h2>
                <input class="form__input @error('email') is-invalid @enderror" wire:model="email" type="text"
                    placeholder="nik">

                @if ($status_pendaftaran == '1')
                @else
                    @if ($show_message == 'username telah digunakan')
                        <b style="color: red">{{ $show_message }}</b>
                    @else
                        <b style="color: green">{{ $show_message }}</b>
                    @endif
                @endif
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input class="form__input @error('password') is-invalid @enderror" type="password" wire:model="password"
                    placeholder="Password"><br>
                <b style="color: red">
                    @php
                        if ($status_pendaftaran == '1') {
                            echo ' Pendaftaran Berhasil, SIlahkan Login';
                        }
                    @endphp
                </b>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <button class="switch__button button">Daftar</button>
                {{-- <div>aa</div> --}}

                <div class="link_auth d-block d-md-none">
                    <p class="text-center">Sudah memiliki akun ? <br>
                    <span>Silahkan Login untuk terhubung ke <br> PPDB Ogan Ilir Tahun 
                        @php
                            echo date('Y');
                        @endphp
    
                    </span> 
                    <a class="btn-disini" href="{{ route('auth.login.index') }}">Masuk</a> disini 
                    </p>
                </div>
            </form>
        </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Masuk !</h2>
                <p class="switch__description description">untuk tetap terhubung dengan PPDB Tahun @php
                    echo date('Y');
                @endphp
                    silahkan Masuk</p>
                <a href="{{ route('auth.login.index') }}"><button class="switch__button button">Masuk</button></a>
            </div>
            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Halo Kawan !</h2>
                <p class="switch__description description">Masukkan detail pribadi Anda dan mulailah perjalanan bersama
                    <a class="switch__button button" href="{{ route('auth.register.index') }}"><button
                            class="switch__button button">Masuk</button></a>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</div>
