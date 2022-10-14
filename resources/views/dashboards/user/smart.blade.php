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
            <th>
                Action
            </th>
            </tr>
            @php
                reset($kriteria);
            @endphp
        </thead>
        <tbody>
            @foreach ($alternatif as $alternatif)
                <tr>
                    <td>{{ $alternatif->nama_alternatif }}</td>
                    @for ($k = 0; $k < $jKriteria; $k++)
                    <form action="{{ route('user.smart.store') }}" method="post">
                        @csrf
                        <td>
                            <input type="number" name="{{ $k }}nilai_awal" value="1" min="1" max="10" required>
                        </td>
                    @endfor
                        <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">
                    <td>
                        <button type="submit"> Simpan </button>
                    </td>
                </form>
                </tr>
            @endforeach


        </tbody>

    </table>

    @else

    @endif
@endsection

@section('jsContent')

@endsection
