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



@endsection

@section('jsContent')
<script>

</script>
@endsection
