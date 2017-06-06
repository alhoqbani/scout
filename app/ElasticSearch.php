<?php

namespace App;

use Elasticsearch\ClientBuilder;

class ElasticSearch
{
    
    /**
     * @var \Elasticsearch\Client
     */
    protected $client;
    
    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }
    
    /**
     * returns all documents in all indices in the cluster
     *
     * @return array
     */
    public function emptySearch()
    {
        return $this->client->search();
    }
    
    public function searchIndex($index)
    {
        $params = [
            'index' => $index,
        ];
        
        return $this->client->search($params);
    }
    
    /**
     * @param array $params
     *
     * @return array
     * @internal param array $params
     *
     * @internal param array $type
     * @link     https://www.elastic.co/guide/en/elasticsearch/reference/current/search-uri-request.html#_parameters_3
     */
    public function parameters(array $params)
    {
        return $this->client->search($params);
    }
    
    public function paginate($size, $from)
    {
        $params = [
            'size' => $size,
            'from' => $from,
        ];
        return $this->client->search($params);
    }
    
    
}