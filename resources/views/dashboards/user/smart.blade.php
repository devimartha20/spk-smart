@extends('layouts.userLayout.userLayout')
@section('cssContent')

@endsection

@section('content')
    {{-- form input nilai awal --}}
    @if ($nilai_smart->isEmpty())

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
                @foreach ($alternatif as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach ($kriteria as $krtieria)
                            <td>input nilai</td>
                        @endforeach
                    </tr>
                @endforeach
        </tbody>

    </table>

    @else

    @endif
@endsection

@section('jsContent')

@endsection
