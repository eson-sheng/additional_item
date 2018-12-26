<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018-12-25
 * Time: 16:25
 */

require_once __DIR__ . "/phpmail/class.phpmailer.php";
require_once __DIR__ . "/phpmail/class.smtp.php";

class TestUnitl
{
    public $config = NULL;

    /**
     * TestUnitl constructor.
     */
    public function __construct ()
    {
        /*配置文件加载*/
        $config = require __DIR__ . '/config/web.php';
        if (is_file(__DIR__ . '/config/local_web.php')) {
            $local_web = require __DIR__ . '/config/local_web.php';
            $config = array_merge($config, $local_web);
        }
        $this->config = $config;
    }

    /**
     * 入口调用方法
     */
    function index ()
    {
        $ret = $this->_shell_ex(["phpunit test.php"]);
        $bool = $this->_checkout_for_send($ret);

        /*获取html页面*/
        ob_start();
        require_once __DIR__ . "/view/index_html.php";
        $html = ob_get_contents();
        ob_end_clean();

        if ($bool) {
            $this->_send_mail($html);
        }

        echo "<h3>测试日志信息记录如下：</h3><hr><pre>{$ret}</pre>";
    }

    /**
     * 执行 shell 命令
     *
     * @param array $cmds
     * @return string
     */
    private function _shell_ex ($cmds)
    {
        $return_str = "\n";
        foreach ($cmds as $cmd) {
            $tmp_return = shell_exec("{$cmd} 2>&1");
            $return_str .= $tmp_return;
        }
        return $return_str;
    }

    /**
     * @param $ret
     * @return bool
     */
    private function _checkout_for_send ($ret)
    {
        // FAILURES!
        $pattern = "/(.*?)FAILURES!(.*?)/";
        if (preg_match($pattern, $ret, $match)) {
            $status = TRUE;
        } else {
            $status = FALSE;
        }
        return $status;
    }

    /**
     * @param $msg
     * @throws phpmailerException
     */
    private function _send_mail ($msg)
    {
        $rets = [];
        $subject = "单元测试预警";
        $froms = $this->config['mail']['send'];
        foreach ($froms AS $from) {
            /*发送邮件*/
            $rets[] = $this->_send($from, $subject, $msg);
            /*测试假装发邮件*/
//            $rets[] = $this->_send_test($from);
        }

        /*页面方便查看*/
        $html = '<h3>预警邮件发送状态：</h3>';
        $html .= '<ul>';
        foreach ($rets AS $ret) {
            $html .= "<li>";
            $html .= "<p>邮件发送信息：{$ret}</p>";
            $html .= "</li>";
        }
        $html .= '</ul>';
        echo $html;
    }

    /**
     * @param $to
     * @return false|string
     */
    private function _send_test ($to)
    {
        return json_encode([
            'to' => $to,
            'status' => TRUE,
            'errmsg' => "Message sent!",
        ]);
    }

    /**
     * @param $to
     * @param $subject
     * @param $msg
     * @return false|string
     * @throws phpmailerException
     */
    private function _send ($to, $subject, $msg)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'HTML';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.163.com';
        $mail->Port = '465';
        $mail->CharSet = "utf-8";
        $mail->SMTPSecure = 'ssl';

        //配置
        $mail->Username = $this->config['mail']['from']['uname'];
        $mail->Password = $this->config['mail']['from']['passd'];
        $mail->setFrom(
            $this->config['mail']['from']['address'],
            $this->config['mail']['from']['name']
        );

        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->MsgHTML($msg);

        if (!$mail->send()) {
            return json_encode([
                'to' => $to,
                'status' => FALSE,
                'errmsg' => "Mailer Error: " . $mail->ErrorInfo,
            ]);
        } else {
            return json_encode([
                'to' => $to,
                'status' => TRUE,
                'errmsg' => "Message sent!",
            ]);
        }
    }
}

$obj = new TestUnitl();
$obj->index();