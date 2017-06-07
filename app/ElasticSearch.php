<?php

namespace App;

use Elasticsearch\ClientBuilder;

class ElasticSearch
{
    
    /**
     * @var \Elasticsearch\Client
     */
    protected $client;
    protected $params = [];
    
    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
        $this->params['index'] = 'posts';
        $this->params['type'] = 'post_type';
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
    
    public function search($query)
    {
        $this->params['index'] = '_all';
        $this->params['type'] = null;
        $this->params['body']['query']['match']['_all'] = $query;

//        dd($this->params);
        
        return $this->client->search($this->params);
    }
    
    public function searchIndex($index)
    {
        $this->params['index'] = $index;
        
        return $this->client->search($this->params);
    }
    
    public function searchType($type)
    {
        $this->params['index'] = '_all';
        $this->params['type'] = $type;
        
        return $this->client->search($this->params);
    }
    
    public function matchFields($query)
    {
        $this->params['body']['query']['match'] = $query;
        
        return $this->client->search($this->params);
    }
    
    /**
     * Search the query in all given fields
     *
     * @param $query
     * @param $fields
     *
     * @return array
     */
    public function matchMultiFields($query, $fields)
    {
        $this->params['body']['query']['multi_match'] = [
            'query'  => $query,
            'fields' => $fields,
        ];
        
        return $this->client->search($this->params);
    }
    
    public function withExplanation()
    {
        $this->params['explain'] = true;
        
        return $this;
    }
    
    public function explainThis($id, $query, $index = null, $type = null)
    {
        $this->params['index'] = $index ?? $this->params['index'];
        $this->params['type'] = $type ?? $this->params['type'];
        $this->params['id'] = $id;
//        $this->params['body']['query']['match'] = $query;
        $this->params['body']['query']['match']['_all'] = $query;
//        dd($this->params);
        return $this->client->explain($this->params);
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
        $this->params = array_merge($this->params, $params);
        
        return $this->client->search($this->params);
    }
    
    public function paginate($size, $from)
    {
        $this->params['size'] = $size;
        $this->params['from'] = $from;
        
        return $this->client->search($this->params);
    }
    
    public function getMapping($type = '', $index = '_all')
    {
        return $this->client->indices()->getMapping(compact(['index', 'type']));
    }
    
    public function analyze($text, $analyzer = 'standard')
    {
        return $this->client->indices()->analyze(compact(['analyzer', 'text']));
    }
    
    
}