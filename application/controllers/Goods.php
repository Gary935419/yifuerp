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
		$this->load->model('Set_model', 'set');
		$this->load->model('Taskclass_model', 'taskclass');
		$this->load->library('PHPExcel');
		$this->load->library('IOFactory');
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
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
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
		$data['zhishiyongliang1'] = '';
		$data['shijiyongliang1'] = '';
		$data['shengyu1'] = '';

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
		$data['zhishiyongliang2'] = '';
		$data['shijiyongliang2'] = '';
		$data['shengyu2'] = '';

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
		$data['zhishiyongliang3'] = '';
		$data['shijiyongliang3'] = '';
		$data['shengyu3'] = '';

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
		$data['zhishiyongliang4'] = '';
		$data['shijiyongliang4'] = '';
		$data['shengyu4'] = '';

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
		$data['zhishiyongliang5'] = '';
		$data['shijiyongliang5'] = '';
		$data['shengyu5'] = '';

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
		$data['zhishiyongliang6'] = '';
		$data['shijiyongliang6'] = '';
		$data['shengyu6'] = '';

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
		$data['zhishiyongliang7'] = '';
		$data['shijiyongliang7'] = '';
		$data['shengyu7'] = '';

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
		$data['zhishiyongliang8'] = '';
		$data['shijiyongliang8'] = '';
		$data['shengyu8'] = '';

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
		$data['zhishiyongliang9'] = '';
		$data['shijiyongliang9'] = '';
		$data['shengyu9'] = '';

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
		$data['zhishiyongliang10'] = '';
		$data['shijiyongliang10'] = '';
		$data['shengyu10'] = '';

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
			$data['zhishiyongliang1'] = $kuanhaos[0]['zhishiyongliang'];
			$data['shijiyongliang1'] = $kuanhaos[0]['shijiyongliang'];
			$data['shengyu1'] = $kuanhaos[0]['shengyu'];
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
			$data['zhishiyongliang2'] = $kuanhaos[1]['zhishiyongliang'];
			$data['shijiyongliang2'] = $kuanhaos[1]['shijiyongliang'];
			$data['shengyu2'] = $kuanhaos[1]['shengyu'];
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
			$data['zhishiyongliang3'] = $kuanhaos[2]['zhishiyongliang'];
			$data['shijiyongliang3'] = $kuanhaos[2]['shijiyongliang'];
			$data['shengyu3'] = $kuanhaos[2]['shengyu'];
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
			$data['zhishiyongliang4'] = $kuanhaos[3]['zhishiyongliang'];
			$data['shijiyongliang4'] = $kuanhaos[3]['shijiyongliang'];
			$data['shengyu4'] = $kuanhaos[3]['shengyu'];
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
			$data['zhishiyongliang5'] = $kuanhaos[4]['zhishiyongliang'];
			$data['shijiyongliang5'] = $kuanhaos[4]['shijiyongliang'];
			$data['shengyu5'] = $kuanhaos[4]['shengyu'];
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
			$data['zhishiyongliang6'] = $kuanhaos[5]['zhishiyongliang'];
			$data['shijiyongliang6'] = $kuanhaos[5]['shijiyongliang'];
			$data['shengyu6'] = $kuanhaos[5]['shengyu'];
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
			$data['zhishiyongliang7'] = $kuanhaos[6]['zhishiyongliang'];
			$data['shijiyongliang7'] = $kuanhaos[6]['shijiyongliang'];
			$data['shengyu7'] = $kuanhaos[6]['shengyu'];
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
			$data['zhishiyongliang8'] = $kuanhaos[7]['zhishiyongliang'];
			$data['shijiyongliang8'] = $kuanhaos[7]['shijiyongliang'];
			$data['shengyu8'] = $kuanhaos[7]['shengyu'];
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
			$data['zhishiyongliang9'] = $kuanhaos[8]['zhishiyongliang'];
			$data['shijiyongliang9'] = $kuanhaos[8]['shijiyongliang'];
			$data['shengyu9'] = $kuanhaos[8]['shengyu'];
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
			$data['zhishiyongliang10'] = $kuanhaos[9]['zhishiyongliang'];
			$data['shijiyongliang10'] = $kuanhaos[9]['shijiyongliang'];
			$data['shengyu10'] = $kuanhaos[9]['shengyu'];
		}
		$this->display("goods/goods_edit_new22", $data);
	}
	public function goods_list_yuan()
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
		$data["list"] = $list;
		$this->display("goods/goods_list_yuan", $data);
	}
	public function goods_list_bao()
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
		$data["list"] = $list;
		$this->display("goods/goods_list_bao", $data);
	}
	public function goods_list_yu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->role->getgoodsAllPage1($gname,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage,$_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["allpage"] = $allpage;
		$list = $this->role->getgoodsAllNew1($page,$gname,$id);
		$data["gname"] = $gname;
		foreach ($list as $k => $v) {
			$guiges = $this->task->gettidlistjichu($v['id']);
			if (!empty($guiges)) {
				$list[$k]['openflg'] = 1;
			} else {
				$list[$k]['openflg'] = 0;
			}

			$pinmings = $this->task->gettidlistxiangmu($v['id']);
			if (!empty($pinmings)) {
				$list[$k]['openflg1'] = 1;
			} else {
				$list[$k]['openflg1'] = 0;
			}
		}
		$data["list"] = $list;
		$this->display("goods/goods_list_yu", $data);
	}
	public function goods_add_jichufei()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$tidlist = $this->task->gettidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/goods_add_jichufei", $data);
	}
	public function goods_save_jichufei()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$kehuming = isset($_POST["kehuming"]) ? $_POST["kehuming"] : '';
		$riqi = isset($_POST["riqi"]) ? $_POST["riqi"] : '';
		$riqi = strtotime($riqi);
		$shengcanshuliang = isset($_POST["shengcanshuliang"]) ? $_POST["shengcanshuliang"] : '';
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		$xiaoji = isset($_POST["xiaoji"]) ? $_POST["xiaoji"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';

		$rid = $this->role->role_save_yusuan($kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		if ($rid) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save_yusuan($kid,$v);
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_edit_jichufei()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdxiaojiejei($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$tidlist = $this->task->gettidlist();
		$data = array();
		$data['id'] = $id;
		$data['kehuming'] = $goods_info['kehuming'];
		$data['riqi'] = $goods_info['riqi'];
		$data['shengcanshuliang'] = $goods_info['shengcanshuliang'];
		$data['sunhao'] = $goods_info['sunhao'];
		$data['xiaoji'] = $goods_info['xiaoji'];
		$data['jiagongfeidanjia'] = $goods_info['jiagongfeidanjia'];
		$data['jiagongfeiyongliang'] = $goods_info['jiagongfeiyongliang'];
		$data['ercijiagongfeidanjia'] = $goods_info['ercijiagongfeidanjia'];
		$data['ercijiagongfeiyongliang'] = $goods_info['ercijiagongfeiyongliang'];
		$data['jianpinfeidanjia'] = $goods_info['jianpinfeidanjia'];
		$data['jianpinfeiyongliang'] = $goods_info['jianpinfeiyongliang'];
		$data['tongguanfeidanjia'] = $goods_info['tongguanfeidanjia'];
		$data['tongguanfeiyongliang'] = $goods_info['tongguanfeiyongliang'];
		$data['mianliaojiancedanjia'] = $goods_info['mianliaojiancedanjia'];
		$data['mianliaojianceyongliang'] = $goods_info['mianliaojianceyongliang'];
		$data['yunfeidanjia'] = $goods_info['yunfeidanjia'];
		$data['yunfeiyongliang'] = $goods_info['yunfeiyongliang'];
		$data['qitadanjia'] = $goods_info['qitadanjia'];
		$data['qitayongliang'] = $goods_info['qitayongliang'];

		$data['tidlist'] = $tidlist;
		$mefuze = $this->task->gettidlistfuzeyusuan($id);
		foreach ($mefuze as $k => $v) {
			$data['mefuze'][] = $v['uid'];
		}
		$this->display("goods/goods_edit_jichufei", $data);
	}
	public function goods_save_jichufei_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$menu = isset($_POST["menu"]) ? $_POST["menu"] : '';
		$add_time = time();
		$kid = isset($_POST["id"]) ? $_POST["id"] : '';
		$kehuming = isset($_POST["kehuming"]) ? $_POST["kehuming"] : '';
		$riqi = isset($_POST["riqi"]) ? $_POST["riqi"] : '';
		$riqi = strtotime($riqi);
		$shengcanshuliang = isset($_POST["shengcanshuliang"]) ? $_POST["shengcanshuliang"] : '';
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		$xiaoji = isset($_POST["xiaoji"]) ? $_POST["xiaoji"] : '';
		$jiagongfeidanjia = isset($_POST["jiagongfeidanjia"]) ? $_POST["jiagongfeidanjia"] : '';
		$jiagongfeiyongliang = isset($_POST["jiagongfeiyongliang"]) ? $_POST["jiagongfeiyongliang"] : '';
		$ercijiagongfeidanjia = isset($_POST["ercijiagongfeidanjia"]) ? $_POST["ercijiagongfeidanjia"] : '';
		$ercijiagongfeiyongliang = isset($_POST["ercijiagongfeiyongliang"]) ? $_POST["ercijiagongfeiyongliang"] : '';
		$jianpinfeidanjia = isset($_POST["jianpinfeidanjia"]) ? $_POST["jianpinfeidanjia"] : '';
		$jianpinfeiyongliang = isset($_POST["jianpinfeiyongliang"]) ? $_POST["jianpinfeiyongliang"] : '';
		$tongguanfeidanjia = isset($_POST["tongguanfeidanjia"]) ? $_POST["tongguanfeidanjia"] : '';
		$tongguanfeiyongliang = isset($_POST["tongguanfeiyongliang"]) ? $_POST["tongguanfeiyongliang"] : '';
		$mianliaojiancedanjia = isset($_POST["mianliaojiancedanjia"]) ? $_POST["mianliaojiancedanjia"] : '';
		$mianliaojianceyongliang = isset($_POST["mianliaojianceyongliang"]) ? $_POST["mianliaojianceyongliang"] : '';
		$yunfeidanjia = isset($_POST["yunfeidanjia"]) ? $_POST["yunfeidanjia"] : '';
		$yunfeiyongliang = isset($_POST["yunfeiyongliang"]) ? $_POST["yunfeiyongliang"] : '';
		$qitadanjia = isset($_POST["qitadanjia"]) ? $_POST["qitadanjia"] : '';
		$qitayongliang = isset($_POST["qitayongliang"]) ? $_POST["qitayongliang"] : '';

		$result = $this->role->goods_save_edit_yusuan($kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time);
		$this->role->goodsimg_delete_yusuan($kid);
		if ($result) {
			foreach ($menu as $k => $v) {
				$this->role->rtom_save_yusuan($kid,$v);
			}
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
		}
	}
	public function goods_add_jichu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add_jichu", $data);
	}
	public function goods_save_jichu()
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

		$xiangmu = isset($_POST["xiangmu"]) ? $_POST["xiangmu"] : '';
		if (empty($xiangmu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加项目!"));
			return;
		}
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		if (empty($mingcheng[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加名称!"));
			return;
		}
		$guige = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guige[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$danjia = isset($_POST["danjia"]) ? $_POST["danjia"] : '';
		if (empty($danjia[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单价!"));
			return;
		}
		$danwei1 = isset($_POST["danwei1"]) ? $_POST["danwei1"] : '';
		if (empty($danwei1[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$yongliang = isset($_POST["yongliang"]) ? $_POST["yongliang"] : '';
		if (empty($yongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加用量!"));
			return;
		}
		$danwei2 = isset($_POST["danwei2"]) ? $_POST["danwei2"] : '';
		if (empty($danwei2[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$jine = isset($_POST["jine"]) ? $_POST["jine"] : '';
		if (empty($jine[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加金额!"));
			return;
		}
		$danwei3 = isset($_POST["danwei3"]) ? $_POST["danwei3"] : '';
		if (empty($danwei3[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$qidingliang = isset($_POST["qidingliang"]) ? $_POST["qidingliang"] : '';
		if (empty($qidingliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加起订量!"));
			return;
		}
		$beizhu = isset($_POST["beizhu"]) ? $_POST["beizhu"] : '';
		if (empty($beizhu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加备注!"));
			return;
		}
		foreach ($xiangmu as $k => $v) {
			if (empty($v) || empty($mingcheng[$k]) || empty($guige[$k]) || empty($danweis[$k]) || empty($danjia[$k]) || empty($danwei1[$k]) || empty($yongliang[$k]) || empty($danwei2[$k]) || empty($jine[$k]) || empty($danwei3[$k]) || empty($qidingliang[$k]) || empty($beizhu[$k])) {
				continue;
			}
			$this->role->role_save_edit_jichu($v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));
	}
	public function goods_edit_jichu()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->role->getgoodsByIdkuanhao($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['id'] = $id;
		$kuanhaos = $this->task->gettidlistjichu1($id);

		$data['xiangmu1'] = '';
		$data['mingcheng1'] = '';
		$data['guige1'] = '';
		$data['danwei1'] = '';
		$data['danjia1'] = '';
		$data['danwei1_1'] = '';
		$data['yongliang1'] = '';
		$data['danwei2_1'] = '';
		$data['jine1'] = '';
		$data['danwei3_1'] = '';
		$data['qidingliang1'] = '';
		$data['beizhu1'] = '';

		$data['xiangmu2'] = '';
		$data['mingcheng2'] = '';
		$data['guige2'] = '';
		$data['danwei2'] = '';
		$data['danjia2'] = '';
		$data['danwei1_2'] = '';
		$data['yongliang2'] = '';
		$data['danwei2_2'] = '';
		$data['jine2'] = '';
		$data['danwei3_2'] = '';
		$data['qidingliang2'] = '';
		$data['beizhu2'] = '';

		$data['xiangmu3'] = '';
		$data['mingcheng3'] = '';
		$data['guige3'] = '';
		$data['danwei3'] = '';
		$data['danjia3'] = '';
		$data['danwei1_3'] = '';
		$data['yongliang3'] = '';
		$data['danwei2_3'] = '';
		$data['jine3'] = '';
		$data['danwei3_3'] = '';
		$data['qidingliang3'] = '';
		$data['beizhu3'] = '';

		$data['xiangmu4'] = '';
		$data['mingcheng4'] = '';
		$data['guige4'] = '';
		$data['danwei4'] = '';
		$data['danjia4'] = '';
		$data['danwei1_4'] = '';
		$data['yongliang4'] = '';
		$data['danwei2_4'] = '';
		$data['jine4'] = '';
		$data['danwei3_4'] = '';
		$data['qidingliang4'] = '';
		$data['beizhu4'] = '';

		$data['xiangmu5'] = '';
		$data['mingcheng5'] = '';
		$data['guige5'] = '';
		$data['danwei5'] = '';
		$data['danjia5'] = '';
		$data['danwei1_5'] = '';
		$data['yongliang5'] = '';
		$data['danwei2_5'] = '';
		$data['jine5'] = '';
		$data['danwei3_5'] = '';
		$data['qidingliang5'] = '';
		$data['beizhu5'] = '';

		$data['xiangmu6'] = '';
		$data['mingcheng6'] = '';
		$data['guige6'] = '';
		$data['danwei6'] = '';
		$data['danjia6'] = '';
		$data['danwei1_6'] = '';
		$data['yongliang6'] = '';
		$data['danwei2_6'] = '';
		$data['jine6'] = '';
		$data['danwei3_6'] = '';
		$data['qidingliang6'] = '';
		$data['beizhu6'] = '';

		$data['xiangmu7'] = '';
		$data['mingcheng7'] = '';
		$data['guige7'] = '';
		$data['danwei7'] = '';
		$data['danjia7'] = '';
		$data['danwei1_7'] = '';
		$data['yongliang7'] = '';
		$data['danwei2_7'] = '';
		$data['jine7'] = '';
		$data['danwei3_7'] = '';
		$data['qidingliang7'] = '';
		$data['beizhu7'] = '';

		$data['xiangmu8'] = '';
		$data['mingcheng8'] = '';
		$data['guige8'] = '';
		$data['danwei8'] = '';
		$data['danjia8'] = '';
		$data['danwei1_8'] = '';
		$data['yongliang8'] = '';
		$data['danwei2_8'] = '';
		$data['jine8'] = '';
		$data['danwei3_8'] = '';
		$data['qidingliang8'] = '';
		$data['beizhu8'] = '';

		$data['xiangmu9'] = '';
		$data['mingcheng9'] = '';
		$data['guige9'] = '';
		$data['danwei9'] = '';
		$data['danjia9'] = '';
		$data['danwei1_9'] = '';
		$data['yongliang9'] = '';
		$data['danwei2_9'] = '';
		$data['jine9'] = '';
		$data['danwei3_9'] = '';
		$data['qidingliang9'] = '';
		$data['beizhu9'] = '';

		$data['xiangmu10'] = '';
		$data['mingcheng10'] = '';
		$data['guige10'] = '';
		$data['danwei10'] = '';
		$data['danjia10'] = '';
		$data['danwei1_10'] = '';
		$data['yongliang10'] = '';
		$data['danwei2_10'] = '';
		$data['jine10'] = '';
		$data['danwei3_10'] = '';
		$data['qidingliang10'] = '';
		$data['beizhu10'] = '';

		if (!empty($kuanhaos[0]['xiangmu'])) {
			$data['xiangmu1'] = $kuanhaos[0]['xiangmu'];
			$data['mingcheng1'] = $kuanhaos[0]['mingcheng'];
			$data['guige1'] = $kuanhaos[0]['guige'];
			$data['danwei1'] = $kuanhaos[0]['danwei'];
			$data['danjia1'] = $kuanhaos[0]['danjia'];
			$data['danwei1_1'] = $kuanhaos[0]['danwei1'];
			$data['yongliang1'] = $kuanhaos[0]['yongliang'];
			$data['danwei2_1'] = $kuanhaos[0]['danwei2'];
			$data['jine1'] = $kuanhaos[0]['jine'];
			$data['danwei3_1'] = $kuanhaos[0]['danwei3'];
			$data['qidingliang1'] = $kuanhaos[0]['qidingliang'];
			$data['beizhu1'] = $kuanhaos[0]['beizhu'];
		}
		if (!empty($kuanhaos[1]['xiangmu'])) {
			$data['xiangmu2'] = $kuanhaos[1]['xiangmu'];
			$data['mingcheng2'] = $kuanhaos[1]['mingcheng'];
			$data['guige2'] = $kuanhaos[1]['guige'];
			$data['danwei2'] = $kuanhaos[1]['danwei'];
			$data['danjia2'] = $kuanhaos[1]['danjia'];
			$data['danwei1_2'] = $kuanhaos[1]['danwei1'];
			$data['yongliang2'] = $kuanhaos[1]['yongliang'];
			$data['danwei2_2'] = $kuanhaos[1]['danwei2'];
			$data['jine2'] = $kuanhaos[1]['jine'];
			$data['danwei3_2'] = $kuanhaos[1]['danwei3'];
			$data['qidingliang2'] = $kuanhaos[1]['qidingliang'];
			$data['beizhu2'] = $kuanhaos[1]['beizhu'];
		}
		if (!empty($kuanhaos[2]['xiangmu'])) {
			$data['xiangmu3'] = $kuanhaos[2]['xiangmu'];
			$data['mingcheng3'] = $kuanhaos[2]['mingcheng'];
			$data['guige3'] = $kuanhaos[2]['guige'];
			$data['danwei3'] = $kuanhaos[2]['danwei'];
			$data['danjia3'] = $kuanhaos[2]['danjia'];
			$data['danwei1_3'] = $kuanhaos[2]['danwei1'];
			$data['yongliang3'] = $kuanhaos[2]['yongliang'];
			$data['danwei2_3'] = $kuanhaos[2]['danwei2'];
			$data['jine3'] = $kuanhaos[2]['jine'];
			$data['danwei3_3'] = $kuanhaos[2]['danwei3'];
			$data['qidingliang3'] = $kuanhaos[2]['qidingliang'];
			$data['beizhu3'] = $kuanhaos[2]['beizhu'];
		}
		if (!empty($kuanhaos[3]['xiangmu'])) {
			$data['xiangmu4'] = $kuanhaos[3]['xiangmu'];
			$data['mingcheng4'] = $kuanhaos[3]['mingcheng'];
			$data['guige4'] = $kuanhaos[3]['guige'];
			$data['danwei4'] = $kuanhaos[3]['danwei'];
			$data['danjia4'] = $kuanhaos[3]['danjia'];
			$data['danwei1_4'] = $kuanhaos[3]['danwei1'];
			$data['yongliang4'] = $kuanhaos[3]['yongliang'];
			$data['danwei2_4'] = $kuanhaos[3]['danwei2'];
			$data['jine4'] = $kuanhaos[3]['jine'];
			$data['danwei3_4'] = $kuanhaos[3]['danwei3'];
			$data['qidingliang4'] = $kuanhaos[3]['qidingliang'];
			$data['beizhu4'] = $kuanhaos[3]['beizhu'];
		}
		if (!empty($kuanhaos[4]['xiangmu'])) {
			$data['xiangmu5'] = $kuanhaos[4]['xiangmu'];
			$data['mingcheng5'] = $kuanhaos[4]['mingcheng'];
			$data['guige5'] = $kuanhaos[4]['guige'];
			$data['danwei5'] = $kuanhaos[4]['danwei'];
			$data['danjia5'] = $kuanhaos[4]['danjia'];
			$data['danwei1_5'] = $kuanhaos[4]['danwei1'];
			$data['yongliang5'] = $kuanhaos[4]['yongliang'];
			$data['danwei2_5'] = $kuanhaos[4]['danwei2'];
			$data['jine5'] = $kuanhaos[4]['jine'];
			$data['danwei3_5'] = $kuanhaos[4]['danwei3'];
			$data['qidingliang5'] = $kuanhaos[4]['qidingliang'];
			$data['beizhu5'] = $kuanhaos[4]['beizhu'];
		}
		if (!empty($kuanhaos[5]['xiangmu'])) {
			$data['xiangmu6'] = $kuanhaos[5]['xiangmu'];
			$data['mingcheng6'] = $kuanhaos[5]['mingcheng'];
			$data['guige6'] = $kuanhaos[5]['guige'];
			$data['danwei6'] = $kuanhaos[5]['danwei'];
			$data['danjia6'] = $kuanhaos[5]['danjia'];
			$data['danwei1_6'] = $kuanhaos[5]['danwei1'];
			$data['yongliang6'] = $kuanhaos[5]['yongliang'];
			$data['danwei2_6'] = $kuanhaos[5]['danwei2'];
			$data['jine6'] = $kuanhaos[5]['jine'];
			$data['danwei3_6'] = $kuanhaos[5]['danwei3'];
			$data['qidingliang6'] = $kuanhaos[5]['qidingliang'];
			$data['beizhu6'] = $kuanhaos[5]['beizhu'];
		}
		if (!empty($kuanhaos[6]['xiangmu'])) {
			$data['xiangmu7'] = $kuanhaos[6]['xiangmu'];
			$data['mingcheng7'] = $kuanhaos[6]['mingcheng'];
			$data['guige7'] = $kuanhaos[6]['guige'];
			$data['danwei7'] = $kuanhaos[6]['danwei'];
			$data['danjia7'] = $kuanhaos[6]['danjia'];
			$data['danwei1_7'] = $kuanhaos[6]['danwei1'];
			$data['yongliang7'] = $kuanhaos[6]['yongliang'];
			$data['danwei2_7'] = $kuanhaos[6]['danwei2'];
			$data['jine7'] = $kuanhaos[6]['jine'];
			$data['danwei3_7'] = $kuanhaos[6]['danwei3'];
			$data['qidingliang7'] = $kuanhaos[6]['qidingliang'];
			$data['beizhu7'] = $kuanhaos[6]['beizhu'];
		}
		if (!empty($kuanhaos[7]['xiangmu'])) {
			$data['xiangmu8'] = $kuanhaos[7]['xiangmu'];
			$data['mingcheng8'] = $kuanhaos[7]['mingcheng'];
			$data['guige8'] = $kuanhaos[7]['guige'];
			$data['danwei8'] = $kuanhaos[7]['danwei'];
			$data['danjia8'] = $kuanhaos[7]['danjia'];
			$data['danwei1_8'] = $kuanhaos[7]['danwei1'];
			$data['yongliang8'] = $kuanhaos[7]['yongliang'];
			$data['danwei2_8'] = $kuanhaos[7]['danwei2'];
			$data['jine8'] = $kuanhaos[7]['jine'];
			$data['danwei3_8'] = $kuanhaos[7]['danwei3'];
			$data['qidingliang8'] = $kuanhaos[7]['qidingliang'];
			$data['beizhu8'] = $kuanhaos[7]['beizhu'];
		}
		if (!empty($kuanhaos[8]['xiangmu'])) {
			$data['xiangmu9'] = $kuanhaos[8]['xiangmu'];
			$data['mingcheng9'] = $kuanhaos[8]['mingcheng'];
			$data['guige9'] = $kuanhaos[8]['guige'];
			$data['danwei9'] = $kuanhaos[8]['danwei'];
			$data['danjia9'] = $kuanhaos[8]['danjia'];
			$data['danwei1_9'] = $kuanhaos[8]['danwei1'];
			$data['yongliang9'] = $kuanhaos[8]['yongliang'];
			$data['danwei2_9'] = $kuanhaos[8]['danwei2'];
			$data['jine9'] = $kuanhaos[8]['jine'];
			$data['danwei3_9'] = $kuanhaos[8]['danwei3'];
			$data['qidingliang9'] = $kuanhaos[8]['qidingliang'];
			$data['beizhu9'] = $kuanhaos[8]['beizhu'];
		}
		if (!empty($kuanhaos[9]['xiangmu'])) {
			$data['xiangmu10'] = $kuanhaos[9]['xiangmu'];
			$data['mingcheng10'] = $kuanhaos[9]['mingcheng'];
			$data['guige10'] = $kuanhaos[9]['guige'];
			$data['danwei10'] = $kuanhaos[9]['danwei'];
			$data['danjia10'] = $kuanhaos[9]['danjia'];
			$data['danwei1_10'] = $kuanhaos[9]['danwei1'];
			$data['yongliang10'] = $kuanhaos[9]['yongliang'];
			$data['danwei2_10'] = $kuanhaos[9]['danwei2'];
			$data['jine10'] = $kuanhaos[9]['jine'];
			$data['danwei3_10'] = $kuanhaos[9]['danwei3'];
			$data['qidingliang10'] = $kuanhaos[9]['qidingliang'];
			$data['beizhu10'] = $kuanhaos[9]['beizhu'];
		}
		$this->display("goods/goods_edit_jichu", $data);
	}
	public function goods_save_edit_jichu()
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

		$xiangmu = isset($_POST["xiangmu"]) ? $_POST["xiangmu"] : '';
		if (empty($xiangmu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加项目!"));
			return;
		}
		$mingcheng = isset($_POST["mingcheng"]) ? $_POST["mingcheng"] : '';
		if (empty($mingcheng[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加名称!"));
			return;
		}
		$guige = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guige[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$danjia = isset($_POST["danjia"]) ? $_POST["danjia"] : '';
		if (empty($danjia[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单价!"));
			return;
		}
		$danwei1 = isset($_POST["danwei1"]) ? $_POST["danwei1"] : '';
		if (empty($danwei1[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$yongliang = isset($_POST["yongliang"]) ? $_POST["yongliang"] : '';
		if (empty($yongliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加用量!"));
			return;
		}
		$danwei2 = isset($_POST["danwei2"]) ? $_POST["danwei2"] : '';
		if (empty($danwei2[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$jine = isset($_POST["jine"]) ? $_POST["jine"] : '';
		if (empty($jine[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加金额!"));
			return;
		}
		$danwei3 = isset($_POST["danwei3"]) ? $_POST["danwei3"] : '';
		if (empty($danwei3[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$qidingliang = isset($_POST["qidingliang"]) ? $_POST["qidingliang"] : '';
		if (empty($qidingliang[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加起订量!"));
			return;
		}
		$beizhu = isset($_POST["beizhu"]) ? $_POST["beizhu"] : '';
		if (empty($beizhu[0])) {
			echo json_encode(array('error' => true, 'msg' => "请添加备注!"));
			return;
		}
		$this->role->goodsimg_delete_jichu($id);
		foreach ($xiangmu as $k => $v) {
			if (empty($v) || empty($mingcheng[$k]) || empty($guige[$k]) || empty($danweis[$k]) || empty($danjia[$k]) || empty($danwei1[$k]) || empty($yongliang[$k]) || empty($danwei2[$k]) || empty($jine[$k]) || empty($danwei3[$k]) || empty($qidingliang[$k]) || empty($beizhu[$k])) {
				continue;
			}
			$this->role->role_save_edit_jichu($v,$mingcheng[$k],$guige[$k],$danweis[$k],$danjia[$k],$danwei1[$k],$yongliang[$k],$danwei2[$k],$jine[$k],$danwei3[$k],$qidingliang[$k],$beizhu[$k],$id,time());
		}
		echo json_encode(array('success' => true, 'msg' => "操作成功。"));

	}
	/**
	 * 原辅料平衡表导出
	 */
	public function goods_csv()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$list = $this->role->getgoodsAllNewid($id);
		$list1 = $this->role->gettidlistguige($id);
		$list2 = $this->role->gettidlistpinming($id);

		$inputFileName = "./static/uploads/yflphb.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//对应的列都附上数据和编号
		$objPHPExcel->getActiveSheet()->setCellValue( 'C13',$list['bianhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G13',$list['kuanhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'K13',date('Y-m-d',$list['qianding']));

		$GUIGE_ARR = array();
		$SEHAO_ARR = array();
		$SHUZHI_ARR = array();
		foreach ($list1 as $k=>$v){
			$GUIGE_ARR[] = $v['guige'];
			$SEHAO_ARR[] = $v['sehao'];
			$SHUZHI_ARR[] = $v['shuzhi'];
		}
		$GUIGE_ARR = array_unique($GUIGE_ARR);
		$SEHAO_ARR = array_unique($SEHAO_ARR);
		$arr1 = array();
		$rowold = -1;
		foreach ($SEHAO_ARR as $kk=>$vv){
			$rowold = $rowold + 1;
			$row = $rowold + 3;
			$objPHPExcel->getActiveSheet()->setCellValue( 'M'.$row,$vv);
			foreach ($list1 as $key=>$val){
				if ($vv == $val['sehao']){
					$arr1[$key]['lin'] = $row;
					$arr1[$key]['guigeold'] = $val['guige'];
					$arr1[$key]['shuzihold'] = $val['shuzhi'];
				}
			}
		}
		$zimu = 'N';
		$rowold1 = -1;
		foreach ($GUIGE_ARR as $kkk=>$vvv){
			$rowold1 = $rowold1 + 1;
			if ($rowold1 == 0){
				$objPHPExcel->getActiveSheet()->setCellValue( 'N1',$vvv);
				$zimu = 'N';
			}
			if ($rowold1 == 1){
				$objPHPExcel->getActiveSheet()->setCellValue( 'O1',$vvv);
				$zimu = 'O';
			}
			if ($rowold1 == 2){
				$objPHPExcel->getActiveSheet()->setCellValue( 'P1',$vvv);
				$zimu = 'P';
			}
			if ($rowold1 == 3){
				$objPHPExcel->getActiveSheet()->setCellValue( 'Q1',$vvv);
				$zimu = 'Q';
			}
			if ($rowold1 == 4){
				$objPHPExcel->getActiveSheet()->setCellValue( 'R1',$vvv);
				$zimu = 'R';
			}
			if ($rowold1 == 5){
				$objPHPExcel->getActiveSheet()->setCellValue( 'S1',$vvv);
				$zimu = 'S';
			}
			if ($rowold1 == 6){
				$objPHPExcel->getActiveSheet()->setCellValue( 'T1',$vvv);
				$zimu = 'T';
			}
			if ($rowold1 == 7){
				$objPHPExcel->getActiveSheet()->setCellValue( 'U1',$vvv);
				$zimu = 'U';
			}
			if ($rowold1 == 8){
				$objPHPExcel->getActiveSheet()->setCellValue( 'V1',$vvv);
				$zimu = 'V';
			}
			if ($rowold1 == 9){
				$objPHPExcel->getActiveSheet()->setCellValue( 'W1',$vvv);
				$zimu = 'W';
			}
			foreach ($arr1 as $keyy=>$vall){
				if ($vall['guigeold'] == $vvv){
					$objPHPExcel->getActiveSheet()->setCellValue($zimu.$vall['lin'],$vall['shuzihold']);
				}
			}
		}

		$rownew = 16;
		$rowoldnew1 = -1;
		foreach ($list2 as $kp=>$vp){
			$rowoldnew1 = $rowoldnew1 + 1;
			$row11 = $rownew + $rowoldnew1;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row11,$vp['pinming']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row11,$vp['pinfan']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row11,$vp['sehao']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row11,$vp['guige']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row11,$vp['danwei']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row11,$vp['tidanshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row11,$vp['qingdianshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row11,$vp['yangzhishi']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row11,$vp['shiji']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row11,$vp['sunhao']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row11,$vp['jianshu']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row11,$vp['sunhaoyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row11,$vp['zhishiyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row11,$vp['shijiyongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row11,$vp['shengyu']);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$row11,$vp['daoliaori']);
		}

		ob_end_clean();//清除缓存区，解决乱码问题
		$fileName = '原辅材料平衡表' . date('Ymd_His');
		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}

	/**
	 * 报价单导出
	 */
	public function goods_csv_baojiadan()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$btype = isset($_GET['btype']) ? $_GET['btype'] : 1;
		if ($btype == 1){
			$fileName = '预算报价单' . date('Ymd_His');
			//预算
			$baojiaxiangmu = $this->role->geterp_baojiaxiangmu($id);
			$baojiafuzeren = $this->role->geterp_baojiafuzeren($id);
			$baojiadanfeiyong = $this->role->getgoodsByIdxiaojiejei($id);
		}else{
			$fileName = '决算报价单' . date('Ymd_His');
			//决算
			$baojiaxiangmu = $this->role->geterp_baojiaxiangmujue($id);
			$baojiafuzeren = $this->role->geterp_baojiafuzerenjue($id);
			$baojiadanfeiyong = $this->role->getgoodsByIdxiaojiejeijue($id);
		}
		$list = $this->role->getgoodsAllNewid($id);
		$set_info1 = $this->set->set_edit_new();
		$huilv = $set_info1['price'];
		$fuzeren = '';
		if (!empty($baojiafuzeren)){
			foreach ($baojiafuzeren as $k=>$v){
				if ($k<1){
					$fuzeren = $fuzeren.$v['username'];
				}else{
					$fuzeren = $fuzeren."、".$v['username'];
				}
			}
		}
		$inputFileName = "./static/uploads/fzbjd.xls";
		date_default_timezone_set('PRC');
		// 读取excel文件
		try {
			$IOFactory = new IOFactory();
			$inputFileType = $IOFactory->identify($inputFileName);
			$objReader = $IOFactory->createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);

		} catch(\Exception $e) {
			die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//对应的列都附上数据和编号
		$objPHPExcel->getActiveSheet()->setCellValue( 'B3',$baojiadanfeiyong['kehuming']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'F3',$list['kuanhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'F2',$fuzeren);
		$objPHPExcel->getActiveSheet()->setCellValue( 'L2',date('Y-m-d',$baojiadanfeiyong['riqi']));
		$objPHPExcel->getActiveSheet()->setCellValue( 'L3',$baojiadanfeiyong['shengcanshuliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E17',$baojiadanfeiyong['sunhao']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G17',$baojiadanfeiyong['xiaoji']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E18',$baojiadanfeiyong['jiagongfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G18',$baojiadanfeiyong['jiagongfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E19',$baojiadanfeiyong['ercijiagongfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G19',$baojiadanfeiyong['ercijiagongfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E20',$baojiadanfeiyong['jianpinfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G20',$baojiadanfeiyong['jianpinfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E21',$baojiadanfeiyong['tongguanfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G21',$baojiadanfeiyong['tongguanfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E22',$baojiadanfeiyong['mianliaojiancedanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G22',$baojiadanfeiyong['mianliaojianceyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E23',$baojiadanfeiyong['yunfeidanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G23',$baojiadanfeiyong['yunfeiyongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'E24',$baojiadanfeiyong['qitadanjia']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'G24',$baojiadanfeiyong['qitayongliang']);
		$objPHPExcel->getActiveSheet()->setCellValue( 'I26',$huilv);

		$rownew = 6;
		$rowoldnew1 = -1;
		foreach ($baojiaxiangmu as $kp=>$vp){
			$rowoldnew1 = $rowoldnew1 + 1;
			$row11 = $rownew + $rowoldnew1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row11,$vp['xiangmu']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row11,$vp['mingcheng']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row11,$vp['guige']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row11,$vp['danwei']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row11,$vp['danjia']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row11,$vp['danwei1']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row11,$vp['yongliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row11,$vp['danwei2']);
//			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row11,$vp['jine']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row11,$vp['danwei3']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row11,$vp['qidingliang']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row11,$vp['beizhu']);
		}

		ob_end_clean();//清除缓存区，解决乱码问题

		// 生成2007excel格式的xlsx文件
		$IOFactory = new IOFactory();
		$PHPWriter = $IOFactory->createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: text/html;charset=utf-8');
		header('Content-Type: xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
		header('Cache-Control: max-age=0');
		$PHPWriter->save("php://output");
		exit;
	}
}
