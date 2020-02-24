<?php

namespace App\Http\Controllers;

use App\Leaf;
use Illuminate\Http\Request;

class LeafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(is_int($request->input("bookId"))){
            $book = \App\Book::find(Array("id", $request->input("bookId")));
            $leaf = new \App\Leaf;
            $leaf->book_id = $request->input("bookId");
            if($request->input("style_id")){
                $leaf->style_id = $request->input("style_id");
            }
            $leaf->save();
            $newLeafId = $leaf->id();
            return( Array("leafId"=>$newLeafId) );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leaf  $leaf
     * @return \Illuminate\Http\Response
     */
    public function show(Leaf $leaf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leaf  $leaf
     * @return \Illuminate\Http\Response
     */
    public function edit(Leaf $leaf)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leaf  $leaf
     * @return \Illuminate\Http\Response
     */
    public function update( $bookId, $leafId )
    {
        $leaf = \App\Leaf::find($leafId);
        if($leaf){
            $attributes = request()->validate([
                "xPos" => "required",
                "yPos" => "required"
            ]);
            $leaf->xPos = $attributes['xPos'];
            $leaf->yPos = $attributes['yPos'];
            $leaf->update();
            return $leaf;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leaf  $leaf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leaf $leaf)
    {
        //
    }

    public function Style(){
        return $this->details["styleString"];
    }

}
