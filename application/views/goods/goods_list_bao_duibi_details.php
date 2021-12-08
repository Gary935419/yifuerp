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
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">预算报价单信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>客户名</th>
								<th>生产数量</th>
								<th>报价日期</th>
								<th>损耗</th>
								<th>小计</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="kehuming" id="kehuming" value="<?php echo $kehumingy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shengcanshuliang" id="shengcanshuliang" value="<?php echo $shengcanshuliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="riqi" id="riqi" value="<?php echo date('Y-m-d',$riqiy) ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao" id="sunhao" value="<?php echo $sunhaoy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="xiaoji" id="xiaoji" value="<?php echo $xiaojiy ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>加工费单价</th>
								<th>加工费用量</th>
								<th>二次加工费单价</th>
								<th>二次加工费用量</th>
								<th>检品费单价</th>
								<th>检品费用量</th>
								<th>通关费单价</th>
								<th>通关费用量</th>
								<th>面料检测单价</th>
								<th>面料检测用量</th>
								<th>运费单价</th>
								<th>运费用量</th>
								<th>其他单价</th>
								<th>其他用量</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="jiagongfeidanjia" id="jiagongfeidanjia" value="<?php echo $jiagongfeidanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeiyongliang" id="jiagongfeiyongliang" value="<?php echo $jiagongfeiyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeidanjia" id="ercijiagongfeidanjia" value="<?php echo $ercijiagongfeidanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeiyongliang" id="ercijiagongfeiyongliang" value="<?php echo $ercijiagongfeiyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeidanjia" id="jianpinfeidanjia" value="<?php echo $jianpinfeidanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeiyongliang" id="jianpinfeiyongliang" value="<?php echo $jianpinfeiyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeidanjia" id="tongguanfeidanjia" value="<?php echo $tongguanfeidanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeiyongliang" id="tongguanfeiyongliang"  value="<?php echo $tongguanfeiyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojiancedanjia" id="mianliaojiancedanjia" value="<?php echo $mianliaojiancedanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojianceyongliang" id="mianliaojianceyongliang" value="<?php echo $mianliaojianceyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeidanjia" id="yunfeidanjia" value="<?php echo $yunfeidanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeiyongliang" id="yunfeiyongliang" value="<?php echo $yunfeiyongliangy ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qitadanjia" id="qitadanjia" value="<?php echo $qitadanjiay ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qitayongliang" id="qitayongliang" value="<?php echo $qitayongliangy ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<br>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>项目</th>
								<th>名称</th>
								<th>规格</th>
								<th>单位</th>
								<th>单价</th>
								<th>单位</th>
								<th>用量</th>
								<th>单位</th>
								<th>金额</th>
								<th>单位</th>
								<th>起订量</th>
								<th>备注</th>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu1 ?>" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng1 ?>" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige1 ?>" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei1 ?>" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia1 ?>" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_1 ?>" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang1 ?>" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_1 ?>" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine1 ?>" id="val111111111" readonly autocomplete="off" onclick="return jisuan1('val111111111','val11111','val1111111')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_1 ?>" id="val1111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang1 ?>" id="val11111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu1 ?>" id="val111111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia2 ?>" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_2 ?>" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang2 ?>" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_2 ?>" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine2 ?>" id="val222222222" readonly autocomplete="off" onclick="return jisuan1('val222222222','val22222','val2222222')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_2 ?>" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang2 ?>" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu2 ?>" id="val222222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia3 ?>" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_3 ?>" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang3 ?>" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_3 ?>" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine3 ?>" id="val333333333" readonly autocomplete="off" onclick="return jisuan1('val333333333','val33333','val3333333')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_3 ?>" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang3 ?>" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu3 ?>" id="val333333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu4)){ ?>
							<tr id="div4" style="display: none;">
							<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia4 ?>" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_4 ?>" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang4 ?>" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_4 ?>" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine4 ?>" id="val444444444" readonly autocomplete="off" onclick="return jisuan1('val444444444','val44444','val4444444')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_4 ?>" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang4 ?>" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu4 ?>" id="val444444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu5)){ ?>
							<tr id="div5" style="display: none;">
							<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia5 ?>" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_5 ?>" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang5 ?>" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_5 ?>" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine5 ?>" id="val555555555" readonly autocomplete="off" onclick="return jisuan1('val555555555','val55555','val5555555')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_5 ?>" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang5 ?>" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu5 ?>" id="val555555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu6)){ ?>
							<tr id="div6" style="display: none;">
							<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia6 ?>" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_6 ?>" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang6 ?>" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_6 ?>" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine6 ?>" id="val666666666" readonly autocomplete="off" onclick="return jisuan1('val666666666','val66666','val6666666')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_6 ?>" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang6 ?>" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu6 ?>" id="val666666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu7)){ ?>
							<tr id="div7" style="display: none;">
							<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia7 ?>" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_7 ?>" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang7 ?>" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_7 ?>" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine7 ?>" id="val777777777" readonly autocomplete="off" onclick="return jisuan1('val777777777','val77777','val7777777')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_7 ?>" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang7 ?>" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu7 ?>" id="val777777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu8)){ ?>
							<tr id="div8" style="display: none;">
							<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia8 ?>" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_8 ?>" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang8 ?>" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_8 ?>" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine8 ?>" id="val888888888" readonly autocomplete="off" onclick="return jisuan1('val888888888','val88888','val8888888')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_8 ?>" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang8 ?>" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu8 ?>" id="val888888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu9)){ ?>
							<tr id="div9" style="display: none;">
							<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia9 ?>" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_9 ?>" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang9 ?>" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_9 ?>" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine9 ?>" id="val999999999" readonly autocomplete="off" onclick="return jisuan1('val999999999','val99999','val9999999')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_9 ?>" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang9 ?>" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu9 ?>" id="val999999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($yxiangmu10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $yxiangmu10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $ymingcheng10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $yguige10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $ydanwei10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $ydanjia10 ?>" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $ydanwei1_10 ?>" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yyongliang10 ?>" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $ydanwei2_10 ?>" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $yjine10 ?>" id="val101010101010101010" readonly autocomplete="off" onclick="return jisuan1('val101010101010101010','val1010101010','val10101010101010')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $ydanwei3_10 ?>" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $yqidingliang10 ?>" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $ybeizhu10 ?>" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 80%;">
							</label>
								<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
									返回上一页
								</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">决算报价单信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>客户名</th>
								<th>生产数量</th>
								<th>报价日期</th>
								<th>损耗</th>
								<th>小计</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="kehuming" id="kehuming" value="<?php echo $kehumingj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shengcanshuliang" id="shengcanshuliang" value="<?php echo $shengcanshuliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="riqi" id="riqi" value="<?php echo date('Y-m-d',$riqij) ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao" id="sunhao" value="<?php echo $sunhaoj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="xiaoji" id="xiaoji" value="<?php echo $xiaojij ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>加工费单价</th>
								<th>加工费用量</th>
								<th>二次加工费单价</th>
								<th>二次加工费用量</th>
								<th>检品费单价</th>
								<th>检品费用量</th>
								<th>通关费单价</th>
								<th>通关费用量</th>
								<th>面料检测单价</th>
								<th>面料检测用量</th>
								<th>运费单价</th>
								<th>运费用量</th>
								<th>其他单价</th>
								<th>其他用量</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="jiagongfeidanjia" id="jiagongfeidanjia" value="<?php echo $jiagongfeidanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeiyongliang" id="jiagongfeiyongliang" value="<?php echo $jiagongfeiyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeidanjia" id="ercijiagongfeidanjia" value="<?php echo $ercijiagongfeidanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeiyongliang" id="ercijiagongfeiyongliang" value="<?php echo $ercijiagongfeiyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeidanjia" id="jianpinfeidanjia" value="<?php echo $jianpinfeidanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeiyongliang" id="jianpinfeiyongliang" value="<?php echo $jianpinfeiyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeidanjia" id="tongguanfeidanjia" value="<?php echo $tongguanfeidanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeiyongliang" id="tongguanfeiyongliang"  value="<?php echo $tongguanfeiyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojiancedanjia" id="mianliaojiancedanjia" value="<?php echo $mianliaojiancedanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojianceyongliang" id="mianliaojianceyongliang" value="<?php echo $mianliaojianceyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeidanjia" id="yunfeidanjia" value="<?php echo $yunfeidanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeiyongliang" id="yunfeiyongliang" value="<?php echo $yunfeiyongliangj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qitadanjia" id="qitadanjia" value="<?php echo $qitadanjiaj ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qitayongliang" id="qitayongliang" value="<?php echo $qitayongliangj ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<br>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>项目</th>
								<th>名称</th>
								<th>规格</th>
								<th>单位</th>
								<th>单价</th>
								<th>单位</th>
								<th>用量</th>
								<th>单位</th>
								<th>金额</th>
								<th>单位</th>
								<th>起订量</th>
								<th>备注</th>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu1 ?>" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng1 ?>" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige1 ?>" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei1 ?>" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia1 ?>" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_1 ?>" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang1 ?>" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_1 ?>" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine1 ?>" id="val111111111" readonly autocomplete="off" onclick="return jisuan1('val111111111','val11111','val1111111')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_1 ?>" id="val1111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang1 ?>" id="val11111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu1 ?>" id="val111111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia2 ?>" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_2 ?>" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang2 ?>" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_2 ?>" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine2 ?>" id="val222222222" readonly autocomplete="off" onclick="return jisuan1('val222222222','val22222','val2222222')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_2 ?>" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang2 ?>" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu2 ?>" id="val222222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia3 ?>" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_3 ?>" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang3 ?>" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_3 ?>" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine3 ?>" id="val333333333" readonly autocomplete="off" onclick="return jisuan1('val333333333','val33333','val3333333')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_3 ?>" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang3 ?>" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu3 ?>" id="val333333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu4)){ ?>
							<tr id="div4" style="display: none;">
							<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia4 ?>" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_4 ?>" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang4 ?>" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_4 ?>" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine4 ?>" id="val444444444" readonly autocomplete="off" onclick="return jisuan1('val444444444','val44444','val4444444')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_4 ?>" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang4 ?>" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu4 ?>" id="val444444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu5)){ ?>
							<tr id="div5" style="display: none;">
							<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia5 ?>" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_5 ?>" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang5 ?>" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_5 ?>" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine5 ?>" id="val555555555" readonly autocomplete="off" onclick="return jisuan1('val555555555','val55555','val5555555')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_5 ?>" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang5 ?>" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu5 ?>" id="val555555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu6)){ ?>
							<tr id="div6" style="display: none;">
							<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia6 ?>" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_6 ?>" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang6 ?>" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_6 ?>" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine6 ?>" id="val666666666" readonly autocomplete="off" onclick="return jisuan1('val666666666','val66666','val6666666')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_6 ?>" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang6 ?>" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu6 ?>" id="val666666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu7)){ ?>
							<tr id="div7" style="display: none;">
							<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia7 ?>" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_7 ?>" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang7 ?>" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_7 ?>" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine7 ?>" id="val777777777" readonly autocomplete="off" onclick="return jisuan1('val777777777','val77777','val7777777')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_7 ?>" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang7 ?>" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu7 ?>" id="val777777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu8)){ ?>
							<tr id="div8" style="display: none;">
							<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia8 ?>" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_8 ?>" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang8 ?>" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_8 ?>" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine8 ?>" id="val888888888" readonly autocomplete="off" onclick="return jisuan1('val888888888','val88888','val8888888')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_8 ?>" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang8 ?>" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu8 ?>" id="val888888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu9)){ ?>
							<tr id="div9" style="display: none;">
							<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia9 ?>" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_9 ?>" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang9 ?>" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_9 ?>" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine9 ?>" id="val999999999" readonly autocomplete="off" onclick="return jisuan1('val999999999','val99999','val9999999')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_9 ?>" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang9 ?>" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu9 ?>" id="val999999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jxiangmu10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jxiangmu10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jmingcheng10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jguige10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jdanwei10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $jdanjia10 ?>" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $jdanwei1_10 ?>" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $jyongliang10 ?>" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $jdanwei2_10 ?>" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jjine10 ?>" id="val101010101010101010" readonly autocomplete="off" onclick="return jisuan1('val101010101010101010','val1010101010','val10101010101010')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $jdanwei3_10 ?>" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $jqidingliang10 ?>" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $jbeizhu10 ?>" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 80%;">
							</label>
							<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
								返回上一页
							</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
	function submitgo(){
		//关闭当前frame
		xadmin.close();
	}
</script>
</body>
</html>
