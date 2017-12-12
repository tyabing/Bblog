<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
class CommonController extends Controller
{
    public $num;
    public function __construct(){   

        $this->num = DB::table('contacts')->count(); 
    }

}
?>