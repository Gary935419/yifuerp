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
	public function role_save_yusuan($name1,$name2,$name3,$name4,$name5,$name6,$name7,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state)
	{
		$name1 = $this->db->escape($name1);
		$name2 = $this->db->escape($name2);
		$name3 = $this->db->escape($name3);
		$name4 = $this->db->escape($name4);
		$name5 = $this->db->escape($name5);
		$name6 = $this->db->escape($name6);
		$name7 = $this->db->escape($name7);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$kid = $this->db->escape($kid);
		$kehuming = $this->db->escape($kehuming);
		$riqi = $this->db->escape($riqi);
		$shengcanshuliang = $this->db->escape($shengcanshuliang);
		$sunhao = $this->db->escape($sunhao);
		$xiaoji = $this->db->escape($xiaoji);
		$jiagongfeidanjia = $this->db->escape($jiagongfeidanjia);
		$jiagongfeiyongliang = $this->db->escape($jiagongfeiyongliang);
		$ercijiagongfeidanjia = $this->db->escape($ercijiagongfeidanjia);
		$ercijiagongfeiyongliang = $this->db->escape($ercijiagongfeiyongliang);
		$jianpinfeidanjia = $this->db->escape($jianpinfeidanjia);
		$jianpinfeiyongliang = $this->db->escape($jianpinfeiyongliang);
		$tongguanfeidanjia = $this->db->escape($tongguanfeidanjia);
		$tongguanfeiyongliang = $this->db->escape($tongguanfeiyongliang);
		$mianliaojiancedanjia = $this->db->escape($mianliaojiancedanjia);
		$mianliaojianceyongliang = $this->db->escape($mianliaojianceyongliang);
		$yunfeidanjia = $this->db->escape($yunfeidanjia);
		$yunfeiyongliang = $this->db->escape($yunfeiyongliang);
		$qitadanjia = $this->db->escape($qitadanjia);
		$qitayongliang = $this->db->escape($qitayongliang);
		$add_time = $this->db->escape($add_time);

		$sql = "INSERT INTO `erp_baojiadanfeiyong` (name1,name2,name3,name4,name5,name6,name7,status,state,kid,kehuming,riqi,shengcanshuliang,sunhao,xiaoji,jiagongfeidanjia,jiagongfeiyongliang,ercijiagongfeidanjia,ercijiagongfeiyongliang,jianpinfeidanjia,jianpinfeiyongliang,tongguanfeidanjia,tongguanfeiyongliang,mianliaojiancedanjia,mianliaojianceyongliang,yunfeidanjia,yunfeiyongliang,qitadanjia,qitayongliang,addtime) VALUES ($name1,$name2,$name3,$name4,$name5,$name6,$name7,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function role_save_yusuanjue($name1,$name2,$name3,$name4,$name5,$name6,$name7,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time,$status,$state)
	{
		$name1 = $this->db->escape($name1);
		$name2 = $this->db->escape($name2);
		$name3 = $this->db->escape($name3);
		$name4 = $this->db->escape($name4);
		$name5 = $this->db->escape($name5);
		$name6 = $this->db->escape($name6);
		$name7 = $this->db->escape($name7);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$kid = $this->db->escape($kid);
		$kehuming = $this->db->escape($kehuming);
		$riqi = $this->db->escape($riqi);
		$shengcanshuliang = $this->db->escape($shengcanshuliang);
		$sunhao = $this->db->escape($sunhao);
		$xiaoji = $this->db->escape($xiaoji);
		$jiagongfeidanjia = $this->db->escape($jiagongfeidanjia);
		$jiagongfeiyongliang = $this->db->escape($jiagongfeiyongliang);
		$ercijiagongfeidanjia = $this->db->escape($ercijiagongfeidanjia);
		$ercijiagongfeiyongliang = $this->db->escape($ercijiagongfeiyongliang);
		$jianpinfeidanjia = $this->db->escape($jianpinfeidanjia);
		$jianpinfeiyongliang = $this->db->escape($jianpinfeiyongliang);
		$tongguanfeidanjia = $this->db->escape($tongguanfeidanjia);
		$tongguanfeiyongliang = $this->db->escape($tongguanfeiyongliang);
		$mianliaojiancedanjia = $this->db->escape($mianliaojiancedanjia);
		$mianliaojianceyongliang = $this->db->escape($mianliaojianceyongliang);
		$yunfeidanjia = $this->db->escape($yunfeidanjia);
		$yunfeiyongliang = $this->db->escape($yunfeiyongliang);
		$qitadanjia = $this->db->escape($qitadanjia);
		$qitayongliang = $this->db->escape($qitayongliang);
		$add_time = $this->db->escape($add_time);

		$sql = "INSERT INTO `erp_baojiadanfeiyongjue` (name1,name2,name3,name4,name5,name6,name7,status,state,kid,kehuming,riqi,shengcanshuliang,sunhao,xiaoji,jiagongfeidanjia,jiagongfeiyongliang,ercijiagongfeidanjia,ercijiagongfeiyongliang,jianpinfeidanjia,jianpinfeiyongliang,tongguanfeidanjia,tongguanfeiyongliang,mianliaojiancedanjia,mianliaojianceyongliang,yunfeidanjia,yunfeiyongliang,qitadanjia,qitayongliang,addtime) VALUES ($name1,$name2,$name3,$name4,$name5,$name6,$name7,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time)";
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
	public function role_save123_cai($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time)
	{
		$caiduanshu = $this->db->escape($caiduanshu);
		$pinfan = $this->db->escape($pinfan);
		$sehao = $this->db->escape($sehao);
		$zhishishu = $this->db->escape($zhishishu);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_caiduanbaogaoshu` (sehao,pinfan,caiduanshu,zhishishu,kid,addtime) VALUES ($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}

	public function role_save123_caitongji($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time,$zhuangxiangxinxi,$zhuangxiangshuliang,$biaoji,$beizhu)
	{
		$caiduanshu = $this->db->escape($caiduanshu);
		$pinfan = $this->db->escape($pinfan);
		$sehao = $this->db->escape($sehao);
		$zhishishu = $this->db->escape($zhishishu);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$zhuangxiangxinxi = $this->db->escape($zhuangxiangxinxi);
		$zhuangxiangshuliang = $this->db->escape($zhuangxiangshuliang);
		$biaoji = $this->db->escape($biaoji);
		$beizhu = $this->db->escape($beizhu);
		$sql = "INSERT INTO `erp_caiduanbaogaoshu` (sehao,pinfan,caiduanshu,zhishishu,kid,addtime,zhuangxiangxinxi,zhuangxiangshuliang,biaoji,beizhu) VALUES ($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time,$zhuangxiangxinxi,$zhuangxiangshuliang,$biaoji,$beizhu)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}

	public function role_save123_caij($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time)
	{
		$caiduanshu = $this->db->escape($caiduanshu);
		$pinfan = $this->db->escape($pinfan);
		$sehao = $this->db->escape($sehao);
		$zhishishu = $this->db->escape($zhishishu);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_caiduanbaogaoshujue` (sehao,pinfan,caiduanshu,zhishishu,kid,addtime) VALUES ($sehao,$pinfan,$caiduanshu,$zhishishu,$kid,$time)";
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
	public function rtom_save_yusuan($bid,$uid)
	{
		$bid = $this->db->escape($bid);
		$uid = $this->db->escape($uid);
		$sql = "INSERT INTO `erp_baojiafuzeren` (bid,uid) VALUES ($bid,$uid);";
		return $this->db->query($sql);
	}
	public function rtom_save_yusuanjue($bid,$uid)
	{
		$bid = $this->db->escape($bid);
		$uid = $this->db->escape($uid);
		$sql = "INSERT INTO `erp_baojiafuzerenjue` (bid,uid) VALUES ($bid,$uid);";
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
	public function goodsimg_delete4($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_yuanfuliaopinghengbian WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete4_cai($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_caiduanbaogaoshu WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete4_caij($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_caiduanbaogaoshujue WHERE kid = $id";
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
	public function getgoodsAllPage1($gname,$id)
	{
		$sqlw = " where 1=1 and u.xid=$id ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	public function getgoodsAllNew1($pg,$gname,$id)
	{
		$sqlw = " where 1=1 and u.xid=$id ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT u.*,r.bianhao,r.qianding,r.mingcheng FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw . " LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsByIdkuanhao($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsAllNewid($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT u.*,r.bianhao,r.qianding FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id where u.id=$id";
		return $this->db->query($sql)->row_array();
	}
	public function gettidlistguige($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_yuanfuliaoguige` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistguige_cai($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshu` where kid = $id order by sehao";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistguige_caizhuangxiang($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshuzhuang` where kid = $id";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistguige_caij($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function gettidlistpinming($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_yuanfuliaopinghengbian` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}

	public function goods_save_edit_yusuan($name1,$name2,$name3,$name4,$name5,$name6,$name7,$infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time)
	{
		$name1 = $this->db->escape($name1);
		$name2 = $this->db->escape($name2);
		$name3 = $this->db->escape($name3);
		$name4 = $this->db->escape($name4);
		$name5 = $this->db->escape($name5);
		$name6 = $this->db->escape($name6);
		$name7 = $this->db->escape($name7);
		$infomation = $this->db->escape($infomation);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$kehuming = $this->db->escape($kehuming);
		$riqi = $this->db->escape($riqi);
		$shengcanshuliang = $this->db->escape($shengcanshuliang);
		$sunhao = $this->db->escape($sunhao);
		$xiaoji = $this->db->escape($xiaoji);
		$jiagongfeidanjia = $this->db->escape($jiagongfeidanjia);
		$jiagongfeiyongliang = $this->db->escape($jiagongfeiyongliang);
		$ercijiagongfeidanjia = $this->db->escape($ercijiagongfeidanjia);
		$ercijiagongfeiyongliang = $this->db->escape($ercijiagongfeiyongliang);
		$jianpinfeidanjia = $this->db->escape($jianpinfeidanjia);
		$jianpinfeiyongliang = $this->db->escape($jianpinfeiyongliang);
		$tongguanfeidanjia = $this->db->escape($tongguanfeidanjia);
		$tongguanfeiyongliang = $this->db->escape($tongguanfeiyongliang);
		$mianliaojiancedanjia = $this->db->escape($mianliaojiancedanjia);
		$mianliaojianceyongliang = $this->db->escape($mianliaojianceyongliang);
		$yunfeidanjia = $this->db->escape($yunfeidanjia);
		$yunfeiyongliang = $this->db->escape($yunfeiyongliang);
		$qitadanjia = $this->db->escape($qitadanjia);
		$qitayongliang = $this->db->escape($qitayongliang);
		$kid = $this->db->escape($kid);
		$sql = "UPDATE `erp_baojiadanfeiyong` SET name1=$name1,name2=$name2,name3=$name3,name4=$name4,name5=$name5,name6=$name6,name7=$name7,infomation=$infomation,state=$state,status=$status,kehuming=$kehuming,riqi=$riqi,shengcanshuliang=$shengcanshuliang,sunhao=$sunhao,xiaoji=$xiaoji,jiagongfeidanjia=$jiagongfeidanjia,jiagongfeiyongliang=$jiagongfeiyongliang,ercijiagongfeidanjia=$ercijiagongfeidanjia,ercijiagongfeiyongliang=$ercijiagongfeiyongliang,jianpinfeidanjia=$jianpinfeidanjia,jianpinfeiyongliang=$jianpinfeiyongliang,tongguanfeidanjia=$tongguanfeidanjia,tongguanfeiyongliang=$tongguanfeiyongliang,mianliaojiancedanjia=$mianliaojiancedanjia,mianliaojianceyongliang=$mianliaojianceyongliang,yunfeidanjia=$yunfeidanjia,yunfeiyongliang=$yunfeiyongliang,qitadanjia=$qitadanjia,qitayongliang=$qitayongliang WHERE kid = $kid";
		return $this->db->query($sql);
	}
	public function goods_save_edit_yusuanjue($name1,$name2,$name3,$name4,$name5,$name6,$name7,$infomation,$status,$state,$kid,$kehuming,$riqi,$shengcanshuliang,$sunhao,$xiaoji,$jiagongfeidanjia,$jiagongfeiyongliang,$ercijiagongfeidanjia,$ercijiagongfeiyongliang,$jianpinfeidanjia,$jianpinfeiyongliang,$tongguanfeidanjia,$tongguanfeiyongliang,$mianliaojiancedanjia,$mianliaojianceyongliang,$yunfeidanjia,$yunfeiyongliang,$qitadanjia,$qitayongliang,$add_time)
	{
		$name1 = $this->db->escape($name1);
		$name2 = $this->db->escape($name2);
		$name3 = $this->db->escape($name3);
		$name4 = $this->db->escape($name4);
		$name5 = $this->db->escape($name5);
		$name6 = $this->db->escape($name6);
		$name7 = $this->db->escape($name7);
		$infomation = $this->db->escape($infomation);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$kehuming = $this->db->escape($kehuming);
		$riqi = $this->db->escape($riqi);
		$shengcanshuliang = $this->db->escape($shengcanshuliang);
		$sunhao = $this->db->escape($sunhao);
		$xiaoji = $this->db->escape($xiaoji);
		$jiagongfeidanjia = $this->db->escape($jiagongfeidanjia);
		$jiagongfeiyongliang = $this->db->escape($jiagongfeiyongliang);
		$ercijiagongfeidanjia = $this->db->escape($ercijiagongfeidanjia);
		$ercijiagongfeiyongliang = $this->db->escape($ercijiagongfeiyongliang);
		$jianpinfeidanjia = $this->db->escape($jianpinfeidanjia);
		$jianpinfeiyongliang = $this->db->escape($jianpinfeiyongliang);
		$tongguanfeidanjia = $this->db->escape($tongguanfeidanjia);
		$tongguanfeiyongliang = $this->db->escape($tongguanfeiyongliang);
		$mianliaojiancedanjia = $this->db->escape($mianliaojiancedanjia);
		$mianliaojianceyongliang = $this->db->escape($mianliaojianceyongliang);
		$yunfeidanjia = $this->db->escape($yunfeidanjia);
		$yunfeiyongliang = $this->db->escape($yunfeiyongliang);
		$qitadanjia = $this->db->escape($qitadanjia);
		$qitayongliang = $this->db->escape($qitayongliang);
		$kid = $this->db->escape($kid);
		$sql = "UPDATE `erp_baojiadanfeiyongjue` SET name1=$name1,name2=$name2,name3=$name3,name4=$name4,name5=$name5,name6=$name6,name7=$name7,infomation=$infomation,state=$state,status=$status,kehuming=$kehuming,riqi=$riqi,shengcanshuliang=$shengcanshuliang,sunhao=$sunhao,xiaoji=$xiaoji,jiagongfeidanjia=$jiagongfeidanjia,jiagongfeiyongliang=$jiagongfeiyongliang,ercijiagongfeidanjia=$ercijiagongfeidanjia,ercijiagongfeiyongliang=$ercijiagongfeiyongliang,jianpinfeidanjia=$jianpinfeidanjia,jianpinfeiyongliang=$jianpinfeiyongliang,tongguanfeidanjia=$tongguanfeidanjia,tongguanfeiyongliang=$tongguanfeiyongliang,mianliaojiancedanjia=$mianliaojiancedanjia,mianliaojianceyongliang=$mianliaojianceyongliang,yunfeidanjia=$yunfeidanjia,yunfeiyongliang=$yunfeiyongliang,qitadanjia=$qitadanjia,qitayongliang=$qitayongliang WHERE kid = $kid";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_yusuan($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_baojiafuzeren WHERE bid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_yusuanjue($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_baojiafuzerenjue WHERE bid = $id";
		return $this->db->query($sql);
	}
	public function role_save_edit_jichu($infomation,$status,$state,$xiangmu,$mingcheng,$guige,$danwei,$danjia,$danwei1,$yongliang,$danwei2,$jine,$danwei3,$qidingliang,$beizhu,$kid,$time)
	{
		$infomation = $this->db->escape($infomation);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$xiangmu = $this->db->escape($xiangmu);
		$mingcheng = $this->db->escape($mingcheng);
		$guige = $this->db->escape($guige);
		$danwei = $this->db->escape($danwei);
		$danjia = $this->db->escape($danjia);
		$danwei1 = $this->db->escape($danwei1);
		$yongliang = $this->db->escape($yongliang);
		$danwei2 = $this->db->escape($danwei2);
		$jine = $this->db->escape($jine);
		$danwei3 = $this->db->escape($danwei3);
		$qidingliang = $this->db->escape($qidingliang);
		$beizhu = $this->db->escape($beizhu);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_baojiaxiangmu` (infomation,status,state,xiangmu,mingcheng,guige,danwei,danjia,danwei1,yongliang,danwei2,jine,danwei3,qidingliang,beizhu,kid,addtime) VALUES ($infomation,$status,$state,$xiangmu,$mingcheng,$guige,$danwei,$danjia,$danwei1,$yongliang,$danwei2,$jine,$danwei3,$qidingliang,$beizhu,$kid,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function role_save_yangpin($zid,$dandangzhe,$kuhumingcheng,$kuanhao,$kuanshi,$yangpinxingzhi,$shuliang,$yangpindanjia,$shoudaoriqi,$fachuriqi,$zhizuozhe,$time)
	{
		$zid = $this->db->escape($zid);
		$dandangzhe = $this->db->escape($dandangzhe);
		$kuhumingcheng = $this->db->escape($kuhumingcheng);
		$kuanhao = $this->db->escape($kuanhao);
		$kuanshi = $this->db->escape($kuanshi);
		$yangpinxingzhi = $this->db->escape($yangpinxingzhi);
		$shuliang = $this->db->escape($shuliang);
		$yangpindanjia = $this->db->escape($yangpindanjia);
		$shoudaoriqi = $this->db->escape($shoudaoriqi);
		$fachuriqi = $this->db->escape($fachuriqi);
		$zhizuozhe = $this->db->escape($zhizuozhe);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_yangmingmingxi` (zid,dandangzhe,kuhumingcheng,kuanhao,kuanshi,yangpinxingzhi,shuliang,yangpindanjia,shoudaoriqi,fachuriqi,zhizuozhe,addtime) VALUES ($zid,$dandangzhe,$kuhumingcheng,$kuanhao,$kuanshi,$yangpinxingzhi,$shuliang,$yangpindanjia,$shoudaoriqi,$fachuriqi,$zhizuozhe,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function role_save_edit_jichujue($infomation,$status,$state,$xiangmu,$mingcheng,$guige,$danwei,$danjia,$danwei1,$yongliang,$danwei2,$jine,$danwei3,$qidingliang,$beizhu,$kid,$time)
	{
		$infomation = $this->db->escape($infomation);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$xiangmu = $this->db->escape($xiangmu);
		$mingcheng = $this->db->escape($mingcheng);
		$guige = $this->db->escape($guige);
		$danwei = $this->db->escape($danwei);
		$danjia = $this->db->escape($danjia);
		$danwei1 = $this->db->escape($danwei1);
		$yongliang = $this->db->escape($yongliang);
		$danwei2 = $this->db->escape($danwei2);
		$jine = $this->db->escape($jine);
		$danwei3 = $this->db->escape($danwei3);
		$qidingliang = $this->db->escape($qidingliang);
		$beizhu = $this->db->escape($beizhu);
		$kid = $this->db->escape($kid);
		$time = $this->db->escape($time);
		$sql = "INSERT INTO `erp_baojiaxiangmujue` (infomation,status,state,xiangmu,mingcheng,guige,danwei,danjia,danwei1,yongliang,danwei2,jine,danwei3,qidingliang,beizhu,kid,addtime) VALUES ($infomation,$status,$state,$xiangmu,$mingcheng,$guige,$danwei,$danjia,$danwei1,$yongliang,$danwei2,$jine,$danwei3,$qidingliang,$beizhu,$kid,$time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function goodsimg_delete_jichu($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_baojiaxiangmu WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_jichujue($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_baojiaxiangmujue WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_jichu_up($id,$status,$state)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$sql = "UPDATE `erp_baojiaxiangmu` SET status=$status,state=$state WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_jichu_up1($id,$status,$state)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$sql = "UPDATE `erp_baojiadanfeiyong` SET status=$status,state=$state WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_jichu_up2($id,$status,$state)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$sql = "UPDATE `erp_baojiadanfeiyongjue` SET status=$status,state=$state WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function goodsimg_delete_jichu_up3($id,$status,$state)
	{
		$id = $this->db->escape($id);
		$status = $this->db->escape($status);
		$state = $this->db->escape($state);
		$sql = "UPDATE `erp_baojiaxiangmujue` SET status=$status,state=$state WHERE kid = $id";
		return $this->db->query($sql);
	}
	public function geterp_baojiaxiangmu($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmu` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function geterp_baojiaxiangmujue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` where kid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function geterp_baojiafuzeren($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT u.*,r.username FROM `erp_xiangmufuzeren` u left join `admin_user` r on u.uid=r.id where u.xid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function geterp_baojiafuzerenjue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT u.*,r.username FROM `erp_baojiafuzerenjue` u left join `admin_user` r on u.uid=r.id where u.bid = $id ";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsByIdxiaojiejei($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyong` where kid=$id";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsByIdxiaojiejeijue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyongjue` where kid=$id";
		return $this->db->query($sql)->row_array();
	}
	public function geterp_xiangmukuanhao($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_xiangmukuanhao` where id=$id";
		return $this->db->query($sql)->row_array();
	}

	public function getgoodsAllPage1duibi($gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	public function getgoodsAllNew1duibi($pg,$gname)
	{
		$sqlw = " where 1=1 ";
		if (!empty($gname)) {
			$sqlw .= " and ( u.kuanhao like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT u.*,r.bianhao,r.qianding FROM `erp_xiangmukuanhao` u left join `erp_xiangmuhetong` r on u.xid=r.id " . $sqlw . " LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsByIdxiaojiejeiduibi($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyong` where kid=$id and state=2 or state=5";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsByIdxiaojiejeiduibi1($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmu` where kid=$id and state=2 or state=5";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsByIdxiaojiejeiduibi11($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiadanfeiyongjue` where kid=$id and state=2 or state=5";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsByIdxiaojiejeiduibi22($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_baojiaxiangmujue` where kid=$id and state=2 or state=5";
		return $this->db->query($sql)->row_array();
	}
	public function yangpin_save_edit($id,$kuhumingcheng,$dandangzhe,$kuanhao,$kuanshi,$yangpinxingzhi,$shuliang,$yangpindanjia,$shoudaoriqi,$fachuriqi,$zhizuozhe)
	{
		$id = $this->db->escape($id);
		$kuhumingcheng = $this->db->escape($kuhumingcheng);
		$dandangzhe = $this->db->escape($dandangzhe);
		$kuanhao = $this->db->escape($kuanhao);
		$kuanshi = $this->db->escape($kuanshi);
		$yangpinxingzhi = $this->db->escape($yangpinxingzhi);
		$shuliang = $this->db->escape($shuliang);
		$yangpindanjia = $this->db->escape($yangpindanjia);
		$shoudaoriqi = $this->db->escape($shoudaoriqi);
		$fachuriqi = $this->db->escape($fachuriqi);
		$zhizuozhe = $this->db->escape($zhizuozhe);
		$sql = "UPDATE `erp_yangmingmingxi` SET kuhumingcheng=$kuhumingcheng,dandangzhe=$dandangzhe,kuanhao=$kuanhao,kuanshi=$kuanshi,yangpinxingzhi=$yangpinxingzhi,shuliang=$shuliang,yangpindanjia=$yangpindanjia,shoudaoriqi=$shoudaoriqi,fachuriqi=$fachuriqi,zhizuozhe=$zhizuozhe WHERE id = $id";
		return $this->db->query($sql);
	}

	public function getyangpinlist($zid,$starttime,$end,$kuanhao,$pg)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuanhao)) {
			$sqlw .= " and ( kuanhao like '%" . $kuanhao . "%' ) ";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime >= $starttime and addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime <= $end ";
		}

		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `erp_yangmingmingxi` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getyangpinlistpage($zid,$starttime,$end,$kuanhao)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuanhao)) {
			$sqlw .= " and ( kuanhao like '%" . $kuanhao . "%' ) ";
		}
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime >= $starttime and addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and addtime <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `erp_yangmingmingxi` " . $sqlw . " order by addtime desc";

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);

	}

	public function getgoodsByIdxiaojiejeiduibiyu($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshu` where kid=$id order by sehao";
		return $this->db->query($sql)->row_array();
	}

	public function getgoodsByIdxiaojiejeiduibijue($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_caiduanbaogaoshujue` where kid=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getroleByname1_zhipinfanhao($zhipinfanhao,$zuname,$jihuariqi)
	{
		$zhipinfanhao = $this->db->escape($zhipinfanhao);
		$zuname = $this->db->escape($zuname);
		$jihuariqi = $this->db->escape($jihuariqi);
		$sql = "SELECT * FROM `erp_shengcanjihua` where zhipinfanhao=$zhipinfanhao and zuname=$zuname and jihuariqi=$jihuariqi ";
		return $this->db->query($sql)->row_array();
	}
	public function getroleByname1_jihuariqi($jihuariqi)
	{
		$jihuariqi = $this->db->escape($jihuariqi);
		$sql = "SELECT * FROM `erp_shengcanjihua` where jihuariqi=$jihuariqi ";
		return $this->db->query($sql)->row_array();
	}
	public function role_save1_jihua($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time)
	{
		$zuname = $this->db->escape($zuname);
		$zhipinfanhao = $this->db->escape($zhipinfanhao);
		$pinming = $this->db->escape($pinming);
		$qihuashu = $this->db->escape($qihuashu);
		$naqi = $this->db->escape($naqi);
		$jihuariqi = $this->db->escape($jihuariqi);
		$add_time = $this->db->escape($add_time);

		$sql = "INSERT INTO `erp_shengcanjihua` (zuname, zhipinfanhao, pinming, qihuashu, naqi, jihuariqi, addtime) VALUES ($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function getgoodsAllPageshengchan($gname,$jihuariqi)
	{
		$sqlw = " where 1=1 and jihuariqi= '$jihuariqi' ";

		if (!empty($gname)) {
			$sqlw .= " and ( zhipinfanhao like '%" . $gname . "%' ) or ( pinming like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `erp_shengcanjihua`" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	public function getgoodsAllNewshengchan($pg,$gname,$jihuariqi)
	{
		$sqlw = " where 1=1 and jihuariqi= '$jihuariqi' ";
		if (!empty($gname)) {
			$sqlw .= " and ( zhipinfanhao like '%" . $gname . "%' ) or ( pinming like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `erp_shengcanjihua` " . $sqlw . " LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	public function getgoodsByIdshengchan($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_shengcanjihua` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsById22shengchan($zhipinfanhao,$zuname,$jihuariqi,$id)
	{
		$zhipinfanhao = $this->db->escape($zhipinfanhao);
		$zuname = $this->db->escape($zuname);
		$jihuariqi = $this->db->escape($jihuariqi);
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_shengcanjihua` where zhipinfanhao=$zhipinfanhao and zuname=$zuname and jihuariqi=$jihuariqi and id!=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function getgoodsById22shengchan_jihuariqi($jihuariqi, $id)
	{
		$jihuariqi = $this->db->escape($jihuariqi);
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_shengcanjihua` where jihuariqi=$jihuariqi and id!=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function goods_save_edit_shengchan($zuname, $zhipinfanhao, $pinming, $qihuashu, $naqi, $jihuariqi, $add_time, $id)
	{
		$zuname = $this->db->escape($zuname);
		$zhipinfanhao = $this->db->escape($zhipinfanhao);
		$pinming = $this->db->escape($pinming);
		$qihuashu = $this->db->escape($qihuashu);
		$naqi = $this->db->escape($naqi);
		$jihuariqi = $this->db->escape($jihuariqi);
		$add_time = $this->db->escape($add_time);
		$id = $this->db->escape($id);
		$sql = "UPDATE `erp_shengcanjihua` SET zuname=$zuname,zhipinfanhao=$zhipinfanhao,pinming=$pinming,qihuashu=$qihuashu,jihuariqi=$jihuariqi,naqi=$naqi,addtime=$add_time WHERE id = $id";
		return $this->db->query($sql);
	}
	public function goods_delete_shengchan($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_shengcanjihua WHERE id = $id";
		return $this->db->query($sql);
	}
	public function role_saveerp_shengcanjihuadate($sid,$add_time)
	{
		$sid = $this->db->escape($sid);
		$add_time = $this->db->escape($add_time);
		$sql = "INSERT INTO `erp_shengcanjihuadate` (sid,addtime) VALUES ($sid,$add_time)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function getlabelByIdyang_shengchan($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_shengcanjihuadate` where sid=$id ";
		return $this->db->query($sql)->row_array();
	}
	public function goods_edit_jichu_shengchan($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_shengcanjihuadate WHERE sid = $id";
		return $this->db->query($sql);
	}
	public function role_saveerp_shengcanjihuadate_insert($sid,$add_time,$y1,$y2,$y3,$y4,$y5,$y6,$y7,$y8,$y9,$y10,$y11,$y12,$y13,$y14,$y15,$y16,$y17,$y18,$y19,$y20,$y21,$y22,$y23,$y24,$y25,$y26,$y27,$y28,$y29,$y30,$y31,$j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$j9,$j10,$j11,$j12,$j13,$j14,$j15,$j16,$j17,$j18,$j19,$j20,$j21,$j22,$j23,$j24,$j25,$j26,$j27,$j28,$j29,$j30,$j31)
	{
		$sid = $this->db->escape($sid);
		$add_time = $this->db->escape($add_time);
		$sql = "INSERT INTO `erp_shengcanjihuadate` (sid,addtime,y1,y2,y3,y4,y5,y6,y7,y8,y9,y10,y11,y12,y13,y14,y15,y16,y17,y18,y19,y20,y21,y22,y23,y24,y25,y26,y27,y28,y29,y30,y31,j1,j2,j3,j4,j5,j6,j7,j8,j9,j10,j11,j12,j13,j14,j15,j16,j17,j18,j19,j20,j21,j22,j23,j24,j25,j26,j27,j28,j29,j30,j31) VALUES ($sid,$add_time,$y1,$y2,$y3,$y4,$y5,$y6,$y7,$y8,$y9,$y10,$y11,$y12,$y13,$y14,$y15,$y16,$y17,$y18,$y19,$y20,$y21,$y22,$y23,$y24,$y25,$y26,$y27,$y28,$y29,$y30,$y31,$j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$j9,$j10,$j11,$j12,$j13,$j14,$j15,$j16,$j17,$j18,$j19,$j20,$j21,$j22,$j23,$j24,$j25,$j26,$j27,$j28,$j29,$j30,$j31)";
		$this->db->query($sql);
		$rid=$this->db->insert_id();
		return $rid;
	}
	public function gettidlistguige_shengchanjihua($jihuariqi)
	{
		$jihuariqi = $this->db->escape($jihuariqi);
		$sql = "SELECT * FROM `erp_shengcanjihua` where jihuariqi = $jihuariqi ";
		return $this->db->query($sql)->result_array();
	}
	public function getlabelByIdyang_shengchan_date($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_shengcanjihuadate` where sid=$id ";
		return $this->db->query($sql)->row_array();
	}
}
