<?php

use Illuminate\Http\Request;


class UserController extends Controller
{
    //
    public function formulario()
    {
        return view('formCadastro');
    }
}
