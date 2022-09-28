<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_kriteria;

class c_kriteria extends Controller
{
    public function __construct()
    {
        $this->m_kriteria = new m_kriteria();
    }

    public function index()
    {
        $kriteria = [
            'kriteria' => $this->m_kriteria->allData(),
        ];
        return view('kriteria.v_index', $kriteria);
    }

    public function create()
    {
        return view('kriteria.v_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis_kriteria' => 'required',
        ]);

        $data = [
            'nama_kriteria' => $request->nama_kriteria,
            'jenis_kriteria' => $request->jenis_kriteria,
        ];
        $this->m_kriteria->addData($data);

        return redirect()->route('kriteria.index');
    }

    public function edit($id)
    {
        $kriteria = [
            'kriteria' => $this->m_kriteria->detailData($id),
        ];

        return view('kriteria.v_edit', $kriteria);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis_kriteria' => 'required',
        ]);

        $data = [
            'nama_kriteria' => $request->nama_kriteria,
            'jenis_kriteria' => $request->jenis_kriteria,
        ];

        $this->m_kriteria->editData($id, $data);

        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        $this->m_kriteria->deleteData($id);

        return redirect()->route('kriteria.index');
    }
}
