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
                            <th>品名</th>
                            <th>品番</th>
                            <th>色号</th>
                            <th>规格</th>
							<th>单位</th>
                            <th>提单数</th>
							<th>清点数</th>
							<th>样指示</th>
							<th>实际</th>
							<th>损耗</th>
							<th>件数</th>
							<th>损耗用量</th>
							<th>到料日</th>
                        </thead>
                        <tbody>
							<tr id="div1">
								<td style="min-width: 80px">
									<?php if (!empty($pinming1) && empty($pinming2)) { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } ?>
								</td>
								<td><input name="pinming[]" value="<?php echo $pinming1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori1 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($pinming2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming2) && empty($pinming3)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei2 ?>" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu2 ?>" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu2 ?>" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi2 ?>" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji2 ?>" id="val222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao2 ?>" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu2 ?>" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang2 ?>" id="val222222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori2 ?>" id="val2222222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($pinming3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming3) && empty($pinming4)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei3 ?>" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu3 ?>" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu3 ?>" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi3 ?>" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji3 ?>" id="val333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao3 ?>" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu3 ?>" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang3 ?>" id="val333333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori3 ?>" id="val3333333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming4)){ ?>
							<tr id="div4" style="display: none;">
								<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming4) && empty($pinming5)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei4 ?>" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu4 ?>" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu4 ?>" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi4 ?>" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji4 ?>" id="val444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao4 ?>" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu4 ?>" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang4 ?>" id="val444444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori4 ?>" id="val4444444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming5)){ ?>
							<tr id="div5" style="display: none;">
								<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming5) && empty($pinming6)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei5 ?>" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu5 ?>" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu5 ?>" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi5 ?>" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji5 ?>" id="val555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao5 ?>" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu5 ?>" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang5 ?>" id="val555555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori5 ?>" id="val5555555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming6)){ ?>
							<tr id="div6" style="display: none;">
								<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming6) && empty($pinming7)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei6 ?>" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu6 ?>" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu6 ?>" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi6 ?>" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji6 ?>" id="val666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao6 ?>" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu6 ?>" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang6 ?>" id="val666666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori6 ?>" id="val6666666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming7)){ ?>
							<tr id="div7" style="display: none;">
								<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming7) && empty($pinming8)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei7 ?>" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu7 ?>" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu7 ?>" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi7 ?>" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji7 ?>" id="val777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao7 ?>" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu7 ?>" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang7 ?>" id="val777777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori7 ?>" id="val7777777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming8)){ ?>
							<tr id="div8" style="display: none;">
								<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming8) && empty($pinming9)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei8 ?>" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu8 ?>" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu8 ?>" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi8 ?>" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji8 ?>" id="val888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao8 ?>" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu8 ?>" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang8 ?>" id="val888888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori8 ?>" id="val8888888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming9)){ ?>
							<tr id="div9" style="display: none;">
								<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming9) && empty($pinming10)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei9 ?>" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu9 ?>" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu9 ?>" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi9 ?>" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji9 ?>" id="val999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao9 ?>" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu9 ?>" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang9 ?>" id="val999999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori9 ?>" id="val9999999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($pinming10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($pinming10)) { ?>
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
								<td><input name="pinming[]" value="<?php echo $pinming10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" value="<?php echo $pinfan10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" value="<?php echo $sehao10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $guige10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $danwei10 ?>" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" value="<?php echo $tidanshu10 ?>" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" value="<?php echo $qingdianshu10 ?>" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" value="<?php echo $yangzhishi10 ?>" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" value="<?php echo $shiji10 ?>" id="val101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" value="<?php echo $sunhao10 ?>" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" value="<?php echo $jianshu10 ?>" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" value="<?php echo $sunhaoyongliang10 ?>" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" value="<?php echo $daoliaori10 ?>" id="val10101010101010101010101010" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
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
