<!doctype html>
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
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list1_caiduanzhuangxiang' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
								   placeholder="合同款号" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-inline layui-show-xs-block">
							<button class="layui-btn" lay-submit="" lay-filter="sreach"><i
										class="layui-icon">&#xe615;</i></button>
						</div>
					</form>
				</div>
				<div class="layui-card-body ">
					<table class="layui-table layui-form">
						<thead>
						<tr>
							<th>合同编号</th>
							<th>合同款号</th>
							<th>客户名称</th>
							<th>日期</th>
							<th>品类</th>
							<th>合计数量</th>
							<th>装箱数量</th>
							<th>状态</th>
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
						        <?php if ($once['openflg2']>=1){ ?>
									<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
										<td><?= $once['bianhao'] ?></td>
										<td><?= $once['kuanhao'] ?></td>
										<td><?= $once['mingcheng'] ?></td>
										<td><?= date('Y-m-d', $once['qianding']) ?></td>
										<td><?= $once['pinlei'] ?></td>
										<td><?= $once['heji'] ?></td>
										<td><?= $once['zhuangxiangshuliang'] ?></td>
										<?php if (empty($once['openflg'])){ ?>
											<td style="color: red;">未完成</td>
										<?php }else{ ?>
											<td style="color: green;">已完成</td>
										<?php } ?>
										<td class="td-manage">
											<button class="layui-btn layui-btn-normal"
													onclick="xadmin.open('生成','<?= RUN . '/label/label_edit_cai?ltype=1&id=' ?>'+<?= $once['id'] ?>,900,500)">
												<i class="layui-icon">&#xe642;</i>生成
											</button>
											<button class="layui-btn layui-btn-normal"
													onclick="xadmin.open('查看','<?= RUN . '/label/label_edit_cai?ltype=2&id=' ?>'+<?= $once['id'] ?>,900,500)">
												<i class="layui-icon">&#xe642;</i>查看
											</button>
											<?php if (empty($once['openflg'])){ ?>
											    <a style="margin-left: 10px;" href="#">
													<button class="layui-btn layui-btn-normal" style="background-color: #C2C2C2;">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
									        <?php }else{ ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_caizhuangxiang?id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
									        <?php } ?>
										</td>
									</tr>
								<?php } ?>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="4" style="text-align: center;">暂无数据</td>
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
</html>
