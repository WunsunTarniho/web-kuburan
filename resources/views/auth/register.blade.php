@extends('main.body')

@section('container')
    <div class="col-xl-5 my-5 col-lg-6 col-md-8 mx-auto d-flex align-items-center justify-content-center" style="min-height: 70vh !important">

        <div class="card o-hidden border-0 shadow-lg w-100">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="px-5 py-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                    </div>
                    <form method="POST" action="/user">
                        @csrf
                        <div class="form-group">
                            <input type="name" class="form-control" id="name" name="name"
                                placeholder="Username" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger mx-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email Address..." value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger mx-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control px-2" name="level" id="level">
                                <option value="admin" checked>Administrator</option>
                                <option value="petugas">Petugas</option>
                            </select>
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
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember
                                    Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Buat Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
