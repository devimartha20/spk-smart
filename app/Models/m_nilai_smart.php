<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_nilai_smart extends Model
{
    use HasFactory;

    public $table = 'nilai_smarts';

    protected $fillable = [
    	'alternative_id', 'criteria_id', 'nilai_awal', 'nilai_utility', 'nilai_akhir'
    ];

    public function allData()
    {
        return DB::table('nilai_smarts')->join('alternatives', 'alternatives.id', '=','nilai_smarts.alternative_id')->join('criterias', 'criterias.id', '=','nilai_smarts.criteria_id')->where('alternatives.user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  DB::table('nilai_smarts')->join('alternatives', 'alternatives.id', '=','nilai_smarts.alternative_id')->join('criterias', 'criterias.id', '=','nilai_smarts.criteria_id')->where('alternative_id', $id)->where('alternatives.user_id', Auth::user()->id)->get();
    }

    public function addData($data)
    {
        DB::table('nilai_smarts')->insert($data);
    }

    public function editData($id, $criteria_id, $data)
    {
        DB::table('nilai_smarts')->where('alternative_id', $id)->where('criteria_id', $criteria_id)->update($data);
    }

    public function deleteData($alternative_id, $criteria_id)
    {
        DB::table('nilai_smarts')->where('alternative_id', $alternative_id)->where('criteria_id', $criteria_id)->delete();
    }

    public function dataHitung($alternative_id, $criteria_id)
    {
        return  DB::table('nilai_smarts')->where('alternative_id', $alternative_id)->where('criteria_id', $criteria_id)->get();
    }

    public function dataMax($criteria_id)
    {
        return  DB::table('nilai_smarts')->join('alternatives', 'alternatives.id', '=','nilai_smarts.alternative_id')->where('criteria_id', $criteria_id)->where('alternatives.user_id', Auth::user()->id)->max('nilai_awal');
    }

    public function dataMin($criteria_id)
    {
        return  DB::table('nilai_smarts')->join('alternatives', 'alternatives.id', '=','nilai_smarts.alternative_id')->where('criteria_id', $criteria_id)->where('alternatives.user_id', Auth::user()->id)->min('nilai_awal');
    }

    
}
