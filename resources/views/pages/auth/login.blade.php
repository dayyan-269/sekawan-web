@extends('template')
@section('title', 'Login Page')
@section('content')
    <div class="bg-primary mx-auto h-100 py-5 d-flex flex-column align-items-center overflow-hidden">
        <div class="card w-25 my-4">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <p class="card-text">Please insert your credential</p>
                <hr>
                @method('POST')
                <form action="/insert" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-2">Submit</button>
                </form>
            </div>
        </div>
        <p class="mt-5 text-white">Sekawan Web Test</p>
    </div>
@endsection