<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_alternatif;

class c_alternatif extends Controller
{
    public function __construct()
    {
        $this->m_alternatif = new m_alternatif();
    }

    public function index()
    {
        $alternatif = [
            'alternatif' => $this->m_alternatif->allData(),
        ];
        return view('dashboards.user.alternatif', $alternatif);
    }

    // public function create()
    // {
    //     return view('alternatif.v_create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            'user_id' => 'required',
        ]);

        $data = [
            'nama_alternatif' => $request->nama_alternatif,
            'user_id' => $request->user_id,
        ];
        $this->m_alternatif->addData($data);

        return redirect()->route('user.alternatif.index');
    }

    // public function edit($id)
    // {
    //     $alternatif = [
    //         'alternatif' => $this->m_alternatif->detailData($id),
    //     ];

    //     return view('alternatif.v_edit', $alternatif);
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            // 'user_id' => 'required',
        ]);

        $data = [
            'nama_alternatif' => $request->nama_alternatif,
            // 'user_id' => $request->user_id,
        ];

        $this->m_alternatif->editData($id, $data);

        return redirect()->route('user.alternatif.index');
    }

    public function destroy($id)
    {
        $this->m_alternatif->deleteData($id);

        return redirect()->route('user.alternatif.index');
    }
}
