<? 
  include_once(APPPATH.'/models/Entity.php');

  class OrangTua extends Entity{ 

		var $query;

    function OrangTua()
		{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
		{
			$str = "SELECT ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, 
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   PEKERJAAN, ALAMAT, KODEPOS, 
				   TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID
				FROM ORANG_TUA a WHERE ORANG_TUA_ID IS NOT NULL"; 
			
			while(list($key,$val) = each($paramsArray))
			{
				$str .= " AND $key = '$val' ";
			}
			$str .= $statement." ORDER BY a.PEGAWAI_ID ASC";
			$this->query = $str;
					
			return $this->selectLimit($str,$limit,$from);  
    }
        
  } 
?>