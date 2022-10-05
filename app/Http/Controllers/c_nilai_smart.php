<?php

namespace App\Http\Controllers;

use App\Models\m_nilai_smart;
use App\Models\m_alternatif;
use App\Models\m_kriteria;
use Illuminate\Http\Request;

class c_nilai_smart extends Controller
{
    public function __construct()
    {
        $this->m_nilai_smart = new m_nilai_smart();
        $this->m_alternatif = new m_alternatif();
        $this->m_kriteria = new m_kriteria();
    }

    public function index()
    {
        $nilai_smart = [
            'nilai_smart' => $this->m_nilai_smart->allData(),
        ];
        return view('smart.v_index', $nilai_smart);
    }

    public function create($id)
    {
        $alternatif = [
            'alternatif' => $this->m_alternatif->detailData($id),
        ];
        return view('smart.v_create', $alternatif);
    }

    public function store(Request $request, $id)
    {   
        $n = $this->m_kriteria-jumlahData();

        for($i = 0; $i < $n; $i++)
        {
            $data = [
                "alternative_id" => $id,
                "criteria_id" => ${"request->criteria_id".$i},
                "nilai_awal" => ${"request->nilai_awal".$i},
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
        $n = $this->m_kriteria-jumlahData();

        for($i = 0; $i < $n; $i++)
        {
            $criteria_id = ${"request->criteria_id".$i};
            $data = [
                "nilai_awal" => ${"request->nilai_awal".$i},
            ];
            $this->m_nilai_smart->addData($id, $criteria_id, $data);
        }
        return redirect()->route('smart.index');
    }

    public function utility()
    {
        $nilai_smart = $this->m_nilai_smart->allData();
        foreach ($nilai_smart as $nilai) {
            $alternative_id = $nilai->alternative_id;
            $criteria_id = $nilai->criteria_id;
            $nilai_hitung = $this->m_nilai_smart->dataHitung($alternative_id, $criteria_id);
            $a = $nilai_hitung->nilai_awal;
            $max = $this->m_nilai_smart->dataMax($nilai_hitung->criteria_id);
            $min = $this->m_nilai_smart->dataMin($nilai_hitung->criteria_id);
            if ($nilai->criteria_id) {
                # code...
            }
        }
        

    }


}
