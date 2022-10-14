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
        return $this->belongsTo('App\Models\m_altrnatif', 'm_alternatif_id');
    }
    public function allData()
    {
        return m_ranking::with('Alternatif')->where('m_alternatifs.user_is', Auth::user()->id)->get();
    }
    public function addData($data)
    {
        DB::table('rankings')->insert($data);
    }

    public function sortDesc()
    {
        return m_ranking::with('Alternatif')->where('m_alternatifs.user_is', Auth::user()->id)->orderby('hasil_akhir', 'desc')->get();
    }

    public function cekData($id)
    {
        return m_ranking::with('Alternatif')->where('m_alternatif_id', $id)->get();
    }
    public function updateData($data, $id)
    {
        m_ranking::with('Alternatif')->where('m_alternatif_id', $id)->update($data);
    }
}
