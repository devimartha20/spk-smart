@extends('layouts.userLayout.userLayout')

@section('cssContent')

@endsection

@section('content')
    <div class="card-body">
        <h2>Kamu belum mengisi Alternatif</h2>
        <hr>
        @if ($alternatif->isEmpty())
    <p> Tidak Ada Alternatif </p> <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAlternatif">Tambah</button>
@else
<div class="card-body">
    <h4 class="card-title">Tabel Alternatif</h4>
    <p class="card-description">

    </p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAlternatif">Tambah</button>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Jurusan</th>
            <th>Kampus</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($alternatif as $alternatif)
                <tr>
                    <td class="py-1">{{ $no++ }}</td>
                    <td>{{ $alternatif->nama_alternatif }}</td>
                    <td>{{ $alternatif->nama_kampus }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editalternatif-{{ $alternatif->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletealternatif-{{ $alternatif->id }}">Hapus</button>
                    </td>
                </tr>

                  {{-- Form Edit alternatif --}}

                    <div class="modal fade" id="editalternatif-{{ $alternatif->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit alternatif</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('user.alternatif.update', $alternatif->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="nama-alternatif" class="col-form-label">Nama Jurusan:</label>
                                    <input type="text" class="form-control" id="nama-alternatif" name="nama_alternatif" placeholder="Nama Jurusan" value="{{ $alternatif->nama_alternatif }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama-kampus" class="col-form-label">Nama Kampus:</label>
                                    <input type="text" class="form-control" id="nama-kampus" name="nama_kampus" placeholder="Nama Kampus" value="{{ $alternatif->nama_kampus }}" required>
                                    </div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>

                      {{-- Form Delete alternatif --}}
                      <div class="modal modal-danger fade" id="deletealternatif-{{ $alternatif->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus alternatif</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('user.alternatif.delete', $alternatif->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="text-center">Apakah Anda yakin untuk menghapus alternatif jurusan <b>{{ $alternatif->nama_alternatif }}</b> di kampus <b>{{ $alternatif->nama_kampus }}</b>?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus alternatif</button>
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
{{-- Form Tambah Alternatif --}}
<div class="modal fade" id="tambahAlternatif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Alternatif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('user.alternatif.store') }}">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Pilihan Jurusan :</label>
              <input type="text" class="form-control" id="nama-alternatif" name="nama_alternatif" placeholder="Nama Jurusan" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Pilihan Kampus :</label>
                <input type="text" class="form-control" id="nama-kampus" name="nama_kampus" placeholder="Nama Kampus" required>
              </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
