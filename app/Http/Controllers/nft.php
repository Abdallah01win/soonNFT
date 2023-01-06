<?php

namespace App\Http\Controllers;

use App\Models\Nfts;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class nft extends Controller
{
    public function index()
    {
        return Nfts::all();
    }
    public function count()
    {
        return Nfts::orderBy('created_at', 'ASC')
            ->groupBy('blockchain')
            ->get(array(
                DB::raw('blockchain'),
                DB::raw('COUNT(blockchain) as count'),
            ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'dropDate' => 'required',
            'imgurl' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required',
            'blockchain' => 'required',
            'twitter' => 'required',
            'discord' => 'required',
            'website' => 'required',
            'supply' => 'required',
        ]);


        $image_path = $request->file('imgurl')->store('images', 'public');

        $nft = new Nfts ([
            'name' => $request->get('name'),
            'discription' => $request->get('description'),
            'dropdate' => $request->get('dropDate'),
            'imgurl' => asset('storage/'.$image_path),
            'price' => $request->get('price'),
            'blockchain' => $request->get('blockchain'),
            'twitter' => $request->get('twitter'),
            'discord' => $request->get('discord'),
            'website' => $request->get('website'),
            'supply' => $request->get('supply'),
        ]);
        sleep(1);
        $nft->save();
        return Redirect::route('dashboard');
    }
}
