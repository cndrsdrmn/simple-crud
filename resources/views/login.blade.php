@extends('layout')

@section('content')
    <div class="container" style="height: 100vh;">
        <div class="align-items-center h-100 justify-content-center row">
            <div class="card col-6 p-0">
                <div class="card-header">
                    <h3 class="card-title text-center">Form Login</h3>
                </div>
                <form autocomplete="off" method="POST" action="{{ route('do.login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" id="email" placeholder="{{ __('Type your email address here...') }}" value="{{ old('email') }}">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('Type your password here...') }}">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-primary col">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
