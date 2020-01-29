<?php

namespace App\Http\Controllers;

use App\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortUrl::latest()->get();
   
        return view('shortenLink', compact('shortLinks'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);
   
        $input['url'] = $request->link;
        $input['code'] = Str::random(6);
   
        ShortUrl::create($input);
  
        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        dd($GLOBALS);

        $find = ShortUrl::where('code', $code)->first();
        $find->counter += 1;
        $find->save();
   
        return redirect($find->url);
    }
}
