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
		$this->setField("CUTI_ID", $this->getNextId("CUTI_ID","CUTI")); 
		
		$str = "INSERT INTO CUTI (
				   CUTI_ID, PEGAWAI_ID, JENIS_CUTI, 
				   NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
				   LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   KETERANGAN, CUTI_KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("CUTI_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("JENIS_CUTI").",
				  '".$this->getField("NO_SURAT")."',
				  ".$this->getField("TANGGAL_PERMOHONAN").",
				  ".$this->getField("TANGGAL_SURAT").",
				  ".$this->getField("LAMA").",
				  ".$this->getField("TANGGAL_MULAI").",
				  ".$this->getField("TANGGAL_SELESAI").",
				  '".$this->getField("KETERANGAN")."',
				  '".$this->getField("CUTI_KETERANGAN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE CUTI
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   JENIS_CUTI    = ".$this->getField("JENIS_CUTI").",
					   NO_SURAT             = '".$this->getField("NO_SURAT")."',
					   TANGGAL_PERMOHONAN     = ".$this->getField("TANGGAL_PERMOHONAN").",
					   TANGGAL_SURAT    = ".$this->getField("TANGGAL_SURAT").",
					   LAMA    = ".$this->getField("LAMA").",
					   TANGGAL_MULAI  = ".$this->getField("TANGGAL_MULAI").",
					   TANGGAL_SELESAI = ".$this->getField("TANGGAL_SELESAI").",
					   KETERANGAN        = '".$this->getField("KETERANGAN")."',
					   CUTI_KETERANGAN= '".$this->getField("CUTI_KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE CUTI_ID= ".$this->getField("CUTI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM CUTI
                WHERE 
                  CUTI_ID= '".$this->getField("CUTI_ID")."'"; 
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT CUTI_ID, PEGAWAI_ID,JENIS_CUTI, 
		   NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
		   LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, CUTI_KETERANGAN, 
		   KETERANGAN, 
		   CASE JENIS_CUTI WHEN 1 THEN 'Cuti Tahunan' 
					WHEN  2 THEN 'Cuti Besar' 
					WHEN  3 THEN 'Cuti Sakit' 
					WHEN  4 THEN 'Cuti Bersalin' 
					WHEN  5 THEN 'CLTN' 
					WHEN  6 THEN 'Perpanjangan CLTN' 
					WHEN  7 THEN 'Cuti Menikah' 
					ELSE 'Cuti karena alasan penting' 
			END NMCUTI
		FROM CUTI 
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
        
  } 
?>