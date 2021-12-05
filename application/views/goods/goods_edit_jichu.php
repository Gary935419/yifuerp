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
							<th>操作</th>
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
								<td style="min-width: 80px">
									<?php if (!empty($xiangmu1) && empty($xiangmu2)) { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } ?>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu1 ?>" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng1 ?>" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige1 ?>" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei1 ?>" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia1 ?>" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_1 ?>" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang1 ?>" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_1 ?>" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine1 ?>" id="val111111111" readonly autocomplete="off" onclick="return jisuan1('val111111111','val11111','val1111111')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_1 ?>" id="val1111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang1 ?>" id="val11111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu1 ?>" id="val111111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($xiangmu2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu2) && empty($xiangmu3)) { ?>
										<i class="layui-icon" id="divadd2"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(3,2)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd2"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(3,2)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia2 ?>" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_2 ?>" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang2 ?>" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_2 ?>" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine2 ?>" id="val222222222" readonly autocomplete="off" onclick="return jisuan1('val222222222','val22222','val2222222')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_2 ?>" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang2 ?>" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu2 ?>" id="val222222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($xiangmu3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu3) && empty($xiangmu4)) { ?>
										<i class="layui-icon"
										   id="divadd3"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(4,3)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd3"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(4,3)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia3 ?>" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_3 ?>" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang3 ?>" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_3 ?>" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine3 ?>" id="val333333333" readonly autocomplete="off" onclick="return jisuan1('val333333333','val33333','val3333333')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_3 ?>" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang3 ?>" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu3 ?>" id="val333333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu4)){ ?>
							<tr id="div4" style="display: none;">
								<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu4) && empty($xiangmu5)) { ?>
										<i class="layui-icon"
										   id="divadd4"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(5,4)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd4"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(5,4)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia4 ?>" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_4 ?>" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang4 ?>" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_4 ?>" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine4 ?>" id="val444444444" readonly autocomplete="off" onclick="return jisuan1('val444444444','val44444','val4444444')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_4 ?>" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang4 ?>" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu4 ?>" id="val444444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu5)){ ?>
							<tr id="div5" style="display: none;">
								<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu5) && empty($xiangmu6)) { ?>
										<i class="layui-icon"
										   id="divadd5"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(6,5)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd5"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(6,5)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia5 ?>" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_5 ?>" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang5 ?>" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_5 ?>" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine5 ?>" id="val555555555" readonly autocomplete="off" onclick="return jisuan1('val555555555','val55555','val5555555')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_5 ?>" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang5 ?>" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu5 ?>" id="val555555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu6)){ ?>
							<tr id="div6" style="display: none;">
								<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu6) && empty($xiangmu7)) { ?>
										<i class="layui-icon"
										   id="divadd6"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd6"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia6 ?>" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_6 ?>" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang6 ?>" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_6 ?>" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine6 ?>" id="val666666666" readonly autocomplete="off" onclick="return jisuan1('val666666666','val66666','val6666666')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_6 ?>" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang6 ?>" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu6 ?>" id="val666666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu7)){ ?>
							<tr id="div7" style="display: none;">
								<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu7) && empty($xiangmu8)) { ?>
										<i class="layui-icon"
										   id="divadd7"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(8,7)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd7"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(8,7)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia7 ?>" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_7 ?>" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang7 ?>" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_7 ?>" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine7 ?>" id="val777777777" readonly autocomplete="off" onclick="return jisuan1('val777777777','val77777','val7777777')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_7 ?>" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang7 ?>" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu7 ?>" id="val777777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu8)){ ?>
							<tr id="div8" style="display: none;">
								<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu8) && empty($xiangmu9)) { ?>
										<i class="layui-icon"
										   id="divadd8"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(9,8)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd8"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(9,8)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia8 ?>" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_8 ?>" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang8 ?>" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_8 ?>" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine8 ?>" id="val888888888" readonly autocomplete="off" onclick="return jisuan1('val888888888','val88888','val8888888')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_8 ?>" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang8 ?>" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu8 ?>" id="val888888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu9)){ ?>
							<tr id="div9" style="display: none;">
								<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu9) && empty($xiangmu10)) { ?>
										<i class="layui-icon"
										   id="divadd9"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(10,9)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd9"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(10,9)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia9 ?>" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_9 ?>" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang9 ?>" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_9 ?>" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine9 ?>" id="val999999999" readonly autocomplete="off" onclick="return jisuan1('val999999999','val99999','val9999999')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_9 ?>" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang9 ?>" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu9 ?>" id="val999999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($xiangmu10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($xiangmu10)) { ?>
										<i class="layui-icon"
										   id="divadd10"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(11,10)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd10"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(11,10)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" value="<?php echo $xiangmu10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $mingcheng10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" value="<?php echo $danjia10 ?>" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" value="<?php echo $danwei1_10 ?>" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" value="<?php echo $yongliang10 ?>" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" value="<?php echo $danwei2_10 ?>" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" value="<?php echo $jine10 ?>" id="val101010101010101010" readonly autocomplete="off" onclick="return jisuan1('val101010101010101010','val1010101010','val10101010101010')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" value="<?php echo $danwei3_10 ?>" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" value="<?php echo $qidingliang10 ?>" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" value="<?php echo $beizhu10 ?>" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
							<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
                        </tbody>
                    </table>
					<div class="layui-form-item" style="margin-top: 15px;">
						<label for="L_repass" class="layui-form-label" style="width: 90%;">
						</label>
						<button class="layui-btn" lay-filter="add" lay-submit="">
							确认提交
						</button>
					</div>
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
							url: "<?= RUN . '/goods/goods_save_edit_jichu' ?>",
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
