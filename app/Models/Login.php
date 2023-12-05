<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'admin';
    public static function getUser($email,$motdepasse){
        $user = DB::table('admin')
        ->where('email', $email)
        ->where('motdepasse', $motdepasse)
        ->first();
        return $user;
    }
}
