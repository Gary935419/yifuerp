<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?= STA ?>/css/font.css">
	<link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
	<link type="text/css" href="<?= STA ?>/css/jquery-ui.css" rel="stylesheet"/>
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
					<blockquote class="layui-elem-quote">欢迎您登录ERP后台管理系统
					</blockquote>
				</div>
			</div>
		</div>
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">审核统计</div>
				<div class="layui-card-body ">
					<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
						<li class="layui-col-md3 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>项目合同待审核量（单位：个）</h3>
								<p>
									<cite><?php echo $ordercount1 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md3 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>预算表待审核量（单位：个）</h3>
								<p>
									<cite><?php echo $ordercount2 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md3 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>决算表待审核量（单位：个）</h3>
								<p>
									<cite><?php echo $ordercount3 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md3 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>报价单待审核量（单位：个）</h3>
								<p>
									<cite><?php echo $ordercount4 ?></cite></p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">数据统计</div>
				<div class="layui-card-body ">
					<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>项目合同有效量（单位：个）</h3>
								<p>
									<cite>23</cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>预算表有效量（单位：个）</h3>
								<p>
									<cite>78</cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>决算表有效量（单位：个）</h3>
								<p>
									<cite>26</cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>报价单有效量（单位：个）</h3>
								<p>
									<cite>7</cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>预算裁断书量（单位：个）</h3>
								<p>
									<cite>67</cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs4">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>生产计划总量（单位：个）</h3>
								<p>
									<cite>77</cite></p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">开发团队</div>
				<div class="layui-card-body ">
					<table class="layui-table">
						<tbody>
						<tr>
							<th>开发者</th>
							<td>Gary(zhaoyeu_gary@163.com)</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!--		<div class="layui-col-md12">-->
<!--			<div class="layui-card">-->
<!--				<div class="layui-card-header">企业Logo</div>-->
<!--				<div class="layui-card-body ">-->
<!--					<img src="http://ryksht.ychlkj.cn/static/images/icon-about_us.png">-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
	</div>
</div>
</div>
</body>
</html>
