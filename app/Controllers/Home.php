<?php

namespace App\Controllers;

class Home extends BaseController{

	//Retorna a view da página inicial
	public function index() {
		return view('menu-inicial');
	}
}
