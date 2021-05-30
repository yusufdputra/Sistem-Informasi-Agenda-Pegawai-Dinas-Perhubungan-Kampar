@include('layouts.header')

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.html" class="logo"><span>Sistem <span>Informasi</span></span></a>
        <h5 class="text-muted m-t-0 font-600"> Agenda Harian Dinas Perhubungan Kabupaten Kampar </h5>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
                <img src="{{asset('adminto/images/brand/kampar.png')}}" height="100px" alt="">
                <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
            </div>
            <div class="p-20">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <div class="col-xs-12">

                            <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">


                            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <!-- <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            @endif
                        </div>
                    </div> -->


                </form>


            </div>
        </div>


    </div>
    <!-- end wrapper page -->



    @include('layouts.footer')