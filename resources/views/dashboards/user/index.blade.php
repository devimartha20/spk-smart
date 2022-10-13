@extends('layouts.userLayout.userLayout')

@section('content')
        {{-- case belum input bobot --}}
        @if ($bobot->isEmpty())
        <h2>Kamu belum mengisi pembobotan</h2>
        <hr>
            @include('dashboards.user.pagination.bobot-part')

        {{-- case sudah ada bobot belum ada alternatif --}}
        @elseif ($alternatif->isEmpty())
        <h2>Kamu belum menentukan alternatif</h2>
        <hr>
            @include('dashboards.user.pagination.alternatif-part')

        {{-- case bobot dan alternatif sudah ada tapi belum input nilai --}}
        @elseif($nilai->isEmpty())
        <h2>Kamu belum mengisi penilaian</h2>
        <hr>
         @include('dashboards.user.pagination.nilai-part')

        {{-- case sudah melakukan semua proses --}}
        @else
        <h2>Hasil Ranking Alternatif</h2>
        <hr>
            @include('dashboards.user.pagination.smart-part')
        @endif

@endsection


