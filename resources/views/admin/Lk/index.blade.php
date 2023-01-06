@extends('admin.layout')

@section('title')
Dokumentasi Latihan Kader
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('latihan-kader.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="">Nama Dokument</label>
                    <input type="text" class="form-control" name="nama">
                    <label for="">File</label>
                    <input type="file" class="form-control" name="dok">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>
    </div>
    <div class="col-md-5">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari dokumen . . ." aria-label="Recipient's username"
                aria-describedby="button-addon2">
            <button class="btn btn-success" type="button" id="button-addon2">Cari</button>
        </div>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">Data Tidak Ada</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
