<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-ERP</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="<?= STA ?>/css/font.css">
    <link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
    <script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.mini.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
</head>

<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a>
              <cite>物流发货</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/order/integralorder_list' ?>">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="开始日期" value="<?php echo $start ?>" name="start" id="start"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="截止日期" value="<?php echo $end ?>" name="end" id="end"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                <i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>真实姓名</th>
                            <th>联系电话</th>
                            <th>商家名称</th>
<!--                            <th>联系邮箱</th>-->
                            <th>商品图片</th>
                            <th>订单状态</th>
                            <th>合作事宜</th>
                            <th>原因</th>
                            <th>提交时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['ogid'] ?>" sid="<?= $once['ogid'] ?>">
                                    <td><?= $once['truename'] ?></td>
                                    <td><?= $once['mobile'] ?></td>
                                    <td><?= $once['shopname'] ?></td>
<!--                                    <td>--><?//= $once['email'] ?><!--</td>-->
                                    <td><img src="<?= $once['gimg'] ?>" style="width: 50px;height: 50px;"></td>
                                    <?php if ($once['ostate']==1){ ?>
                                        <td style="color: #ff820b;">审核中</td>
                                    <?php }elseif ($once['ostate']==2){ ?>
                                        <td style="color: green;">已通过</td>
                                    <?php }elseif ($once['ostate']==3){ ?>
                                        <td style="color: red;">已驳回</td>
                                    <?php }else{ ?>
                                        <td style="color: red;">数据错误</td>
                                    <?php } ?>
                                    <td>
                                        <button class="layui-btn layui-btn-warm"
                                                onclick="xadmin.open('申请详情','<?= RUN . '/examine/task_examine_details1?ogid=' ?>'+<?= $once['ogid'] ?>,900,500)">
                                            <i class="layui-icon">&#xe60b;</i>查看
                                        </button>
                                    </td>
                                    <td><?= $once['tareject'] ?></td>
                                    <td><?= date('Y-m-d H:i:s', $once['addtime']) ?></td>
                                    <td class="td-manage">
                                        <?php if ($once['ostate']==1){ ?>
                                            <button class="layui-btn layui-btn-normal"
                                                    onclick="xadmin.open('审核操作','<?= RUN . '/examine/goods_examine?ogid=' ?>'+<?= $once['ogid'] ?>,900,250)">
                                                <i class="layui-icon">&#xe642;</i>通过
                                            </button>
                                            <button class="layui-btn layui-btn-danger"
                                                    onclick="xadmin.open('审核操作','<?= RUN . '/examine/goodsno_examine?ogid=' ?>'+<?= $once['ogid'] ?>,900,250)">
                                                <i class="layui-icon">&#xe642;</i>驳回
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" style="text-align: center;">暂无数据</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <?= $pagehtml ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });
            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });
</script>
</html>
