@php
    use App\Models\Umum\Kontak;
    $kontak = Kontak::first();
@endphp
<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPDB OGAN ILIR</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->

    <link href="{{ asset('assets_umum/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">



    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets_umum/css/all.min.css') }}">



    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600&display=swap" rel="stylesheet">



    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">



    <link href="{{ asset('assets_umum/css/style.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('assets_umum/css/owl.carousel.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets_umum/css/owl.theme.default.min.css') }}" />
    @livewireScripts('script')
    @livewireStyles('style')

</head>



<body>

    @include('layouts.umum.header');


    <div>
        {{ $slot }}

        {{-- <div class="subcribe-div">

            <div class="container text-center">

                <h1> NEED MORE INFORMATION? </h1>

                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod </p>

                <a href="#"></i> <b style="color: white"> 1800-229-602 </b>
                </a>

            </div>

        </div> --}}

    </div>





    <footer>

        <div class="container">

            <div class="row">

                <div class="d-flex justify-content-between">

                    <div class="col-md-4">

                        {{-- <img src="{{ asset('assets_umum/images/logo-footer.png') }}" alt="logo"> --}}
                        <img src="{{ asset('assets_umum/images/oganilir-bangkit.png') }}" alt="logo" style="width: 60%">

                        {{-- <p class="text-white"> Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p> --}}

                    </div>



                    <div class="col-md-4 offset-md-4">
                        <div class="comon-footer">
                            <h5> Hubungi Kami </h5>

                            <ul class="list-unstyled">

                                <li> <i class="bi bi-geo-alt-fill"></i> {{$kontak->alamat}} </a> </li>

                                <li> <a href="#"> <i class="bi bi-telephone-forward"></i> {{$kontak->telp}} </a>
                                </li>

                                <li> <a href="#"> <i class="bi bi-envelope"></i> {{ strtolower($kontak->email) }}
                                    </a> </li>
                        </div>

                        </ul>

                    </div>

                </div>



            </div>

        </div>

        <hr class="bg-white" />

        <div class="container">

            <div class="row row-cols-1 row-cols-md-2 justify-content-between">

                <div class="col-lg-6 text-white"> © 2023 Diskominfo Kabupaten Ogan Ilir | All right reserved. </div>

                <div class="col-lg-6">

                    <ul class="list-unstyled socal">

                        <li> <a href="#"> <i class="bi bi-facebook"></i> </a>

                            <a href="#"> <i class="bi bi-twitter"></i> </a>

                            <a href="#"> <i class="bi bi-instagram"></i></a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </footer>






    <!-- login Modal -->
    <div class="modal fade login-div-modal" id="logoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">

                    <div id="login-td-div" class="com-div-md">
                        <span class="text-center d-table m-auto user-icon"> <i class="fas fa-user-circle"></i> </span>
                        <h5 class="text-center mb-3"> Sign In </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="login-modal-pn">

                            <div class="cm-select-login mt-3">
                                <div class="country-dp">

                                    <input type="email" class="form-control" placeholder="Username Or Email"
                                        alt="pn">
                                </div>
                                <div class="phone-div">

                                    <input type="password" class="form-control" placeholder="Password" alt="pn">
                                </div>


                            </div>



                            <button class="btn continue-bn"> <i class="fas fa-lock"></i> SIGN IN </button>
                        </div>

                        <p class="text-center  mt-3">
                            <a data-bs-toggle="modal" class="regster-bn" data-bs-target="#lostpsModal"
                                data-bs-dismiss="modal"> Lost
                                Password ? </a>
                        </p>


                        <p class="text-center  mt-3"> Do not have an account?
                            <a data-bs-toggle="modal" class="regster-bn" data-bs-target="#registerModal"
                                data-bs-dismiss="modal">
                                Register </a>
                        </p>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <!-- register Modal -->

    <div class="modal fade login-div-modal" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <div id="login-td-div" class="com-div-md">
                        <span class="text-center d-table m-auto user-icon"> <i class="fas fa-user-circle"></i> </span>
                        <h5 class="text-center mb-3"> Register </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="login-modal-pn">

                            <div class="cm-select-login mt-3">
                                <div class="country-dp">

                                    <input type="text" class="form-control" placeholder="Full Name"
                                        alt="pn">
                                </div>
                                <div class="phone-div">

                                    <input type="email" class="form-control" placeholder="Email or Phone Number"
                                        alt="pn">
                                </div>

                                <div class="phone-div">

                                    <input type="password" class="form-control" placeholder="Create Password"
                                        alt="pn">
                                </div>
                                <div class="phone-div">

                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        alt="pn">
                                </div>

                                <div class="forget2 mt-3 ml-3 d-flex justify-content-between">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1"> By clicking Register, you
                                        agree to our
                                        Terms of Use
                                        and
                                        Cookie Policy</label>
                                </div>

                            </div>



                            <button class="btn continue-bn"> Register </button>
                        </div>

                        <p class="text-center  mt-3"> Do not have an account?
                            <a data-bs-toggle="modal" class="regster-bn" data-bs-target="#loginModal"
                                data-bs-dismiss="modal"> Login
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- lost password -->

    <div class="modal fade login-div-modal" id="lostpsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div id="login-td-div" class="com-div-md">
                        <span class="text-center d-table m-auto user-icon"> <i class="fas fa-user-circle"></i> </span>
                        <h5 class="text-center mb-3"> Forget Your Password? </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="login-modal-pn">
                            <p> We'll email you a link to reset your password</p>
                            <div class="cm-select-login mt-3">

                                <div class="phone-div">

                                    <input type="email" class="form-control" placeholder="Enter Your Email "
                                        alt="pn">
                                </div>


                            </div>



                            <button class="btn continue-bn"> Send Me a password reset Link </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>





    <script src="{{ asset('assets_umum/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets_umum/js/jquery.min.js') }}"></script>

    <script src="{{ asset('assets_umum/js/custom.js') }}"></script>



    <script src="{{ asset('assets_umum/js/mixitup.min.js') }}"></script>

    <script>
        var mixer = mixitup('.gallery');
    </script>

    <script>
        $(document).ready(function() {

            $(window).scroll(function() {

                var height = $(window).scrollTop();

                if (height >= 100) {

                    $('.mn-head').addClass('fixed-menu');

                } else {

                    $('.mn-head').removeClass('fixed-menu');

                }

            });

        });
    </script>


@stack('scripts')

</body>

</html>
