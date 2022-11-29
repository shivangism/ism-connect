<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedImages;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Feed::all();
    }
    public function returnFeedImages(Request $request)
    {
        $request->validate([
            'feed_id'=> 'required',
        ]);        
        return FeedImages::where('feed_id',$request->input('feed_id'))->get();

    }
    public function returnFeeds(Request $request)
    {
        $feed =  Feed::where('user_id',$request->input('user_id'))->get();
        $sz = count($feed);
        for($i=0;$i<$sz;$i++)
        {
            $feed[$i]["items"] = FeedImages::where('feed_id',$feed[$i]["id"])->get();
        }
        return $feed;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'feed_heading'=> 'required',
            'username'=> 'required',
            'image_path'=> 'required',
            'userid'=> 'required',
            'content'=> 'required',
        ]);

        return Feed::create($request->all(['feed_heading','username','image_path','userid','content',]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Feed::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $item = Feed::find($id);
        return $item->update($request->all(['feed_heading','username','image_path','userid','content',]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Feed::find($id);
        return $item->delete();
    }
}
