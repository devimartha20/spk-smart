<?php

namespace App\Http\Controllers;

use App\Models\m_nilai_smart;
use App\Models\m_alternatif;
use App\Models\m_bobot;
use App\Models\m_kriteria;
use Illuminate\Http\Request;

class c_nilai_smart extends Controller
{
    public function __construct()
    {
        $this->m_nilai_smart = new m_nilai_smart();
        $this->m_alternatif = new m_alternatif();
        $this->m_kriteria = new m_kriteria();
        $this->m_bobot = new m_bobot();
    }

    public function index()
    {
        $data= [
            'nilai_smart' => $this->m_nilai_smart->allData(),
            'kriteria' => $this->m_kriteria->allData(),
            'alternatif' => $this->m_alternatif->allData(),
        ];

        return view('dashboards.user.smart', $nilai_smart, $kriteria, $alternatif );
    }

    // public function create($id)
    // {
    //     $alternatif = [
    //         'alternatif' => $this->m_alternatif->detailData($id),
    //     ];
    //     return view('smart.v_create', $alternatif);
    // }

    public function store(Request $request, $id)
    {
        $n = $this->m_kriteria->jumlahData();

        for($i = 0; $i < $n; $i++)
        {
            $data = [
                'alternative_id' => $id,
                'criteria_id' => ${"request->criteria_id".$i},
                'nilai_awal' => ${"request->nilai_awal".$i},
            ];
            $this->m_nilai_smart->addData($data);
        }
        return redirect()->route('smart.index');
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
        $n = $this->m_kriteria->jumlahData();

        for($i = 0; $i < $n; $i++)
        {
            $criteria_id = ${"request->criteria_id".$i};
            $data = [
                'nilai_awal' => ${"request->nilai_awal".$i},
            ];
            $this->m_nilai_smart->addData($id, $criteria_id, $data);
        }
        return redirect()->route('smart.index');
    }

    public function utility()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $id = $nilai->alternative_id;
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
            $id = $nilai->alternative_id;
            $criteria_id = $nilai->criteria_id;
            $a = $nilai->nilai_utility;
            $bobot = $this->m_bobot->bobotCriteria($criteria_id);
            $nilai_akhir = $a * $bobot->bobot;
            $data = [
                'nilai_akhir' => $nilai_akhir,
            ];
            $this->m_nilai_smart->update($id, $criteria_id, $data);
        }
        return redirect()->route('rank.store');
    }

}
