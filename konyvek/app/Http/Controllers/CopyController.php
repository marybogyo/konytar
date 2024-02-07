<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CopyController extends Controller
{
    public function index(){
        $copy = response()->json(Copy::all());
        return $copy;
    }

    public function show($id){
        $copy = response()->json(Copy::find($id));
        return $copy;
    }

    public function store(Request $request){
        $copy = new Copy();
        $copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->publication = $request->publication;
        $copy->status = $request->status;
        $copy->save();
    }

    public function update(Request $request, $id){
        $copy = Copy::find($id);
        $copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->publication = $request->publication;
        $copy->status = $request->status;
        $copy->save();
    }

    public function destroy($id){
        Copy::find($id)->delete();
    }

    public function HAuthorTitle($hardcovered) {
        $books = DB::table('copies as c')	//egy tábla lehet csak
	    ->select('author', 'title')		//itt nem szükséges
        ->join('books as b' ,'c.book_id','=','b.book_id') //kapcsolat leírása, akár több join is lehet
        ->where('hardcovered', $hardcovered) 	//ez csak a copiesban van
        ->get();			//esetleges aggregálás; ha select, akkor get() a vége
        return $books;
    }

    public function ev($year) {
        $copies = Copy::whereYear('publication', $year)	//egy tábla lehet csak
	    ->join('books' ,'copies.book_id','=','books.book_id') //kapcsolat leírása, akár több join is lehet
        ->select('copies.copy_id', 'books.author','books.title')
        ->get();			//esetleges aggregálás; ha select, akkor get() a vége
        return $copies ;
    }

}

