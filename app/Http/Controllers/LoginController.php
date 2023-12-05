<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Diffusion;

class LoginController extends Controller
{
    //
    public function login(){
        return view('login');
    }
    public function logout(){
        return view('login');
    }
    public function checkUser(Request $request){
        $email = $request->input('email');
        $mdp = $request->input('mdp');
        $user = Login::getUser($email,$mdp);
        if(empty($user)){
            $message = "Identification invalid";
            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }else{
            $listdiffusionSociete = Diffusion::getListDiffusionSociete();
            $listdiffusionClient = Diffusion::getListDiffusionClient();
            return view('index',[
                'user' => $user,
                'listdiffusionSociete' => $listdiffusionSociete,
                'listdiffusionClient' => $listdiffusionClient
            ]);
        }
    }
}
