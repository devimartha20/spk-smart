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
        @php
            $no = 1;
        @endphp
        @foreach ($kriteria as $kriteria)
        <div class="form-group">
            <label for="{{ $kriteria->nama_kriteria }}"><h4>{{ $kriteria->nama_kriteria }}</h4></label>
            <p class="card-secription">Seberapa penting {{ $kriteria->nama_kriteria }} terhadap jurusan yang dipilih bagi kamu?</p>
            <input class="progress" type="range" name="bobot{{ $kriteria->nama_kriteria }}" id="get" min="1" max="10" value="1" onchange="{{ $kriteria->nama_kriteria }}()" step="1" required>
            <input type="number" id="put" style="width:3rem;" value="1" readonly>
            <script>
                function (){
                var get = document.getElementById("get").value;
                document.getElementById("put").value = get;
            }
            </script>
        </div>
        @endforeach

        {{-- <div class="form-group">
            <label for="biaya"><h4>Tingkat Minat</h4></label>
            <p class="card-secription">Seberapa penting tingkat minat pribadi kamu terhadap jurusan yang dipilih?</p>
            <input class="progress" type="range" name="minat" id="get-minat" min="1" max="10" value="1" onchange="fetch_minat()" step="1" required>
            <input type="number" id="put-minat" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Biaya Kuliah</h4></label>
            <p class="card-secription">Seberapa penting biaya kuliah yang murah bagi kamu?</p>
            <input class="progress" type="range" name="biayaKuliah" id="get-biayaKuliah" min="1" max="10" value="1" onchange="fetch_biayaKuliah()" step="1" required>
            <input type="number" id="put-biayaKuliah" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Akreditasi Kampus</h4></label>
            <p class="card-secription">Seberapa penting akreditasi kampus bagi kamu?</p>
            <input class="progress" type="range" name="akreditasiKampus" id="get-akreditasiKampus" min="1" max="10" value="1" onchange="fetch_akreditasiKampus()" step="1" required>
            <input type="number" id="put-akreditasiKampus" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Akreditasi jurusan</h4></label>
            <p class="card-secription">Seberapa penting akreditasi jurusan bagi kamu?</p>
            <input class="progress" type="range" name="akreditasiJurusan" id="get-akreditasiJurusan" min="1" max="10" value="1" onchange="fetch_akreditasiJurusan()" step="1" required>
            <input type="number" id="put-akreditasiJurusan" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Prospek Kerja</h4></label>
            <p class="card-secription">Seberapa penting prospek kerja jurusan yang kamu pilih?</p>
            <input class="progress" type="range" name="prospekKerja" id="get-prospekKerja" min="1" max="10" value="1" onchange="fetch_prospekKerja()" step="1" required>
            <input type="number" id="put-prospekKerja" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Jenjang Pendidikan</h4></label>
            <p class="card-secription">Seberapa penting tingkat jenjang pendidikan dari jurusan yang kamu pilih?</p>
            <input class="progress" type="range" name="jenjangPendidikan" id="get-jenjangPendidikan" min="1" max="10" value="1" onchange="fetch_jenjangPendidikan()" step="1" required>
            <input type="number" id="put-jenjangPendidikan" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Tingkat Kesulitan Masuk</h4></label>
            <p class="card-secription">Seberapa penting kemudahan masuk bagi kamu?</p>
            <input class="progress" type="range" name="sulitMasuk" id="get-sulitMasuk" min="1" max="10" value="1" onchange="fetch_sulitMasuk()" step="1" required>
            <input type="number" id="put-sulitMasuk" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Tingkat Kesulitan lulus</h4></label>
            <p class="card-secription">Seberapa penting kemudahan lulus bagi kamu?</p>
            <input class="progress" type="range" name="sulitLulus" id="get-sulitLulus" min="1" max="10" value="1" onchange="fetch_sulitLulus()" step="1" required>
            <input type="number" id="put-sulitLulus" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Biaya Hidup</h4></label>
            <p class="card-secription">Seberapa penting biaya hidup yang murah bagi kamu?</p>
            <input class="progress" type="range" name="biayaHidup" id="get-biayaHidup" min="1" max="10" value="1" onchange="fetch_biayaHidup()" step="1" required>
            <input type="number" id="put-biayaHidup" style="width:3rem;" value="1" readonly>
        </div>
        <div class="form-group">
            <label for="biaya"><h4>Jumlah Peminat</h4></label>
            <p class="card-secription">Seberapa penting jumlah peminat jurusan yang sedikit bagi kamu?</p>
            <input class="progress" type="range" name="peminat" id="get-peminat" min="1" max="10" value="1" onchange="fetch_peminat()" step="1" required>
            <input type="number" id="put-peminat" style="width:3rem;" value="1" readonly>
        </div> --}}

      <button type="submit" class="btn btn-primary mr-2">Submit</button>
      <button class="btn btn-light">Cancel</button>
    </form>
  </div>
@endsection

@section('jsContent')
<script>


    function fetch1(){
        var getMinat = document.getElementById("get1").value;
        document.getElementById("put1").value = getMinat;
    }
    // function fetch_biayaKuliah(){
    //     var getBiayaKuliah = document.getElementById("get-biayaKuliah").value;
    //     document.getElementById("put-biayaKuliah").value = getBiayaKuliah;
    // }
    // function fetch_akreditasiKampus(){
    //     var getakreditasiKampus = document.getElementById("get-akreditasiKampus").value;
    //     document.getElementById("put-akreditasiKampus").value = getakreditasiKampus;
    // }
    // function fetch_akreditasiJurusan(){
    //     var getakreditasiJurusan = document.getElementById("get-akreditasiJurusan").value;
    //     document.getElementById("put-akreditasiJurusan").value = getakreditasiJurusan;
    // }
    // function fetch_prospekKerja(){
    //     var getprospekKerja = document.getElementById("get-prospekKerja").value;
    //     document.getElementById("put-prospekKerja").value = getprospekKerja;
    // }
    // function fetch_jenjangPendidikan(){
    //     var getjenjangPendidikan = document.getElementById("get-jenjangPendidikan").value;
    //     document.getElementById("put-jenjangPendidikan").value = getjenjangPendidikan;
    // }
    // function fetch_sulitMasuk(){
    //     var getsulitMasuk = document.getElementById("get-sulitMasuk").value;
    //     document.getElementById("put-sulitMasuk").value = getsulitMasuk;
    // }
    // function fetch_sulitLulus(){
    //     var getsulitLulus = document.getElementById("get-sulitLulus").value;
    //     document.getElementById("put-sulitLulus").value = getsulitLulus;
    // }
    // function fetch_biayaHidup(){
    //     var getbiayaHidup = document.getElementById("get-biayaHidup").value;
    //     document.getElementById("put-biayaHidup").value = getbiayaHidup;
    // }
    // function fetch_peminat(){
    //     var getpeminat = document.getElementById("get-peminat").value;
    //     document.getElementById("put-peminat").value = getpeminat;
    // }
</script>
@endsection
