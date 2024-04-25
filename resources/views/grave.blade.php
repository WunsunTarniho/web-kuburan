@extends('main.body')

@section('container')
    <div class="d-flex align-items-center my-3" style="min-height: 80vh">
        <div class="row px-0 col-md-9 border rounded mx-auto bg-white" style="min-height: 60vh">
            <div class="position-relative d-flex bg-secondary align-items-center justify-content-center p-0 col-lg-6"
                style="min-height: 40vh">
                <img class="position-absolute mw-100 mh-100 z-0" src="{{ asset('storage/' . $grave->image) }}" alt="">
            </div>
            <div class="col-lg-6 px-4 py-5 text-dark">
                <h4 class="mb-4">Blok {{ $grave->blok }}</h4>
                <div class="row mb-2">
                    <span class="col-6">Nama</span>
                    <span class="col-6">: {{ $grave->nama }}</span>
                </div>
                <div class="row mb-2">
                    <span class="col-6">Blok</span>
                    <span class="col-6">: {{ $grave->blok }}</span>
                </div>
                <div class="row mb-2">
                    <span class="col-6">Tanggal Lahir</span>
                    <span class="col-6">: {{ $grave->tgl_lahir ?? ' - ' }}</span>
                </div>
                <div class="row mb-2">
                    <span class="col-6">Tanggal Wafat</span>
                    <span class="col-6">: {{ $grave->tgl_wafat }}</span>
                </div>
                <button class="btn btn-primary mt-5 mb-2" data-toggle="modal" data-target="#detailModal">Lihat Kerabat</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Kerabat</h5>
                </div>
                <div class="modal-body" id='modal-kerabat'>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm text-dark">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Kerabat</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($relatives as $relative)
                                    <tr>
                                        <td class="">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $relative->nama_kerabat }}</td>
                                        <td>{{ $relative->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
