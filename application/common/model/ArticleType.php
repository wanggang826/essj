<?php
/**
 * Created by tiway
 * Date: 2017/9/15
 * Time: 16:23
 */

namespace app\common\model;


use traits\model\SoftDelete;

class ArticleType
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

}