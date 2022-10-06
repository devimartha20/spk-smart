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
        $this->m_rangking = new m_rangking();
    }

    public function store()
    {
        
    }
}
