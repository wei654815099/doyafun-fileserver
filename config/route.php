<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use app\controller\File;
use Webman\Route;

/* main router */
Route::group("/api", function (){
    Route::post("/files", [File::class, "store"]);
    Route::delete("/file/{filename}", [File::class, "destroy"]);
});

// 关闭默认路由
Route::disableDefaultRoute();