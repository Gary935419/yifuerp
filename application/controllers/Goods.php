<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：商品
 * 作成者        ： Gary
 * **********************************************************************
 */
class Goods extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user_name'])) {
			header("Location:" . RUN . '/login/logout');
		}
		$this->load->model('Goods_model', 'goods');
		$this->load->model('Role_model', 'role');
		$this->load->model('Task_model', 'task');
		$this->load->model('Taskclass_model', 'taskclass');
		header("Content-type:text/html;charset=utf-8");
	}

	public function goods_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}

		$bianhao = isset($_POST["bianhao"]) ? $_POST["bianhao"] : '';
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		$qianding = isset($_POST["qianding"]) ? $_POST["qianding"] : '';
		$jiaohuoqi = isset($_POST["jiaohuoqi"]) ? $_POST["jiaohuoqi"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		if (empty($kuanhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加合同款号!"));
			return;
		}
		$add_time = time();
		$role_info = $this->role->getroleByname1($bianhao);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该合同编号已经存在。请去项目列表查看!"));
			return;
		}
		foreach ($kuanhao as $kkk => $vvv) {
			if (empty($vvv)) {
				continue;
			}
			$kuanhao_info = $this->role->getroleBynamekuanhao($vvv);
			if (!empty($kuanhao_info)) {
				echo json_encode(array('error' => true, 'msg' => "该款号" . $vvv . "已经存在!"));
				return;
			}
		}
		$qianding = strtotime($qianding);
		$jiaohuoqi = strtotime($jiaohuoqi);
		$rid = $this->role->role_save1($bianhao, $mingcheng, $qianding, $jiaohuoqi, $add_time);
		if ($rid) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save1($rid, $v);
			}
			foreach ($kuanhao as $kk => $vv) {
				if (empty($vv)) {
					continue;
				}
				$this->role->rtom_save2($rid, $vv, $add_time);
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_save1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加数值!"));
			return;
		}

		foreach ($guiges as $k => $v) {
			if (empty($v) || empty($sehaos[$k]) || empty($shuzhis[$k])) {
				continue;
			}
			$this->role->role_save12($v, $sehaos[$k], $shuzhis[$k], $id, time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}

		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$bianhao = isset($_POST["bianhao"]) ? $_POST["bianhao"] : '';
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		$qianding = isset($_POST["qianding"]) ? $_POST["qianding"] : '';
		$jiaohuoqi = isset($_POST["jiaohuoqi"]) ? $_POST["jiaohuoqi"] : '';
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$kuanhao = isset($_POST["kuanhao"]) ? $_POST["kuanhao"] : '';
		if (empty($kuanhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加合同款号!"));
			return;
		}
		$add_time = time();
		$role_info = $this->role->getgoodsById22($bianhao, $id);
		if (!empty($role_info)) {
			echo json_encode(array('error' => true, 'msg' => "该合同编号已经存在!"));
			return;
		}
		foreach ($kuanhao as $kkk => $vvv) {
			if (empty($vvv)) {
				continue;
			}
			$kuanhao_info = $this->role->getgoodsById22kuanhao($vvv, $id);
			if (!empty($kuanhao_info)) {
				echo json_encode(array('error' => true, 'msg' => "该款号" . $vvv . "已经存在!"));
				return;
			}
		}
		$qianding = strtotime($qianding);
		$jiaohuoqi = strtotime($jiaohuoqi);
		$result = $this->role->goods_save_edit($bianhao, $mingcheng, $qianding, $jiaohuoqi, $add_time, $id);
		$this->role->goodsimg_delete1($id);
		$this->role->goodsimg_delete2($id);
		if ($result) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save1($id, $v);
			}
			foreach ($kuanhao as $kk => $vv) {
				if (empty($vv)) {
					continue;
				}
				$this->role->rtom_save2($id, $vv, $add_time);
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_save_edit1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';

		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加数值!"));
			return;
		}
		$this->role->goodsimg_delete3($id);
		foreach ($guiges as $k => $v) {
			if (empty($v) || empty($sehaos[$k]) || empty($shuzhis[$k])) {
				continue;
			}
			$this->role->role_save12($v, $sehaos[$k], $shuzhis[$k], $id, time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	public function goods_save2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$pinmings = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		if (empty($pinmings[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品名!"));
			return;
		}
		$pinfans = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfans[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$tidanshu = isset($_POST["tidanshu"]) ? $_POST["tidanshu"] : '';
		if (empty($tidanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加提单数!"));
			return;
		}
		$qingdianshu = isset($_POST["qingdianshu"]) ? $_POST["qingdianshu"] : '';
		if (empty($qingdianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加请点数!"));
			return;
		}
		$yangzhishi = isset($_POST["yangzhishi"]) ? $_POST["yangzhishi"] : '';
		if (empty($yangzhishi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样指示!"));
			return;
		}
		$shiji = isset($_POST["shiji"]) ? $_POST["shiji"] : '';
		if (empty($shiji[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加实际!"));
			return;
		}
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		if (empty($sunhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗!"));
			return;
		}
		$jianshu = isset($_POST["jianshu"]) ? $_POST["jianshu"] : '';
		if (empty($jianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加件数!"));
			return;
		}
		$sunhaoyongliang = isset($_POST["sunhaoyongliang"]) ? $_POST["sunhaoyongliang"] : '';
		if (empty($sunhaoyongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗用量!"));
			return;
		}
		$daoliaori = isset($_POST["daoliaori"]) ? $_POST["daoliaori"] : '';
		if (empty($daoliaori[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加到料日!"));
			return;
		}
		foreach ($pinmings as $k => $v) {
			if (empty($v) || empty($pinfans[$k]) || empty($sehaos[$k]) || empty($guiges[$k]) || empty($danweis[$k]) || empty($tidanshu[$k]) || empty($qingdianshu[$k]) || empty($yangzhishi[$k]) || empty($shiji[$k]) || empty($sunhao[$k]) || empty($jianshu[$k]) || empty($sunhaoyongliang[$k]) || empty($daoliaori[$k])) {
				continue;
			}
			$zhishiyongliang = floatval($yangzhishi[$k]) * floatval($jianshu[$k]);
			$shijiyongliang = floatval($shiji[$k]) * floatval($jianshu[$k]);
			$shengyu = floatval($tidanshu[$k]) - floatval($zhishiyongliang);;
			$this->role->role_save123($v,$pinfans[$k],$sehaos[$k],$guiges[$k],$danweis[$k],$tidanshu[$k],$qingdianshu[$k],$yangzhishi[$k],$shiji[$k],$sunhao[$k],$jianshu[$k],$sunhaoyongliang[$k],$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_save_edit2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';

		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$pinmings = isset($_POST["pinming"]) ? $_POST["pinming"] : '';
		if (empty($pinmings[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品名!"));
			return;
		}
		$pinfans = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfans[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$tidanshu = isset($_POST["tidanshu"]) ? $_POST["tidanshu"] : '';
		if (empty($tidanshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加提单数!"));
			return;
		}
		$qingdianshu = isset($_POST["qingdianshu"]) ? $_POST["qingdianshu"] : '';
		if (empty($qingdianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加请点数!"));
			return;
		}
		$yangzhishi = isset($_POST["yangzhishi"]) ? $_POST["yangzhishi"] : '';
		if (empty($yangzhishi[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加样指示!"));
			return;
		}
		$shiji = isset($_POST["shiji"]) ? $_POST["shiji"] : '';
		if (empty($shiji[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加实际!"));
			return;
		}
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		if (empty($sunhao[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗!"));
			return;
		}
		$jianshu = isset($_POST["jianshu"]) ? $_POST["jianshu"] : '';
		if (empty($jianshu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加件数!"));
			return;
		}
		$sunhaoyongliang = isset($_POST["sunhaoyongliang"]) ? $_POST["sunhaoyongliang"] : '';
		if (empty($sunhaoyongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗用量!"));
			return;
		}
		$daoliaori = isset($_POST["daoliaori"]) ? $_POST["daoliaori"] : '';
		if (empty($daoliaori[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加到料日!"));
			return;
		}
		$this->role->goodsimg_delete4($id);
		foreach ($pinmings as $k => $v) {
			if (empty($v) || empty($pinfans[$k]) || empty($sehaos[$k]) || empty($guiges[$k]) || empty($danweis[$k]) || empty($tidanshu[$k]) || empty($qingdianshu[$k]) || empty($yangzhishi[$k]) || empty($shiji[$k]) || empty($sunhao[$k]) || empty($jianshu[$k]) || empty($sunhaoyongliang[$k]) || empty($daoliaori[$k])) {
				continue;
			}
			$zhishiyongliang = floatval($yangzhishi[$k]) * floatval($jianshu[$k]);
			$shijiyongliang = floatval($shiji[$k]) * floatval($jianshu[$k]);
			$shengyu = floatval($tidanshu[$k]) - floatval($zhishiyongliang);;
			$this->role->role_save123($v,$pinfans[$k],$sehaos[$k],$guiges[$k],$danweis[$k],$tidanshu[$k],$qingdianshu[$k],$yangzhishi[$k],$shiji[$k],$sunhao[$k],$jianshu[$k],$sunhaoyongliang[$k],$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori[$k],$id,time());
		}

		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}

	public function goods_list()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew($page, $gname);
		$data["gname"] = $gname;
//        foreach ($list as $k=>$v){
//            $tidone = $this->taskclass->gettaskclassById($v['tid']);
//            $list[$k]['tname'] = $tidone['tname'];
//        }
		$data["list"] = $list;
		$this->display("goods/goods_list", $data);
	}
	public function goods_add()
	{
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add", $data);
	}
	public function goods_add1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add1", $data);
	}
	public function goods_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->role->goods_delete($id)) {
			$this->role->goodsimg_delete1($id);
			$this->role->goodsimg_delete2($id);
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
			return;
		}
	}
	public function goods_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['bianhao'] = $goods_info['bianhao'];
		$data['mingcheng'] = $goods_info['mingcheng'];
		$data['qianding'] = $goods_info['qianding'];
		$data['jiaohuoqi'] = $goods_info['jiaohuoqi'];
		$data['id'] = $id;
		$data['tidlist'] = $tidlist;
		$mefuze = $this->task->gettidlistfuze($id);
		foreach ($mefuze as $k => $v) {
			$data['mefuze'][] = $v['uid'];
		}
		$kuanhaos = $this->task->gettidlistkuanhao($id);
		$data['kuanhao1'] = '';
		$data['kuanhao2'] = '';
		$data['kuanhao3'] = '';
		$data['kuanhao4'] = '';
		$data['kuanhao5'] = '';
		$data['kuanhao6'] = '';
		$data['kuanhao7'] = '';
		$data['kuanhao8'] = '';
		$data['kuanhao9'] = '';
		$data['kuanhao10'] = '';
		if (!empty($kuanhaos[0]['kuanhao'])) {
			$data['kuanhao1'] = $kuanhaos[0]['kuanhao'];
		}
		if (!empty($kuanhaos[1]['kuanhao'])) {
			$data['kuanhao2'] = $kuanhaos[1]['kuanhao'];
		}
		if (!empty($kuanhaos[2]['kuanhao'])) {
			$data['kuanhao3'] = $kuanhaos[2]['kuanhao'];
		}
		if (!empty($kuanhaos[3]['kuanhao'])) {
			$data['kuanhao4'] = $kuanhaos[3]['kuanhao'];
		}
		if (!empty($kuanhaos[4]['kuanhao'])) {
			$data['kuanhao5'] = $kuanhaos[4]['kuanhao'];
		}
		if (!empty($kuanhaos[5]['kuanhao'])) {
			$data['kuanhao6'] = $kuanhaos[5]['kuanhao'];
		}
		if (!empty($kuanhaos[6]['kuanhao'])) {
			$data['kuanhao7'] = $kuanhaos[6]['kuanhao'];
		}
		if (!empty($kuanhaos[7]['kuanhao'])) {
			$data['kuanhao8'] = $kuanhaos[7]['kuanhao'];
		}
		if (!empty($kuanhaos[8]['kuanhao'])) {
			$data['kuanhao9'] = $kuanhaos[8]['kuanhao'];
		}
		if (!empty($kuanhaos[9]['kuanhao'])) {
			$data['kuanhao10'] = $kuanhaos[9]['kuanhao'];
		}
		$this->display("goods/goods_edit", $data);
	}
	public function goods_list1()
	{
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page, $gname);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$guiges = $this->task->gettidlistguige($v['id']);
			if (!empty($guiges)) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}

			$pinmings = $this->task->gettidlistpinming($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list1", $data);
	}
	public function goods_edit1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistguige($id);

		$data['guige1'] = '';
		$data['sehao1'] = '';
		$data['shuzhi1'] = '';
		$data['guige2'] = '';
		$data['sehao2'] = '';
		$data['shuzhi2'] = '';
		$data['guige3'] = '';
		$data['sehao3'] = '';
		$data['shuzhi3'] = '';
		$data['guige4'] = '';
		$data['sehao4'] = '';
		$data['shuzhi4'] = '';
		$data['guige5'] = '';
		$data['sehao5'] = '';
		$data['shuzhi5'] = '';
		$data['guige6'] = '';
		$data['sehao6'] = '';
		$data['shuzhi6'] = '';
		$data['guige7'] = '';
		$data['sehao7'] = '';
		$data['shuzhi7'] = '';
		$data['guige8'] = '';
		$data['sehao8'] = '';
		$data['shuzhi8'] = '';
		$data['guige9'] = '';
		$data['sehao9'] = '';
		$data['shuzhi9'] = '';
		$data['guige10'] = '';
		$data['sehao10'] = '';
		$data['shuzhi10'] = '';
		if (!empty($kuanhaos[0]['guige'])) {
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['shuzhi1'] = $kuanhaos[0]['shuzhi'];
		}
		if (!empty($kuanhaos[1]['guige'])) {
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['shuzhi2'] = $kuanhaos[1]['shuzhi'];
		}
		if (!empty($kuanhaos[2]['guige'])) {
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['shuzhi3'] = $kuanhaos[2]['shuzhi'];
		}
		if (!empty($kuanhaos[3]['guige'])) {
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['shuzhi4'] = $kuanhaos[3]['shuzhi'];
		}
		if (!empty($kuanhaos[4]['guige'])) {
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['shuzhi5'] = $kuanhaos[4]['shuzhi'];
		}
		if (!empty($kuanhaos[5]['guige'])) {
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['shuzhi6'] = $kuanhaos[5]['shuzhi'];
		}
		if (!empty($kuanhaos[6]['guige'])) {
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['shuzhi7'] = $kuanhaos[6]['shuzhi'];
		}
		if (!empty($kuanhaos[7]['guige'])) {
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['shuzhi8'] = $kuanhaos[7]['shuzhi'];
		}
		if (!empty($kuanhaos[8]['guige'])) {
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['shuzhi9'] = $kuanhaos[8]['shuzhi'];
		}
		if (!empty($kuanhaos[9]['guige'])) {
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['shuzhi10'] = $kuanhaos[9]['shuzhi'];
		}
		$this->display("goods/goods_edit1", $data);
	}
	public function goods_add2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add2", $data);
	}
	public function goods_edit2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming($id);

		$data['pinming1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['tidanshu1'] = '';
		$data['qingdianshu1'] = '';
		$data['yangzhishi1'] = '';
		$data['shiji1'] = '';
		$data['sunhao1'] = '';
		$data['jianshu1'] = '';
		$data['sunhaoyongliang1'] = '';
		$data['daoliaori1'] = '';

		$data['pinming2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['tidanshu2'] = '';
		$data['qingdianshu2'] = '';
		$data['yangzhishi2'] = '';
		$data['shiji2'] = '';
		$data['sunhao2'] = '';
		$data['jianshu2'] = '';
		$data['sunhaoyongliang2'] = '';
		$data['daoliaori2'] = '';

		$data['pinming3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['tidanshu3'] = '';
		$data['qingdianshu3'] = '';
		$data['yangzhishi3'] = '';
		$data['shiji3'] = '';
		$data['sunhao3'] = '';
		$data['jianshu3'] = '';
		$data['sunhaoyongliang3'] = '';
		$data['daoliaori3'] = '';

		$data['pinming4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['tidanshu4'] = '';
		$data['qingdianshu4'] = '';
		$data['yangzhishi4'] = '';
		$data['shiji4'] = '';
		$data['sunhao4'] = '';
		$data['jianshu4'] = '';
		$data['sunhaoyongliang4'] = '';
		$data['daoliaori4'] = '';

		$data['pinming5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['tidanshu5'] = '';
		$data['qingdianshu5'] = '';
		$data['yangzhishi5'] = '';
		$data['shiji5'] = '';
		$data['sunhao5'] = '';
		$data['jianshu5'] = '';
		$data['sunhaoyongliang5'] = '';
		$data['daoliaori5'] = '';

		$data['pinming6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['tidanshu6'] = '';
		$data['qingdianshu6'] = '';
		$data['yangzhishi6'] = '';
		$data['shiji6'] = '';
		$data['sunhao6'] = '';
		$data['jianshu6'] = '';
		$data['sunhaoyongliang6'] = '';
		$data['daoliaori6'] = '';

		$data['pinming7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['tidanshu7'] = '';
		$data['qingdianshu7'] = '';
		$data['yangzhishi7'] = '';
		$data['shiji7'] = '';
		$data['sunhao7'] = '';
		$data['jianshu7'] = '';
		$data['sunhaoyongliang7'] = '';
		$data['daoliaori7'] = '';

		$data['pinming8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['tidanshu8'] = '';
		$data['qingdianshu8'] = '';
		$data['yangzhishi8'] = '';
		$data['shiji8'] = '';
		$data['sunhao8'] = '';
		$data['jianshu8'] = '';
		$data['sunhaoyongliang8'] = '';
		$data['daoliaori8'] = '';

		$data['pinming9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['tidanshu9'] = '';
		$data['qingdianshu9'] = '';
		$data['yangzhishi9'] = '';
		$data['shiji9'] = '';
		$data['sunhao9'] = '';
		$data['jianshu9'] = '';
		$data['sunhaoyongliang9'] = '';
		$data['daoliaori9'] = '';

		$data['pinming10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['tidanshu10'] = '';
		$data['qingdianshu10'] = '';
		$data['yangzhishi10'] = '';
		$data['shiji10'] = '';
		$data['sunhao10'] = '';
		$data['jianshu10'] = '';
		$data['sunhaoyongliang10'] = '';
		$data['daoliaori10'] = '';

		if (!empty($kuanhaos[0]['pinming'])) {
			$data['pinming1'] = $kuanhaos[0]['pinming'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['tidanshu1'] = $kuanhaos[0]['tidanshu'];
			$data['qingdianshu1'] = $kuanhaos[0]['qingdianshu'];
			$data['yangzhishi1'] = $kuanhaos[0]['yangzhishi'];
			$data['shiji1'] = $kuanhaos[0]['shiji'];
			$data['sunhao1'] = $kuanhaos[0]['sunhao'];
			$data['jianshu1'] = $kuanhaos[0]['jianshu'];
			$data['sunhaoyongliang1'] = $kuanhaos[0]['sunhaoyongliang'];
			$data['daoliaori1'] = $kuanhaos[0]['daoliaori'];
		}
		if (!empty($kuanhaos[1]['pinming'])) {
			$data['pinming2'] = $kuanhaos[1]['pinming'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['tidanshu2'] = $kuanhaos[1]['tidanshu'];
			$data['qingdianshu2'] = $kuanhaos[1]['qingdianshu'];
			$data['yangzhishi2'] = $kuanhaos[1]['yangzhishi'];
			$data['shiji2'] = $kuanhaos[1]['shiji'];
			$data['sunhao2'] = $kuanhaos[1]['sunhao'];
			$data['jianshu2'] = $kuanhaos[1]['jianshu'];
			$data['sunhaoyongliang2'] = $kuanhaos[1]['sunhaoyongliang'];
			$data['daoliaori2'] = $kuanhaos[1]['daoliaori'];
		}
		if (!empty($kuanhaos[2]['pinming'])) {
			$data['pinming3'] = $kuanhaos[2]['pinming'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['tidanshu3'] = $kuanhaos[2]['tidanshu'];
			$data['qingdianshu3'] = $kuanhaos[2]['qingdianshu'];
			$data['yangzhishi3'] = $kuanhaos[2]['yangzhishi'];
			$data['shiji3'] = $kuanhaos[2]['shiji'];
			$data['sunhao3'] = $kuanhaos[2]['sunhao'];
			$data['jianshu3'] = $kuanhaos[2]['jianshu'];
			$data['sunhaoyongliang3'] = $kuanhaos[2]['sunhaoyongliang'];
			$data['daoliaori3'] = $kuanhaos[2]['daoliaori'];
		}
		if (!empty($kuanhaos[3]['pinming'])) {
			$data['pinming4'] = $kuanhaos[3]['pinming'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['tidanshu4'] = $kuanhaos[3]['tidanshu'];
			$data['qingdianshu4'] = $kuanhaos[3]['qingdianshu'];
			$data['yangzhishi4'] = $kuanhaos[3]['yangzhishi'];
			$data['shiji4'] = $kuanhaos[3]['shiji'];
			$data['sunhao4'] = $kuanhaos[3]['sunhao'];
			$data['jianshu4'] = $kuanhaos[3]['jianshu'];
			$data['sunhaoyongliang4'] = $kuanhaos[3]['sunhaoyongliang'];
			$data['daoliaori4'] = $kuanhaos[3]['daoliaori'];
		}
		if (!empty($kuanhaos[4]['pinming'])) {
			$data['pinming5'] = $kuanhaos[4]['pinming'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['tidanshu5'] = $kuanhaos[4]['tidanshu'];
			$data['qingdianshu5'] = $kuanhaos[4]['qingdianshu'];
			$data['yangzhishi5'] = $kuanhaos[4]['yangzhishi'];
			$data['shiji5'] = $kuanhaos[4]['shiji'];
			$data['sunhao5'] = $kuanhaos[4]['sunhao'];
			$data['jianshu5'] = $kuanhaos[4]['jianshu'];
			$data['sunhaoyongliang5'] = $kuanhaos[4]['sunhaoyongliang'];
			$data['daoliaori5'] = $kuanhaos[4]['daoliaori'];
		}
		if (!empty($kuanhaos[5]['pinming'])) {
			$data['pinming6'] = $kuanhaos[5]['pinming'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['tidanshu6'] = $kuanhaos[5]['tidanshu'];
			$data['qingdianshu6'] = $kuanhaos[5]['qingdianshu'];
			$data['yangzhishi6'] = $kuanhaos[5]['yangzhishi'];
			$data['shiji6'] = $kuanhaos[5]['shiji'];
			$data['sunhao6'] = $kuanhaos[5]['sunhao'];
			$data['jianshu6'] = $kuanhaos[5]['jianshu'];
			$data['sunhaoyongliang6'] = $kuanhaos[5]['sunhaoyongliang'];
			$data['daoliaori6'] = $kuanhaos[5]['daoliaori'];
		}
		if (!empty($kuanhaos[6]['pinming'])) {
			$data['pinming7'] = $kuanhaos[6]['pinming'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['tidanshu7'] = $kuanhaos[6]['tidanshu'];
			$data['qingdianshu7'] = $kuanhaos[6]['qingdianshu'];
			$data['yangzhishi7'] = $kuanhaos[6]['yangzhishi'];
			$data['shiji7'] = $kuanhaos[6]['shiji'];
			$data['sunhao7'] = $kuanhaos[6]['sunhao'];
			$data['jianshu7'] = $kuanhaos[6]['jianshu'];
			$data['sunhaoyongliang7'] = $kuanhaos[6]['sunhaoyongliang'];
			$data['daoliaori7'] = $kuanhaos[6]['daoliaori'];
		}
		if (!empty($kuanhaos[7]['pinming'])) {
			$data['pinming8'] = $kuanhaos[7]['pinming'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['tidanshu8'] = $kuanhaos[7]['tidanshu'];
			$data['qingdianshu8'] = $kuanhaos[7]['qingdianshu'];
			$data['yangzhishi8'] = $kuanhaos[7]['yangzhishi'];
			$data['shiji8'] = $kuanhaos[7]['shiji'];
			$data['sunhao8'] = $kuanhaos[7]['sunhao'];
			$data['jianshu8'] = $kuanhaos[7]['jianshu'];
			$data['sunhaoyongliang8'] = $kuanhaos[7]['sunhaoyongliang'];
			$data['daoliaori8'] = $kuanhaos[7]['daoliaori'];
		}
		if (!empty($kuanhaos[8]['pinming'])) {
			$data['pinming9'] = $kuanhaos[8]['pinming'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['tidanshu9'] = $kuanhaos[8]['tidanshu'];
			$data['qingdianshu9'] = $kuanhaos[8]['qingdianshu'];
			$data['yangzhishi9'] = $kuanhaos[8]['yangzhishi'];
			$data['shiji9'] = $kuanhaos[8]['shiji'];
			$data['sunhao9'] = $kuanhaos[8]['sunhao'];
			$data['jianshu9'] = $kuanhaos[8]['jianshu'];
			$data['sunhaoyongliang9'] = $kuanhaos[8]['sunhaoyongliang'];
			$data['daoliaori9'] = $kuanhaos[8]['daoliaori'];
		}
		if (!empty($kuanhaos[9]['pinming'])) {
			$data['pinming10'] = $kuanhaos[9]['pinming'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['tidanshu10'] = $kuanhaos[9]['tidanshu'];
			$data['qingdianshu10'] = $kuanhaos[9]['qingdianshu'];
			$data['yangzhishi10'] = $kuanhaos[9]['yangzhishi'];
			$data['shiji10'] = $kuanhaos[9]['shiji'];
			$data['sunhao10'] = $kuanhaos[9]['sunhao'];
			$data['jianshu10'] = $kuanhaos[9]['jianshu'];
			$data['sunhaoyongliang10'] = $kuanhaos[9]['sunhaoyongliang'];
			$data['daoliaori10'] = $kuanhaos[9]['daoliaori'];
		}
		$this->display("goods/goods_edit2", $data);
	}
	public function goods_add_new()
	{
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add_new", $data);
	}
	public function goods_edit_new()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['bianhao'] = $goods_info['bianhao'];
		$data['mingcheng'] = $goods_info['mingcheng'];
		$data['qianding'] = $goods_info['qianding'];
		$data['jiaohuoqi'] = $goods_info['jiaohuoqi'];
		$data['id'] = $id;
		$data['tidlist'] = $tidlist;
		$mefuze = $this->task->gettidlistfuze($id);
		foreach ($mefuze as $k => $v) {
			$data['mefuze'][] = $v['uid'];
		}
		$kuanhaos = $this->task->gettidlistkuanhao($id);
		$data['kuanhao1'] = '';
		$data['kuanhao2'] = '';
		$data['kuanhao3'] = '';
		$data['kuanhao4'] = '';
		$data['kuanhao5'] = '';
		$data['kuanhao6'] = '';
		$data['kuanhao7'] = '';
		$data['kuanhao8'] = '';
		$data['kuanhao9'] = '';
		$data['kuanhao10'] = '';
		if (!empty($kuanhaos[0]['kuanhao'])) {
			$data['kuanhao1'] = $kuanhaos[0]['kuanhao'];
		}
		if (!empty($kuanhaos[1]['kuanhao'])) {
			$data['kuanhao2'] = $kuanhaos[1]['kuanhao'];
		}
		if (!empty($kuanhaos[2]['kuanhao'])) {
			$data['kuanhao3'] = $kuanhaos[2]['kuanhao'];
		}
		if (!empty($kuanhaos[3]['kuanhao'])) {
			$data['kuanhao4'] = $kuanhaos[3]['kuanhao'];
		}
		if (!empty($kuanhaos[4]['kuanhao'])) {
			$data['kuanhao5'] = $kuanhaos[4]['kuanhao'];
		}
		if (!empty($kuanhaos[5]['kuanhao'])) {
			$data['kuanhao6'] = $kuanhaos[5]['kuanhao'];
		}
		if (!empty($kuanhaos[6]['kuanhao'])) {
			$data['kuanhao7'] = $kuanhaos[6]['kuanhao'];
		}
		if (!empty($kuanhaos[7]['kuanhao'])) {
			$data['kuanhao8'] = $kuanhaos[7]['kuanhao'];
		}
		if (!empty($kuanhaos[8]['kuanhao'])) {
			$data['kuanhao9'] = $kuanhaos[8]['kuanhao'];
		}
		if (!empty($kuanhaos[9]['kuanhao'])) {
			$data['kuanhao10'] = $kuanhaos[9]['kuanhao'];
		}
		$this->display("goods/goods_edit_new", $data);
	}
	public function goods_add_new1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new1", $data);
	}
	public function goods_edit_new1()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistguige($id);

		$data['guige1'] = '';
		$data['sehao1'] = '';
		$data['shuzhi1'] = '';
		$data['guige2'] = '';
		$data['sehao2'] = '';
		$data['shuzhi2'] = '';
		$data['guige3'] = '';
		$data['sehao3'] = '';
		$data['shuzhi3'] = '';
		$data['guige4'] = '';
		$data['sehao4'] = '';
		$data['shuzhi4'] = '';
		$data['guige5'] = '';
		$data['sehao5'] = '';
		$data['shuzhi5'] = '';
		$data['guige6'] = '';
		$data['sehao6'] = '';
		$data['shuzhi6'] = '';
		$data['guige7'] = '';
		$data['sehao7'] = '';
		$data['shuzhi7'] = '';
		$data['guige8'] = '';
		$data['sehao8'] = '';
		$data['shuzhi8'] = '';
		$data['guige9'] = '';
		$data['sehao9'] = '';
		$data['shuzhi9'] = '';
		$data['guige10'] = '';
		$data['sehao10'] = '';
		$data['shuzhi10'] = '';
		if (!empty($kuanhaos[0]['guige'])) {
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['shuzhi1'] = $kuanhaos[0]['shuzhi'];
		}
		if (!empty($kuanhaos[1]['guige'])) {
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['shuzhi2'] = $kuanhaos[1]['shuzhi'];
		}
		if (!empty($kuanhaos[2]['guige'])) {
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['shuzhi3'] = $kuanhaos[2]['shuzhi'];
		}
		if (!empty($kuanhaos[3]['guige'])) {
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['shuzhi4'] = $kuanhaos[3]['shuzhi'];
		}
		if (!empty($kuanhaos[4]['guige'])) {
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['shuzhi5'] = $kuanhaos[4]['shuzhi'];
		}
		if (!empty($kuanhaos[5]['guige'])) {
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['shuzhi6'] = $kuanhaos[5]['shuzhi'];
		}
		if (!empty($kuanhaos[6]['guige'])) {
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['shuzhi7'] = $kuanhaos[6]['shuzhi'];
		}
		if (!empty($kuanhaos[7]['guige'])) {
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['shuzhi8'] = $kuanhaos[7]['shuzhi'];
		}
		if (!empty($kuanhaos[8]['guige'])) {
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['shuzhi9'] = $kuanhaos[8]['shuzhi'];
		}
		if (!empty($kuanhaos[9]['guige'])) {
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['shuzhi10'] = $kuanhaos[9]['shuzhi'];
		}
		$this->display("goods/goods_edit_new1", $data);
	}
	public function goods_add_new2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new2", $data);
	}
	public function goods_edit_new2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming($id);

		$data['pinming1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['tidanshu1'] = '';
		$data['qingdianshu1'] = '';
		$data['yangzhishi1'] = '';
		$data['shiji1'] = '';
		$data['sunhao1'] = '';
		$data['jianshu1'] = '';
		$data['sunhaoyongliang1'] = '';
		$data['daoliaori1'] = '';

		$data['pinming2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['tidanshu2'] = '';
		$data['qingdianshu2'] = '';
		$data['yangzhishi2'] = '';
		$data['shiji2'] = '';
		$data['sunhao2'] = '';
		$data['jianshu2'] = '';
		$data['sunhaoyongliang2'] = '';
		$data['daoliaori2'] = '';

		$data['pinming3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['tidanshu3'] = '';
		$data['qingdianshu3'] = '';
		$data['yangzhishi3'] = '';
		$data['shiji3'] = '';
		$data['sunhao3'] = '';
		$data['jianshu3'] = '';
		$data['sunhaoyongliang3'] = '';
		$data['daoliaori3'] = '';

		$data['pinming4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['tidanshu4'] = '';
		$data['qingdianshu4'] = '';
		$data['yangzhishi4'] = '';
		$data['shiji4'] = '';
		$data['sunhao4'] = '';
		$data['jianshu4'] = '';
		$data['sunhaoyongliang4'] = '';
		$data['daoliaori4'] = '';

		$data['pinming5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['tidanshu5'] = '';
		$data['qingdianshu5'] = '';
		$data['yangzhishi5'] = '';
		$data['shiji5'] = '';
		$data['sunhao5'] = '';
		$data['jianshu5'] = '';
		$data['sunhaoyongliang5'] = '';
		$data['daoliaori5'] = '';

		$data['pinming6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['tidanshu6'] = '';
		$data['qingdianshu6'] = '';
		$data['yangzhishi6'] = '';
		$data['shiji6'] = '';
		$data['sunhao6'] = '';
		$data['jianshu6'] = '';
		$data['sunhaoyongliang6'] = '';
		$data['daoliaori6'] = '';

		$data['pinming7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['tidanshu7'] = '';
		$data['qingdianshu7'] = '';
		$data['yangzhishi7'] = '';
		$data['shiji7'] = '';
		$data['sunhao7'] = '';
		$data['jianshu7'] = '';
		$data['sunhaoyongliang7'] = '';
		$data['daoliaori7'] = '';

		$data['pinming8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['tidanshu8'] = '';
		$data['qingdianshu8'] = '';
		$data['yangzhishi8'] = '';
		$data['shiji8'] = '';
		$data['sunhao8'] = '';
		$data['jianshu8'] = '';
		$data['sunhaoyongliang8'] = '';
		$data['daoliaori8'] = '';

		$data['pinming9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['tidanshu9'] = '';
		$data['qingdianshu9'] = '';
		$data['yangzhishi9'] = '';
		$data['shiji9'] = '';
		$data['sunhao9'] = '';
		$data['jianshu9'] = '';
		$data['sunhaoyongliang9'] = '';
		$data['daoliaori9'] = '';

		$data['pinming10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['tidanshu10'] = '';
		$data['qingdianshu10'] = '';
		$data['yangzhishi10'] = '';
		$data['shiji10'] = '';
		$data['sunhao10'] = '';
		$data['jianshu10'] = '';
		$data['sunhaoyongliang10'] = '';
		$data['daoliaori10'] = '';

		if (!empty($kuanhaos[0]['pinming'])) {
			$data['pinming1'] = $kuanhaos[0]['pinming'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['tidanshu1'] = $kuanhaos[0]['tidanshu'];
			$data['qingdianshu1'] = $kuanhaos[0]['qingdianshu'];
			$data['yangzhishi1'] = $kuanhaos[0]['yangzhishi'];
			$data['shiji1'] = $kuanhaos[0]['shiji'];
			$data['sunhao1'] = $kuanhaos[0]['sunhao'];
			$data['jianshu1'] = $kuanhaos[0]['jianshu'];
			$data['sunhaoyongliang1'] = $kuanhaos[0]['sunhaoyongliang'];
			$data['daoliaori1'] = $kuanhaos[0]['daoliaori'];
		}
		if (!empty($kuanhaos[1]['pinming'])) {
			$data['pinming2'] = $kuanhaos[1]['pinming'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['tidanshu2'] = $kuanhaos[1]['tidanshu'];
			$data['qingdianshu2'] = $kuanhaos[1]['qingdianshu'];
			$data['yangzhishi2'] = $kuanhaos[1]['yangzhishi'];
			$data['shiji2'] = $kuanhaos[1]['shiji'];
			$data['sunhao2'] = $kuanhaos[1]['sunhao'];
			$data['jianshu2'] = $kuanhaos[1]['jianshu'];
			$data['sunhaoyongliang2'] = $kuanhaos[1]['sunhaoyongliang'];
			$data['daoliaori2'] = $kuanhaos[1]['daoliaori'];
		}
		if (!empty($kuanhaos[2]['pinming'])) {
			$data['pinming3'] = $kuanhaos[2]['pinming'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['tidanshu3'] = $kuanhaos[2]['tidanshu'];
			$data['qingdianshu3'] = $kuanhaos[2]['qingdianshu'];
			$data['yangzhishi3'] = $kuanhaos[2]['yangzhishi'];
			$data['shiji3'] = $kuanhaos[2]['shiji'];
			$data['sunhao3'] = $kuanhaos[2]['sunhao'];
			$data['jianshu3'] = $kuanhaos[2]['jianshu'];
			$data['sunhaoyongliang3'] = $kuanhaos[2]['sunhaoyongliang'];
			$data['daoliaori3'] = $kuanhaos[2]['daoliaori'];
		}
		if (!empty($kuanhaos[3]['pinming'])) {
			$data['pinming4'] = $kuanhaos[3]['pinming'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['tidanshu4'] = $kuanhaos[3]['tidanshu'];
			$data['qingdianshu4'] = $kuanhaos[3]['qingdianshu'];
			$data['yangzhishi4'] = $kuanhaos[3]['yangzhishi'];
			$data['shiji4'] = $kuanhaos[3]['shiji'];
			$data['sunhao4'] = $kuanhaos[3]['sunhao'];
			$data['jianshu4'] = $kuanhaos[3]['jianshu'];
			$data['sunhaoyongliang4'] = $kuanhaos[3]['sunhaoyongliang'];
			$data['daoliaori4'] = $kuanhaos[3]['daoliaori'];
		}
		if (!empty($kuanhaos[4]['pinming'])) {
			$data['pinming5'] = $kuanhaos[4]['pinming'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['tidanshu5'] = $kuanhaos[4]['tidanshu'];
			$data['qingdianshu5'] = $kuanhaos[4]['qingdianshu'];
			$data['yangzhishi5'] = $kuanhaos[4]['yangzhishi'];
			$data['shiji5'] = $kuanhaos[4]['shiji'];
			$data['sunhao5'] = $kuanhaos[4]['sunhao'];
			$data['jianshu5'] = $kuanhaos[4]['jianshu'];
			$data['sunhaoyongliang5'] = $kuanhaos[4]['sunhaoyongliang'];
			$data['daoliaori5'] = $kuanhaos[4]['daoliaori'];
		}
		if (!empty($kuanhaos[5]['pinming'])) {
			$data['pinming6'] = $kuanhaos[5]['pinming'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['tidanshu6'] = $kuanhaos[5]['tidanshu'];
			$data['qingdianshu6'] = $kuanhaos[5]['qingdianshu'];
			$data['yangzhishi6'] = $kuanhaos[5]['yangzhishi'];
			$data['shiji6'] = $kuanhaos[5]['shiji'];
			$data['sunhao6'] = $kuanhaos[5]['sunhao'];
			$data['jianshu6'] = $kuanhaos[5]['jianshu'];
			$data['sunhaoyongliang6'] = $kuanhaos[5]['sunhaoyongliang'];
			$data['daoliaori6'] = $kuanhaos[5]['daoliaori'];
		}
		if (!empty($kuanhaos[6]['pinming'])) {
			$data['pinming7'] = $kuanhaos[6]['pinming'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['tidanshu7'] = $kuanhaos[6]['tidanshu'];
			$data['qingdianshu7'] = $kuanhaos[6]['qingdianshu'];
			$data['yangzhishi7'] = $kuanhaos[6]['yangzhishi'];
			$data['shiji7'] = $kuanhaos[6]['shiji'];
			$data['sunhao7'] = $kuanhaos[6]['sunhao'];
			$data['jianshu7'] = $kuanhaos[6]['jianshu'];
			$data['sunhaoyongliang7'] = $kuanhaos[6]['sunhaoyongliang'];
			$data['daoliaori7'] = $kuanhaos[6]['daoliaori'];
		}
		if (!empty($kuanhaos[7]['pinming'])) {
			$data['pinming8'] = $kuanhaos[7]['pinming'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['tidanshu8'] = $kuanhaos[7]['tidanshu'];
			$data['qingdianshu8'] = $kuanhaos[7]['qingdianshu'];
			$data['yangzhishi8'] = $kuanhaos[7]['yangzhishi'];
			$data['shiji8'] = $kuanhaos[7]['shiji'];
			$data['sunhao8'] = $kuanhaos[7]['sunhao'];
			$data['jianshu8'] = $kuanhaos[7]['jianshu'];
			$data['sunhaoyongliang8'] = $kuanhaos[7]['sunhaoyongliang'];
			$data['daoliaori8'] = $kuanhaos[7]['daoliaori'];
		}
		if (!empty($kuanhaos[8]['pinming'])) {
			$data['pinming9'] = $kuanhaos[8]['pinming'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['tidanshu9'] = $kuanhaos[8]['tidanshu'];
			$data['qingdianshu9'] = $kuanhaos[8]['qingdianshu'];
			$data['yangzhishi9'] = $kuanhaos[8]['yangzhishi'];
			$data['shiji9'] = $kuanhaos[8]['shiji'];
			$data['sunhao9'] = $kuanhaos[8]['sunhao'];
			$data['jianshu9'] = $kuanhaos[8]['jianshu'];
			$data['sunhaoyongliang9'] = $kuanhaos[8]['sunhaoyongliang'];
			$data['daoliaori9'] = $kuanhaos[8]['daoliaori'];
		}
		if (!empty($kuanhaos[9]['pinming'])) {
			$data['pinming10'] = $kuanhaos[9]['pinming'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['tidanshu10'] = $kuanhaos[9]['tidanshu'];
			$data['qingdianshu10'] = $kuanhaos[9]['qingdianshu'];
			$data['yangzhishi10'] = $kuanhaos[9]['yangzhishi'];
			$data['shiji10'] = $kuanhaos[9]['shiji'];
			$data['sunhao10'] = $kuanhaos[9]['sunhao'];
			$data['jianshu10'] = $kuanhaos[9]['jianshu'];
			$data['sunhaoyongliang10'] = $kuanhaos[9]['sunhaoyongliang'];
			$data['daoliaori10'] = $kuanhaos[9]['daoliaori'];
		}
		$this->display("goods/goods_edit_new2", $data);
	}
	public function goods_add_new22()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_new22", $data);
	}
	public function goods_edit_new22()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistpinming($id);

		$data['pinming1'] = '';
		$data['pinfan1'] = '';
		$data['sehao1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['tidanshu1'] = '';
		$data['qingdianshu1'] = '';
		$data['yangzhishi1'] = '';
		$data['shiji1'] = '';
		$data['sunhao1'] = '';
		$data['jianshu1'] = '';
		$data['sunhaoyongliang1'] = '';
		$data['daoliaori1'] = '';

		$data['pinming2'] = '';
		$data['pinfan2'] = '';
		$data['sehao2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['tidanshu2'] = '';
		$data['qingdianshu2'] = '';
		$data['yangzhishi2'] = '';
		$data['shiji2'] = '';
		$data['sunhao2'] = '';
		$data['jianshu2'] = '';
		$data['sunhaoyongliang2'] = '';
		$data['daoliaori2'] = '';

		$data['pinming3'] = '';
		$data['pinfan3'] = '';
		$data['sehao3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['tidanshu3'] = '';
		$data['qingdianshu3'] = '';
		$data['yangzhishi3'] = '';
		$data['shiji3'] = '';
		$data['sunhao3'] = '';
		$data['jianshu3'] = '';
		$data['sunhaoyongliang3'] = '';
		$data['daoliaori3'] = '';

		$data['pinming4'] = '';
		$data['pinfan4'] = '';
		$data['sehao4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['tidanshu4'] = '';
		$data['qingdianshu4'] = '';
		$data['yangzhishi4'] = '';
		$data['shiji4'] = '';
		$data['sunhao4'] = '';
		$data['jianshu4'] = '';
		$data['sunhaoyongliang4'] = '';
		$data['daoliaori4'] = '';

		$data['pinming5'] = '';
		$data['pinfan5'] = '';
		$data['sehao5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['tidanshu5'] = '';
		$data['qingdianshu5'] = '';
		$data['yangzhishi5'] = '';
		$data['shiji5'] = '';
		$data['sunhao5'] = '';
		$data['jianshu5'] = '';
		$data['sunhaoyongliang5'] = '';
		$data['daoliaori5'] = '';

		$data['pinming6'] = '';
		$data['pinfan6'] = '';
		$data['sehao6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['tidanshu6'] = '';
		$data['qingdianshu6'] = '';
		$data['yangzhishi6'] = '';
		$data['shiji6'] = '';
		$data['sunhao6'] = '';
		$data['jianshu6'] = '';
		$data['sunhaoyongliang6'] = '';
		$data['daoliaori6'] = '';

		$data['pinming7'] = '';
		$data['pinfan7'] = '';
		$data['sehao7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['tidanshu7'] = '';
		$data['qingdianshu7'] = '';
		$data['yangzhishi7'] = '';
		$data['shiji7'] = '';
		$data['sunhao7'] = '';
		$data['jianshu7'] = '';
		$data['sunhaoyongliang7'] = '';
		$data['daoliaori7'] = '';

		$data['pinming8'] = '';
		$data['pinfan8'] = '';
		$data['sehao8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['tidanshu8'] = '';
		$data['qingdianshu8'] = '';
		$data['yangzhishi8'] = '';
		$data['shiji8'] = '';
		$data['sunhao8'] = '';
		$data['jianshu8'] = '';
		$data['sunhaoyongliang8'] = '';
		$data['daoliaori8'] = '';

		$data['pinming9'] = '';
		$data['pinfan9'] = '';
		$data['sehao9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['tidanshu9'] = '';
		$data['qingdianshu9'] = '';
		$data['yangzhishi9'] = '';
		$data['shiji9'] = '';
		$data['sunhao9'] = '';
		$data['jianshu9'] = '';
		$data['sunhaoyongliang9'] = '';
		$data['daoliaori9'] = '';

		$data['pinming10'] = '';
		$data['pinfan10'] = '';
		$data['sehao10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['tidanshu10'] = '';
		$data['qingdianshu10'] = '';
		$data['yangzhishi10'] = '';
		$data['shiji10'] = '';
		$data['sunhao10'] = '';
		$data['jianshu10'] = '';
		$data['sunhaoyongliang10'] = '';
		$data['daoliaori10'] = '';

		if (!empty($kuanhaos[0]['pinming'])) {
			$data['pinming1'] = $kuanhaos[0]['pinming'];
			$data['pinfan1'] = $kuanhaos[0]['pinfan'];
			$data['sehao1'] = $kuanhaos[0]['sehao'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['tidanshu1'] = $kuanhaos[0]['tidanshu'];
			$data['qingdianshu1'] = $kuanhaos[0]['qingdianshu'];
			$data['yangzhishi1'] = $kuanhaos[0]['yangzhishi'];
			$data['shiji1'] = $kuanhaos[0]['shiji'];
			$data['sunhao1'] = $kuanhaos[0]['sunhao'];
			$data['jianshu1'] = $kuanhaos[0]['jianshu'];
			$data['sunhaoyongliang1'] = $kuanhaos[0]['sunhaoyongliang'];
			$data['daoliaori1'] = $kuanhaos[0]['daoliaori'];
		}
		if (!empty($kuanhaos[1]['pinming'])) {
			$data['pinming2'] = $kuanhaos[1]['pinming'];
			$data['pinfan2'] = $kuanhaos[1]['pinfan'];
			$data['sehao2'] = $kuanhaos[1]['sehao'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['tidanshu2'] = $kuanhaos[1]['tidanshu'];
			$data['qingdianshu2'] = $kuanhaos[1]['qingdianshu'];
			$data['yangzhishi2'] = $kuanhaos[1]['yangzhishi'];
			$data['shiji2'] = $kuanhaos[1]['shiji'];
			$data['sunhao2'] = $kuanhaos[1]['sunhao'];
			$data['jianshu2'] = $kuanhaos[1]['jianshu'];
			$data['sunhaoyongliang2'] = $kuanhaos[1]['sunhaoyongliang'];
			$data['daoliaori2'] = $kuanhaos[1]['daoliaori'];
		}
		if (!empty($kuanhaos[2]['pinming'])) {
			$data['pinming3'] = $kuanhaos[2]['pinming'];
			$data['pinfan3'] = $kuanhaos[2]['pinfan'];
			$data['sehao3'] = $kuanhaos[2]['sehao'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['tidanshu3'] = $kuanhaos[2]['tidanshu'];
			$data['qingdianshu3'] = $kuanhaos[2]['qingdianshu'];
			$data['yangzhishi3'] = $kuanhaos[2]['yangzhishi'];
			$data['shiji3'] = $kuanhaos[2]['shiji'];
			$data['sunhao3'] = $kuanhaos[2]['sunhao'];
			$data['jianshu3'] = $kuanhaos[2]['jianshu'];
			$data['sunhaoyongliang3'] = $kuanhaos[2]['sunhaoyongliang'];
			$data['daoliaori3'] = $kuanhaos[2]['daoliaori'];
		}
		if (!empty($kuanhaos[3]['pinming'])) {
			$data['pinming4'] = $kuanhaos[3]['pinming'];
			$data['pinfan4'] = $kuanhaos[3]['pinfan'];
			$data['sehao4'] = $kuanhaos[3]['sehao'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['tidanshu4'] = $kuanhaos[3]['tidanshu'];
			$data['qingdianshu4'] = $kuanhaos[3]['qingdianshu'];
			$data['yangzhishi4'] = $kuanhaos[3]['yangzhishi'];
			$data['shiji4'] = $kuanhaos[3]['shiji'];
			$data['sunhao4'] = $kuanhaos[3]['sunhao'];
			$data['jianshu4'] = $kuanhaos[3]['jianshu'];
			$data['sunhaoyongliang4'] = $kuanhaos[3]['sunhaoyongliang'];
			$data['daoliaori4'] = $kuanhaos[3]['daoliaori'];
		}
		if (!empty($kuanhaos[4]['pinming'])) {
			$data['pinming5'] = $kuanhaos[4]['pinming'];
			$data['pinfan5'] = $kuanhaos[4]['pinfan'];
			$data['sehao5'] = $kuanhaos[4]['sehao'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['tidanshu5'] = $kuanhaos[4]['tidanshu'];
			$data['qingdianshu5'] = $kuanhaos[4]['qingdianshu'];
			$data['yangzhishi5'] = $kuanhaos[4]['yangzhishi'];
			$data['shiji5'] = $kuanhaos[4]['shiji'];
			$data['sunhao5'] = $kuanhaos[4]['sunhao'];
			$data['jianshu5'] = $kuanhaos[4]['jianshu'];
			$data['sunhaoyongliang5'] = $kuanhaos[4]['sunhaoyongliang'];
			$data['daoliaori5'] = $kuanhaos[4]['daoliaori'];
		}
		if (!empty($kuanhaos[5]['pinming'])) {
			$data['pinming6'] = $kuanhaos[5]['pinming'];
			$data['pinfan6'] = $kuanhaos[5]['pinfan'];
			$data['sehao6'] = $kuanhaos[5]['sehao'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['tidanshu6'] = $kuanhaos[5]['tidanshu'];
			$data['qingdianshu6'] = $kuanhaos[5]['qingdianshu'];
			$data['yangzhishi6'] = $kuanhaos[5]['yangzhishi'];
			$data['shiji6'] = $kuanhaos[5]['shiji'];
			$data['sunhao6'] = $kuanhaos[5]['sunhao'];
			$data['jianshu6'] = $kuanhaos[5]['jianshu'];
			$data['sunhaoyongliang6'] = $kuanhaos[5]['sunhaoyongliang'];
			$data['daoliaori6'] = $kuanhaos[5]['daoliaori'];
		}
		if (!empty($kuanhaos[6]['pinming'])) {
			$data['pinming7'] = $kuanhaos[6]['pinming'];
			$data['pinfan7'] = $kuanhaos[6]['pinfan'];
			$data['sehao7'] = $kuanhaos[6]['sehao'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['tidanshu7'] = $kuanhaos[6]['tidanshu'];
			$data['qingdianshu7'] = $kuanhaos[6]['qingdianshu'];
			$data['yangzhishi7'] = $kuanhaos[6]['yangzhishi'];
			$data['shiji7'] = $kuanhaos[6]['shiji'];
			$data['sunhao7'] = $kuanhaos[6]['sunhao'];
			$data['jianshu7'] = $kuanhaos[6]['jianshu'];
			$data['sunhaoyongliang7'] = $kuanhaos[6]['sunhaoyongliang'];
			$data['daoliaori7'] = $kuanhaos[6]['daoliaori'];
		}
		if (!empty($kuanhaos[7]['pinming'])) {
			$data['pinming8'] = $kuanhaos[7]['pinming'];
			$data['pinfan8'] = $kuanhaos[7]['pinfan'];
			$data['sehao8'] = $kuanhaos[7]['sehao'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['tidanshu8'] = $kuanhaos[7]['tidanshu'];
			$data['qingdianshu8'] = $kuanhaos[7]['qingdianshu'];
			$data['yangzhishi8'] = $kuanhaos[7]['yangzhishi'];
			$data['shiji8'] = $kuanhaos[7]['shiji'];
			$data['sunhao8'] = $kuanhaos[7]['sunhao'];
			$data['jianshu8'] = $kuanhaos[7]['jianshu'];
			$data['sunhaoyongliang8'] = $kuanhaos[7]['sunhaoyongliang'];
			$data['daoliaori8'] = $kuanhaos[7]['daoliaori'];
		}
		if (!empty($kuanhaos[8]['pinming'])) {
			$data['pinming9'] = $kuanhaos[8]['pinming'];
			$data['pinfan9'] = $kuanhaos[8]['pinfan'];
			$data['sehao9'] = $kuanhaos[8]['sehao'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['tidanshu9'] = $kuanhaos[8]['tidanshu'];
			$data['qingdianshu9'] = $kuanhaos[8]['qingdianshu'];
			$data['yangzhishi9'] = $kuanhaos[8]['yangzhishi'];
			$data['shiji9'] = $kuanhaos[8]['shiji'];
			$data['sunhao9'] = $kuanhaos[8]['sunhao'];
			$data['jianshu9'] = $kuanhaos[8]['jianshu'];
			$data['sunhaoyongliang9'] = $kuanhaos[8]['sunhaoyongliang'];
			$data['daoliaori9'] = $kuanhaos[8]['daoliaori'];
		}
		if (!empty($kuanhaos[9]['pinming'])) {
			$data['pinming10'] = $kuanhaos[9]['pinming'];
			$data['pinfan10'] = $kuanhaos[9]['pinfan'];
			$data['sehao10'] = $kuanhaos[9]['sehao'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['tidanshu10'] = $kuanhaos[9]['tidanshu'];
			$data['qingdianshu10'] = $kuanhaos[9]['qingdianshu'];
			$data['yangzhishi10'] = $kuanhaos[9]['yangzhishi'];
			$data['shiji10'] = $kuanhaos[9]['shiji'];
			$data['sunhao10'] = $kuanhaos[9]['sunhao'];
			$data['jianshu10'] = $kuanhaos[9]['jianshu'];
			$data['sunhaoyongliang10'] = $kuanhaos[9]['sunhaoyongliang'];
			$data['daoliaori10'] = $kuanhaos[9]['daoliaori'];
		}
		$this->display("goods/goods_edit_new22", $data);
	}
}
