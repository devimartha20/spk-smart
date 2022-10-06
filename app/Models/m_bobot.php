<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class m_bobot extends Model
{
    use HasFactory;

    public $table = 'bobots';

    protected $fillable = [
    	'id', 'bobot', 'criteria_id', 'user_id'
    ];

    public function allData()
    {
        return DB::table('bobots')->join('users', 'users.id', '=','bobots.user_id')->join('criterias', 'criterias.id', '=','bobots.criteria_id')->where('bobots.user_id', Auth::user()->id)->get();
    }

    public function detailData($id)
    {
        return  DB::table('bobots')->join('users', 'users.id', '=','bobots.user_id')->join('criterias', 'criterias.id', '=','bobots.criteria_id')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('bobots')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('bobots')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('bobots')->where('id', $id)->delete();
    }

    public function bobotCriteria($criteria_id)
    {
        return DB::table('bobots')->join('criterias', 'criterias.id', '=','bobots.criteria_id')->where('user_id', Auth::user()->id)->where('criteria_id', $criteria_id)->get();
    }
}
