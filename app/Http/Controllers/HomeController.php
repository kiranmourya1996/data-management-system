<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount  = User::count();
        $categoryCount  = Categories::count();
        $productCount  = Products::count();
    
        $data = array('userCount'=>$userCount, 'categoryCount'=>$categoryCount, 'productCount'=>$productCount);
        
        return view("home")->with('data',$data);
        
    }
}
