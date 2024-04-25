@extends('main.body')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="row">
        <div class="table-responsive small col-lg-8">
            <table class="table table-striped table-sm text-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Blok</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Tanggal Wafat</th>
                        <th scope="col" style="width: 90px" class="text-center">Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($graves as $grave)
                        <tr>
                            <td class="">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $grave->nama }}</td>
                            <td>{{ $grave->blok }}</td>
                            <td>{{ $grave->tgl_lahir ?? ' - ' }}</td>
                            <td>{{ $grave->tgl_wafat }}</td>
                            <td class="text-center text-nowrap">
                                @if ($tools)
                                    <a href="/grave/{{ $grave->slug }}" class="badge text-white p-1 me-1 bg-success">
                                        Detail
                                        {{-- <i class="bi bi-eye"></i> --}}
                                    </a>
                                    @can('admin-petugas')
                                        <a href="/grave/{{ $grave->id }}/edit" class="badge text-white p-1 me-1 bg-warning">
                                            Edit
                                            {{-- <i class="bi bi-pencil"></i> --}}
                                        </a>
                                        <form action="/grave/{{ $grave->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge text-white p-1 bg-danger border border-none"
                                                onclick="return confirm('Yakin ingin hapus ?')">
                                                Delete
                                                {{-- <i class="bi bi-trash"></i> --}}
                                            </button>
                                        </form>
                                    @endcan
                                @else
                                    <form action="/trash/" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="trash_id" value="{{ $grave->id }}">
                                        <button class="badge text-white p-1 bg-warning border border-none"
                                            onclick="return confirm('Yakin ingin dikembalikan ?')">
                                            <i class="bi bi-arrow-clockwise"></i>
                                            Restore
                                        </button>
                                    </form>
                                    <form action="/trash/{{ $grave->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge text-white p-1 bg-danger border border-none"
                                            onclick="return confirm('Yakin ingin dihapus secara permanen ?')">
                                            <i class="bi bi-trash"></i>
                                            Delete Permanently
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $graves->links() }}
    </div>
@endsection
