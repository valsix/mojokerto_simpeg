<? 
  include_once(APPPATH.'/models/Entity.php');

  class Mertua extends Entity{ 

		var $query;

    function Mertua()
		{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
		{
			$str = "SELECT MERTUA_ID, PEGAWAI_ID, JENIS_KELAMIN, 
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   PEKERJAAN, ALAMAT, KODEPOS, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
				   TELEPON
				FROM MERTUA a WHERE MERTUA_ID IS NOT NULL"; 
			
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