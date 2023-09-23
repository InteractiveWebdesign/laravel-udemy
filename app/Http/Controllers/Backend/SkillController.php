<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;


class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(StoreSkillRequest $request)
    {
       if($request->hasFile('image')){
           $image = $request->file('image')->store('skills');

            Skill::create([
            'name' => $request->name,
            'image' => $image
            ]);

            return redirect()->route('skills.index');

       }

         return redirect()->back();
    }
}