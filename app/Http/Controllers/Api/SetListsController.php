<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SetLists;
use Illuminate\Http\Request;

class SetListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setlists = SetLists::where('title', 'like', '%'.$request->query('search').'%')
                            ->Orderby('created_at','Desc')
                            ->paginate(10);

        return response()->json($setlists, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newSetList = new SetLists();
        $newSetList->title = $request["title"];
        $newSetList->thumbnail = $request["thumbnail"];
        $newSetList->store = $request["store"];
        $newSetList->artists_id = $request["artistsId"];
        $newSetList->save();
        return response()->json($newSetList, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setList = SetLists::find($id);

        return response()->json($setList, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $setList = SetLists::find($id);

        if($setList){
            $setList->title = $request["title"];
            $setList->thumbnail = $request["thumbnail"];
            $setList->store = $request["store"];
            $setList->save();
        }

        return response()->json($setList, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setList = SetLists::find($id);

        try{
            $setList->delete();
            $response = [
                'message' => 'setList Deleted',
            ];

            return response()->json($response, 200);

        } catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'message' => 'Failed' . $e->getMessage(),
            ]);
        }
    }
}
