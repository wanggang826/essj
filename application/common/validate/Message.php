<?php
namespace app\common\validate;
use think\Validate;

class Message extends Validate{
    protected $rule = [
        ['title',          'require',                        '标识不能为空'],
        ['content',        'require',                        '消息内容不能为空'],
        ['send_uid',       'require',                        '发送者不能为空'],
        ['receive_uid',    'require',                        '接收者不能为空'],
        ['flag',           'require',                        '消息类型不能为空'],

    ];
    protected $scene = [
        'add'   => ['title','content','send_uid','receive_uid','flag'],
        'edit'	=>	['title','content','send_uid','receive_uid','flag'],
    ];    
}