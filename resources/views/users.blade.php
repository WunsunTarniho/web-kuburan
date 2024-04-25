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
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Created at</th>
                        <th scope="col" style="width: 90px" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucwords($user->level) }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="text-center text-nowrap">
                                <form action="/user/{{ $user->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge text-white p-1 bg-danger border border-none"
                                        onclick="return confirm('Yakin ingin hapus ?')">
                                        Delete
                                        {{-- <i class="bi bi-trash"></i> --}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection
