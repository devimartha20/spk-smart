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

    public function addData($data)
    {
        DB::table('nilai_smarts')->insert($data);
    }
    
}
