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
				   a. NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   PEKERJAAN, ALAMAT, KODEPOS, 
				   TELEPON, a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID,
				 (select nama from propinsi b where a.propinsi_id =b.propinsi_id LIMIT 1) nama_propinsi ,
					(select nama from kabupaten b where a.kabupaten_id =b.kabupaten_id LIMIT 1) nama_kabupaten,
					(select nama from kecamatan b where a.kecamatan_id =b.kecamatan_id LIMIT 1) nama_kecamatan,
					(select nama from kelurahan b where a.kelurahan_id =b.kelurahan_id LIMIT 1) nama_kelurahan
					FROM ORANG_TUA a 
				WHERE ORANG_TUA_ID IS NOT NULL"; 
			
			while(list($key,$val) = each($paramsArray))
			{
				$str .= " AND $key = '$val' ";
			}
			$str .= $statement." ORDER BY a.PEGAWAI_ID ASC";
			$this->query = $str;
			// echo$str;exit;
					
			return $this->selectLimit($str,$limit,$from);  
    }
        
  } 
?>