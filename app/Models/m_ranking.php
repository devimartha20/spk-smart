<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_ranking extends Model
{
    use HasFactory;

    public $table = 'm_rankings';

    protected $fillable = [
    	'hasil_akhir',  'rangking', 'm_alternatif_id'
    ];

    // relasi
    public function Alternatif(){
        return $this->belongsTo('App\Models\m_alternatif', 'm_alternatif_id');
    }
    public function allData()
    {
        return m_ranking::with('Alternatif')->join('m_alternatifs', 'm_alternatifs.id', '=','m_rankings.m_alternatif_id')->where('m_alternatifs.user_id', Auth::user()->id)->get();
    }
    public function addData($data)
    {
        DB::table('m_rankings')->insert($data);
    }

    public function sortDesc()
    {
        return m_ranking::with('Alternatif')->join('m_alternatifs', 'm_alternatifs.id', '=','m_rankings.m_alternatif_id')->where('m_alternatifs.user_id', Auth::user()->id)->orderby('hasil_akhir', 'desc')->get();
    }

    public function cekData($id)
    {
        return m_ranking::with('Alternatif')->where('m_alternatif_id', $id)->first();
    }
    public function updateData($data, $id)
    {
        m_ranking::with('Alternatif')->where('m_alternatif_id', $id)->update($data);
    }
}
