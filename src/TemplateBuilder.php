<?php

namespace GeTui;

use GeTui\igetui\template\IGtLinkTemplate;
use GeTui\igetui\template\IGtNotificationTemplate;
use GeTui\igetui\template\IGtNotyPopLoadTemplate;
use GeTui\igetui\template\IGtTransmissionTemplate;
use GeTui\igetui\IGtAPNPayload;
use GeTui\igetui\DictionaryAlertMsg;


class TemplateBuilder {
    /**
     * @var string 个推后台应用的AppID
     */
    private $_appId = '';

    /**
     * @var string 个推后台应用的MasterSecret
     */
    private $appKey = '';

    public function __construct($appId, $appKey) {
        $this->_appId = $appId;
        $this->_appKey = $appKey;
    }

    public function IGtLinkTemplate() {
        $template = new IGtLinkTemplate();
        $template->set_appId($this->_appId);//应用appid
        $template->set_appkey($this->_appKey);//应用appkey
        $template->set_title("请输入通知标题");//通知栏标题
        $template->set_text("请输入通知内容");//通知栏内容
        $template->set_logo("");//通知栏logo
        $template->set_isRing(true);//是否响铃
        $template->set_isVibrate(true);//是否震动
        $template->set_isClearable(true);//通知栏是否可清除
        $template->set_url("http://www.igetui.com/");//打开连接地址
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        return $template;
    }

    public function IGtNotificationTemplate() {
        $template = new IGtNotificationTemplate();
        $template->set_appId($this->_appId);//应用appid
        $template->set_appkey($this->_appKey);//应用appkey
        $template->set_transmissionType(1);//透传消息类型
        $template->set_transmissionContent("测试离线");//透传内容
        $template->set_title("个推");//通知栏标题
        $template->set_text("个推最新版点击下载");//通知栏内容
        $template->set_logo("http://wwww.igetui.com/logo.png");//通知栏logo
        $template->set_isRing(true);//是否响铃
        $template->set_isVibrate(true);//是否震动
        $template->set_isClearable(true);//通知栏是否可清除
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        return $template;
    }

    /**
     * xxxxxxx
     *
     * @access public
     * @param string $content 透传内容 [Must]
     * @return object IGtTransmissionTemplate
     */
    public function IGtTransmissionTemplate($content = '') {
        $template = new IGtTransmissionTemplate();
        $template->set_appId($this->_appId);//应用appid
        $template->set_appkey($this->_appKey);//应用appkey
        $template->set_transmissionType(1);//透传消息类型
        $template->set_transmissionContent($content);//透传内容
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //APN简单推送
       // $template = new IGtAPNTemplate();
       // $apn = new IGtAPNPayload();
       // $alertmsg=new SimpleAlertMsg();
       // $alertmsg->alertMsg="";
       // $apn->alertMsg=$alertmsg;
       // // $apn->badge=2;
       // // $apn->sound="";
       // $apn->add_customMsg("payload","payload");
       // $apn->contentAvailable=1;
       // $apn->category="ACTIONABLE";
       // $template->set_apnInfo($apn);
       // $message = new IGtSingleMessage();

        //APN高级推送
        $apn = new IGtAPNPayload();
        $alertmsg = new DictionaryAlertMsg();
        $alertmsg->body = "body";
        $alertmsg->actionLocKey = "ActionLockey";
        $alertmsg->locKey = "LocKey";
        $alertmsg->locArgs = array("locargs");
        $alertmsg->launchImage = "launchimage";
       // IOS8.2 支持
        $alertmsg->title = "Title";
        $alertmsg->titleLocKey = "TitleLocKey";
        $alertmsg->titleLocArgs = array("TitleLocArg");

        $apn->alertMsg = $alertmsg;
        $apn->badge = 7;
        $apn->sound = "";
        $apn->add_customMsg("payload", "payload");
        $apn->contentAvailable = 1;
        $apn->category = "ACTIONABLE";
        //$template->set_apnInfo($apn);

        return $template;
    }


    //所有推送接口均支持四个消息模板，依次为通知弹框下载模板，通知链接模板，通知透传模板，透传模板
    //注：IOS离线推送需通过APN进行转发，需填写pushInfo字段，目前仅不支持通知弹框下载功能
    function IGtNotyPopLoadTemplate() {
        $template = new IGtNotyPopLoadTemplate();

        $template->set_appId($this->_appId);//应用appid
        $template->set_appkey($this->_appKey);//应用appkey
        //通知栏
        $template->set_notyTitle("个推");//通知栏标题
        $template->set_notyContent("个推最新版点击下载");//通知栏内容
        $template->set_notyIcon("");//通知栏logo
        $template->set_isBelled(true);//是否响铃
        $template->set_isVibrationed(true);//是否震动
        $template->set_isCleared(true);//通知栏是否可清除
        //弹框
        $template->set_popTitle("弹框标题");//弹框标题
        $template->set_popContent("弹框内容");//弹框内容
        $template->set_popImage("");//弹框图片
        $template->set_popButton1("下载");//左键
        $template->set_popButton2("取消");//右键
        //下载
        $template->set_loadIcon("");//弹框图片
        $template->set_loadTitle("地震速报下载");
        $template->set_loadUrl("http://dizhensubao.igexin.com/dl/com.ceic.apk");
        $template->set_isAutoInstall(false);
        $template->set_isActived(true);
        //$template->set_notifyStyle(0);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

        return $template;
    }
}