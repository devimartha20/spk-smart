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
    	'id', 'nama_alternatif', 'nama_kampus', 'user_id', 'created_at', 'updated_at',
    ];

//Definisi Relasi tabel
    public function User(){
        return $this->belongsTo(User::class);
    }

//CRUD
    public function allData()
    {
        return m_alternatif::with('User')->where('user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return m_alternatif::with('User')->where('user_id', Auth::user()->id)->where('id', $id)->first();
    }

    public function addData($data)
    {
        m_alternatif::with('User')->insert($data);
    }

    public function editData($id, $data)
    {
        m_alternatif::with('User')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        m_alternatif::with('User')->where('id', $id)->delete();
    }

    public function jumlahData()
    {
        m_alternatif::with('User')->where('user_id', Auth::user()->id)->count();
    }


}
