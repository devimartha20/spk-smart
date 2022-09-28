<?php

namespace App\Http\Controllers;

use App\Models\m_nilai_smart;
use Illuminate\Http\Request;

class c_nilai_smart extends Controller
{
    public function __construct()
    {
        $this->m_nilai_smart = new m_nilai_smart();
    }

    public function index()
    {
        $nilai_smart = [
            'nilai_smart' => $this->m_nilai_smart->allData(),
        ];
        return view('smart.v_index', $nilai_smart);
    }

    public function create()
    {
        return view('smart.v_create');
    }


}
