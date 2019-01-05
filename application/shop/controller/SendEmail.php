<?php
namespace app\shop\controller;
use extend\PhpMailer;
use extend\PhpmailerException;
use extend\SMTP;
use extend\Encrypt;
/**
 * 邮件发送控制器
 * @author wanggang 2017/6/27
 * 
 * Class SendMail PHP邮件发送类
 * @param $tomail 接收邮件者邮箱
 * @param $toname 接收邮件者名称
 * @param $subject 邮件主题
 * @param $body_info 邮件内容相关信息
 * @param $attachment 附件列表
 * @param $date_timezone 默认时区 PRC
 * @param $charset 默认字符集 UTF-8
 * @return true false
 */
class SendEmail extends MallBase{
	//发送邮件
    public static function send_mail($tomail, $toname, $subject = '', $body_info=array(),$attachment = null,$date_timezone='PRC',$charset='UTF-8')
    {
        //设置时区
        date_default_timezone_set($date_timezone);

        //实例化邮件对象
      
        import('PhpMailer', EXTEND_PATH);
        $mail = new PhpMailer();
        $email_config = model('config')->where('group','email')->field('config_mark,config_value')->select();
        resultToArray($email_config);
        $data = array();
        foreach ($email_config as $key => $value) {
        	$data[$value['config_mark']] = $value['config_value'];
        }
        $body    = $data['EMAIL_BODY'];
        $body    = str_replace('{$act}',$body_info['action_name'],$body);
        $user_id =  Encrypt::authcode(session('user.user_id'),'ENCODE'); //加密
        $link    = config('STATIC_URL').url('UserCenter/check_code',['user_id'=>$user_id]);
        $re_link = stripslashes("<a href='".$link."'>".$link."</a>");
        $body    = str_replace('{$link}',$re_link,$body);
        $body    = str_replace('{$code}',$body_info['code'],$body);
        // dump($body);die;
        //设置字符集
        $mail->CharSet = $charset;
        //使用SMTP服务
        $mail->isSMTP();
        //关闭调试模式 0=关闭 1=错误和消息 1=消息
        $mail->SMTPDebug = 0;
        //启用SMTP验证功能
        $mail->SMTPAuth = true;
        //使用安全协议
        $mail->SMTPSecure = $data['EMAIL_SMTPSECURE'];
        //SMTP 服务器
        $mail->Host = $data['EMAIL_HOST'];
        //SMTP端口号
        $mail->Port = $data['EMAIL_PORT'];
        //SMTP 用户名
        $mail->Username = $data['EMAIL_USERNAME'];
        //SMTP 密码
        $mail->Password = $data['EMAIL_PASSWORD'];
        //发件人地址，发件人名称
        $mail->setFrom($data['EMAIL_FROM'],$data['EMAIL_FROMNAME']);
        //回复地址 回复名称 留空默认为发件人地址和发件人名称
        $mail->addReplyTo('','');
        //邮件主题
        $mail->Subject = $data['EMAIL_SUBJECT'];
        //邮件内容
        $mail->msgHTML($body);
        //发送者地址和名称
        $mail->addAddress($tomail,$toname);
        //添加附件
        if( is_array($attachment) )
        {
            foreach($attachment as $file)
            {
                is_file($file) && $mail->addAttachment($file);
            }
        }
        //返回发送状态及信息
        if(!$mail->send()){
        	return array('status'=>2,'info'=>$mail->ErrorInfo);
        }else{
        	return array('status'=>1,'info'=>'发送成功');
        }
    }
}