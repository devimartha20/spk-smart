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
    	'hasil_akhir',  'rangking', 'm_alternative_id'
    ];

    public function allData()
    {
        return DB::table('rankings')->join('m_alternatives', 'm_alternatives.id', '=','rankings.m_alternative_id')->where('m_alternatives.user_is', Auth::user()->id)->get();
    }
    public function addData($data)
    {
        DB::table('rankings')->insert($data);
    }

    public function sortDesc()
    {
        return DB::table('rankings')->join('m_alternatives', 'm_alternatives.id', '=','rankings.m_alternative_id')->where('m_alternatives.user_is', Auth::user()->id)->orderby('hasil_akhir', 'desc')->get();
    }

    public function cekData($id)
    {
        return DB::table('rankings')->where('m_alternative_id', $id)->get();
    }
    public function updateData($hasil_akhir, $id)
    {
        DB::table('rankings')->where('m_alternative_id', $id)->update($data);
    }
}
