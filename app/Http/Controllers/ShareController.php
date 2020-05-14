<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareController extends BaseController
{
    //
    public function search(Request $request){

        $email =$request->email;
        $users=User::where('email','like','%'.$email.'%')->where('email','!=',Auth::user()->email)->get();
        return $this->responseAPI(true,'search',$users,200);
    }
    public function store(Request $request){
        $post_id=$request->post_id;
        $user_id_from=$request->user_id_form;
        Share::create([
            'note_id'   => $post_id,
            'user_to'   =>Auth::user()->id,
            'user_from' =>$user_id_from
        ]);
    }
}
