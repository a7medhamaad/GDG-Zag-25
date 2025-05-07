<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private $profiles = [
        1 => ['name' => 'Ahmed Hamaad', 'age' => 21, 'email' => 'ahmed@example.com'],
        2 => ['name' => 'Kondy', 'age' => 26, 'email' => 'Kondy@example.com'],
        3 => ['name' => 'Pedrii', 'age' => 22, 'email' => 'Pedri@example.com'],
    ];

    public function index()
    {
        $profiles=$this->profiles;
        return View('profiles.index',compact('profiles'));
    }


    public function show($id)
    {
        if (!isset($this->profiles[$id])) {
            abort(404);
        }
        $profiles=$this->profiles[$id];
        return view('profiles.show', compact('profiles'));
    }
}
