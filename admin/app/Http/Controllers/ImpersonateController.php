<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;


class ImpersonateController extends Controller
{

    public function impersonate( $user_id ){

        if( $user_id != ' '){
            $user = User::find($user_id);
            Auth::user()->impersonate($user);
            return redirect('/');
        }

        return redirect()->back();
    }


    public function impersonate_leave(){

        Auth::user()->leaveImpersonation();
        return redirect('/');

    }

}
