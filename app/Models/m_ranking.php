<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_ranking extends Model
{
    use HasFactory;

    public $table = 'rangkings';

    protected $fillable = [
    	'hasil_akhir',  'rangking', 'alternative_id'
    ];

    public function allData()
    {
        DB::table('rangkings')->join('alternatives', 'alternatives.id', '=','rangkings.alternative_id')->where('alternatives.user_is', Auth::user()->id)->get();
    }
    public function addData($data)
    {
        DB::table('rangkings')->insert($data);
    }
    
    public function sortDesc()
    {
        return DB::table('rangkings')->join('alternatives', 'alternatives.id', '=','rangkings.alternative_id')->where('alternatives.user_is', Auth::user()->id)->orderby('hasil_akhir', 'desc')->get();
    }

    public function updateData($id, $data)
    {
        DB::table('rangkings')->where('id', $id)->update($data);
    }
}
