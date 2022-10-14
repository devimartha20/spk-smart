@extends('layouts.userLayout.userLayout')
@section('cssContent')

@endsection

@section('content')
@if ($nilai_smart->isEmpty())
 {{-- form input nilai awal --}}
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
@else
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


@endif


@endsection

@section('jsContent')

@endsection
