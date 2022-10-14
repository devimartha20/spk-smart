<?php

namespace App\Http\Controllers;

use App\Models\m_nilai_smart;
use App\Models\m_alternatif;
use App\Models\m_bobot;
use App\Models\m_kriteria;
use App\Models\m_ranking;
use Illuminate\Http\Request;

class c_nilai_smart extends Controller
{
    public function __construct()
    {
        $this->m_nilai_smart = new m_nilai_smart();
        $this->m_alternatif = new m_alternatif();
        $this->m_kriteria = new m_kriteria();
        $this->m_bobot = new m_bobot();
        $this->m_ranking = new m_ranking();
    }

    public function index()
    {
        $data= [
            'nilai_smart' => $this->m_nilai_smart->allData(),
            'kriteria' => $this->m_kriteria->allData(),
            'alternatif' => $this->m_alternatif->allData(),
            'jKriteria' => $this->m_kriteria->jumlahData(),
        ];

        return view('dashboards.user.smart', $data );
    }

    // public function create($id)
    // {
    //     $alternatif = [
    //         'alternatif' => $this->m_alternatif->detailData($id),
    //     ];
    //     return view('smart.v_create', $alternatif);
    // }

    public function store(Request $request)
    {
        $alternatif = $this->m_alternatif->allData();
        foreach ($alternatif as $data2) {
        $kriteria = $this->m_kriteria->allData();
        $i = 1;
        foreach ($kriteria as $data1) {
            $nama_alternatif = $data2->nama_alternatif;
            $data = [
                'm_alternative_id' => $request->alternatif_id,
                'm_criteria_id' => $data1->id,
                'nilai_awal' => $request->{$nama_alternatif.$i."nilai_awal"},
            ];
            $this->m_nilai_smart->addData($data);
            $i = $i + 1;
        }
        }
        return redirect()->route('smart.utylity');
    }

    public function edit($id)
    {
        $nilai_smart = [
            'nilai_smart' => $this->m_nilai_smart->detailData($id),
        ];
        return view('smart.v_edit', $nilai_smart);
    }

    public function update(Request $request, $id)
    {
        $alternatif = $this->m_alternatif->allData();
        foreach ($alternatif as $data2) {
        $kriteria = $this->m_kriteria->allData();
        $i = 1;
        foreach ($kriteria as $data1) {
            $id = $data2->id;
            $m_kriteria_id = $data1->id;
            $data = [
                'nilai_awal' => ${"request->".$data1->nama_alternatif.$i."nilai_awal"},
            ];
            $this->m_nilai_smart->editData($id,  $m_kriteria_id, $data);
            $i = $i + 1;
        }
        }
        return redirect()->route('smart.utylity');
    }

    public function utility()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $id = $nilai->m_alternative_id;
            $criteria_id = $nilai->criteria_id;
            $a = $nilai->nilai_awal;
            $max = $this->m_nilai_smart->dataMax($criteria_id);
            $min = $this->m_nilai_smart->dataMin($criteria_id);
            if ($nilai->criteria_id == "Benefit")
            {
                $nilai_utility = ($a-$min)/($max-$min);
            } else
            {
                $nilai_utility = ($max-$a)/($max-$min);
            }
            $data = [
                'nilai_utility' => $nilai_utility,
            ];
            $this->m_nilai_smart->update($id, $criteria_id, $data);
        }
        return redirect()->route('smart.akhir');
    }

    public function akhir()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $id = $nilai->m_alternative_id;
            $criteria_id = $nilai->m_criteria_id;
            $a = $nilai->nilai_utility;
            $bobot = $this->m_bobot->bobotCriteria($criteria_id);
            $nilai_akhir = $a * $bobot->bobot;
            $data = [
                'nilai_akhir' => $nilai_akhir,
            ];
            $this->m_nilai_smart->update($id, $criteria_id, $data);
        }
        return redirect()->route('smart.create');
    }

    
    public function create()
    {
        $alternative = $this->m_alternatif->allData();

        foreach ($alternative as $data1)
        {
            $cek = $this->m_ranking->cekData();
            if ($cek->hasil_akhir <> null) {
                $id = $data1->id;
                $hasil_akhir = $this->m_nilai_smart->hasilData($alternative_id);
                $data = [
                    'hasil_akhir' => $hasil_akhir,
                ];
                $this->m_ranking->updateData1($id, $$data);
            } else {
                $alternative_id = $data1->id;
                $hasil_akhir = $this->m_nilai_smart->hasilData($alternative_id);
                $data = [
                    'hasil_akhir' => $hasil_akhir,
                    'm_alternative_id' => $alternative_id,
                ];
                $this->m_ranking->addData($data);
            }
        }
        return redirect()->route('store.rank');

    }

    public function rank()
    {
        $akhir = $this->m_ranking->sortDesc();
        $ranking = 0;
        foreach ($akhir as $hakhir)
        {
            $id = $akhir->m_alternative_id;
            $ranking = $ranking + 1;
            $data = [
                'rangking' => $ranking,
            ];
            $this->m_ranking->updateData($id, $data);
        }
        return redirect()->route('smart.index');
    }

}
