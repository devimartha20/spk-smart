@extends('layouts.userLayout.userLayout')
@section('cssContent')

@endsection
@section('content')
<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>Kampus</th>
            <th>Hasil Akhir</th>
            <th>Ranking</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ranking as $ranking)
            <tr>
                <td>{{ $ranking->Alternatif->nama_alternatif }}</td>
                <td>{{ $ranking->Alternatif->nama_kampus }}</td>
                <td>{{ $ranking->hasil_akhir }}</td>
                <td>{{ $ranking->ranking }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>
<h3>Rincian Nilai</h3>
<hr>
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Kampus</th>
                    <th>Kriteria</th>
                    <th>Nilai Awal</th>
                    <th>Nilai Utility</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai_smart as $nilai)
                    <tr>
                        <td>{{ $nilai->Alternatif->nama_alternatif }}</td>
                        <td>{{ $nilai->Alternatif->nama_kampus }}</td>
                        <td>{{ $nilai->Kriteria->nama_kriteria }}</td>

                        <td>{{ $nilai->nilai_awal }} <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editnilai-{{ $nilai->m_alternatif_id }}{{ $nilai->m_kriteria_id }}">Edit</button></td>

                        {{-- form edit --}}
                        <div class="modal fade" id="editnilai-{{ $nilai->m_alternatif_id }}{{ $nilai->m_kriteria_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Nilai Awal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                </div>
                                <div class="modal-body">
                                <p>Ubah nilai kriteria {{ $nilai->Kriteria->nama_kriteria }} untuk jurusan {{ $nilai->Alternatif->nama_alternatif }}, kampus {{ $nilai->Alternatif->nama_kampus }}</p>
                                <form method="POST" action="{{ route('user.smart.update', $nilai->m_alternatif_id) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="nama-alternatif" class="col-form-label">Nilai Awal:</label>
                                        <input type="number" class="form-control" id="nama-alternatif" name="{{ $nilai->m_alternatif_id }}{{ $nilai->m_kriteria_id }}nilai_awal" value="{{ $nilai->nilai_awal }}" min="1" max="10" required>
                                        <input type="hidden" name="kriteria_id" value="{{ $nilai->m_kriteria_id }}">
                                    </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>



                        <td>{{ $nilai->nilai_utility }}</td>
                        <td>{{ $nilai->nilai_akhir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection
@section('jsContent')

@endsection
