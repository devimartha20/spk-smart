@extends('layouts.userLayout.userLayout')
@section('content')

@endsection
@section('content')
<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>Hasil Akhir</th>
            <th>Ranking</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ranking as $ranking)
            <tr>
                <td>{{ $ranking->Alternatif->nama_alternatif }}</td>
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
                        <td>{{ $nilai->Kriteria->nama_kriteria }}</td>
                        <td>{{ $nilai->nilai_utility }}</td>
                        <td>{{ $nilai->nilai_awal }}</td>
                        <td>{{ $nilai->nilai_akhir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection
@section('jsContent')

@endsection
