<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeFacture extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'type_facture';
    public static function getList(){
        return DB::select('select * from type_facture');
    }
    public static function getById($id){
        $result = DB::table('type_facture')->where('id', $id)->first();
        return $result;
    }
}
