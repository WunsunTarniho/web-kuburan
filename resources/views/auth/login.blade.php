@include('main.head')

<div class="container">

    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-xl-4 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="px-md-5 py-5 px-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                        </div>
                        <form method="POST" action="/login">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email Address..." value={{ old('email') }}>
                                @error('email')
                                    <small class="text-danger mx-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-danger mx-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember
                                        Me</label>
                                </div>
                            </div>
                            <p>Belum punya akun ? <a href="/register">Register</a></p>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                            <a href="/auth/google" type="button" class="btn btn-danger btn-user btn-block">
                                Login with Google
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('main.footer')
