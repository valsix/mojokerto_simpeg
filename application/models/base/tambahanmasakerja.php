<? 
include_once(APPPATH.'/models/Entity.php');

class TambahanMasaKerja extends Entity{ 

	var $query;

	function TambahanMasaKerja()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TAMBAHAN_MASA_KERJA_ID", $this->getNextId("TAMBAHAN_MASA_KERJA_ID","TAMBAHAN_MASA_KERJA")); 

		$str = "INSERT INTO TAMBAHAN_MASA_KERJA (
				   TAMBAHAN_MASA_KERJA_ID, PEGAWAI_ID, NO_SK, 
				   TANGGAL_SK, TMT_SK, TAHUN_TAMBAHAN, 
				   BULAN_TAMBAHAN, TAHUN_BARU, BULAN_BARU, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("TAMBAHAN_MASA_KERJA_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TMT_SK").",
				  '".$this->getField("TAHUN_TAMBAHAN")."',
				  '".$this->getField("BULAN_TAMBAHAN")."',
				  '".$this->getField("TAHUN_BARU")."',
				  '".$this->getField("BULAN_BARU")."',				 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'	
				)"; 
				
		$this->id= $this->getField("TAMBAHAN_MASA_KERJA_ID");	
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE TAMBAHAN_MASA_KERJA
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   NO_SK    = '".$this->getField("NO_SK")."',
					   TANGGAL_SK             = ".$this->getField("TANGGAL_SK").",
					   TMT_SK     = ".$this->getField("TMT_SK").",
					   TAHUN_TAMBAHAN    = '".$this->getField("TAHUN_TAMBAHAN")."',
					   BULAN_TAMBAHAN    = '".$this->getField("BULAN_TAMBAHAN")."',
					   TAHUN_BARU  = '".$this->getField("TAHUN_BARU")."',
					   BULAN_BARU = '".$this->getField("BULAN_BARU")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  TAMBAHAN_MASA_KERJA_ID          = '".$this->getField("TAMBAHAN_MASA_KERJA_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

   	function delete()
	{
        $str = "DELETE FROM TAMBAHAN_MASA_KERJA
                WHERE 
                  TAMBAHAN_MASA_KERJA_ID = '".$this->getField("TAMBAHAN_MASA_KERJA_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
				    	*
				    	FROM TAMBAHAN_MASA_KERJA A
                        WHERE 1=1 "; 

    	while(list($key,$val) = each($paramsArray))
    	{
    		$str .= " AND $key = '$val' ";
    	}

		$str .= $statement."";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>
