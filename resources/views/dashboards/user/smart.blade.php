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
                                <input type="number" name="{{ $alternatif->nama_alternatif }}{{ $k }}nilai_awal" value="1" min="1" max="10" required>
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
                    <th>Kriteria</th>
                    <th>Nilai Utility</th>
                    <th>Nilai Akhir</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai_smart as $nilai)
                    <tr>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endif


@endsection

@section('jsContent')

@endsection
