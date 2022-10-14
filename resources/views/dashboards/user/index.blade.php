{{-- case belum input bobot --}}
        @if ($bobot->isEmpty())
            @include('dashboards.user.pagination.bobot-part')

        {{-- case sudah ada bobot belum ada alternatif --}}
        @elseif ($alternatif->isEmpty())
            @include('dashboards.user.pagination.alternatif-part')

        {{-- case bobot dan alternatif sudah ada tapi belum input nilai --}}
        @elseif($nilai->isEmpty())
         @include('dashboards.user.pagination.nilai-part')

        {{-- case sudah melakukan semua proses --}}
        @else
            @include('dashboards.user.pagination.smart-part')
        @endif




