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
    <form method="post" class="form-x" action="<?php echo site_url('admin/News/newsupdate')?>" enctype="multipart/form-data"> 
   <input type="hidden" name='id' value="<?php echo $row[0]['news_id']?>"> 
      <div class="form-group">
        <div class="label">
          <label>新闻图片：</label>
        </div>
        <div class="field">
          <input type="file" class="" value="" name="news_img" data-validate="required:" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>新闻标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo $row[0]['news_title']?>" name="news_title" data-validate="required:请输入新闻标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>新闻内容：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo $row[0]['news_content']?>" name="news_content" data-validate="required:请输入新闻内容" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>所属分类：</label>
        </div>
        <div class="field">
           <select name="cate_id" id="">
          <?php foreach($newsarr as $k=>$v){?>
          <option value="<?php echo $k?>"><?php echo $v?></option>
          <?php }?>
          </select>
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