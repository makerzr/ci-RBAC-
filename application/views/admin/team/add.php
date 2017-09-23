<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<base href="<?php echo base_url()?>public/admin/">
<link rel="stylesheet" href="css/pintuer.css">
<link rel="stylesheet" href="css/admin.css">
<script src="js/jquery.js"></script>
<script src="js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo site_url('admin/Manage/userinsert')?>" enctype="multipart/form-data">  
      <div class="form-group">
        <div class="label">
          <label>成员头像：</label>
        </div>
        <div class="field">
          <input type="file" class="" value="" name="team_img" data-validate="required:请上传" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>成员姓名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="team_name" data-validate="required:请输入姓名" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>成员职位：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="team_position" data-validate="required:请输入职位" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>成员发言：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="team_manifo" data-validate="required:请输入发言" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>