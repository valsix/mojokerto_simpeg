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

class TipePegawai extends Entity{ 

	var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function TipePegawai()
	{
      $this->Entity(); 
    }
	
	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TIPE_PEGAWAI_ID", $this->getNextId("TIPE_PEGAWAI_ID","TIPE_PEGAWAI")); 

		$str = "INSERT INTO TIPE_PEGAWAI (
				   TIPE_PEGAWAI_ID, TIPE_PEGAWAI_ID_PARENT, NAMA) 
				VALUES (
				  '".$this->getField("TIPE_PEGAWAI_ID")."',
				  '".$this->getField("TIPE_PEGAWAI_ID_PARENT")."',
				  '".$this->getField("NAMA")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE TIPE_PEGAWAI
				SET    
					   TIPE_PEGAWAI_ID_PARENT       = '".$this->getField("TIPE_PEGAWAI_ID_PARENT")."',
					   NAMA    = '".$this->getField("NAMA")."'
				WHERE  TIPE_PEGAWAI_ID          = ''".$this->getField("TIPE_PEGAWAI_ID")."''
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM TIPE_PEGAWAI
                WHERE 
                  TIPE_PEGAWAI_ID = ''".$this->getField("TIPE_PEGAWAI_ID")."''"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","NAMA"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT TIPE_PEGAWAI_ID, TIPE_PEGAWAI_ID_PARENT, NAMA
				FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TIPE_PEGAWAI_ID ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    
	function selectByParamsLike($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT TIPE_PEGAWAI_ID, TIPE_PEGAWAI_ID_PARENT, NAMA
				FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY TIPE_PEGAWAI_ID ASC";
		return $this->selectLimit($str,$limit,$from); 
    }	
	
	function selectByTipeGolongan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT COUNT(GOL) JML, GOL, TIPE_PEGAWAI_ID
					FROM(
					SELECT  A.PEGAWAI_ID, B.GOL_RUANG, substr(B.GOL_RUANG, 1, CASE WHEN position('/' in B.GOL_RUANG) IS NULL OR position('/' in B.GOL_RUANG) = 0 THEN 1 ELSE position('/' in B.GOL_RUANG) END -1) GOL, TIPE_PEGAWAI_ID
					FROM PEGAWAI A
					LEFT JOIN (SELECT TMT_PANGKAT, GOL_RUANG, PEGAWAI_ID, PANGKAT_ID FROM PANGKAT_TERAKHIR) B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
					WHERE A.STATUS_PEGAWAI IN (1,2)  
						  ".$statement."
						  ORDER BY B.GOL_RUANG
				) A
				WHERE 1=1
				"; //AND GOL = 'I' AND TIPE_PEGAWAI_ID = 'I'
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= " GROUP BY GOL, TIPE_PEGAWAI_ID ORDER BY GOL";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByTipePendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT COUNT(PENDIDIKAN) JML, PENDIDIKAN, TIPE_PEGAWAI_ID
					FROM(
					SELECT  A.PEGAWAI_ID, B.PENDIDIKAN, TIPE_PEGAWAI_ID
					FROM PEGAWAI A
					LEFT JOIN (SELECT PEGAWAI_ID, TAHUN LULUS, PENDIDIKAN FROM PENDIDIKAN_TERAKHIR X) B ON A.PEGAWAI_ID = B.PEGAWAI_ID
					WHERE A.STATUS_PEGAWAI IN (1,2)
						  ".$statement."
						  ORDER BY B.PENDIDIKAN
				) A
				WHERE 1=1
				"; //AND PENDIDIKAN = 'S1' AND TIPE_PEGAWAI_ID = 'I'
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= " GROUP BY PENDIDIKAN, TIPE_PEGAWAI_ID ORDER BY PENDIDIKAN";
		return $this->selectLimit($str,$limit,$from); 
    }        

    /** 
    * Hitung jumlah record berdasarkan parameter (array). 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","NAMA"=>"yyy") 
    * @return long Jumlah record yang sesuai kriteria 
    **/ 
	function getCountByTipePegawai($paramsArray=array(), $stat = '')
	{
		$str = "SELECT  COUNT(A.TIPE_PEGAWAI_ID) JML
                FROM PEGAWAI A
                WHERE STATUS_PEGAWAI IN (1, 2)          
				"; 
				//AND SATKER_ID = '04040101' AND TIPE_PEGAWAI_ID = '12'
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $stat.' GROUP BY TIPE_PEGAWAI_ID';
		
		$this->select($str);
		$this->query = $str; 
		if($this->firstRow()) 
			return $this->getField("JML"); 
		else 
			return 0; 
    }
	
    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(TIPE_PEGAWAI_ID) AS ROWCOUNT FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL "; 
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

    function getCountByParamsLike($paramsArray=array())
	{
		$str = "SELECT COUNT(TIPE_PEGAWAI_ID) AS ROWCOUNT FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
  } 
?>