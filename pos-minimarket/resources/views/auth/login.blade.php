@extends('layouts.auth')
@section('login')
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo justify-center items-center flex">
                <a href="{{url('/')}}">
                    <img src="{{asset('img/logoToko.png')}}" width="200px" height="200px">
                </a>
            </div>
            <h1 class="login-box-msg tw-text-3xl text-red">Kita Mart</h1>

            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group has-feedback @error('email') has-error @enderror">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{old('email')}}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                        <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group has-feedback @error('password') has-error @enderror">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
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
