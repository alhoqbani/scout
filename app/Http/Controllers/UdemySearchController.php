<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UdemySearchController extends Controller
{
    
    const RESULTS_PER_PAGE = 3;
    /**
     * @var \Elasticsearch\Client
     */
    private $client;
    
    /**
     * UdemySearchController constructor.
     *
     * @param \Elasticsearch\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @internal param \Elasticsearch\Client $client
     *
     */
    public function index()
    {
        if (request()->has('q')) {
            $page = request()->input('page', 1);
            $q = request()->input('q');
            $from = ($page - 1) * self::RESULTS_PER_PAGE;
            $variables['page'] = $page;
            $variables['q'] = $q;
            $variables['from'] = $from;
            $startPrice = request()->input('startprice');
            $endPrice = request()->input('endprice');
    
            $queryArray = [
                'bool' => [
                    'must' => [],
                ],
            ];
            $tokens = explode(' ', $q);
            foreach ($tokens as $token) {
                $queryArray['bool']['must'][] = [
                    'match' => [
                        'name' => [
                            'query'     => $token,
                            'fuzziness' => 'AUTO',
                        ],
                    ],
                ];
            }
            if($startPrice && $endPrice) {
                $queryArray['bool']['filter']['range']['price'] = [
                    'gte' => $startPrice,
                    'lte' => $endPrice,
                ];
            }
            $params = [
                'index' => 'commerce',
                'type'  => 'products',
                'body'  => [
                    'query' => $queryArray,
                    'size'  => self::RESULTS_PER_PAGE,
                    'from'  => $from,
                ],
            ];
//            $results = $this->client->search($params);
            $results = $this->getFilters($params);
            $variables['hits'] = $results['hits']['hits'];
            $total = $results['hits']['total'];
            $to = ($page * self::RESULTS_PER_PAGE);
            $to = ($to > $total) ? $total : $to;
            $variables['total'] = $total;
            $variables['to'] = $to;
            
            $items = new LengthAwarePaginator(
                $variables['hits'], $total, self::RESULTS_PER_PAGE, $page, [
                    'query' => [
                        'q' => $q,
                        'startprice' => $startPrice,
                        'endtprice' => $endPrice,
                    ],
                    'path'  => 'udemy',
                    
                ]
            );
            $price_ranges = $results['aggregations']['price_range']['buckets'];
            
            return view('udemy.results', ['variables' => $variables, 'items' => $items, 'price_ranges' => $price_ranges]);
        }
        
        return view('udemy.index', compact('q'));
    }
    
    protected function getFilters(array $queryArray)
    {
        $price_range = [
            'range' => [
                'field'  => 'price',
                'ranges' => [
                    ['from' => 1, 'to' => 25],
                    ['from' => 25, 'to' => 50],
                    ['from' => 50, 'to' => 100],
                    ['from' => 100, 'to' => 1000],
                ],
            ],
        ];
        $queryArray['body']['aggs']['price_range'] = $price_range;

//        dd($queryArray);
        
        return $this->client->search($queryArray);
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
