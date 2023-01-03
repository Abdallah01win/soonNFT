<?php

namespace App\Http\Controllers;
use App\Models\Nfts;
use Redirect;
use Illuminate\Http\Request;

class nft extends Controller
{
    public function index(){
        return Nfts::all();
    }
    public function count(){
        return Nfts::count();
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'dropDate' => 'required',
            'imgurl' => 'required',
            'price' => 'required',
            'blockchain' => 'required',
            'twitter' => 'required',
            'discord' => 'required',
            'website' => 'required',
            'supply' => 'required',
        ]);

        $nft = new Nfts([
            'name' => $request->get('name'),
            'discription' => $request->get('description'),
            'dropdate' => $request->get('dropDate'),
            'imgurl' => $request->get('imgurl'),
            'price' => $request->get('price'),
            'blockchain' => $request->get('blockchain'),
            'twitter' => $request->get('twitter'),
            'discord' => $request->get('discord'),
            'website' => $request->get('website'),
            'supply' => $request->get('supply'),
        ]);
        $nft->save();
        //return redirect('/dashboard')->with('success', 'NFT saved!');
        return Redirect::route('dashboard');
    }
}
