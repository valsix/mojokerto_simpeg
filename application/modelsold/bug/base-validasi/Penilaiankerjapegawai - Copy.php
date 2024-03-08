<? 

  include_once(APPPATH.'/models/Entity.php');

  class PenilaianKerjaPegawai extends Entity{ 

	var $query;
	function PenilaianKerjaPegawai()
	{
		$this->Entity(); 
	}
	
	function insert()
	{
		//orientasi;1;integrasi;2;komitmen;3;disiplin;4;kerjasama;5;kepemimpinan;6;
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PENILAIAN_KERJA_PEGAWAI")); 

		$str = "INSERT INTO validasi.PENILAIAN_KERJA_PEGAWAI (
				PENILAIAN_KERJA_PEGAWAI_ID, PEJABAT_PENILAI_ID,ATASAN_PEJABAT_PENILAI_ID,JENIS_JABATAN_ID, TAHUN, NILAI1, 
				NILAI2, NILAI3, NILAI4, 
				NILAI5, NILAI6,  SASARAN_KERJA, SASARAN_KERJA_HASIL, PERILAKU_HASIL, NILAI_PERILAKU, NILAI_HASIL,STATUS,STATUS_ATASAN,TMT_GOLONGAN, NAMA_ATASAN_PENILAI,JABATAN_ATASAN_PENILAI,UNOR_ATASAN_PENILAI,GOLONGAN_ATASAN_PENILAI,TMT_GOLONGAN_ATASAN,PEGAWAI_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID) 
				VALUES (
				  ".$this->getField("PENILAIAN_KERJA_PEGAWAI_ID").",
				  ".$this->getField("PEJABAT_PENILAI_ID").",
				  ".$this->getField("ATASAN_PEJABAT_PENILAI_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
				  ".$this->getField("TAHUN").",
				  ".$this->getField("NILAI1").",
				  ".$this->getField("NILAI2").",
				  ".$this->getField("NILAI3").",
				  ".$this->getField("NILAI4").",
				  ".$this->getField("NILAI5").",
				  ".$this->getField("NILAI6").",
				  ".$this->getField("SASARAN_KERJA").",
				  ".$this->getField("SASARAN_KERJA_HASIL").",
				  ".$this->getField("PERILAKU_HASIL").",
				  ".$this->getField("NILAI_PERILAKU").",
				  ".$this->getField("NILAI_HASIL").",
				  ".$this->getField("STATUS").",
				  ".$this->getField("STATUS_ATASAN").",
				  ".$this->getField("TMT_GOLONGAN").",
				  '".$this->getField("NAMA_ATASAN_PENILAI")."',
				  '".$this->getField("JABATAN_ATASAN_PENILAI")."',
				  '".$this->getField("UNOR_ATASAN_PENILAI")."',
				  '".$this->getField("GOLONGAN_ATASAN_PENILAI")."',
				  ".$this->getField("TMT_GOLONGAN_ATASAN").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				//echo $str;
		$this->id = $this->getField("TEMP_VALIDASI_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
 	}

 	function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE validasi.PENILAIAN_KERJA_PEGAWAI
				SET 
					PEJABAT_PENILAI_ID= ".$this->getField("PEJABAT_PENILAI_ID").",
					ATASAN_PEJABAT_PENILAI_ID= ".$this->getField("ATASAN_PEJABAT_PENILAI_ID").",
					JENIS_JABATAN_ID= ".$this->getField("JENIS_JABATAN_ID").",
					TAHUN= ".$this->getField("TAHUN").",
					NILAI1= ".$this->getField("NILAI1").",
					NILAI2= ".$this->getField("NILAI2").",
					NILAI3= ".$this->getField("NILAI3").",
					NILAI4= ".$this->getField("NILAI4").",
					NILAI5= ".$this->getField("NILAI5").",
					NILAI6= ".$this->getField("NILAI6").",
					SASARAN_KERJA= ".$this->getField("SASARAN_KERJA").",
					SASARAN_KERJA_HASIL= ".$this->getField("SASARAN_KERJA_HASIL").",
				    PERILAKU_HASIL= ".$this->getField("PERILAKU_HASIL").",
					NILAI_PERILAKU		= ".$this->getField("NILAI_PERILAKU").",
					NILAI_HASIL		= ".$this->getField("NILAI_HASIL").",
					STATUS		= ".$this->getField("STATUS").",
					STATUS_ATASAN		= ".$this->getField("STATUS_ATASAN").",
					TMT_GOLONGAN		= ".$this->getField("TMT_GOLONGAN").",
					NAMA_ATASAN_PENILAI		= '".$this->getField("NAMA_ATASAN_PENILAI")."',
					JABATAN_ATASAN_PENILAI		= '".$this->getField("JABATAN_ATASAN_PENILAI")."',
					UNOR_ATASAN_PENILAI		= '".$this->getField("UNOR_ATASAN_PENILAI")."',
					GOLONGAN_ATASAN_PENILAI		= '".$this->getField("GOLONGAN_ATASAN_PENILAI")."',
					TMT_GOLONGAN_ATASAN		= ".$this->getField("TMT_GOLONGAN_ATASAN").",
					PEGAWAI_ID		= ".$this->getField("PEGAWAI_ID").",
					LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
 	}
	

	function updateValidasi()
	{
        $str = "
		UPDATE validasi.PENILAIAN_KERJA_PEGAWAI
		SET    
			   VALIDASI= ".$this->getField("VALIDASI").",
			   TANGGAL_VALIDASI= NOW(),
			   VALIDATOR= '".$this->getField("VALIDATOR")."'
		WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
        return $this->execQuery($str);
    }

	function delete()
	{
	 $str = "DELETE FROM validasi.PENILAIAN_KERJA_PEGAWAI
			  WHERE 
			 TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'";  
					  
			$this->query = $str;
	 return $this->execQuery($str);
	 }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
			
			SELECT A.PENILAIAN_KERJA_PEGAWAI_ID,
				A.PEJABAT_PENILAI_ID,
				A.ATASAN_PEJABAT_PENILAI_ID,
				A.JENIS_JABATAN_ID
				, C.NAMA_PENILAI
				, COALESCE(C.JABATAN_FUNG, C.JABATAN_STRUK, C.JABATAN_PELAKSANA) JABATAN_PENILAI
				, C.NIP_BARU ||' - '|| C.NAMA_PENILAI PEGAWAI_INFO
				, C.UNOR UNOR_PENILAI
				, C.NIP_BARU NIP_PENILAI
				, B.GOL_RUANG GOLONGAN_PENILAI
				, B.TMT_PANGKAT
				, E.NIP_BARU ||' - '|| E.NAMA_PENILAI PEGAWAI_ATASAN_INFO
				, COALESCE(E.NAMA_PENILAI,A.NAMA_ATASAN_PENILAI) ATASAN_PENILAI
				, COALESCE(E.JABATAN_FUNG, E.JABATAN_STRUK, E.JABATAN_PELAKSANA,A.JABATAN_ATASAN_PENILAI) JABATAN_ATASAN_PENILAI
				, COALESCE(E.UNOR,A.UNOR_ATASAN_PENILAI) UNOR_ATASAN_PENILAI
				, COALESCE(D.GOL_RUANG,A.GOLONGAN_ATASAN_PENILAI) GOLONGAN_ATASAN_PENILAI
				, A.TMT_GOLONGAN_ATASAN
				, A.STATUS
				, A.STATUS_ATASAN
				, A.TMT_GOLONGAN
				, TAHUN,  NILAI1,
				NILAI2, NILAI3, NILAI4, 
				NILAI5, NILAI6,  A.PEGAWAI_ID,
				SASARAN_KERJA, SASARAN_KERJA_HASIL, PERILAKU_HASIL, NILAI_HASIL,
				CASE WHEN NILAI_HASIL <= 50 AND NILAI_HASIL IS NOT NULL
				THEN 'Kurang'
				WHEN NILAI_HASIL <= 60 AND NILAI_HASIL IS NOT NULL
				THEN 'Sedang'
				WHEN NILAI_HASIL <= 75 AND NILAI_HASIL IS NOT NULL
				THEN 'Cukup'
				WHEN NILAI_HASIL < 91 AND NILAI_HASIL IS NOT NULL
				THEN 'Baik'
				WHEN NILAI_HASIL IS NOT NULL
				THEN 'Sangat Baik'
				END NILAI_HASIL_NAMA
				, F.NAMA JENIS_JABATAN_INFO
				
				,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
				FROM validasi.validasi_penilaian_kerja_pegawai A
				LEFT JOIN 
				(
					SELECT A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, F.PANGKAT_ID, F.GOL_RUANG,F.TMT_PANGKAT 
					FROM 
					PEGAWAI A
					LEFT JOIN 
					(
						SELECT A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, A.PANGKAT_ID, B.KODE GOL_RUANG,A.TMT_PANGKAT 
						FROM PANGKAT_RIWAYAT A 
						LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
						INNER JOIN 
							(
								SELECT A.PEGAWAI_ID,MAX (A.PANGKAT_RIWAYAT_ID) PANGKAT_RIWAYAT_ID
								FROM PANGKAT_RIWAYAT A
								GROUP BY A.PEGAWAI_ID
							) F ON F.PANGKAT_RIWAYAT_ID = A.PANGKAT_RIWAYAT_ID
					) F ON F.PEGAWAI_ID = A.PEGAWAI_ID
				) B ON A.PEJABAT_PENILAI_ID = B.PEGAWAI_ID  
				LEFT JOIN 
				(	
					SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID,C.NAMA JABATAN_FUNG
					,D.NAMA JABATAN_STRUK,E.NAMA JABATAN_PELAKSANA,F.NAMA NAMA_PENILAI,G.NAMA UNOR,F.NIP_BARU
						FROM PEGAWAI_JABATAN A 
						LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
						LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
						LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
						LEFT JOIN SATKER G ON G.SATKER_ID = A.UNOR_ID
						INNER JOIN 
						(
							SELECT A.PEGAWAI_ID,B.NAMA,B.NIP_BARU, MAX (A.PEGAWAI_JABATAN_ID) PEGAWAI_JABATAN_ID
							FROM PEGAWAI_JABATAN A
							INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
							GROUP BY A.PEGAWAI_ID,B.NAMA,B.NIP_BARU
						) F ON F.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
				) C ON A.PEJABAT_PENILAI_ID = C.PEGAWAI_ID
				LEFT JOIN 
				(
					SELECT A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, A.PANGKAT_ID, B.KODE GOL_RUANG,A.TMT_PANGKAT 
					FROM PANGKAT_RIWAYAT A 
					LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
					INNER JOIN 
						(
							SELECT A.PEGAWAI_ID,MAX (A.PANGKAT_RIWAYAT_ID) PANGKAT_RIWAYAT_ID
							FROM PANGKAT_RIWAYAT A
							GROUP BY A.PEGAWAI_ID
						) F ON F.PANGKAT_RIWAYAT_ID = A.PANGKAT_RIWAYAT_ID
				) D ON A.ATASAN_PEJABAT_PENILAI_ID = D.PEGAWAI_ID  
				LEFT JOIN 
				(	
					SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID,C.NAMA JABATAN_FUNG
					,D.NAMA JABATAN_STRUK,E.NAMA JABATAN_PELAKSANA,F.NAMA NAMA_PENILAI,G.NAMA UNOR,F.NIP_BARU
						FROM PEGAWAI_JABATAN A 
						LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
						LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
						LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
						LEFT JOIN SATKER G ON G.SATKER_ID = A.UNOR_ID
						INNER JOIN 
						(
							SELECT A.PEGAWAI_ID,B.NAMA,B.NIP_BARU, MAX (A.PEGAWAI_JABATAN_ID) PEGAWAI_JABATAN_ID
							FROM PEGAWAI_JABATAN A
							INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
							GROUP BY A.PEGAWAI_ID,B.NAMA,B.NIP_BARU
						) F ON F.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
				) E ON A.ATASAN_PEJABAT_PENILAI_ID = E.PEGAWAI_ID  
				LEFT JOIN JENIS_JABATAN F ON F.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
				
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
	
 	function selectByParamsJenisJabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.*, COALESCE(C.JABATAN_FUNG, C.JABATAN_STRUK, C.JABATAN_PELAKSANA) JABATAN,C.JENIS_JABATAN_ID,C.JENIS_JABATAN
		FROM PEGAWAI A
		INNER JOIN 
		(	SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, B.NAMA ESELON, C.NAMA JABATAN_FUNG,D.NAMA JABATAN_STRUK,E.NAMA JABATAN_PELAKSANA, 
			A.TMT_JABATAN,A.KELAS_JABATAN,A.BUP,G.TIPE_PEGAWAI_NEW_ID,G.NAMA TIPE_PEGAWAI_NAMA,H.JENIS_JABATAN_ID,H.NAMA JENIS_JABATAN
			FROM PEGAWAI_JABATAN A 
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
			LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
			LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
			LEFT JOIN TIPE_PEGAWAI_NEW G ON G.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (A.PEGAWAI_JABATAN_ID) PEGAWAI_JABATAN_ID
				FROM PEGAWAI_JABATAN A
				GROUP BY A.PEGAWAI_ID
			) F ON F.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
			LEFT JOIN JENIS_JABATAN H ON H.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID

		) C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		
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
 
 /** 
 * Hitung jumlah record berdasarkan parameter (array). 
 * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","TANGGAL_AKHIR"=>"yyy") 
 * @return long Jumlah record yang sesuai kriteria 
 **/ 
	function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(PENILAIAN_KERJA_PEGAWAI_ID) AS ROWCOUNT FROM PENILAIAN_KERJA_PEGAWAI WHERE PENILAIAN_KERJA_PEGAWAI_ID IS NOT NULL "; 
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