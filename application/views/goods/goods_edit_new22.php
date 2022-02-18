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
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
							<th>箱号</th>
							<th>品名</th>
							<th>品番</th>
							<th>色号</th>
							<th>规格</th>
							<th>单位</th>
							<th>提单数</th>
							<th>清点数</th>
							<th>样单耗</th>
							<th>实际单耗</th>
							<th>3%损耗</th>
							<th>件数</th>
							<th>增减数</th>
							<th>指示用量</th>
							<th>实际用量</th>
							<th>不足</th>
							<th>剩余</th>
							<th>备注</th>
							<th>到料日</th>
                        </thead>
                        <tbody>
						<?php foreach ($list as $k=>$v){ ?>
							<tr id="div1">
								<td><input name="xianghao[]" id="val" value="<?= $v['xianghao'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinming[]" id="val1" value="<?= $v['pinming'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val11" value="<?= $v['pinfan'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val111" value="<?= $v['sehao'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val1111" value="<?= $v['guige'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val11111" value="<?= $v['danwei'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val111111" value="<?= $v['tidanshu'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val1111111" value="<?= $v['qingdianshu'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val11111111" value="<?= $v['yangzhishi'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val111111111" value="<?= $v['shiji'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val1111111111" value="<?= $v['sunhao'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val11111111111" value="<?= $v['jianshu'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val111111111111" value="<?= $v['sunhaoyongliang'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" value="<?= $v['zhishiyongliang'] ?>" id="val11111111111111" readonly autocomplete="off" class="layui-input"></td>
								<td><input name="shijiyongliang[]" value="<?= $v['shijiyongliang'] ?>" id="val111111111111111" readonly autocomplete="off"  class="layui-input"></td>
								<td><input name="buzu[]" id="val1111111111" value="<?= $v['buzu'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shengyu[]" value="<?= $v['shengyu'] ?>" id="val1111111111111111" readonly autocomplete="off"  class="layui-input"></td>
								<td><input name="beizhu[]" id="val1111111111" value="<?= $v['beizhu'] ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val1111111111111" value="<?= $v['daoliaori'] ?>" autocomplete="off" class="layui-input"></td>
							</tr>
						<?php } ?>
                        </tbody>
                    </table>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
	function jisuan1(a,b,c){
		var num = (Number($("#"+b).val())*Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function jisuan2(a,b,c){
		var num = (Number($("#"+b).val())*Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function jisuan3(a,b,c){
		var num = (Number($("#"+b).val())-Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function addnow(id, idd) {
		$("#div" + id).show();
		$("#divadd" + idd).hide();
		if (id == 2) {
			$("#divadd2").show();
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 3) {
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 4) {
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 5) {
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 6) {
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 7) {
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 8) {
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 9) {
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 10) {
			$("#divadd10").show();
		}
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
		$("#val" + id + id + id + id).val("");
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#divadd" + idd).show();
	}
</script>
<script>
	layui.use(['form', 'layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_edit2' ?>",
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
