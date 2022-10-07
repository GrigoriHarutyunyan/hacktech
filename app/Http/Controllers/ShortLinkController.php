<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCsvRequest;
use App\Http\Requests\ShortLinkRequest;
use App\Imports\WebsiteImport;
use App\Models\ShortLink;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ShortLinkController extends Controller
{
    public function index() {
        $links = ShortLink::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('/dashboard', compact('links'));
    }

    public function store(ShortLinkRequest $request) {
        $data = $request->validated();
        $user = Auth::user();
        $shortURL = ShortURL::destinationUrl($data['url'])->make();
        ShortLink::create([
            'website_url' => $shortURL['destination_url'],
            'short_url' => $shortURL['url_key'],
            'user_id' => $user->id,
        ]);
        return redirect('/')->with('success', 'Short link generated successfully!!!');
    }

    public function linkTracking(Request $request) {
        $id = $request->link_id;
        $link = ShortLink::where('id', $id)
            ->select('tracking')
            ->first();

        ShortLink::find($id)->update([
           'tracking' => $link['tracking'] + 1,
        ]);

        $data = $link['tracking'] + 1;
        return response()->json($data, '200');
    }

    public function importCsv(ImportCsvRequest $request) {
        $file = $request->file('csv-file');
        Excel::import(new WebsiteImport,$file);
        return redirect('/')->with('success', 'Short link generated successfully!!!');

    }
}
