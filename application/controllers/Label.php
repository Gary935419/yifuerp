<?php

/**
 * **********************************************************************
 * サブシステム名  ： ERP
 * 機能名         ：子公司
 * 作成者        ： Gary
 * **********************************************************************
 */
class Label extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Label_model', 'label');
        header("Content-type:text/html;charset=utf-8");
    }
    public function label_list()
    {
        $lname = isset($_GET['lname']) ? $_GET['lname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->label->getlabelAllPage($lname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->label->getlabelAll($page, $lname);
        $data["list"] = $list;
        $data["lname"] = $lname;
        $this->display("label/label_list", $data);
    }
    public function label_add()
    {
        $this->display("label/label_add");
    }
    public function label_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
        $add_time = time();

        $label_info = $this->label->getlabelByname($lname);
        if (!empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "该公司名称已经存在。"));
            return;
        }
        $result = $this->label->label_save($lname,$lpname,$ltel,$add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
        }
    }
    public function label_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->label->label_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
        }
    }
    public function label_edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $label_info = $this->label->getlabelById($id);
        if (empty($label_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['lname'] = $label_info['lname'];
		$data['lpname'] = $label_info['lpname'];
		$data['ltel'] = $label_info['ltel'];
        $data['id'] = $id;
        $this->display("label/label_edit", $data);
    }
    public function label_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
		$lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
		$lpname = isset($_POST["lpname"]) ? $_POST["lpname"] : '';
		$ltel = isset($_POST["ltel"]) ? $_POST["ltel"] : '';
        $id = isset($_POST["id"]) ? $_POST["id"] : '';
        $label_info = $this->label->getlabelById2($lname,$id);
        if (!empty($label_info)){
            echo json_encode(array('error' => false, 'msg' => "该标签名称已经存在"));
            return;
        }

        $result = $this->label->label_save_edit($id,$lname,$lpname,$ltel);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
        }
    }
	public function yangpin_add()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$data["id"] = $id;
		$this->display("label/yangpin_add", $data);
	}
	public function yangpin_list()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$kuhumingcheng = isset($_GET["kuhumingcheng"]) ? $_GET["kuhumingcheng"] : '';
		$allpage = $this->label->getlabelAllPageyangpin($kuhumingcheng,$start,$end,$id);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page,$allpage, $_GET);
		$data["page"] = $page;
		$data["id"] = $id;
		$data["start"] = $start;
		$data["end"] = $end;
		$data["allpage"] = $allpage;
		$list = $this->label->getlabelAllyangpin($page,$kuhumingcheng,$start,$end,$id);
		$data["list"] = $list;
		$data["kuhumingcheng"] = $kuhumingcheng;
		$this->display("label/yangpin_list", $data);
	}

}
