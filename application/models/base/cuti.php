<? 
include_once(APPPATH.'/models/Entity.php');

class Cuti extends Entity{ 

	var $query;

	function Cuti()
	{
		$this->Entity(); 
	}


	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("CUTI_ID", $this->getNextId("CUTI_ID","CUTI")); 

		$str = "INSERT INTO CUTI (
				   CUTI_ID, PEGAWAI_ID, JENIS_CUTI, 
				   NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
				   LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("CUTI_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("JENIS_CUTI")."',
				  '".$this->getField("NO_SURAT")."',
				  ".$this->getField("TANGGAL_PERMOHONAN").",
				  ".$this->getField("TANGGAL_SURAT").",
				  '".$this->getField("LAMA")."',
				  ".$this->getField("TANGGAL_MULAI").",
				  ".$this->getField("TANGGAL_SELESAI").",
				  '".$this->getField("KETERANGAN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE CUTI
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   JENIS_CUTI    = '".$this->getField("JENIS_CUTI")."',
					   NO_SURAT             = '".$this->getField("NO_SURAT")."',
					   TANGGAL_PERMOHONAN     = ".$this->getField("TANGGAL_PERMOHONAN").",
					   TANGGAL_SURAT    = ".$this->getField("TANGGAL_SURAT").",
					   LAMA    = '".$this->getField("LAMA")."',
					   TANGGAL_MULAI  = ".$this->getField("TANGGAL_MULAI").",
					   TANGGAL_SELESAI = ".$this->getField("TANGGAL_SELESAI").",
					   KETERANGAN        = '".$this->getField("KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'	
				WHERE  CUTI_ID          = '".$this->getField("CUTI_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM CUTI
                WHERE 
                  CUTI_ID = '".$this->getField("CUTI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT CUTI_ID, PEGAWAI_ID, JENIS_CUTI, 
				   NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
				   LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   KETERANGAN, FOTO_BLOB,
				   case 
				   when JENIS_CUTI = 1 then 'Cuti Tahunan' 
				   when JENIS_CUTI = 2 then 'Cuti Besar' 
				   when JENIS_CUTI = 3 then 'Cuti Sakit'
				   when JENIS_CUTI = 4 then 'Cuti Bersalin'
				   when JENIS_CUTI = 5 then 'CLTN'
				   when JENIS_CUTI = 6 then 'Perpanjangan CLTN'
				   when JENIS_CUTI = 7 then 'Cuti Menikah'
				   when JENIS_CUTI = 10 then 'Cuti Alasan Penting'
				   end  NMCUTI
				FROM CUTI WHERE CUTI_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NO_SURAT ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
		{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM CUTI WHERE  CUTI_ID IS NOT NULL ".$statement; 
				
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		// echo $str;exit;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }
} 
?>