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
        <div class="panel-head"><strong class="icon-reorder"> 权限管理</strong></div>
        <div class="padding border-bottom">
            <ul class="search">
                <li>
                    <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
                    <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
                        新增权限
                    </button>
                </li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="120">ID</th>
                <th>角色名称</th>
                <th>Urls</th>
                <th>操作</th>
            </tr>
            <?php foreach($data as $val):?>
                <tr>
                    <td><input type="checkbox" name="id[]" value="1" />&nbsp;&nbsp;&nbsp;<?= $val['power_id']?></td>
                    <td><?= $val['power_name']?></td>
                    <td><?= $val['route']?></td>
                    <td>
                        <div class="button-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="edit(<?= $val['power_id']?>)">
                                编辑
                            </button>
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
                <h4 class="modal-title" id="myModalLabel">编辑权限</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="power_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">权限名称:</label>
                        <input type="email" class="form-control" id="power_name" placeholder="权限名称">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Urls名称:</label>
                        <textarea class="form-control" id="route" placeholder="路由url,多个用逗号隔开"></textarea>
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
                <h4 class="modal-title" id="myModalLabel">添加权限</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">权限名称:</label>
                        <input type="email" class="form-control" id="powername" placeholder="权限名称">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Urls名称:</label>
                        <textarea class="form-control" id="routes" placeholder="路由url,多个用逗号隔开"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="addpower()">添加</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    //根据id 获取相关的信息
    function edit(id)
    {
        var power = id;
        $.get('powerlist',{'power_id':power},
            function(msg) {
                var obj = $.parseJSON(msg);
                $("#power_name").val(obj.power_name);
                $("#route").val(obj.route);
                $("#power_id").val(obj.power_id);
            });
    }
    //修改权限
    function update()
    {
        var power_name = $('#power_name').val();
        var route =$("#route").val();
        var power_id = $("#power_id").val();
        $.post('updatepower',{'power_id':power_id,'power_name':power_name,'route':route},
            function(msg){
                if(msg=="OK"){
                    alert("修改成功!");
                    $("#myModal").hide();
                    location.href="powerlist";
                }
            });
    }
    //新增权限
    function addpower()
    {
       var powername =$('#powername').val();
       var routes =$("#routes").val();
       $.get('addPower',{'powername':powername,'routes':routes},
             function(msg) {
                if(msg=="OK"){
                    alert("添加成功!");
                    $("#myModal2").hide();
                    location.href="powerlist";
                }
       });
    }
</script>