<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Foundation\Auth\User;

class m_bobot extends Model
{
    use HasFactory;

    public $table = 'bobots';

    protected $fillable = [
    	'id', 'bobot', 'point', 'criteria_id', 'user_id'
    ];

//definisi relasi tabel
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Kriteria(){
        return $this->hasOne(m_kriteria::class);
    }

//CRUD
    public function allData()
    {
        return m_bobot::with('User', 'Kriteria')->where('user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  m_bobot::with('User')->where('id', $id)->first();
    }

    public function addData($data)
    {
        m_bobot::with('User')->insert($data);
    }

    public function editData($id, $data)
    {
        m_bobot::with('User')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        m_bobot::with('User')->where('id', $id)->delete();
    }

    public function bobotCriteria($criteria_id)
    {
        m_bobot::with('User', 'Kriteria')->where('user_id', Auth::user()->id)->where('criteria_id', $criteria_id)->get();
    }
}
