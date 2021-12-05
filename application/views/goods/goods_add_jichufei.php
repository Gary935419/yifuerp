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
	<script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
</head>
<body>
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<table class="layui-table layui-form">
						<thead>
						<tr>
							<th>
								<div class="layui-row">
									<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
										<div class="layui-form-item">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>客户名
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="kehuming" name="kehuming" lay-verify="kehuming"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>生产数量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="shengcanshuliang" name="shengcanshuliang" lay-verify="shengcanshuliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>报价日期
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input id="riqi" name="riqi" lay-verify="riqi"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>损耗
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="sunhao" name="sunhao" lay-verify="sunhao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>小计
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="xiaoji" name="xiaoji" lay-verify="xiaoji"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>加工费单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="jiagongfeidanjia" name="jiagongfeidanjia" lay-verify="jiagongfeidanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>加工费用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="jiagongfeiyongliang" name="jiagongfeiyongliang" lay-verify="jiagongfeiyongliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>二次加工费单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input id="ercijiagongfeidanjia" name="ercijiagongfeidanjia" lay-verify="ercijiagongfeidanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>二次加工费用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="ercijiagongfeiyongliang" name="ercijiagongfeiyongliang" lay-verify="ercijiagongfeiyongliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>检品费单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="jianpinfeidanjia" name="jianpinfeidanjia" lay-verify="jianpinfeidanjia"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>检品费用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="jianpinfeiyongliang" name="jianpinfeiyongliang" lay-verify="jianpinfeiyongliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>通关费单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="tongguanfeidanjia" name="tongguanfeidanjia" lay-verify="tongguanfeidanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>通关费用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input id="tongguanfeiyongliang" name="tongguanfeiyongliang" lay-verify="tongguanfeiyongliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>面料检测单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="mianliaojiancedanjia" name="mianliaojiancedanjia" lay-verify="mianliaojiancedanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>面料检测用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="mianliaojianceyongliang" name="mianliaojianceyongliang" lay-verify="mianliaojianceyongliang"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>运费单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="yunfeidanjia" name="yunfeidanjia" lay-verify="yunfeidanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>运费用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="yunfeiyongliang" name="yunfeiyongliang" lay-verify="yunfeiyongliang"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>其他单价
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input id="qitadanjia" name="qitadanjia" lay-verify="qitadanjia"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>其他用量
											</label>
											<div class="layui-input-inline" style="width: 100px;">
												<input type="text" id="qitayongliang" name="qitayongliang" lay-verify="qitayongliang"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>项目负责人
											</label>
											<div class="layui-input-inline" style="width: 66%;">
												<?php if (isset($tidlist) && !empty($tidlist)) { ?>
													<?php foreach ($tidlist as $k => $v) : ?>
														<input type="checkbox" name="menu[]" value="<?= $v['id'] ?>" lay-skin="primary" lay-filter="father"
															   lay-verify="check" title="<?= $v['username'] ?>">
													<?php endforeach; ?>
												<?php } ?>
											</div>
										</div>
										<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
										<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
										<div class="layui-form-item">
											<label for="L_repass" class="layui-form-label" style="width: 90%;">
											</label>
											<button class="layui-btn" lay-filter="add" lay-submit="">
												确认提交
											</button>
										</div>
									</form>
								</div>
							</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#riqi' //指定元素
				});
			});
</script>
<script>
	layui.use(['form','layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				var layedit = layui.layedit;
				layedit.set({
					uploadImage: {
						url: '<?= RUN . '/upload/pushFIletextarea' ?>',
						type: 'post',
					}
				});
				//自定义验证规则
				form.verify({
					kehuming: function (value) {
						if ($('#kehuming').val() == "") {
							return '请输入客户名。';
						}
					},
					riqi: function (value) {
						if ($('#riqi').val() == "") {
							return '请输入报价日期。';
						}
					},
					shengcanshuliang: function (value) {
						if ($('#shengcanshuliang').val() == "") {
							return '请输入生产数量。';
						}
					},
					sunhao: function (value) {
						if ($('#sunhao').val() == "") {
							return '请输入损耗。';
						}
					},
					xiaoji: function (value) {
						if ($('#xiaoji').val() == "") {
							return '请输入小计。';
						}
					},
					jiagongfeidanjia: function (value) {
						if ($('#jiagongfeidanjia').val() == "") {
							return '请输入加工费单价。';
						}
					},
					jiagongfeiyongliang: function (value) {
						if ($('#jiagongfeiyongliang').val() == "") {
							return '请输入加工费用量。';
						}
					},
					ercijiagongfeidanjia: function (value) {
						if ($('#jiagongfeidanjia').val() == "") {
							return '请输入二次加工费单价。';
						}
					},
					ercijiagongfeiyongliang: function (value) {
						if ($('#jiagongfeiyongliang').val() == "") {
							return '请输入二次加工费用量。';
						}
					},
					jianpinfeidanjia: function (value) {
						if ($('#jianpinfeidanjia').val() == "") {
							return '请输入检品费单价。';
						}
					},
					jianpinfeiyongliang: function (value) {
						if ($('#jianpinfeiyongliang').val() == "") {
							return '请输入检品费用量。';
						}
					},
					tongguanfeidanjia: function (value) {
						if ($('#tongguanfeidanjia').val() == "") {
							return '请输入通关费单价。';
						}
					},
					tongguanfeiyongliang: function (value) {
						if ($('#tongguanfeiyongliang').val() == "") {
							return '请输入通关费用量。';
						}
					},
					mianliaojiancedanjia: function (value) {
						if ($('#mianliaojiancedanjia').val() == "") {
							return '请输入面料检测费单价。';
						}
					},
					mianliaojianceyongliang: function (value) {
						if ($('#mianliaojianceyongliang').val() == "") {
							return '请输入面料检测费用量。';
						}
					},
					yunfeidanjia: function (value) {
						if ($('#yunfeidanjia').val() == "") {
							return '请输入运费单价。';
						}
					},
					yunfeiyongliang: function (value) {
						if ($('#yunfeiyongliang').val() == "") {
							return '请输入运费用量。';
						}
					},
					qitadanjia: function (value) {
						if ($('#qitadanjia').val() == "") {
							return '请输入其他单价。';
						}
					},
					qitayongliang: function (value) {
						if ($('#qitayongliang').val() == "") {
							return '请输入其他用量。';
						}
					},
					check: function () {
						var checked = $("input[type='checkbox']:checked").length;
						if (checked < 1) {
							return '请勾选负责人。';
						}
					}
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_jichufei' ?>",
							data: $('#tab').serialize(),
							async: false,
							error: function (request) {
								alert("error");
							},
							success: function (data) {
								var data = eval("(" + data + ")");
								if (data.success) {
									layer.msg(data.msg);
									setTimeout(function () {
										cancel();
									}, 2000);
								} else {
									layer.msg(data.msg);
								}
							}
						});
					}
				});
			});

	function cancel() {
		//关闭当前frame
		xadmin.close();
	}
</script>
</body>
</html>
