<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_kriteria extends Model
{
    use HasFactory;

    public $table = 'criterias';

    protected $fillable = [
    	'id', 'nama_kriteria', 'jenis_kriteria'
    ];

    public function allData()
    {
        return DB::table('criterias')->get();
    }

    public function detailData($id)
    {
        return  DB::table('criterias')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('criterias')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('criterias')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('criterias')->where('id', $id)->delete();
    }
}
