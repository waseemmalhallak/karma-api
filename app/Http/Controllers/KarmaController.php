<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KarmaController extends Controller
{
    public function karmaPosition($id){
        $pos=User::find($id)->get();
        echo $pos;
    }
}
