<?php
/**
 * Created by tiway
 * Date: 2017/9/15
 * Time: 9:02
 */

use think\Route;


// 注册路系统信息
Route::get(['admin/basedata/msg_info'=>'admin/basedata/article_info?type_id=1']);
//积分制度
Route::get(['admin/basedata/integral_info'=>'admin/basedata/article_info?type_id=2']);
//帮助中心
Route::get(['admin/basedata/help_info'=>'admin/basedata/article_info?type_id=3']);
//头条列表
Route::get(['admin/basedata/headline_info'=>'admin/basedata/article_info?type_id=4']);
//关于我们
Route::get(['admin/set/aboutus_info'=>'admin/basedata/article_info?type_id=5']);
//产品介绍
Route::get(['admin/set/productsdes_info'=>'admin/basedata/article_info?type_id=6']);