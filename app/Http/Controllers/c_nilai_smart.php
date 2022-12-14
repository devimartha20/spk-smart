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
            'ranking' => $this->m_ranking->allData(),
            'bobot' => $this->m_bobot->allData(),
            'kosong' => $this->m_nilai_smart->datakosong(),
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
        $i = 0;
        foreach ($kriteria as $data1) {
            $id = $data2->id;
            $data = [
                'm_alternatif_id' => $id,
                'm_kriteria_id' => $data1->id,
                'nilai_awal' => $request->{$id.$i."nilai_awal"},
            ];
            $this->m_nilai_smart->addData($data);
            $i = $i + 1;
        }
        }
        return redirect('/user/utility/');
    }

    public function databaru(Request $request)
    {
        $kosong =  $this->m_nilai_smart->datakosong();
        
        foreach ($kosong as $data2) {
            $kriteria = $this->m_kriteria->allData();
            $i = 0;
        foreach ($kriteria as $data1) {
            $id = $data2->id;
            $data = [
                'm_alternatif_id' => $id,
                'm_kriteria_id' => $data1->id,
                'nilai_awal' => $request->{$id.$i."nilai_awal"},
            ];
            $this->m_nilai_smart->addData($data);
            $i = $i + 1;
        }
        }
        return redirect('/user/utility/');
    }

    public function edit($id)
    {
        $nilai_smart = [
            'nilai_smart' => $this->m_nilai_smart->detailData($id),
        ];
        return view('smart.v_edit', $nilai_smart);
    }

    public function update(Request $request, $m_alternatif_id)
    {
        // $alternatif = $this->m_alternatif->allData();
        // foreach ($alternatif as $data2) {
        // $kriteria = $this->m_kriteria->allData();
        // $i = 0;
        // foreach ($kriteria as $data1) {
        //     $id = $data2->id;
        //     $m_kriteria_id = $data1->id;
        //     $data = [
        //         'nilai_awal' => $request->{$id.$i."nilai_awal"},
        //     ];
        //     $this->m_nilai_smart->editData($m_alternatif_id,  $m_kriteria_id, $data);
        //     $i = $i + 1;
        // }
        // }
             $m_kriteria_id = $request->kriteria_id;
             $nilai_awal = $request->{$m_alternatif_id.$m_kriteria_id."nilai_awal"};

            $this->m_nilai_smart->editData($m_alternatif_id,  $m_kriteria_id, $nilai_awal);
        return redirect('/user/utility/');
    }

    public function utility()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $m_alternatif_id = $nilai->m_alternatif_id;
            $m_kriteria_id = $nilai->m_kriteria_id;
            $a = $nilai->nilai_awal;
            $max = $this->m_nilai_smart->dataMax($m_kriteria_id);
            $min = $this->m_nilai_smart->dataMin($m_kriteria_id);
            // if ($max == $min){
            //     $pembagi = 1;
            // }else{
            
                $pembagi = ($max-$min);
            if ($pembagi == 0) {
                $nilai_utility = 0;
            }
            else {
                # code...
           
            if ($nilai->jenis_kriteria == "benefit")
            {
                $nilai_utility = ($a-$min)/$pembagi;
            } else
            {
                $nilai_utility = ($max-$a)/$pembagi;
            }
        }

            $this->m_nilai_smart->utility($m_alternatif_id, $m_kriteria_id, $nilai_utility);
        }
        return redirect('/user/akhir/');
    }

    public function akhir()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $m_alternatif_id = $nilai->m_alternatif_id;
            $criteria_id = $nilai->m_kriteria_id;
            $m_kriteria_id = $criteria_id;
            $a = $nilai->nilai_utility;
            $bobot = $this->m_bobot->bobotCriteria($criteria_id);
            $nilai_akhir = $a * $bobot->bobot;
            $this->m_nilai_smart->nilaiakhir($m_alternatif_id, $m_kriteria_id, $nilai_akhir);
        }
        return redirect()->route('user.rank.create');
    }


    public function create()
    {
        $alternative = $this->m_alternatif->allData();

        foreach ($alternative as $data1)
        {
            $id = $data1->id;
            $cek = $this->m_ranking->cekData($id);
            if ($cek <> null) {
                $m_alternatif_id = $data1->id;
                $id = $m_alternatif_id;
                $hasil_akhir = $this->m_nilai_smart->hasilData($m_alternatif_id);
                $data = [
                    'hasil_akhir' => $hasil_akhir,
                ];
                $this->m_ranking->updateData($data, $id);
            } else {
                $m_alternatif_id = $data1->id;
                $hasil_akhir = $this->m_nilai_smart->hasilData($m_alternatif_id);
                $data = [
                    'hasil_akhir' => $hasil_akhir,
                    'm_alternatif_id' => $m_alternatif_id,
                ];
                $this->m_ranking->addData($data);
             }
        }
        return redirect()->route('user.rank.store');

    }

    public function rank()
    {
        $akhir = $this->m_ranking->sortDesc();
        $ranking = 0;
        foreach ($akhir as $akhir)
        {
            $id = $akhir->m_alternatif_id;
            $ranking = $ranking + 1;
            $data = [
                'ranking' => $ranking,
            ];
            $this->m_ranking->updateData($data, $id);
        }
        return redirect()->back();
    }

}
