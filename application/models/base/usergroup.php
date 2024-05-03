<?
/* *******************************************************************************************************
MODUL NAME 			: MTSN LAWANG
FILE NAME 			: 
AUTHOR				: 
VERSION				: 1.0
MODIFICATION DOC	:
DESCRIPTION			: 
***************************************************************************************************** */

/***
 * Entity-base class untuk mengimplementasikan tabel kategori.
 * 
 ***/
include_once(APPPATH . '/models/Entity.php');

class UserGroup extends Entity{

	var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function UserGroup()
	{
      $this->Entity(); 
    }
	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("USER_GROUP_ID", $this->getNextId("USER_GROUP_ID","USER_GROUP"));

		$str = "
				INSERT INTO USER_GROUP (
				   USER_GROUP_ID, NAMA, PEGAWAI_PROSES, 
				   DUK_PROSES, KGB_PROSES, KP_PROSES, 
				   PENSIUN_PROSES, ANJAB_PROSES, MUTASI_PROSES, HUKUMAN_PROSES, MASTER_PROSES, LIHAT_PROSES, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,
				   BIDANG_PEMBINAAN, BIDANG_DOKUMENTASI, BIDANG_PENDIDIKAN, BIDANG_MUTASI
				   ) 
                VALUES(
				  '".$this->getField("USER_GROUP_ID")."',
                  '".$this->getField("NAMA")."',
				  '".$this->getField("PEGAWAI_PROSES")."',
				  '".$this->getField("DUK_PROSES")."',
				  '".$this->getField("KGB_PROSES")."',
				  '".$this->getField("KP_PROSES")."',
				  '".$this->getField("PENSIUN_PROSES")."',
				  '".$this->getField("ANJAB_PROSES")."',
				  '".$this->getField("MUTASI_PROSES")."',
				  '".$this->getField("HUKUMAN_PROSES")."',
				  '".$this->getField("MASTER_PROSES")."',
				  '".$this->getField("LIHAT_PROSES")."'	,				 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  '".$this->getField("BIDANG_PEMBINAAN")."',
				  '".$this->getField("BIDANG_DOKUMENTASI")."',
				  '".$this->getField("BIDANG_PENDIDIKAN")."',
				  '".$this->getField("BIDANG_MUTASI")."'
                )";  
		$this->id = $this->getField("USER_GROUP_ID");

		// echo $str;exit;
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE USER_GROUP 
                SET 
                  NAMA = '".$this->getField("NAMA")."',
				  PEGAWAI_PROSES = '".$this->getField("PEGAWAI_PROSES")."',
				  DUK_PROSES = '".$this->getField("DUK_PROSES")."',
				  KGB_PROSES = '".$this->getField("KGB_PROSES")."',
				  KP_PROSES = '".$this->getField("KP_PROSES")."',
				  PENSIUN_PROSES = '".$this->getField("PENSIUN_PROSES")."',
				  ANJAB_PROSES = '".$this->getField("ANJAB_PROSES")."',
				  MUTASI_PROSES = '".$this->getField("MUTASI_PROSES")."',
				  HUKUMAN_PROSES = '".$this->getField("HUKUMAN_PROSES")."',
				  MASTER_PROSES = '".$this->getField("MASTER_PROSES")."',
				  LIHAT_PROSES= '".$this->getField("LIHAT_PROSES")."',
				  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
				  BIDANG_PEMBINAAN= '".$this->getField("BIDANG_PEMBINAAN")."',
				  BIDANG_DOKUMENTASI= '".$this->getField("BIDANG_DOKUMENTASI")."',
				  BIDANG_PENDIDIKAN= '".$this->getField("BIDANG_PENDIDIKAN")."',
				  BIDANG_MUTASI= '".$this->getField("BIDANG_MUTASI")."'
                WHERE 
                  USER_GROUP_ID = '".$this->getField("USER_GROUP_ID")."'"; 
		$this->query = $str;
		//echo $this->query;exit;
		return $this->execQuery($str);
    }

	function delete()
	{
        $str = "DELETE FROM USER_GROUP
                WHERE 
                  USER_GROUP_ID = ".$this->getField("USER_GROUP_ID").""; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","IJIN_USAHA_ID"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY NAMA ASC')
	{
		$str = "	
		SELECT 
		USER_GROUP_ID, NAMA, PEGAWAI_PROSES, 
		DUK_PROSES, KGB_PROSES, KP_PROSES, 
		PENSIUN_PROSES, ANJAB_PROSES, MUTASI_PROSES, HUKUMAN_PROSES, MASTER_PROSES, LIHAT_PROSES,
		BIDANG_PEMBINAAN, BIDANG_DOKUMENTASI, BIDANG_PENDIDIKAN, BIDANG_MUTASI
		FROM USER_GROUP A WHERE USER_GROUP_ID IS NOT NULL  "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }
    
	
    function getCountByParams($paramsArray=array(), $statement="")
	{
		$str = "SELECT COUNT(USER_GROUP_ID) AS ROWCOUNT FROM USER_GROUP A
		        WHERE 1 = 1 ".$statement; 
		
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
  } 
?>