@extends('layouts.userLayout.userLayout')

@section('cssContent')
<style>
.progress {
  background: linear-gradient(to right, #82CFD0 0%, #82CFD0 40%, #fff 40%, #fff 100%);
  border: solid 2px #82CFD0;
  border-radius: 8px;
  height: 7px;
  width: 400px;
  outline: none;
  transition: background 450ms ease-in;

}

.progress::-webkit-slider-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #434343;
}

</style>

@endsection

@section('content')
@if ($bobot->isEmpty())
<div class="card-body">
    <h4 class="card-title">Seberapa penting kriteria ini untuk kamu?</h4>
    <p class="card-description">
      Beri nilai dari 1-10 untuk memberikan penilaian seberapa penting kriteria ini untuk kamu
    </p>
    <hr><br>
    <form class="forms-sample" action="{{ route('user.bobot.store') }}" method="POST">
        @csrf
        @foreach ($kriteria as $kriteria)
        <div class="form-group">
            <label for="{{ $kriteria->nama_kriteria }}"><h4>{{ $kriteria->nama_kriteria }}</h4></label>
            <p class="card-secription">Seberapa penting {{ $kriteria->nama_kriteria }} terhadap jurusan yang dipilih bagi kamu?</p>
            <input class="progress" type="range" name="{{ $kriteria->id }}point" id="get{{ $kriteria->id }}" min="1" max="10" value="1" onchange="bobot{{ $kriteria->id }}()" step="1" required>
            <input type="hidden" name="{{ $kriteria->id }}kriteria">

            <input type="number" id="put{{ $kriteria->id }}" style="width:3rem;" value="1" readonly>
            <script>
                function bobot{{ $kriteria->id }}(){
                var get = document.getElementById("get{{ $kriteria->id }}").value;
                document.getElementById("put{{ $kriteria->id }}").value = get;
            }
            </script>
        </div>
        @endforeach

      <button type="submit" class="btn btn-primary mr-2">Submit</button>
      <button class="btn btn-light">Cancel</button>
    </form>
  </div>
@else
    <div class="div table-responsive">
        <table class="div table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Point</th>
                    <th>Bobot</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($bobot as $bobot)
                    <tr>
                        <td class="py-1">{{ $no++ }}</td>
                         <td>{{ $bobot->Kriteria->nama_kriteria }}</td>
                        <td>{{ $bobot->point }}</td>
                        <td>{{ $bobot->bobot }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editbobot-{{ $bobot->id }}">Edit</button>
                        </td>
                    </tr>

                    {{-- form edit --}}
                    <div class="modal fade" id="editbobot-{{ $bobot->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Bobot</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('user.bobot.update', $bobot->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="{{ $bobot->Kriteria->id }}"><h4>{{ $bobot->Kriteria->nama_kriteria }}</h4></label>
                                    <p class="card-secription">Seberapa penting {{ $bobot->Kriteria->nama_kriteria }} terhadap jurusan yang dipilih bagi kamu?</p>
                                    <input class="progress" type="range" name="point" id="get{{ $bobot->Kriteria->id }}" min="1" max="10" value="1" onchange="bobot{{ $bobot->Kriteria->id }}()" step="1" required>
                                    <input type="hidden" name="{{ $bobot->Kriteria->id }}kriteria">

                                    <input type="number" id="put{{ $bobot->Kriteria->id }}" style="width:3rem;" value="1" readonly>
                                    <script>
                                        function bobot{{ $bobot->Kriteria->id }}(){
                                        var get = document.getElementById("get{{ $bobot->Kriteria->id }}").value;
                                        document.getElementById("put{{ $bobot->Kriteria->id }}").value = get;
                                    }
                                    </script>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection

@section('jsContent')
<script>



</script>
@endsection
