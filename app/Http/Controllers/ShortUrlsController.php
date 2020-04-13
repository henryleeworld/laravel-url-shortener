<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\ShortUrls;

class ShortUrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortUrls = ShortUrls::latest()->get();
   
        return view('shortUrl', compact('shortUrls'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'url' => 'required|url'
        ]);
   
        $input['url'] = $request->url ;
        $input['code'] = Str::random(9);
   
        ShortUrls::create($input);
  
        return redirect('short-url/generate')
             ->with('success', 'Shorten Link Generated Successfully!');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectUrl($code)
    {
        $url = \Cache::rememberForever("short-url.$code", function () use ($code) {
            return ShortUrls::whereCode($code)->first();
        });

		if ($url !== null) {
            if ($url->hasExpired()) {
                abort(410);
            }
            $url->increment('counter');
            return redirect()->away($url->url, $url->couldExpire() ? 302 : 301);
        }
        abort(404);
    }
}
