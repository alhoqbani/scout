<?php

namespace App\Http\Controllers;

use App\Post;

class MysqlController extends Controller
{
    
    /**
     * @var \PDO
     */
    private $db;
    
    public function __construct()
    {
        $this->db = \DB::getPdo();
    }
    
    public function index(Post $post)
    {
        $sql = "SELECT id, title, MATCH (title,text) AGAINST
    ('الأضرار'
    IN NATURAL LANGUAGE MODE) AS score
    FROM articles WHERE MATCH (title,text) AGAINST
    ('الأضرار'
    IN NATURAL LANGUAGE MODE)";
        dd($post->search('Hamoud')->get(1));


//        $stmt = $this->db->query('SELECT * FROM Country');
//        while($conntry = $stmt->fetchObject()) {
//            echo $conntry->Name . ' <br> ';
//        }
//        $stmt1 = $this->db->query('INSERT INTO City (Name, CountryCode) VALUE (\'Jeddah\', \'SAR\')');
//        dd($this->db);
    
    }
}
