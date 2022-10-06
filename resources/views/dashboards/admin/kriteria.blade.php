@extends('layouts.adminLayout.adminLayout')
@section('cssContent')

@endsection

@section('content')
<div class="card-body">
    <h4 class="card-title">Tabel Kriteria</h4>
    <p class="card-description">

    </p>
    <a href="/admin/kriteria/create"><button type="button" class="btn btn-success btn-rounded btn-fw">Tambah</button></a>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>
              No
            </th>
            <th>
              Kriteria
            </th>
            <th>
              Jens Kriteria
            </th>
            <th>
              Action
            </th>
          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($kriteria as $kriteria)
                <tr>
                    <td class="py-1">
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $kriteria->nama_kriteria }}
                    </td>
                    <td>
                        {{ $kriteria->jenis_kriteria }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('jsContent')

@endsection
