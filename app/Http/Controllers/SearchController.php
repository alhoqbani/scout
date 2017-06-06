<?php

namespace App\Http\Controllers;

use App\ElasticSearch;
use App\PostRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    protected $elasticSearch;
    
    public function __construct()
    {
        $this->elasticSearch = new ElasticSearch();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->input('q');
        $results = PostRepository::searchBody($q);
        dump($results);
        return view('search.index', compact('q'));
    }
    
    public function search()
    {
//        return $this->elasticSearch->emptySearch();
//        return $this->elasticSearch->searchIndex('gb,us');
//        return $this->elasticSearch->searchType('user');
//        return $this->elasticSearch->parameters(['q' => 'mary', 'type' => 'user']);
        return $this->elasticSearch->paginate(3, 2);
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
        //
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
        //
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
    }
}
