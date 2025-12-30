<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::where('designer_id',auth()->id())->get();
        return view('desainer.service.index',compact('services'));
    }

    public function create(){
        $categories = Category::all();
        return view('desainer.service.create',compact('categories'));
    }

    public function store(Request $r){
        Service::create([
            'designer_id'=>auth()->id(),
            'category_id'=>$r->category_id,
            'title'=>$r->title,
            'description'=>$r->description,
            'price'=>$r->price
        ]);
        return redirect('/desainer/service');
    }
}

