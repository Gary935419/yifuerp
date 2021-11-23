<?php


class Role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //查询角色信息列表
    public function getroleAll()
    {
        $sql = "SELECT * FROM `role` order by rid desc";
        return $this->db->query($sql)->result_array();
    }
    //角色count
    public function getroleAllPage()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT count(1) as number FROM `role` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //角色list
    public function getroleAllNew($pg)
    {
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sqlw = " where 1=1 ";
        $sql = "SELECT * FROM `role` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
	public function getRtomList($rid)
	{
		$sqlw = " where rid = $rid ";
		$sql = "SELECT * FROM `rtom` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
    //角色save
    public function role_save($rname, $rdetails, $add_time)
    {
        $rname = $this->db->escape($rname);
        $rdetails = $this->db->escape($rdetails);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `role` (rname,rdetails,add_time) VALUES ($rname,$rdetails,$add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
    }
	public function rtom_save($rid,$mid)
	{
		$sql = "INSERT INTO `rtom` (rid,mid) VALUES ($rid,$mid);";
		return $this->db->query($sql);
	}
    //角色delete
    public function role_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM role WHERE rid = $id";
        return $this->db->query($sql);
    }
	public function role_delete_rtom($rid)
	{
		$rid = $this->db->escape($rid);
		$sql = "DELETE FROM rtom WHERE rid = $rid";
		return $this->db->query($sql);
	}
    //角色byid
    public function getroleById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `role` where rid=$id ";
        return $this->db->query($sql)->row_array();
    }
	public function getroleByIdRtom($id,$mid)
	{
		$id = $this->db->escape($id);
		$mid = $this->db->escape($mid);
		$sql = "SELECT * FROM `rtom` where rid=$id and mid=$mid";
		return $this->db->query($sql)->row_array();
	}
    //角色byname
    public function getroleByname($rname)
    {
        $rname = $this->db->escape($rname);
        $sql = "SELECT * FROM `role` where rname=$rname ";
        return $this->db->query($sql)->row_array();
    }
    //角色save_edit
    public function role_save_edit($rid, $rname, $rdetails)
    {
        $rid = $this->db->escape($rid);
        $rname = $this->db->escape($rname);
        $rdetails = $this->db->escape($rdetails);

        $sql = "UPDATE `role` SET rname=$rname,rdetails=$rdetails WHERE rid = $rid";
        return $this->db->query($sql);
    }



	public function getroleByname1($bianhao)
	{
		$bianhao = $this->db->escape($bianhao);
		$sql = "SELECT * FROM `erp_xiangmuhetong` where bianhao=$bianhao ";
		return $this->db->query($sql)->row_array();
	}
	public function role_save1($bianhao,$mingcheng,$qianding,$jiaohuoqi,$add_time)
	{
		$bianhao = $this->db->escape($bianhao);
		$mingcheng = $this->db->escape($mingcheng);
		$qianding = $this->db->escape($qianding);
		$jiaohuoqi = $this->db->escape($jiaohuoqi);
		$add_time = $this->db->escape($add_time);

		$sql = "INSERT INTO `erp_xiangmuhetong` (bianhao,mingcheng,qianding,jiaohuoqi,addtime) VALUES ($bianhao,$mingcheng,$qianding,$jiaohuoqi,$add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function role_save12($guige,$sehao,$shuzhi,$kid,$time)
	{
		$guige = $this->db->escape($guige);
		$sehao = $this->db->escape($sehao);
		$shuzhi = $this->db->escape($shuzhi);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_yuanfuliaoguige` (guige,sehao,shuzhi,kid,addtime) VALUES ($guige,$sehao,$shuzhi,$kid,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function role_save123($pinming,$pinfan,$sehao,$guige,$danwei,$tidanshu,$qingdianshu,$yangzhishi,$shiji,$sunhao,$jianshu,$sunhaoyongliang,$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori,$kid,$time)
	{
		$pinming = $this->db->escape($pinming);
		$pinfan = $this->db->escape($pinfan);
		$sehao = $this->db->escape($sehao);
		$guige = $this->db->escape($guige);
		$danwei = $this->db->escape($danwei);
		$tidanshu = $this->db->escape($tidanshu);
		$qingdianshu = $this->db->escape($qingdianshu);
		$yangzhishi = $this->db->escape($yangzhishi);
		$shiji = $this->db->escape($shiji);
		$sunhao = $this->db->escape($sunhao);
		$jianshu = $this->db->escape($jianshu);
		$sunhaoyongliang = $this->db->escape($sunhaoyongliang);
		$zhishiyongliang = $this->db->escape($zhishiyongliang);
		$shijiyongliang = $this->db->escape($shijiyongliang);
		$shengyu = $this->db->escape($shengyu);
		$daoliaori = $this->db->escape($daoliaori);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_yuanfuliaopinghengbian` (pinming,pinfan,sehao,guige,danwei,tidanshu,qingdianshu,yangzhishi,shiji,sunhao,jianshu,sunhaoyongliang,zhishiyongliang,shijiyongliang,shengyu,daoliaori,kid,addtime) VALUES ($pinming,$pinfan,$sehao,$guige,$danwei,$tidanshu,$qingdianshu,$yangzhishi,$shiji,$sunhao,$jianshu,$sunhaoyongliang,$zhishiyongliang,$shijiyongliang,$shengyu,$daoliaori,$kid,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function rtom_save1($xid,$uid)
	{
		$xid = $this->db->escape($xid);
		$uid = $this->db->escape($uid);
		$sql = "INSERT INTO `erp_xiangmufuzeren` (xid,uid) VALUES ($xid,$uid);";
		return $this->db->query($sql);
	}
	public function rtom_save2($xid,$kuanhao,$add_time)
	{
		$xid = $this->db->escape($xid);
		$kuanhao = $this->db->escape($kuanhao);
		$add_time = $this->db->escape($add_time);
		$sql = "INSERT INTO `erp_xiangmukuanhao` (xid,kuanhao,addtime) VALUES ($xid,$kuanhao,$add_time);";
		return $this->db->query($sql);
	}
	public function getgoodsAllPage($gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( bianhao like '%" . $gname . "%' ) or ( mingcheng like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_xiangmuhetong`" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	public function getgoodsAllNew($pg,$gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( bianhao like '%" . $gname . "%' ) or ( mingcheng like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `erp_xiangmuhetong` " . $sqlw . " LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmuhetong` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsById22($bianhao,$id)
	{
		$bianhao = $this->db->escape($bianhao);
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmuhetong` where bianhao=$bianhao and id!=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function goods_save_edit($bianhao,$mingcheng,$qianding,$jiaohuoqi,$add_time,$id)
	{
		$bianhao = $this->db->escape($bianhao);
		$mingcheng = $this->db->escape($mingcheng);
		$qianding = $this->db->escape($qianding);
		$jiaohuoqi = $this->db->escape($jiaohuoqi);
		$add_time = $this->db->escape($add_time);
		$id = $this->db->escape($id);
		$sql = "UPDATE `erp_xiangmuhetong` SET bianhao=$bianhao,mingcheng=$mingcheng,qianding=$qianding,jiaohuoqi=$jiaohuoqi,addtime=$add_time WHERE id = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete1($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_xiangmufuzeren WHERE xid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete2($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_xiangmukuanhao WHERE xid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete3($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_yuanfuliaoguige WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goods_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_xiangmuhetong WHERE id = $id";
		return $this->db->query($sql);
	}
	public function getroleBynamekuanhao($kuanhao)
	{
		$kuanhao = $this->db->escape($kuanhao);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where kuanhao=$kuanhao ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsById22kuanhao($kuanhao,$id)
	{
		$kuanhao = $this->db->escape($kuanhao);
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where kuanhao=$kuanhao and xid!=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsAllPage1($gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	public function getgoodsAllNew1($pg,$gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT u.*,r.bianhao,r.qianding FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw . " order by u.addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsByIdkuanhao($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
}