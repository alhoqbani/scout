<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UdemySearchController extends Controller
{
    
    const RESULTS_PER_PAGE = 3;
    
    /**
     * Display a listing of the resource.
     *
     * @param \Elasticsearch\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        if (request()->has('q')) {
            $page = request()->input('page', 1);
            $q = request()->input('q');
            $from = ($page - 1) * self::RESULTS_PER_PAGE;
            $variables['page'] = $page;
            $variables['q'] = $q;
            $variables['from'] = $from;
            $params = [
                'index' => 'commerce',
                'type'  => 'products',
                'body'  => [
                    'query' => [
                        'match' => [
                            'name' => $q,
                        ],
                    ],
                    'size'  => self::RESULTS_PER_PAGE,
                    'from'  => $from,
                ],
            ];
            $results = $client->search($params);
            $variables['hits'] = $results['hits']['hits'];
            $total = $results['hits']['total'];
            $to = ($page * self::RESULTS_PER_PAGE);
            $to = ($to > $total) ? $total : $to;
            $variables['total'] = $total;
            $variables['to'] = $to;
            
            $items = new LengthAwarePaginator(
                $variables['hits'], $total, self::RESULTS_PER_PAGE, $page, [
                    'query' => ['q' => $q],
                    'path'  => 'udemy',
                ]
            );
            
            return view('udemy.results', ['variables' => $variables, 'items' => $items]);
        }
        
        return view('udemy.index', compact('q'));
    }
    
    public function search()
    {
    
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
