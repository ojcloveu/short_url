<?php

namespace App\Http\Controllers;

use App\User;
use App\Options;
use App\ShortUrl;
use App\refererDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $options = Options::all();
   
        return view('shortenLink', compact('shortLinks','options'));
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
  
        return redirect('/')
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
        $o = $request->input('o', null);
        $user = User::where('code', $k)->first();
        $option = Options::where('code', $o)->first();
        $userId = $user? $user->id:null;
        $optionId = $option? $option->name:null;
        $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
        $REQUEST_TIME = $_SERVER['REQUEST_TIME'];

        DB::beginTransaction();
        try {
            $find = ShortUrl::where('code', $code)->firstOrFail();
            $find->counter += 1;
            

            $refDetail = refererDetail::
                                where(['short_urls_id' => $find->id, 'remote_addr' =>  $REMOTE_ADDR])->
                                whereDate('created_at', Carbon::today())->get()->last();
            if(!$refDetail){
                $find->save();
                $ref = $find->referers()->updateOrCreate(['refer_name'=>$optionId,'user_id' => $userId], [   'counter' => DB::raw('counter+1') ]);

                $ref->refererDetails()->updateOrCreate(['short_urls_id'=>$find->id,'remote_addr' => $REMOTE_ADDR,'created_at'=> Carbon::today()],
                 ['refer_name'=> $optionId,'request_at' => $REQUEST_TIME,   'counter' => DB::raw('counter+1') ,'user_id' => $userId]);

            }
            
            


            DB::commit();
            return redirect($find->url);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $e->getMessage();
        }  
    }

    public function show($id)
    {
       $single = ShortUrl::findOrFail($id);
       $options = Options::all();
       return view('show', compact('single','options'));
    }


}
