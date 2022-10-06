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
<div class="card-body">
    <h4 class="card-title">Seberapa penting kriteria ini untuk kamu?</h4>
    <p class="card-description">
      Beri nilai dari 1-10 untuk memberikan penilaian seberapa penting kriteria ini untuk kamu
    </p>
    <hr><br>
    <form class="forms-sample">
        @foreach ($kriteria as $kriteria)
        <div class="form-group">
            <label for="{{ $kriteria->nama_kriteria }}"><h4>{{ $kriteria->nama_kriteria }}</h4></label>
            <p class="card-secription">Seberapa penting {{ $kriteria->nama_kriteria }} terhadap jurusan yang dipilih bagi kamu?</p>
            <input class="progress" type="range" name="{{ $kriteria->id }}bobot" id="get{{ $kriteria->id }}" min="1" max="10" value="1" onchange="bobot{{ $kriteria->id }}()" step="1" required>
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
@endsection

@section('jsContent')
<script>



</script>
@endsection
