
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="/CI/public/admin/css/pintuer.css">
    <link rel="stylesheet" href="/CI/public/admin/css/admin.css">
    <link rel="stylesheet" href="/CI/public/admin/css/bootstrap.min.css">
    <script src="/CI/public/admin/js/jquery.js"></script>
    <script src="/CI/public/admin/js/pintuer.js"></script>
    <script src="/CI/public/admin/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 留言管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
                新增用户
            </button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>用户名</th> 
        <th>真实姓名</th>
        <th>手机号码</th>      
        <th>登录次数</th>
        <th>最近登录</th>
        <th>注册时间</th>
        <th>状态</th>
        <th>操作</th>       
      </tr>
        <?php foreach($array as $item):?>      
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />&nbsp;&nbsp;&nbsp;<?= $item['admin_id']?></td>
          <td><?= $item['admin_name']?></td>
          <td><?= $item['true_name']?></td>
          <td><?= $item['mobile']?></td>  
          <td><?= $item['logins']?></td>
          <td><?= date('Y-m-d H:i:s',$item['lastlogin'])?></td>
          <td><?= date('Y-m-d H:i:s',$item['reg_time'])?></td>
          <?php if($item['status']==1):?>
            <td><font color="green">正常</font></td>
            <?php else:?>
            <td><font color="red">禁用</font></td>
            <?php endif;?>
          <td>
              <div class="button-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="edit(<?=$item['admin_id']?>);">
                      编辑
                  </button>
                  <a class="btn btn-warning" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span> 删除</a>
              </div>
          </td>
        </tr>
      <?php endforeach;?>
      <tr>
        <td colspan="10"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){
		
	}
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>
<!--编辑出现弹框-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="myModalLabel">编辑用户</h4>
            </div>
            <div class="modal-body">
                <form>
                <input type="hidden" id="admin_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">用户名:</label>
                        <input type="email" class="form-control" id="admin_name" placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">用户密码:</label>
                        <input type="password" class="form-control" id="admin_pwd" placeholder="用户密码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">真实姓名:</label>
                        <input type="email" class="form-control" id="true_name" placeholder="真实姓名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">手机号码:</label>
                        <input type="email" class="form-control" id="mobile" placeholder="手机号码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">账号状态:</label>
                        <select for="exampleInputEmail1" id="status">
                            <option value="1" selected>正常</option>
                            <option value="0">禁用</option>
                        </select>
                    </div>
                    <div class="checkbox">
                        <p>所属角色:</p>
                        <div style="margin-left: 20px;">
                            <?php foreach ($data as $val ):?>      
                              <input type="checkbox" value="<?= $val['role_id']?>" name="role_id"><?=$val['role_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php endforeach;?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="update();">修改</button>
            </div>
        </div>
    </div>
</div>
<!-- 新增用户弹窗框 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="myModalLabel">添加新的用户</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">用户名:</label>
                        <input type="email" class="form-control" id="addadmin_name" placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">用户密码:</label>
                        <input type="password" class="form-control" id="addadmin_pwd" placeholder="用户密码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">真实姓名:</label>
                        <input type="email" class="form-control" id="addtrue_name" placeholder="真实姓名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">手机号码:</label>
                        <input type="email" class="form-control" id="addmobile" placeholder="手机号码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">账号状态:</label>
                        <select for="exampleInputEmail1" id="addstatus">
                            <option value="1" selected>正常</option>
                            <option value="0">禁用</option>
                        </select>
                    </div>
                    <div class="checkbox">
                        <p>所属角色:</p>
                        <div style="margin-left: 20px;">
                            <?php foreach ($data as $val ):?>      
                              <input type="checkbox" value="<?= $val['role_id']?>" name="addrole_id"><?=$val['role_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php endforeach;?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="addadmin();">添加</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    //判断和遍历 用户状态的函数
    function sele(sele,status) {
        $(sele).children('option').each(function () {
            $(this).prop("selected","");
            if($(this).val()==status){
                $(this).prop("selected","selected");
            }else if($(this).val()==status){
                $(this).prop("selected","selected");
            }
        })
    }
//根据id 获取相关的信息
    function edit(id)
    {
        var id = id;
        $.get('adminlist',{'id':id},
          function(msg) {
            var data = JSON.parse(msg);
              $('#admin_id').val(id);
              $('#admin_name').val(data.info.admin_name);
              $('#admin_pwd').val(data.info.admin_pwd);
               $('#true_name').val(data.info.true_name);
               $('#mobile').val(data.info.mobile);
                var status=data.info.status;
                sele('#status',status)
                var role = data.role;
                console.log(role);
                $("#myModal .checkbox input[type=checkbox]").each(function(index, el) {
                      $(this).prop({
                        checked: false,
                      })
                  for (var i = 0; i<role.length; i++) {
                    if (role[i].role_id==($(this).val())) {
                      $(this).prop({
                        checked: true,
                      })
                    }
                  }
                });
        });
    }
    //更新用户数据
    function update()
    {
        var admin_id =$("#admin_id").val();
        var admin_name = $('#admin_name').val();
        var admin_pwd =$('#admin_pwd').val();
        var true_name= $('#true_name').val();
        var mobile = $('#mobile').val();
        var status = $('#status').val();
        var obj=document.getElementsByName('role_id');
        var s=''; 
        for(var i=0; i<obj.length; i++){ 
        if(obj[i].checked) s+=obj[i].value+','; //如果选中，将value添加到变量s中 
        }
        var role_id =s;  
        $.post('updateadmin',{'admin_id':admin_id,'admin_name':admin_name,'admin_pwd':admin_pwd,'true_name':true_name,'mobile':mobile,'status':status,'role_id':role_id},
          function(msg){
            if(msg=="OK"){
              alert("修改成功!");
              $("myModal").hide();
              location.href="adminlist";
            }
        });
    }
    // 添加用户操作
    function addadmin()
    {
        var admin_name = $('#addadmin_name').val();
        if (admin_name=='') {
          alert("账号名称不能为空!");
          return false;
        }
        var admin_pwd =$('#addadmin_pwd').val();
        if (admin_pwd=='') {
          alert("账号密码不能为空!");
          return false;
        }
        var true_name= $('#addtrue_name').val();
        var mobile = $('#addmobile').val();
        var status = $('#addstatus').val();
        var obj=document.getElementsByName('addrole_id');
        var s=''; 
        for(var i=0; i<obj.length; i++){ 
        if(obj[i].checked) s+=obj[i].value+','; //如果选中，将value添加到变量s中 
        }
        var role_id =s;  
        $.post('addadmin',{'addadmin_name':admin_name,'addadmin_pwd':admin_pwd,'addtrue_name':true_name,'addmobile':mobile,'addstatus':status,'role_id':role_id},
          function(msg){
            if(msg=="yes"){
              alert("添加成功!");
              $("#myModal2").hide();
              location.href="adminlist";
            }
        });
    }
</script>