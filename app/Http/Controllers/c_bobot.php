<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_bobot;
use App\Models\m_kriteria;
use Auth;

class c_bobot extends Controller
{
    public function __construct()
    {
        $this->m_bobot = new m_bobot();
        $this->m_kriteria = new m_kriteria();
    }

    public function index()
    {
        $bobot = [
            'bobot' => $this->m_bobot->allData(),
        ];
        $kriteria = [
            'kriteria' => $this->m_kriteria->allData()
        ];
        return view('dashboards.user.bobot', $bobot, $kriteria);
    }

    // public function create()
    // {
    //     return view('bobot.v_create');
    // }

    public function store(Request $request)
    {

        $kriteria = $this->m_kriteria->allData();
        foreach ($kriteria as $data1) {

        $data = [
            'point' => $request->{$data1->id."point"},
            'm_kriteria_id' => $data1->id,
            'user_id' => Auth::user()->id,
        ];
        $this->m_bobot->addData($data);
        }

        return redirect('/user/bobothitung');
    }

    public function bobot()
    {
        $bobot = $this->m_bobot->allData();
        foreach ($bobot as $data1) {
            $n = $data1->point;
            $p = $this->m_bobot->jumlah($data1->user_id);
            $h = $n/$p;
            $id = $data1->id;
            $data = [
                'bobot' => $h,
            ];
            $this->m_bobot->editData($id, $data);
        }
        return redirect()->route('user.bobot.index');
    }

    // public function edit($id)
    // {
    //     $bobot = [
    //         'bobot' => $this->m_bobot->detailData($id),
    //     ];

    //     return view('bobot.v_edit', $bobot);
    // }

    public function update(Request $request, $id)
    {
        $data = [
            'point' => $request->point,
        ];
        $this->m_bobot->editData($id, $data);
        return redirect('/user/bobothitung');
    }

    public function destroy($id)
    {
        $this->m_bobot->deleteData($id);

        return redirect()->back();
    }
}
