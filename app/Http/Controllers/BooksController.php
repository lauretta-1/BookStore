<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use App\Http\Resources\Resource\BookResource;
use App\Http\Resources\Collection\BookCollection;

class BooksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Book::latest();

        $filter = $request->query('filter');
        if(!empty($filter)){
            $books = $query->where('title', 'like', '%'.$filter.'%' )->orWhere('description', 'like', '%'.$filter.'%')
            ->orWhere('cover_image', 'like', '%'.$filter.'%')->orWhere('price', 'like', '%'.$filter.'%')
            ->orWhere('author', 'like', '%'.$filter.'%')->paginate(10);
        }else{
                $books = $query->paginate(10);
        }

        return BookResource::collection(Book::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        if(\Auth::user()->name == 'Darth Vader') {
 
            return response()->json(['message'=>'Sorry, You cannot publish your book on wookie'], 401);
                   
            }
else{
        if ($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');
            $originalname = $file->getClientOriginalName();
            $request->cover_image->storeAs('public/books/', $originalname);
        }
        $book = Book::create(array_merge(
            $request->validated(),
            [
                'author'=>\Auth::user()->id,
                'cover_image' => $request->cover_image->getClientOriginalName()
            ]
        ));

        return new BookResource($book);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BooksRequest $request, Book $book)
    {
    //    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $userId = $book->author;
        if(\Auth::user()->id == $userId){
            $book->delete();
            return ['status' => 'Deleted Successfully'];
        }else{
            return response()->json(['message'=>'Sorry, This book was not published by you'], 401);
        }
       
    }
}
