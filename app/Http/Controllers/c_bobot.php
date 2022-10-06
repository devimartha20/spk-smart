<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_bobot;
use App\Models\m_kriteria;

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

    public function create()
    {
        return view('bobot.v_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bobot' => 'required',
            'criteria_id' => 'required',
            'user_id' => 'required',
        ]);

        $data = [
            'bobot' => $request->bobot,
            'criteria_id' => $request->criteria_id,
            'user_id' => $request->user_id,
        ];
        $this->m_bobot->addData($data);

        return redirect()->route('bobot.index');
    }

    public function edit($id)
    {
        $bobot = [
            'bobot' => $this->m_bobot->detailData($id),
        ];

        return view('bobot.v_edit', $bobot);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bobot' => 'required',
            'criteria_id' => 'required',
            'user_id' => 'required',
        ]);

        $data = [
            'bobot' => $request->bobot,
            'criteria_id' => $request->criteria_id,
            'user_id' => $request->user_id,
        ];

        $this->m_bobot->editData($id, $data);

        return redirect()->route('bobot.index');
    }

    public function destroy($id)
    {
        $this->m_bobot->deleteData($id);

        return redirect()->route('bobot.index');
    }
}
