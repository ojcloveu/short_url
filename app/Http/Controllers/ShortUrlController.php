<?php

namespace App\Http\Controllers;

use App\User;
use App\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $input['code'] = Str::slug(Str::random(6));
   
        ShortUrl::create($input);
  
        return redirect('home')
             ->with('success', 'Shorten Link Generated Successfully!');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink(Request $request, $code)
    {
        $k = $request->input('k', null);

        $user = User::where('code', $k)->first();
        $userId = $user? $user->id:null;

        $httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

        $find = ShortUrl::where('code', $code)->first();
        $find->counter += 1;
        $find->save();

        $ref = $find->referers()->updateOrCreate(['refer_name'=>$httpReferer,'user_id' => $userId], [   'counter' => DB::raw('counter+1') ]);

   
        return redirect($find->url);
    }

    public function show($id)
    {
       $single = ShortUrl::find($id)->with('referers')->first();
       return view('show', compact('single'));
    }


}
