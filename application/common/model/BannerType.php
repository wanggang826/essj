<?php
/**
 * Created by tiway
 * Date: 2017/9/15
 * Time: 9:39
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class BannerType extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
}