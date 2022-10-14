<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_nilai_smart extends Model
{
    use HasFactory;

    public $table = 'm_nilai_smarts';

    protected $fillable = [
    	'm_alternatif_id', 'm_kriteria_id', 'nilai_awal', 'nilai_utility', 'nilai_akhir',
    ];

    // relasi tabel

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Kriteria(){
        return $this->belongsTo('App\Models\m_kriteria', 'm_kriteria_id');
    }

    public function Alternatif(){
        return $this->belongsTo('App\Models\m_alternatif', 'm_alternatif_id');
    }

    public function allData()
    {
        return m_nilai_smart::with('Alternatif', 'Kriteria')->join('m_alternatifs', 'm_alternatifs.id', '=','m_nilai_smarts.m_alternatif_id')->join('m_kriterias', 'm_kriterias.id', '=','m_nilai_smarts.m_kriteria_id')->where('m_alternatifs.user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  m_nilai_smart::with('Alternatif', 'Kriteria')->join('m_alternatifs', 'm_alternatifs.id', '=','m_nilai_smarts.m_alternatif_id')->join('m_kriterias', 'm_kriterias.id', '=','m_nilai_smarts.m_kriteria_id')->where('m_alternatif_id', $id)->where('m_alternatifs.user_id', Auth::user()->id)->get();
    }

    public function addData($data)
    {
        DB::table('m_nilai_smarts')->insert($data);
    }

    public function editData($m_alternatif_id, $m_kriteria_id, $data)
    {
        DB::table('m_nilai_smarts')->where('m_alternatif_id', $m_alternatif_id)->where('m_kriteria_id', $m_kriteria_id)->update($data);
    }

    public function utility($m_alternatif_id, $m_kriteria_id, $nilai_utility)
    {
        DB::table('m_nilai_smarts')->where('m_alternatif_id', $m_alternatif_id)->where('m_kriteria_id', $m_kriteria_id)->update(['nilai_utility' => $nilai_utility]);
    }

    public function deleteData($m_alternatif_id, $m_kriteria_id)
    {
        DB::table('m_nilai_smarts')->where('m_alternatif_id', $m_alternatif_id)->where('m_kriteria_id', $m_kriteria_id)->delete();
    }

    public function dataHitung($m_alternatif_id, $m_kriteria_id)
    {
        return  DB::table('m_nilai_smarts')->where('m_alternatif_id', $m_alternatif_id)->where('m_kriteria_id', $m_kriteria_id)->get();
    }

    public function dataMax($m_kriteria_id)
    {
        return  DB::table('m_nilai_smarts')->join('m_alternatifs', 'm_alternatifs.id', '=','m_nilai_smarts.m_alternatif_id')->where('m_kriteria_id', $m_kriteria_id)->where('m_alternatifs.user_id', Auth::user()->id)->max('nilai_awal');
    }

    public function dataMin($m_kriteria_id)
    {
        return  DB::table('m_nilai_smarts')->join('m_alternatifs', 'm_alternatifs.id', '=','m_nilai_smarts.m_alternatif_id')->where('m_kriteria_id', $m_kriteria_id)->where('m_alternatifs.user_id', Auth::user()->id)->min('nilai_awal');
    }

    public function hasilData($m_alternatif_id)
    {
        return  DB::table('m_nilai_smarts')->join('m_alternatifs', 'm_alternatifs.id', '=','m_nilai_smarts.m_alternatif_id')->where('alternativ_id', $m_alternatif_id)->where('m_alternatifs.user_id', Auth::user()->id)->sum('nilai_akhir');
    }
}
