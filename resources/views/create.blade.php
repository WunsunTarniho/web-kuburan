@extends('main.body')

@section('container')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <div>
            @error('status.*')
                <span class="text-danger small mx-1">
                    Kolom status ada yang kosong
                </span>
            @enderror
            <button class="btn btn-primary" data-toggle="modal" data-target="#detailModal">Tambah Kerabat</button>
        </div>
    </div>
    <div class="d-flex align-items-center my-3" style="min-height: 75vh">
        <form class="w-100" method="POST" action="/grave" enctype="multipart/form-data">
            <div class="row px-0 col-md-9 border rounded mx-auto bg-white" style="min-height:50vh">
                <div class="position-relative d-flex bg-secondary align-items-center justify-content-center p-0 col-lg-6"
                    style="min-height: 50vh">
                    <img class="position-absolute mw-100 mh-100 z-0" id="previewImage" src="" alt="">
                    <label for="image" class="btn btn-primary btn-image position-absolute z-1 my-3"
                        style="bottom: 0">Tambah Foto</label>
                    <input class="d-none" type="file" id="image" name="image" onchange="uploadImage()">
                </div>
                <div class="col-lg-6 px-4 py-5">
                    <h4 class="mb-4">{{ $title }}</h4>
                    @csrf
                    <div class="form-group">
                        <input type="nama" class="form-control" id="nama" name="nama" placeholder="Nama"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <small class="text-danger mx-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="blok" name="blok" placeholder="Blok"
                            value="{{ old('blok') }}">
                        @error('blok')
                            <small class="text-danger mx-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-12 mb-1">Tanggal Lahir (Optional)</label>
                        <div class="col-4">
                            <select name="tgl_lahir[]" id="bln_lahir" class="form-control">
                                <option value='' selected>月</option>
                                @foreach ($months as $month)
                                    @if (old('tgl_lahir.0') == $month)
                                        <option value="{{ $month }}" selected>{{ $month }}</option>
                                    @endif
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="tgl_lahir[]" id="tgl_lahir" class="form-control">
                                <option value='' selected>日</option>
                                @foreach ($days as $day)
                                    @if (old('tgl_lahir.1') == $day)
                                        <option value="{{ $day }}" selected>{{ $day }}</option>
                                    @endif
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="thn_lahir" name="tgl_lahir[]" placeholder="年"
                                value="{{ old('tgl_lahir.2') }}">
                        </div>
                        @error('tgl_lahir.*')
                            <small class="col-12 text-danger mx-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-12 mb-1">Tanggal Wafat</label>
                        <div class="col-4">
                            <select name="tgl_wafat[]" id="bln_wafat" class="form-control">
                                <option value='' selected>月</option>
                                @foreach ($months as $month)
                                    @if (old('tgl_wafat.0') == $month)
                                        <option value="{{ $month }}" selected>{{ $month }}</option>
                                    @endif
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="tgl_wafat[]" id="tgl_wafat" class="form-control">
                                <option value='' selected>日</option>
                                @foreach ($days as $day)
                                    @if (old('tgl_wafat.1') == $day)
                                        <option value="{{ $day }}" selected>{{ $day }}</option>
                                    @endif
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="thn_wafat" name="tgl_wafat[]" placeholder="年"
                                value="{{ old('tgl_wafat.2') }}">
                        </div>
                        @error('tgl_wafat.*')
                            <small class="col-12 text-danger mx-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-image btn-primary btn-user btn-block mt-2">
                        Tambahkan
                    </button>
                </div>
            </div>
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between align-items-center">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kerabat</h5>
                            <button class="btn btn-primary" id='add-field' type="button">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="modal-body" id='modal-kerabat'>
                            @if ($errors->any())
                                @if (count(old('nama_kerabat')) !== 0)
                                    @foreach (old('nama_kerabat') as $index => $kerabat)
                                        <div class="form-group row col-11 mb-2 position-relative field-kerabat">
                                            <div class="col-md-6 col-12 mb-1">
                                                <input class="form-control" type="text" placeholder="Nama"
                                                    name="nama_kerabat[]" value="{{ $kerabat }}">
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <input class="form-control" type="text" placeholder="Status"
                                                    name="status[]" value="{{ request()->old('status')[$index] }}">
                                                @error('status.*')
                                                    <div class="text-danger mx-1 small error-message">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-transparent position-absolute delete-field" type="button" onclick="deleteField(this)"
                                                style="right: -20px; transform: translateY(-50%); top: 50%">
                                                <i class="bi bi-x-circle text-danger"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    @include('component.kerabatField')
                                @endif
                            @else
                                @include('component.kerabatField')
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="btn-cancel" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="/js/image.js"></script>
    <script src="/js/field.js"></script>
@endsection
