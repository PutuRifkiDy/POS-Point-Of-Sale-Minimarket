@extends('layouts.auth')
@section('content')
    <div class="">

        <!-- /.login-logo -->
        <div class="login-box-body login-box tw-rounded-xl">
            <div class="login-logo justify-center items-center flex">
                <a href="{{url('/')}}">
                    <img src="{{asset('img/logoToko.png')}}" width="200px" height="200px">
                </a>
            </div>
            <h1 class="login-box-msg tw-text-4xl tw-text-[#f54242] tw-font-semibold">Kita Mart</h1>

            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group has-feedback @error('email') has-error @enderror">
                    <input type="email" name="email" class="form-control tw-text-2xl" placeholder="Email" required value="{{old('email')}}" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                        <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group has-feedback @error('password') has-error @enderror">
                    <input type="password" name="password" class="form-control tw-text-2xl" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                        <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck col-xs-0">
                            <label class="">
                                <input type="checkbox"> Remember Me 
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4 ">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
