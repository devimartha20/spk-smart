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
@endsection
@section('jsContent')

@endsection
