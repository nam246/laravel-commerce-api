<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;

use App\Http\Controllers\Controller;
use App\Models\Articles;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($request)
    {
        var_dump($request);
        // $articles = Articles::paginate(10);
        // return response()->json($articles, 200);

    }


    /*
     * Display 1 by Id
     */

    public function getById($id)
    {
        // $article = Articles::get()->whereRaw('id', $id);

        $article = DB::table('articles')->whereRaw('id = ' . $id)->get();

        return response()->json($article, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticlesRequest $request)
    {
        if ($request) {
            
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $image_path = $request->file('image')->store('image', 'public');
    
            $validatedData['image'] = $request->files('image')->store('image');

            $item = Articles::create($request->all());

            return response()->json('Article created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticlesRequest $request, Articles $articles)
    {
        $item = Articles::find();
        $item->field1 = 'new_value1';
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Articles::where('id', $id)->delete();
        return [
            'message' => 'Deleted successfully',
        ];
    }
}
