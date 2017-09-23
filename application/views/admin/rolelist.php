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
    <div class="panel-head"><strong class="icon-reorder"> 角色管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
<button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
                新增角色
            </button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>角色名称</th>
        <th>操作</th>       
      </tr>
        <?php foreach($data as $val):?>
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />&nbsp;&nbsp;&nbsp;<?= $val['role_id']?></td>
          <td><?= $val['role_name']?></td>
          <td>
              <div class="button-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="edit(<?= $val['role_id']?>)">
                      编辑
                  </button>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" onclick="getrolename(<?= $val['role_id']?>);">设置权限</button>
                  <a class="btn btn-danger" href="javascript:void(0)" onclick="return del(1)"><span class="icon-trash-o"></span>删除</a>
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
                <h4 class="modal-title" id="myModalLabel">编辑角色</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">角色名称:</label>
                        <input type="text" class="form-control" id="role_name" placeholder="角色名称">
                        <input type="hidden" id="roleid" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="update();">确定</button>
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
                <h4 class="modal-title" id="myModalLabel">添加新的角色</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">角色名称:</label>
                        <input type="text" class="form-control" id="rolename" placeholder="角色名称">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="addrole();">添加</button>
            </div>
        </div>
    </div>
</div>
<!-- 设置权限弹窗框 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="exampleModalLabel">给角色添加权限</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" id="ro_id">
          给<span class="role_name" style="color: red;font-size: 20px;"></span>设置权限:
          <div class="form-group111">
            <label for="recipient-name" class="control-label">选择权限:</label>
            <?php foreach ($array as $val):?>
            <input type="checkbox" value="<?= $val['power_id']?>" name="ro_id"><?= $val['power_name']?>
            <?php endforeach;?>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="addquanxian()">确认</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
// 添加新的角色 操作
function addrole()
{
  var rolename = $("#rolename").val();
  $.post('addrole', {'rolename':rolename},
   function(msg) {
    if(msg=="OK"){
      alert("添加成功!");
      $("#myModal2").hide();
      location.href="rolelist";
    }
  });
}
//根据id 获取相关的信息
    function edit(id)
    {
        var role_id = id;
        $.get('rolelist',{'role_id':id},
          function(msg) {
              if(msg!="false"){
                  $("#role_name").val(msg);
                  $("#roleid").val(role_id);
              }
        });
    }
    //更新用户数据
    function update()
    {
        var role_name = $('#role_name').val();
        var role_id =$("#roleid").val();
        $.post('updaterole',{'role_id':role_id,'role_name':role_name},
          function(msg){
            if(msg=="yes"){
              alert("修改成功!");
              $("#myModal").hide();
              location.href="rolelist";
            }
        });
    }
    //根据id 获取角色的名称
    function getrolename(id)
    {
      var role_id = id;
      $.get('getRoleName',{'role_id':role_id},
        function(msg) {
         var obj =$.parseJSON(msg);
        $('.role_name').text(obj.rolename);
        $('#ro_id').val(role_id);
        var power_id=obj.power_id;
        $("#exampleModal .form-group111 input[type=checkbox]").each(function(index, el) {
                      $(this).prop({
                        checked: false,
                      })
                  for (var i = 0; i<power_id.length; i++) {
                    if (power_id[i].power_id==($(this).val())) {
                      $(this).prop({
                        checked: true,
                      })
                    }
                  }
                });
      });
    }
    //提交权限
    function addquanxian()
    {
      var role_id = $('#ro_id').val();
      var obj = document.getElementsByName('ro_id');
      var s='';
      for(var i=0;i<obj.length;i++)
      {
        if(obj[i].checked){
          s+=obj[i].value+',';
        }
      }
      var powerid = s;
      $.get('roleAddPower',{'role_id':role_id,'powerid':s},function(msg) {
       if(msg=="OK"){
          alert('权限分配成功!');
          $("#exampleModal").hide();
          location.href="rolelist";
       }
      });
    }
</script>