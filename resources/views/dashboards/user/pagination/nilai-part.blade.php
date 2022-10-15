@extends('layouts.userLayout.userLayout')
@section('cssContent')

@endsection
@section('content')
<h2>Kamu belum mengisi nilai</h2>
        <hr>
<table>
    <thead>
        <tr>
            <th>Alternatif</th>
        @foreach ($kriteria as $kriteria)
            <th>{{ $kriteria->nama_kriteria }}</th>
        @endforeach
        </tr>
    </thead>
    <tbody>
        <form action="{{ route('user.smart.store') }}" method="post">
            @csrf
                @foreach ($alternatif as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @for ($k = 0; $k < $jKriteria; $k++)
                            <td>
                                <input type="number" name="{{ $alternatif->id }}{{ $k }}nilai_awal" value="1" min="1" max="10" required>
                            </td>
                        @endfor
                            <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">
                    </tr>
                @endforeach
        </tbody>
</table>
            <button type="submit">Simpan</button>
        </form>
<hr>
<p>Tambah Alternatif</p>
<hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAlternatif">Tambah</button>



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
