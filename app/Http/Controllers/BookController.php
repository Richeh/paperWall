<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = \App\Book::all();
        return view("book/index", Array("books"=>$books));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $book = new \App\Book();

            $attributes = request()->validate([
                "title" => "required"
            ]);
        $book->title = $attributes['title'];
        $book->owner = 1;
        $book->save();
        return redirect("/books/");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        $book = \App\Book::find($bookId);
        return view("book/show", Array("book"=>$book));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
        $book = \App\Book::find($bookId);
        return view("book/edit", Array("book"=>$book));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update($bookId)
    {
        
        $book = \App\Book::find($bookId);
        $attributes = request()->validate([
            "title" => "required"
        ]);
        $book->title = $attributes['title'];
        $book->save();
        return redirect("/books/".$book->id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        
        $book = \App\Book::find($bookId);
        $leaves = $book->Leafs()->get();
        foreach( $leaves as $leaf ){
            $leaf->delete();
        }
        $book->delete();
        return redirect("/books/");
    }
}
