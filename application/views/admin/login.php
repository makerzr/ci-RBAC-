<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>登录</title>  
    <link rel="stylesheet" href="/CI/public/admin/css/pintuer.css">
    <link rel="stylesheet" href="/CI/public/admin/css/admin.css">
    <script src="/CI/public/admin/js/jquery.js"></script>
   <!--  <script src="js/pintuer.js"></script>   -->
</head>
<body>
<div class="bg"></div>
<div class="container">
    <div class="line bouncein">
        <div class="xs6 xm4 xs3-move xm4-move">
            <div style="height:150px;"></div>
            <div class="media media-y margin-big-bottom">           
            </div>         
            <div class="panel loginbox">
                <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input input-big" id="name" placeholder="登录账号" data-validate="required:请填写账号" />
                            <span class="icon icon-user margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input input-big" id="password" placeholder="登录密码" data-validate="required:请填写密码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input input-big" name="code" placeholder="填写右侧的验证码" id="code" data-validate="required:请填写右侧的验证码" />
                   
                                <img src="code" class="passcode" alt="" style="height:43px;cursor:pointer;" onclick= this.src="code/"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"/>                 
                        </div>
                    </div>
                </div>
                <div style="padding:30px;"><input type="button" class="button button-block bg-main text-big input-big login-btn" value="登录"></div>
            </div>       
        </div>
    </div>
</div>
<script type="text/javascript">
    
  $('.login-btn').click(function(){
      var name = $("#name").val();
      if(name==''){
        alert('用户名不能为空!');
        return false;
      }
      var password = $('#password').val();
      if(password==''){
        alert('密码不能为空!');
        return false;
      }
      var code =$('#code').val();
      if(code==''){
        alert('验证码不能为空!');
        return false;
      }
      $.post('login', {'name':name,'password':password,'code':code}, 
        function(msg) {
         if(msg=="adminnonull"){
            alert("小子,用户名不能为空!");
            return false;
         }else if(msg=="pwdnonull"){
            alert("小子,密码不能为空!");
            return false;
         }else if(msg=="codenonull"){
            alert("小子,验证码不能为空!");
            return false;
         }else if(msg=="codenoright")
         {
            alert("小子,验证码不正确!");
            return false;
         }else if(msg=="nameorpwdnoright")
         {
            alert("用户名或者密码不正确!");
            return false;
         }else if(msg=="goindex")
         {
            location.href="index";
         }
      });
  })


</script>
</body>
</html>