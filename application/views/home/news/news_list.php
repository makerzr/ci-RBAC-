<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>某某环保设备有限公司-模板之家</title>
    <meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<base href="<?php echo base_url()?>public/home/">
<link rel="alternate icon" type="image/png" href="images/favicon.png">
<link rel='icon' href='favicon.ico' type='image/x-ico' />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="css/default.min.css?t=227" />
<!--[if (gte IE 9)|!(IE)]><!-->
<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="lib/amazeui/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script type="text/javascript" src="lib/handlebars/handlebars.min.js"></script>
<script type="text/javascript" src="lib/iscroll/iscroll-probe.js"></script>
<script type="text/javascript" src="lib/amazeui/amazeui.min.js"></script>
<script type="text/javascript" src="lib/raty/jquery.raty.js"></script>
<script type="text/javascript" src="js/main.min.js?t=1"></script>
</head>
<body>
<header>
      <div class="header-top">
        <div class="width-center">
            <div class="header-logo "><img src="images/logo.png" alt=""></div>
            <div class="header-title div-inline">
                <strong>绿地环保设备有限公司</strong>
                <span>GREENBELT ENVIRONMENTAL COMPANY</span>
            </div>

            <div class="header-right">
                <span>全国咨询热线</span>
                <span>422-016-5966600</span>
            </div>



        </div>
    </div>
    <div class="header-nav">
        <button class="am-show-sm-only am-collapsed font f-btn" data-am-collapse="{target: '.header-nav'}">Menu <i
                class="am-icon-bars"></i></button>
        <nav>
        <ul class="header-nav-ul am-collapse am-in">
            <li class="on"><a href="<?php echo site_url('home/index/index')?>" name="index">网站首页</a></li>
            <li><a href="<?php echo site_url('home/about/index')?>" name="about">关于我们</a></li>
            <li><a href="<?php echo site_url('home/product/index')?>" name="show">工程案例</a></li>
            <li><a href="<?php echo site_url('home/news/index')?>" name="new">新闻资讯</a></li>
            <li><a href="<?php echo site_url('home/callme/index')?>" name="message">联系我们</a>
                <div class="secondary-menu">

                    <ul><li><a href="<?php echo site_url('home/message/index')?>" class="message"></a></li></ul>
                </div>
            </li>
        </ul>




        </nav>
    </div>

</header>
<div class="am-slider am-slider-default" data-am-flexslider="{playAfterPaused: 8000, controlNav: false, directionNav: false  }">
    <a class="prevbtn" href="#" onClick="javascript :history.back(-1);"></a>
    <div class="search-box">
        <div><input type="text" name="" placeholder="      请输入您需要的环保类别"></div>
        <div class="search-box-btn"></div>
    </div>
    <ul class="am-slides">
        <li><img src="images/banner.jpg" alt="" ></li>
        <li><img src="images/banner.jpg" alt="" ></li>
        <li><img src="images/banner.jpg" alt="" ></li>
        <li><img src="images/banner.jpg" alt="" ></li>
    </ul>
</div>
<div>
<style>
section.article-content>.article-protect-tab>span.infobox{
    position: relative;

}
section.article-content>.article-protect-tab>span.infobox .info{
    position: absolute;
    left: 0;
    right: 0;
    top:40px;
    background: url(images/message2.png) no-repeat center top;
    line-height: 40px;
    text-align:center;
    color: #fff;
    font-size: 14px;
    height: 40px;
    display: none;
}
section.article-content>.article-protect-tab>span.infobox:hover .info{
    display: block;
}

</style>

    <section class="article-content">
        <div class="article-protect-tab">
        <?php foreach($cates as $key=>$value){?>
            <span class='infobox'><a href="<?php echo site_url('home/News/catelist/?id=').$value['cate_id'];?>"><?php echo $value['cate_name']?></a>
                <div class="info">
                <?php foreach($value['son'] as $v){?>
                <a href="<?php echo site_url('home/News/catelist/?id=').$value['cate_id'];?>"><?php echo $v['cate_name'];?></a>
                <?php }?>
        
                </div>


            </span>
           

            <?php }?>
        </div>
        <div class="article-protect-body">
           <?php foreach($arr as $k=>$v){?>
            <img src="../../public/uploads/<?php echo $v['news_img']?>" style="width:380px;height:300px;">
            <?php }?>
            <ul>
            <?php foreach($news as $k=>$v){?>
                <li>
                    <a href="<?php echo site_url('home/News/content/?id=').$v['news_id'];?>">
                    <h3><?php echo $v['news_title']?></h3>
                    <span><?php echo date('Y-m-d',$v['add_time'])?></span>
                    </a>
                    <p><?php echo mb_substr($v['news_content'],0,100).'...'?></p>
                </li>
                <?php }?>
            </ul>
        </div>
    </section>
    <section class="article-content">
        <ul>
        <?php foreach($newlist as $k=>$v){?>
            <li>
            
                <div class="article-date">
                    <strong><?php echo $k+1?></strong>
                    <p><?php echo date('Y/m/d',$v['add_time'])?></p>
                    
                </div>
                <div class="article-info">
                    <a href="<?php echo site_url('home/News/content/?id=').$v['news_id'];?>">
                        <h3><?php echo $v['news_title']?></h3>
                        <i class="font">&#xe6aa;</i>
                        <p><?php echo mb_substr($v['news_content'],0,100).'...'?></p>
                        <span>2017/06/01</span>
                    </a>
                </div>
               
            </li>
             <?php }?>
        </ul>
    </section>
    <div class="article_list_more_pages">
        <ul>
            <li><a>上一页</a></li>
            <li class="article-current"><a>1</a></li>
            <li><a>2</a></li>
            <li><a>3</a></li>
            <li><a>下一页</a></li>
        </ul>
    </div>
    <div class="feature">
        <img class="sm" src="images/main5.jpg">
    </div>
</div>
<footer class="footer">
    <div class="footer-pc">
    <ul>
        <li><p>网站首页 | 关于我们 | 工程案例 | 新闻资讯 | 联系我们</p></li>
        <li><p>地址：湖北省大冶市东岳路街道4439号</p></li>
        <li><P>电话：0714-8868331</P></li>
        <li><p>邮编：435100</p></li>
        <li><span><a href="http://www.haothemes.com/" target="_blank" title="好主题">好主题</a>提供 - More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></span></li>
    </ul>
    <img src="images/qccode.png" alt="">
    </div>

    <div class="footer-phone">
        <button data-am-smooth-scroll class="am-btn am-btn-success">Top<i class="font">&#xe611;</i></button>
    </div>
</footer>
</body>
</html>