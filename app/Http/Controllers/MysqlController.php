<?php

namespace App\Http\Controllers;

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
    
    public function index()
    {
//        $stmt = $this->db->query('SELECT * FROM Country');
//        while($conntry = $stmt->fetchObject()) {
//            echo $conntry->Name . ' <br> ';
//        }
        $stmt1 = $this->db->query('INSERT INTO City (Name, CountryCode) VALUE (\'Jeddah\', \'SAR\')');
        dd($this->db);
    
    }
}
