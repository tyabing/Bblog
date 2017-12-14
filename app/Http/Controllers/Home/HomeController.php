<?php
/*
 * @Author: DingBing 
 * @Date: 2017-12-14 19:15:33 
 * @Last Modified by: DingBing
 * @Last Modified time: 2017-12-14 19:20:13
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class HomeController extends Controller
{

    public function __construct(){
        
        // 载入皮肤
        $this->theme = env('DEFAULT_THEM','Pithy');
        
    }


}
