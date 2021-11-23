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
              <cite>账单详情(代驾)</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">账单统计</div>
				<div class="layui-card-body ">
					<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>账单总金额（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice1)?0.00:$orderprice1 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>司机总金额（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice2)?0.00:$orderprice2 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>平台总抽成（单位：元）</h3>
								<p>
									<cite><?php echo empty($orderprice3)?0.00:$orderprice3 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>平台总小费（单位：元）</h3>
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
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/examine/withdrawal_list3' ?>">
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
				<a href="<?= RUN. '/examine/examine_csv2?start='.(isset($start)?$start:"")."&end=".(isset($end)?$end:"") ?>">
					<button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"><i class="layui-icon"></i>账单导出
					</button>
				</a>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
							<th>账单时间</th>
							<th>账单类型</th>
							<th>账单状态</th>
							<th>账单总金额</th>
							<th>账单司机费</th>
							<th>账单小费</th>
							<th>账单抽成费</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
									<td>代驾</td>
									<?php if ($once['status']==1){ ?>
										<td>待接单</td>
									<?php }elseif ($once['status']==2){ ?>
										<td>待接驾</td>
									<?php }elseif ($once['status']==3){ ?>
										<td>用户上车</td>
									<?php }elseif ($once['status']==4){ ?>
										<td>已开始</td>
									<?php }elseif ($once['status']==6){ ?>
										<td>已完成</td>
									<?php }elseif ($once['status']==7){ ?>
										<td>已取消</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
									<td><?= empty($once['price'])?0.00:$once['price'] ?>元</td>
									<td><?= empty($once['order_driver_price'])?0.00:$once['order_driver_price'] ?>元</td>
									<td><?= empty($once['tip_price'])?0.00:$once['tip_price'] ?>元</td>
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
