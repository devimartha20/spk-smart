<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\m_alternatif;
use App\Models\m_bobot;
use App\Models\m_kriteria;
use App\Models\m_nilai_smart;
use App\Models\m_ranking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->m_bobot = new m_bobot();
    //     $this->m_kriteria = new m_kriteria();
    //     $this->m_alternatif = new m_alternatif();
    //     $this->m_nilai_smart = new m_nilai_smart();
    //     $this->m_ranking = new m_ranking();
    // }
    // public function index(){

    //     $bobot = m_bobot::all()->where('user_id', Auth::user()->id);
    //     $kriteria = m_kriteria::all();
    //     $alternatif = m_alternatif::all()->where('user_id', Auth::user()->id);
    //     $nilai = m_nilai_smart::all()->where('user_id', Auth::user()->id);
    //     $ranking = m_ranking::all()->where('user_id', Auth::user()->id);
    //     $jKriteria = m_kriteria::all()->count();

    //     return view('dashboards.user.index', compact('bobot', 'kriteria', 'alternatif', 'nilai', 'ranking', 'jKriteria'));
    // }
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
        ];

        return view('dashboards.user.index', $data );
    }
}
