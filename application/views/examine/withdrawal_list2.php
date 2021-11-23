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
              <cite>ERP系统Demo页面</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">数据统计</div>
				<div class="layui-card-body ">
					<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>成本总金额（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice1)?0.00:$orderprice1 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>利润总金额（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice2)?0.00:$orderprice2 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>数量总金额（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice3)?0.00:$orderprice3 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>等等等等等（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice4)?0.00:$orderprice4 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>等等等等等（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice5)?0.00:$orderprice5 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>等等等等等（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice5)?0.00:$orderprice5 ?></cite></p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/examine/withdrawal_list2' ?>">
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
				<a href="#">
					<button onclick="xadmin.open('添加','<?= RUN . '/users/users_add5' ?>',900,500)" class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 130px;"><i class="layui-icon"></i>添加处理
					</button>
				</a>
				<a href="#">
					<button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"><i class="layui-icon"></i>导出处理
					</button>
				</a>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
							<th>原料时间</th>
							<th>原料类型</th>
							<th>原料状态</th>
							<th>原料总金额</th>
							<th>原料费</th>
							<th>原料小费</th>
							<th>原料保价费</th>
							<th>原料抽成费</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
									<?php if ($once['order_type']==1){ ?>
										<td>类型1</td>
									<?php }elseif ($once['order_type']==2){ ?>
										<td>类型2</td>
									<?php }elseif ($once['order_type']==3){ ?>
										<td>类型3</td>
									<?php }elseif ($once['order_type']==4){ ?>
										<td>类型4</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
									<?php if ($once['status']==7){ ?>
										<td>状态1</td>
									<?php }elseif ($once['order_status']==1){ ?>
										<td>状态2</td>
									<?php }elseif ($once['order_status']==2){ ?>
										<td>状态3</td>
									<?php }elseif ($once['order_status']==3){ ?>
										<td>状态4</td>
									<?php }elseif ($once['order_status']==4){ ?>
										<td>状态5</td>
									<?php }elseif ($once['order_status']==5){ ?>
										<td>状态6</td>
									<?php }elseif ($once['order_status']==6){ ?>
										<td>状态7</td>
									<?php }elseif ($once['order_status']==7){ ?>
										<td>状态8</td>
									<?php }elseif ($once['order_status']==8){ ?>
										<td>状态9</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
									<td><?= empty($once['price'])?0.00:$once['price'] ?>元</td>
									<td><?= empty($once['order_driver_price'])?0.00:$once['order_driver_price'] ?>元</td>
									<td><?= empty($once['tip_price'])?0.00:$once['tip_price'] ?>元</td>
									<td><?= empty($once['protect_price'])?0.00:$once['protect_price'] ?>元</td>
									<td><?= empty($once['cost_price'])?0.00:$once['cost_price'] ?>元</td>
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
