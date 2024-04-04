<? 
  include_once(APPPATH.'/models/Entity.php');

  class SuamiIstri extends Entity{ 

		var $query;

    function SuamiIstri()
		{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
		{
			$str = "SELECT SUAMI_ISTRI_ID, PEGAWAI_ID, PENDIDIKAN_ID, 
				   (SELECT X.GELAR_DEPAN ||  (case when X.GELAR_DEPAN = NULL then '' else ' ' end ) || X.NAMA || (case when X.GELAR_BELAKANG = NULL then '' else ' ' end) || X.GELAR_BELAKANG FROM PEGAWAI X WHERE A.PEGAWAI_ID = X.PEGAWAI_ID) NAMA_PEGAWAI,
				   (SELECT X.NIP_BARU FROM PEGAWAI X WHERE A.PEGAWAI_ID = X.PEGAWAI_ID) NIP_PEGAWAI,
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   TANGGAL_KAWIN, KARTU, STATUS_PNS,
				   case when STATUS_PNS = 1 then 'Ya' when STATUS_PNS = 0 then 'Tidak' end  NMPNS,
				   NIP_PNS, PEKERJAAN, STATUS_TUNJANGAN, 
				   STATUS_BAYAR, BULAN_BAYAR, FOTO,
				   (SELECT X.NAMA  FROM PENDIDIKAN X WHERE X.PENDIDIKAN_ID = a.PENDIDIKAN_ID) NMPENDIDIKAN, FOTO_BLOB,
				   SK_CERAI, SK_CERAI_TANGGAL, 
   				   SK_CERAI_TMT, STATUS, FOTO_SCAN, DOSIR_KARPEG, FORMAT_KARPEG, UKURAN_KARPEG,DOSIR_SURAT_NIKAH, FORMAT_SURAT_NIKAH, UKURAN_SURAT_NIKAH,LINK_FILE_APPS_KARPEG,LINK_FILE_APPS_SURAT_NIKAH,JENIS_KELAMIN
				FROM SUAMI_ISTRI A WHERE SUAMI_ISTRI_ID IS NOT NULL"; 
		
			while(list($key,$val) = each($paramsArray))
			{
				$str .= " AND $key = '$val' ";
			}
			
			$str .= $statement." ORDER BY TANGGAL_KAWIN ASC";
			$this->query = $str;
					
			return $this->selectLimit($str,$limit,$from); 
    }        
  } 
?>