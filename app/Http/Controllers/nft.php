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
        $nfts = Nfts::all();
        return Inertia::render('Allnfts', ['NftData' => $nfts]);
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
            'imgurl' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
            'price' => 'required',
            'blockchain' => 'required',
            'supply' => 'required',
            'is_featured' => 'required',
        ]);


        $image_path = $request->file('imgurl')->store('images', 'public');

        $nft = new Nfts ([
            'name' => $request->get('name'),
            'discription' => $request->get('description'),
            'imgurl' => asset('storage/'.$image_path),
            'price' => $request->get('price'),
            'blockchain' => $request->get('blockchain'),
            'twitter' => $request->get('twitter'),
            'discord' => $request->get('discord'),
            'website' => $request->get('website'),
            'supply' => $request->get('supply'),
            'is_featured' => $request->get('is_featured'),
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
        return redirect('nfts/all')->with('success', 'NFT Deleted');
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
