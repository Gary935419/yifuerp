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
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list_yu' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
								   placeholder="合同款号" autocomplete="off" class="layui-input">
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
						<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
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
							<th>合同款号</th>
							<th>签订日期</th>
							<th>报价单费用信息审核状态</th>
							<th>报价单基础信息审核状态</th>
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= $once['kuanhao'] ?></td>
									<td><?= date('Y-m-d', $once['qianding']) ?></td>
									<?php if ($once['openflg']>=1){ ?>
										<?php if ($once['state1']==3){ ?>
											<td style="color: red;">审核驳回</td>
										<?php } ?>
										<?php if ($once['state1']==2){ ?>
										    <td style="color: green;">审核通过</td>
										<?php } ?>
										<?php if ($once['state1']==1){ ?>
										    <td style="color: #FFB800;">正在审核</td>
										<?php } ?>
										<?php if ($once['state1']==4){ ?>
											<td style="color: #0000FF;">暂无提交审核</td>
										<?php } ?>
									<?php }else{ ?>
										<td style="color: #0000FF;">暂无提交审核</td>
									<?php } ?>
									<?php if ($once['openflg1']>=1){ ?>
										<?php if ($once['state2']==3){ ?>
											<td style="color: red;">审核驳回</td>
										<?php } ?>
										<?php if ($once['state2']==2){ ?>
										    <td style="color: green;">审核通过</td>
										<?php } ?>
										<?php if ($once['state2']==1){ ?>
										    <td style="color: #FFB800;">正在审核</td>
										<?php } ?>
										<?php if ($once['state2']==4){ ?>
											<td style="color: #0000FF;">暂无提交审核</td>
										<?php } ?>
									<?php }else{ ?>
										<td style="color: #0000FF;">暂无提交审核</td>
									<?php } ?>
									<td class="td-manage">
										<?php if ($btype==1){ ?>
											<?php if ($once['openflg']>=1){ ?>
											    <?php if ($once['status1']==1 || $once['state1']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('报价单费用信息编辑（预算）','<?= RUN . '/goods/goods_edit_jichufei?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="iconfont">&#xe69e;</i>  报价单费用信息编辑（预算）
													</button>
												<?php }else{ ?>
												    <?php if ($once['status1']==2 && $once['state1']==1 && $shenheflg==1){ ?>
														<button class="layui-btn layui-btn-warm"
																onclick="xadmin.open('报价单费用信息（预算审核）','<?= RUN . '/goods/goods_edit_jichufei?btype=3&id=' ?>'+'<?= $once['id'] ?>')">
															<i class="iconfont">&#xe69e;</i>  报价单费用信息（预算审核）
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单费用信息添加（预算）','<?= RUN . '/goods/goods_add_jichufei?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="iconfont">&#xe69e;</i>  报价单费用信息添加（预算）
												</button>
											<?php } ?>
											
											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('报价单基础信息编辑（预算）','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="layui-icon">&#xe642;</i>报价单基础信息编辑（预算）
													</button>
												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1 && $shenheflg==1){ ?>
														<button class="layui-btn layui-btn-warm"
																onclick="xadmin.open('报价单基础信息（预算审核）','<?= RUN . '/goods/goods_edit_jichu?btype=3&id=' ?>'+'<?= $once['id'] ?>')">
															<i class="layui-icon">&#xe642;</i>报价单基础信息（预算审核）
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单基础信息添加（预算）','<?= RUN . '/goods/goods_add_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>报价单基础信息添加（预算）
												</button>
											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=1&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  Excel导出（预算）
													</button>
												</a>
											<?php } ?>
										
										<?php }else{ ?>
										
											<?php if ($once['openflg']>=1){ ?>
											    <?php if ($once['status1']==1 || $once['state1']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('报价单费用信息编辑（决算）','<?= RUN . '/goods/goods_edit_jichufei?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="iconfont">&#xe69e;</i>  报价单费用信息编辑（决算）
													</button>
												<?php }else{ ?>
												    <?php if ($once['status1']==2 && $once['state1']==1 && $shenheflg==1){ ?>
														<button class="layui-btn layui-btn-warm"
																onclick="xadmin.open('报价单费用信息（决算审核）','<?= RUN . '/goods/goods_edit_jichufei?btype=4&id=' ?>'+'<?= $once['id'] ?>')">
															<i class="iconfont">&#xe69e;</i>  报价单费用信息（决算审核）
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单费用信息添加（决算）','<?= RUN . '/goods/goods_add_jichufei?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="iconfont">&#xe69e;</i>  报价单费用信息添加（决算）
												</button>
											<?php } ?>
											
											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('报价单基础信息编辑（决算）','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="layui-icon">&#xe642;</i>报价单基础信息编辑（决算）
													</button>
												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1 && $shenheflg==1){ ?>
														<button class="layui-btn layui-btn-warm"
																onclick="xadmin.open('报价单基础信息（决算审核）','<?= RUN . '/goods/goods_edit_jichu?btype=4&id=' ?>'+'<?= $once['id'] ?>')">
															<i class="layui-icon">&#xe642;</i>报价单基础信息（决算审核）
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单基础信息添加（决算）','<?= RUN . '/goods/goods_add_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>报价单基础信息添加（决算）
												</button>
											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=2&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  Excel导出（决算）
													</button>
												</a>
											<?php } ?>
										<?php } ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="11" style="text-align: center;">暂无数据</td>
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
