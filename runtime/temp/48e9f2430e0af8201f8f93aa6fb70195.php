<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:45:"template/default_pc/html/user/ajax_login.html";i:1544280248;}*/ ?>
<div class="fed-part-mask fed-part-full fed-back-masks"></div>
<div class="fed-mode-info fed-event">
<div class="fed-part-layout fed-back-whits fed-anim fed-anim-scale">
<a class="fed-mode-close" href="javascript:;">×</a>
<div class="fed-user-login">
<div class="fed-list-head fed-part-rows fed-padding">
<h2 class="fed-font-xviii fed-text-center">会员登录</h2>
</div>
<form class="fed-user-form fed-user-width fed-part-rows" action="<?php echo mac_url('user/login'); ?>">
<input class="fed-user-text fed-col-xs12" type="text" name="user_name" placeholder="请输入账号" maxlength="16" />
<input class="fed-user-text fed-col-xs12" type="password" name="user_pwd" placeholder="请输入密码" maxlength="20" />
<input class="fed-user-text fed-col-xs8" type="tel" name="verify" placeholder="请输入验证码" maxlength="4" />
<img class="fed-user-code fed-user-text fed-col-xs4" height="45" src="<?php echo mac_url('verify/index'); ?>" onClick="this.src=this.src+'?'" title="看不清楚? 换一张！" />
<span class="fed-user-tips fed-text-gules fed-padding-v fed-visible fed-col-xs12">　</span>
<a class="fed-subm-login fed-user-submit fed-rims-info fed-btns-info fed-btns-green fed-col-xs12">登录</a>
<a class="fed-padding fed-col-xs3 fed-text-left" href="<?php echo mac_url('user/reg'); ?>">注册账号</a>


<a class="fed-padding<?php if($vfedcc['connect']['qq']['status']=='1') echo ' fed-col-xs3'; else echo ' fed-col-xs6'; ?> fed-text-center" href="<?php echo mac_url('user/oauth'); ?>?type=weixin">微信登录</a>

<a class="fed-padding<?php if($vfedcc['connect']['weixin']['status']=='1') echo ' fed-col-xs3'; else echo ' fed-col-xs6'; ?> fed-text-center" href="<?php echo mac_url('user/oauth'); ?>?type=qq">QQ登录</a>

<a class="fed-padding fed-col-xs6 fed-text-center" href="javascript:;">&nbsp;</a>

<a class="fed-padding fed-col-xs3 fed-text-right" href="<?php echo mac_url('user/findpass'); ?>">忘记密码</a>
</form>
</div>
</div>
</div>