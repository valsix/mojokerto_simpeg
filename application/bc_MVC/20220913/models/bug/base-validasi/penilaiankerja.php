<? 
  include_once(APPPATH.'/models/Entity.php');

  class PenilaianKerja extends Entity{ 

	var $query;

    function PenilaianKerja()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PENILAIAN_KERJA")); 

		$str = "INSERT INTO validasi.PENILAIAN_KERJA (
				PENILAIAN_KERJA_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, TANGGAL_AWAL, 
				TANGGAL_AKHIR, TAHUN, NILAI1, 
				NILAI2, NILAI3, NILAI4, 
				NILAI5, NILAI6, REKOMENDASI, JUMLAH, RATA_RATA, SASARAN_KERJA, SASARAN_KERJA_HASIL, PERILAKU_HASIL, NILAI_HASIL, PEGAWAI_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID) 
				VALUES (
				  ".$this->getField("PENILAIAN_KERJA_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TANGGAL_AWAL").",
				  ".$this->getField("TANGGAL_AKHIR").",
				  ".$this->getField("TAHUN").",
				  ".$this->getField("NILAI1").",
				  ".$this->getField("NILAI2").",
				  ".$this->getField("NILAI3").",
				  ".$this->getField("NILAI4").",
				  ".$this->getField("NILAI5").",
				  ".$this->getField("NILAI6").",
				  '".$this->getField("REKOMENDASI")."',
				  ".$this->getField("JUMLAH").",
				  ".$this->getField("RATA_RATA").",
				  ".$this->getField("SASARAN_KERJA").",
				  ".$this->getField("SASARAN_KERJA_HASIL").",
				  ".$this->getField("PERILAKU_HASIL").",
				  ".$this->getField("NILAI_HASIL").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				//echo $str;
		$this->query = $str;
		return $this->execQuery($str);
 	}

 	function update()
	{
		$str = "
				UPDATE validasi.PENILAIAN_KERJA
				SET 
					PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
					TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
					TAHUN= ".$this->getField("TAHUN").",
					NILAI1= ".$this->getField("NILAI1").",
					NILAI2= ".$this->getField("NILAI2").",
					NILAI3= ".$this->getField("NILAI3").",
					NILAI4= ".$this->getField("NILAI4").",
					NILAI5= ".$this->getField("NILAI5").",
					NILAI6= ".$this->getField("NILAI6").",
					REKOMENDASI= '".$this->getField("REKOMENDASI")."',
					JUMLAH= ".$this->getField("JUMLAH").",
				    RATA_RATA= ".$this->getField("RATA_RATA").",
					SASARAN_KERJA= ".$this->getField("SASARAN_KERJA").",
					SASARAN_KERJA_HASIL= ".$this->getField("SASARAN_KERJA_HASIL").",
				    PERILAKU_HASIL= ".$this->getField("PERILAKU_HASIL").",
				    NILAI_HASIL= ".$this->getField("NILAI_HASIL").",
					PEGAWAI_ID		= ".$this->getField("PEGAWAI_ID").",
					LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
 	}


 	function updateValidasi()
	{
		$str = "
				UPDATE validasi.PENILAIAN_KERJA
				SET 
					PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
					TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
					TAHUN= ".$this->getField("TAHUN").",
					NILAI1= ".$this->getField("NILAI1").",
					NILAI2= ".$this->getField("NILAI2").",
					NILAI3= ".$this->getField("NILAI3").",
					NILAI4= ".$this->getField("NILAI4").",
					NILAI5= ".$this->getField("NILAI5").",
					NILAI6= ".$this->getField("NILAI6").",
					REKOMENDASI= '".$this->getField("REKOMENDASI")."',
					JUMLAH= ".$this->getField("JUMLAH").",
				    RATA_RATA= ".$this->getField("RATA_RATA").",
					SASARAN_KERJA= ".$this->getField("SASARAN_KERJA").",
					SASARAN_KERJA_HASIL= ".$this->getField("SASARAN_KERJA_HASIL").",
				    PERILAKU_HASIL= ".$this->getField("PERILAKU_HASIL").",
				    NILAI_HASIL= ".$this->getField("NILAI_HASIL").",
					PEGAWAI_ID		= ".$this->getField("PEGAWAI_ID").",
					VALIDASI	= ".$this->getField("VALIDASI").",
					LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
				  	TANGGAL_VALIDASI= NOW()
				WHERE  TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
 	}

 	function delete()
	{
	 $str = "DELETE FROM validasi.PENILAIAN_KERJA
			  WHERE 
			 TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'";  
					  
			$this->query = $str;
	 return $this->execQuery($str);
	 }
	

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PENILAIAN_KERJA_ID, 
				A.PEJABAT_PENETAP_ID, b.JABATAN PEJABAT_PENETAP,
				TANGGAL_AWAL, TANGGAL_AKHIR, TANGGAL_AWAL || ' s/d ' || TANGGAL_AKHIR JANGKA_WAKTU, TAHUN,  NILAI1,
				NILAI2, NILAI3, NILAI4, 
				NILAI5, NILAI6, REKOMENDASI, encode(FOTO_BLOB, 'base64') FOTO_BLOB, PEGAWAI_ID,
				JUMLAH, RATA_RATA, SASARAN_KERJA, SASARAN_KERJA_HASIL, PERILAKU_HASIL, NILAI_HASIL,
				CASE WHEN NILAI_HASIL <= 50 AND NILAI_HASIL IS NOT NULL
				THEN '(Buruk)'
				WHEN NILAI_HASIL <= 60 AND NILAI_HASIL IS NOT NULL
				THEN '(Sedang)'
				WHEN NILAI_HASIL <= 75 AND NILAI_HASIL IS NOT NULL
				THEN '(Cukup)'
				WHEN NILAI_HASIL < 91 AND NILAI_HASIL IS NOT NULL
				THEN '(Baik)'
				WHEN NILAI_HASIL IS NOT NULL
				THEN '(Sangat Baik)'
				END NILAI_HASIL_NAMA
				,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
				FROM validasi.validasi_pegawai_penilaian_kerja A 
				LEFT JOIN PEJABAT_PENETAP b ON A.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID
				WHERE 1=1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY TANGGAL_AKHIR ASC";
				
		return $this->selectLimit($str,$limit,$from); 
 	}
        
  } 
?>