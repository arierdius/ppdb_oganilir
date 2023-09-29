<div>
    <div class="main">
        <div class="row">
            <div class="container a-container" id="a-container">
                <form wire:submit.prevent="loginAttemp()" class="form mx-auto" id="a-form" method="" action="">
                    <img src="{{ asset('assets_umum/images/logologin.png') }}" class="img-login" alt="">
                    <h2 class="form_title title">Masuk ke PPDB</h2>
                    <input class="form__input" wire:model="email" type="text" placeholder="nik">
                    <input class="form__input" type="password" wire:model="password" placeholder="Password"><br>
                    <b>{{ $keterangan_login }}</b>

                    <button class="switch__button button">Masuk</button>

                    <div class="link_auth d-block d-md-none">
                        <p class="text-center">Belum memiliki akun ? <br>
                        <span>Silahkan buat akun untuk terhubung ke <br> PPDB Ogan Ilir Tahun
                            @php
                                echo date('Y');
                            @endphp

                        </span>
                        <a class="btn-disini" href="{{ route('auth.register.index') }}">Daftar</a> disini.
                        </p>
                    </div>

                </form>
            </div>

        </div>


        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                {{-- <img src="{{ asset('assets_umum/images/logologin.png') }}" style="max-width:20%" alt=""> --}}
                <h2 class="switch__title title">Daftar Akun !</h2>
                <p class="switch__description description">Daftar akun untuk terhubung ke PPDB Ogan Ilir Tahun
                    @php
                        echo date('Y');
                    @endphp</p>
                <a href="{{ route('auth.register.index') }}"><button class="switch__button button">Daftar</button></a>
            </div>
            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Halo Kawan !</h2>
                <p class="switch__description description">Masukkan detail pribadi Anda dan mulailah perjalanan bersama
                    <a class="switch__button button" href="{{ route('auth.register.index') }}"><button
                            class="switch__button button">Masuk</button>
                    </a>
            </div>

        </div>
    </div>
    <script src="main.js"></script>
</div>
