<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artists;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $artists = Artists::where('name', 'like', '%'.$request->query('search').'%')
                            ->withCount('setlists')
                            ->Orderby('name','asc')
                            ->paginate(10);

        return response()->json($artists, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newArtist = new Artists();
        $newArtist->name = $request["name"];
        // $newArtist->users_id = auth('sanctum')->user()->id;
        $newArtist->save();
        return response()->json($newArtist, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $artist = Artists::find($id);

        if($request["withSets"] == 'true'){
            $artistSets = $artist->setLists()->where('title', 'like', '%'.$request->query('search').'%')->paginate(10);
            return response()->json($artistSets, 200);
        }

        return response()->json($artist, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $artist = Artists::find($id);

        if($artist){
            $artist->name = $request["name"];
            $artist->save();
        }

        return response()->json($artist, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist = Artists::find($id);

        try{
            $artist->delete();
            $response = [
                'message' => 'Artist Deleted',
            ];

            return response()->json($response, 200);

        } catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'message' => 'Failed' . $e->getMessage(),
            ]);
        }
    }
}
