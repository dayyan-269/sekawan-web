@extends('template')
@section('title', 'Login Page')
@section('content')
    <div class="bg-primary mx-auto background py-5 d-flex flex-column align-items-center justify-content-center overflow-hidden">
        <div class="card w-50 w-lg-25 my-4">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <p class="card-text">Please insert your credential</p>
                <hr>
                <form action="{{ route('auth.login') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-2">Submit</button>
                </form>
            </div>
        </div>
        <p class="mt-5 text-white">Sekawan Web Test</p>
    </div>
@endsection