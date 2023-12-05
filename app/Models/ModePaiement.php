<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModePaiement extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mode_paiement';
    public static function getList(){
        return DB::select('select * from mode_paiement');
    }
    public static function getById($id){
        $result = DB::table('mode_paiement')->where('id', $id)->first();
        return $result;
    }
}
