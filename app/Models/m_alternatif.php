<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_alternatif extends Model
{
    use HasFactory;

    public $table = 'alterinatives';

    protected $fillable = [
    	'id', 'nama_alternatif', 'user_id'
    ];

    public function allData()
    {
        return DB::table('alterinatives')->join('users', 'users.id', '=','alterinatives.user_id')->where('alternatives.user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  DB::table('alterinatives')->join('users', 'users.id', '=','alterinatives.user_id')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('alterinatives')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('alterinatives')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('alterinatives')->where('id', $id)->delete();
    }
}
