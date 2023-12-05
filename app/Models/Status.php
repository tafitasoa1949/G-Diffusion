<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'status';
    public static function getList(){
        return DB::select('select * from status');
    }
    public static function getById($id){
        $result = DB::table('status')->where('id', $id)->first();
        return $result;
    }
}
