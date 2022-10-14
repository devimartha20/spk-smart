@extends('layouts.userLayout.userLayout')
@section('cssContent')

@endsection

@section('content')
    {{-- form input nilai awal --}}
    @if ($nilai_smart->isEmpty())

    <table>

        <thead>
            <tr>
            @foreach ($kriteria as $kriteria)
                <th>{{ $kriteria->nama_kriteria }}</th>
            </tr>
        </thead>
                <form action="">
                    {{-- @foreach ($alternatif as $alternatif)



                    @endforeach --}}
                </form>

        @endforeach
    </table>

    @else

    @endif
@endsection

@section('jsContent')

@endsection
