@foreach ($relatives as $relative)
    <div class="form-group row col-11 mb-2 position-relative field-kerabat">
        <input type="hidden" name="id_kerabat[]" value="{{ $relative->id }}">
        <div class="col-md-6 col-12 mb-1">
            <input class="form-control" type="text" placeholder="Nama" name="nama_kerabat[]"
                value="{{ $relative->nama_kerabat }}">
        </div>
        <div class="col-md-6 col-12 mb-1">
            <input class="form-control" type="text" placeholder="Status" name="status[]"
                value="{{ $relative->status }}">
        </div>
        <button type="button" class="btn btn-transparent position-absolute delete-field" onclick="deleteField(this)"
            style="right: -20px; transform: translateY(-50%); top: 50%">
            <i class="bi bi-x-circle text-danger"></i>
        </button>
    </div>
@endforeach
