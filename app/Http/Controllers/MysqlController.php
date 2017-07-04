<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
        dd($post->search('Hamoud')->paginate(1));
        
        
        
//        $stmt = $this->db->query('SELECT * FROM Country');
//        while($conntry = $stmt->fetchObject()) {
//            echo $conntry->Name . ' <br> ';
//        }
//        $stmt1 = $this->db->query('INSERT INTO City (Name, CountryCode) VALUE (\'Jeddah\', \'SAR\')');
//        dd($this->db);
    
    }
}
