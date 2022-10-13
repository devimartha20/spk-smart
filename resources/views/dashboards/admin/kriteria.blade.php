@extends('layouts.adminLayout.adminLayout')
@section('cssContent')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('content')
@if ($kriteria->isEmpty())
    <p> Tidak Ada Kriteria </p> <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKriteria">Tambah</button>
@else
<div class="card-body">
    <h4 class="card-title">Tabel Kriteria</h4>
    <p class="card-description">

    </p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKriteria">Tambah</button>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Jenis Kriteria</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($kriteria as $kriteria)
                <tr>
                    <td class="py-1">{{ $no++ }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td> {{ $kriteria->jenis_kriteria }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editKriteria-{{ $kriteria->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteKriteria-{{ $kriteria->id }}">Hapus</button>
                    </td>
                </tr>

                  {{-- Form Edit Kriteria --}}

                    <div class="modal fade" id="editKriteria-{{ $kriteria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('admin.kriteria.update', $kriteria->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Kriteria:</label>
                                <input type="text" class="form-control" id="nama-kriteria" name="nama_kriteria" placeholder="Nama Kriteria" value="{{ $kriteria->nama_kriteria }}" required>
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Jenis Kriteria:</label>
                                <select id="jenis-kriteria" name="jenis_kriteria" class="form-control" required>
                                    <option @if ($kriteria->jenis_kriteria == "benefit") selected @endif value="benefit">benefit</option>
                                    <option @if ($kriteria->jenis_kriteria == "cost") selected @endif value="cost">cost</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>

                      {{-- Form Delete Kriteria --}}
                      <div class="modal modal-danger fade" id="deleteKriteria-{{ $kriteria->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kriteria</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('admin.kriteria.delete', $kriteria->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="text-center">Apakah Anda yakin untuk menghapus kriteria {{ $kriteria->nama_kriteria }}?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus Kriteria</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

            @endforeach
        </tbody>
      </table>
    </div>
  </div>


@endif


{{-- Form Tambah Kriteria --}}
<div class="modal fade" id="tambahKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('admin.kriteria.store') }}">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Kriteria:</label>
              <input type="text" class="form-control" id="nama-kriteria" name="nama_kriteria" placeholder="Nama Kriteria" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Jenis Kriteria:</label>
              <select id="jenis-kriteria" name="jenis_kriteria" class="form-control" required>
                <option value="benefit">benefit</option>
                <option value="cost">cost</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>



@endsection

@section('jsContent')



@endsection
