<?php

namespace App\Http\Controllers;

use App\Models\Nfts;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use GuzzleHttp\Client;

class nft extends Controller
{
    public function index()
    {
        return Nfts::all();
    }
    public function eth()
    {
        return Nfts::where('blockchain', 'ethereum')->get();
    }
    public function solana()
    {
        return Nfts::where('blockchain', 'solana')->get();
    }
    public function upcoming()
    {
        return Nfts::whereDate('dropdate', '>', date('Y-m-d'))
        ->get();
    }
    public function count()
    {
        return Nfts::count();    
    }

    public function view(Request $request)
    {
        $id = $request->get('id');
        $nft = Nfts::where('id', $id)->limit(1)->get();
        return Inertia::render('Nft', ['nft' => $nft[0]]);
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

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $imgurl = nfts::where('id', $id)->limit(1)->get('imgurl');
        $imagename = substr($imgurl[0]['imgurl'], strpos($imgurl[0]['imgurl'], 'images/') + 7);
        @unlink('storage/images/'.$imagename);
        DB::table('nfts')->Where('id', $id)->delete();
        return redirect('/')->with('success', 'NFT Deleted');
    }
    /*public function collection(Request $request)
    {
        $id = $request->get('id');
        $client = new Client();
        $response = $client->get("https://api-devnet.magiceden.dev/v2/collections/{$id}/activities?offset=0&limit=100");
        $col = json_decode($response->getBody(), true);

        $response2 = $client->get("https://api-devnet.magiceden.dev/v2/collections/{$id}/stats");
        $secondData = json_decode($response2->getBody(), true);
        $combinedData = [];
        $col = array_merge($col, $secondData);
        return Inertia::render('Collection', [
            'data' => $col,
        ]);
    }*/
}
