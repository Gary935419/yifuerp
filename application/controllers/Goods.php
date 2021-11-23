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
		if (empty($kuanhao)) {
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
		if (empty($guiges)) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos)) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis)) {
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
		if (empty($kuanhao)) {
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

	public function goods_save_edit1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges)) {
			echo json_encode(array('error' => true, 'msg' => "请添加完整表单信息!"));
			return;
		}

		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges)) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos)) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$shuzhis = isset($_POST["shuzhi"]) ? $_POST["shuzhi"] : '';
		if (empty($shuzhis)) {
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

	public function goods_add2()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;
		$this->display("goods/goods_add2", $data);
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
		if (empty($pinmings)) {
			echo json_encode(array('error' => true, 'msg' => "请添加品名!"));
			return;
		}
		$pinfans = isset($_POST["pinfan"]) ? $_POST["pinfan"] : '';
		if (empty($pinfans)) {
			echo json_encode(array('error' => true, 'msg' => "请添加品番!"));
			return;
		}
		$sehaos = isset($_POST["sehao"]) ? $_POST["sehao"] : '';
		if (empty($sehaos)) {
			echo json_encode(array('error' => true, 'msg' => "请添加色号!"));
			return;
		}
		$guiges = isset($_POST["guige"]) ? $_POST["guige"] : '';
		if (empty($guiges)) {
			echo json_encode(array('error' => true, 'msg' => "请添加规格!"));
			return;
		}
		$danweis = isset($_POST["danwei"]) ? $_POST["danwei"] : '';
		if (empty($danweis)) {
			echo json_encode(array('error' => true, 'msg' => "请添加单位!"));
			return;
		}
		$tidanshu = isset($_POST["tidanshu"]) ? $_POST["tidanshu"] : '';
		if (empty($tidanshu)) {
			echo json_encode(array('error' => true, 'msg' => "请添加提单数!"));
			return;
		}
		$qingdianshu = isset($_POST["qingdianshu"]) ? $_POST["qingdianshu"] : '';
		if (empty($qingdianshu)) {
			echo json_encode(array('error' => true, 'msg' => "请添加请点数!"));
			return;
		}
		$yangzhishi = isset($_POST["yangzhishi"]) ? $_POST["yangzhishi"] : '';
		if (empty($yangzhishi)) {
			echo json_encode(array('error' => true, 'msg' => "请添加样指示!"));
			return;
		}
		$shiji = isset($_POST["shiji"]) ? $_POST["shiji"] : '';
		if (empty($shiji)) {
			echo json_encode(array('error' => true, 'msg' => "请添加实际!"));
			return;
		}
		$sunhao = isset($_POST["sunhao"]) ? $_POST["sunhao"] : '';
		if (empty($sunhao)) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗!"));
			return;
		}
		$jianshu = isset($_POST["jianshu"]) ? $_POST["jianshu"] : '';
		if (empty($jianshu)) {
			echo json_encode(array('error' => true, 'msg' => "请添加件数!"));
			return;
		}
		$sunhaoyongliang = isset($_POST["sunhaoyongliang"]) ? $_POST["sunhaoyongliang"] : '';
		if (empty($sunhaoyongliang)) {
			echo json_encode(array('error' => true, 'msg' => "请添加损耗用量!"));
			return;
		}
		$daoliaori = isset($_POST["daoliaori"]) ? $_POST["daoliaori"] : '';
		if (empty($daoliaori)) {
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
}
