<?php


class Label_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }

    public function getlabelAllPage($lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `erp_zigongsi` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }

    public function getlabelAll($pg,$lname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($lname)) {
            $sqlw .= " and ( lname like '%" . $lname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `erp_zigongsi` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

    public function label_save($lname,$lpname,$ltel,$addtime)
    {
        $lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
		$addtime = $this->db->escape($addtime);
        $sql = "INSERT INTO `erp_zigongsi` (lname,lpname,ltel,addtime) VALUES ($lname,$lpname,$ltel,$addtime)";
        return $this->db->query($sql);
    }

    public function label_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM erp_zigongsi WHERE id = $id";
        return $this->db->query($sql);
    }

    public function getlabelById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `erp_zigongsi` where id=$id ";
        return $this->db->query($sql)->row_array();
    }

    public function getlabelByname($lname)
    {
        $lname = $this->db->escape($lname);
        $sql = "SELECT * FROM `erp_zigongsi` where lname=$lname ";
        return $this->db->query($sql)->row_array();
    }

    public function getlabelById2($lname, $id)
    {
        $lname = $this->db->escape($lname);
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `erp_zigongsi` where lname=$lname and id != $id";
        return $this->db->query($sql)->row_array();
    }

    public function label_save_edit($id,$lname,$lpname,$ltel)
    {
        $id = $this->db->escape($id);
        $lname = $this->db->escape($lname);
		$lpname = $this->db->escape($lpname);
		$ltel = $this->db->escape($ltel);
        $sql = "UPDATE `erp_zigongsi` SET lname=$lname,lpname=$lpname,ltel=$ltel WHERE id = $id";
        return $this->db->query($sql);
    }

	public function getlabelAllPageyangpin($kuhumingcheng,$starttime,$end,$zid)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuhumingcheng)) {
			$sqlw .= " and ( kuhumingcheng like '%" . $kuhumingcheng . "%' ) ";
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
		$sql = "SELECT count(1) as number FROM `erp_yangmingmingxi` " . " order by addtime desc";

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);

	}

	public function getlabelAllyangpin($pg,$kuhumingcheng,$starttime,$end,$zid)
	{
		$sqlw = " where 1=1 and zid=$zid ";
		if (!empty($kuhumingcheng)) {
			$sqlw .= " and ( kuhumingcheng like '%" . $kuhumingcheng . "%' ) ";
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
	public function yangpin_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM erp_yangmingmingxi WHERE id = $id";
		return $this->db->query($sql);
	}
	public function getlabelByIdyang($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `erp_yangmingmingxi` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
}
