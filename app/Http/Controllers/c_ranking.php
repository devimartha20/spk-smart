<?php

namespace App\Http\Controllers;
use App\Models\m_nilai_smart;
use App\Models\m_alternatif;
use App\Models\m_kriteria;
use App\Models\m_rangking;
use Illuminate\Http\Request;

class c_ranking extends Controller
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
        $ranking = [
            'rangking' => $this->m_ranking->allData(),
        ];
        return view('v_hasil', $ranking);
    }

    // public function store()
    // {
    //     $alternative = $this->m_alternatif->allData();

    //     foreach ($alternative as $data1)
    //     {
    //         $cek = $this->m_ranking->cekData();
    //         if ($cek->hasil_akhir <> null) {
    //             $id = $data1->id;
    //             $hasil_akhir = $this->m_nilai_smart->hasilData($alternative_id);
    //             $data = [
    //                 'hasil_akhir' => $hasil_akhir,
    //             ];
    //             $this->m_ranking->updateData1($id, $$data);
    //         } else {
    //             $alternative_id = $data1->id;
    //             $hasil_akhir = $this->m_nilai_smart->hasilData($alternative_id);
    //             $data = [
    //                 'hasil_akhir' => $hasil_akhir,
    //                 'm_alternative_id' => $alternative_id,
    //             ];
    //             $this->m_ranking->addData($data);
    //         }
    //     }
    //     return redirect()->route('rank.update');

    // }

    // public function update()
    // {
    //     $akhir = $this->m_ranking->sortDesc();
    //     $ranking = 0;
    //     foreach ($akhir as $hakhir)
    //     {
    //         $id = $akhir->m_alternatif_id;
    //         $ranking = $ranking + 1;
    //         $data = [
    //             'rangking' => $ranking,
    //         ];
    //         $this->m_ranking->updateData($id, $data);
    //     }
    //     return redirect()->route('smart.index');
    // }
}
