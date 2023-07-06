<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller {
    public function painel_adm(){
        return view('painel_adm');
    }
}
