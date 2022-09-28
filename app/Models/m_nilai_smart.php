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
        return  DB::table('nilai_smarts')->join('alternatives', 'alternatives.id', '=','nilai_smarts.alternative_id')->join('criterias', 'criterias.id', '=','nilai_smarts.criteria_id')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('nilai_smarts')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('nilai_smarts')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('nilai_smarts')->where('id', $id)->delete();
    }
}
