<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_alternatif extends Model
{
    use HasFactory;

    public $table = 'alternatives';

    protected $fillable = [
    	'id', 'nama_alternatif', 'user_id'
    ];

    public function allData()
    {
        return DB::table('alternatives')->join('users', 'users.id', '=','alternatives.user_id')->where('alternatives.user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  DB::table('alternatives')->join('users', 'users.id', '=','alternatives.user_id')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('alternatives')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('alternatives')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('alternatives')->where('id', $id)->delete();
    }

    public function jumlahData()
    {
        DB::table('alternatives')->where('user_id', Auth::user()->id)->count();
    }
}
