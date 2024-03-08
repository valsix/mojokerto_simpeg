<? 
  include_once(APPPATH.'/models/Entity.php');

  class Pegawai extends Entity{ 

	var $query;

    function Pegawai()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$str = "DELETE FROM validasi.PEGAWAI
                WHERE 
                PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."'";  
		$this->execQuery($str);

		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI")); 		
		$str = "INSERT INTO validasi.PEGAWAI (
				   PEGAWAI_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID, 
				   KEDUDUKAN_ID, JENIS_PEGAWAI_ID, BANK_ID, 
				   NIP_LAMA, NIP_BARU, NAMA, 
				   GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH,
				   EMAIL, ALAMAT, RT, RW, TELEPON, KODEPOS, STATUS_PEGAWAI, KARTU_PEGAWAI, ASKES, TASPEN,
				   NPWP, NIK, FOTO, FOTO_SETENGAH, NO_REKENING, TANGGAL_MATI, TANGGAL_PENSIUN, TANGGAL_TERUSAN, TIPE_PEGAWAI_ID,
				   AGAMA_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID, SK_KONVERSI_NIP)
				VALUES (
				  ".$this->getField("PEGAWAI_ID").",
				  ".$this->getField("PROPINSI_ID").",
				  ".$this->getField("KABUPATEN_ID").",
				  ".$this->getField("KECAMATAN_ID").",
				  ".$this->getField("KELURAHAN_ID").",
				  '".$this->getField("SATKER_ID")."',
				  ".$this->getField("KEDUDUKAN_ID").",
				  ".$this->getField("JENIS_PEGAWAI_ID").",
				  ".$this->getField("BANK_ID").",
				  '".$this->getField("NIP_LAMA")."',
				  '".$this->getField("NIP_BARU")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("GELAR_DEPAN")."',
				  '".$this->getField("GELAR_BELAKANG")."',
				  '".$this->getField("TEMPAT_LAHIR")."',
				  ".$this->getField("TANGGAL_LAHIR").",
				  '".$this->getField("JENIS_KELAMIN")."',
				  ".$this->getField("STATUS_KAWIN").",
				  '".$this->getField("SUKU_BANGSA")."',
				  '".$this->getField("GOLONGAN_DARAH")."',
				  '".$this->getField("EMAIL")."',
				  '".$this->getField("ALAMAT")."',
				  '".$this->getField("RT")."',
				  '".$this->getField("RW")."',
				  '".$this->getField("TELEPON")."',
				  '".$this->getField("KODEPOS")."',
				  ".$this->getField("STATUS_PEGAWAI").",
				  '".$this->getField("KARTU_PEGAWAI")."',
				  '".$this->getField("ASKES")."',
				  '".$this->getField("TASPEN")."',
				  '".$this->getField("NPWP")."',
				  '".$this->getField("NIK")."',
				  '".$this->getField("FOTO")."',
				  '".$this->getField("FOTO_SETENGAH")."',
				  '".$this->getField("NO_REKENING")."',
				  ".$this->getField("TANGGAL_MATI").",
				  ".$this->getField("TANGGAL_PENSIUN").",
				  ".$this->getField("TANGGAL_TERUSAN").",
				  '".$this->getField("TIPE_PEGAWAI_ID")."',
				  ".$this->getField("AGAMA_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID").",
				  '".$this->getField("SK_KONVERSI_NIP")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		$this->pegawai_id 	  = $this->getField("PEGAWAI_ID");
		$this->tempValidasiId = $this->getField("TEMP_VALIDASI_ID");
		return $this->execQuery($str);
    }

     function insertupload()
	{
		$this->setField("PEGAWAI_FILE_ID", $this->getNextId("PEGAWAI_FILE_ID","PEGAWAI_FILE")); 
		
		$str = "INSERT INTO PEGAWAI_FILE(
	            PEGAWAI_FILE_ID, PEGAWAI_ID,TEMP_VALIDASI_ID,  
	            NAMA_FILE_FOTO, LINK_FILE_FOTO, NAMA_FILE_KARPEG,LINK_FILE_KARPEG,NAMA_FILE_ASKES,LINK_FILE_ASKES,NAMA_FILE_TASPEN,LINK_FILE_TASPEN,NAMA_FILE_NPWP,LINK_FILE_NPWP,NAMA_FILE_NIK,LINK_FILE_NIK,NAMA_FILE_SK,LINK_FILE_SK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("PEGAWAI_FILE_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  ".$this->getField("TEMP_VALIDASI_ID").",
				  '".$this->getField("NAMA_FILE_FOTO")."',
				  '".$this->getField("LINK_FILE_FOTO")."',
				  '".$this->getField("NAMA_FILE_KARPEG")."',
				  '".$this->getField("LINK_FILE_KARPEG")."',
				  '".$this->getField("NAMA_FILE_ASKES")."',
				  '".$this->getField("LINK_FILE_ASKES")."',
				  '".$this->getField("NAMA_FILE_TASPEN")."',
				  '".$this->getField("LINK_FILE_TASPEN")."',
				  '".$this->getField("NAMA_FILE_NPWP")."',
				  '".$this->getField("LINK_FILE_NPWP")."',
				  '".$this->getField("NAMA_FILE_NIK")."',
				  '".$this->getField("LINK_FILE_NIK")."',
				  '".$this->getField("NAMA_FILE_SK")."',
				  '".$this->getField("LINK_FILE_SK")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateupload($nama,$link,$tipe)
	{
		$str = "
				UPDATE PEGAWAI_FILE
				SET    
					   TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID").",
					   ".$nama."= '".$this->getField($nama)."',
					   ".$link."= '".$this->getField($link)."',
					   ".$tipe."= '".$this->getField($tipe)."',
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PEGAWAI_FILE_ID= '".$this->getField("PEGAWAI_FILE_ID")."'
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.PEGAWAI
				SET    
					   PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
					   KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
					   KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
					   KELURAHAN_ID= ".$this->getField("KELURAHAN_ID").",
					   SATKER_ID= '".$this->getField("SATKER_ID")."',
					   KEDUDUKAN_ID= ".$this->getField("KEDUDUKAN_ID").",
					   JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID").",
					   BANK_ID= ".$this->getField("BANK_ID").",
					   NIP_LAMA= '".$this->getField("NIP_LAMA")."',
					   NIP_BARU= '".$this->getField("NIP_BARU")."',
					   NAMA= '".$this->getField("NAMA")."',
					   GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."',
					   GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."',
					   TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
					   TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
					   JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
					   STATUS_KAWIN= ".$this->getField("STATUS_KAWIN").",
					   SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."',
					   GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."',
					   EMAIL= '".$this->getField("EMAIL")."',
					   ALAMAT= '".$this->getField("ALAMAT")."',
					   RT= '".$this->getField("RT")."',
					   RW= '".$this->getField("RW")."',
					   TELEPON= '".$this->getField("TELEPON")."',
					   KODEPOS= '".$this->getField("KODEPOS")."',
					   STATUS_PEGAWAI= ".$this->getField("STATUS_PEGAWAI").",
					   KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."',
					   ASKES= '".$this->getField("ASKES")."',
					   TASPEN= '".$this->getField("TASPEN")."',
					   NPWP= '".$this->getField("NPWP")."',
					   NIK= '".$this->getField("NIK")."',
					   FOTO= '".$this->getField("FOTO")."',
					   FOTO_SETENGAH= '".$this->getField("FOTO_SETENGAH")."',
					   NO_REKENING= '".$this->getField("NO_REKENING")."',					 
					   TANGGAL_PENSIUN= ".$this->getField("TANGGAL_PENSIUN").",
					   AGAMA_ID= ".$this->getField("AGAMA_ID").",
					   VALIDASI= NULL,
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					  SK_KONVERSI_NIP=  '".$this->getField("SK_KONVERSI_NIP")."'
				WHERE  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.PEGAWAI
				SET    
					   PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
					   KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
					   KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
					   KELURAHAN_ID= ".$this->getField("KELURAHAN_ID").",
					   SATKER_ID= '".$this->getField("SATKER_ID")."',
					   KEDUDUKAN_ID= ".$this->getField("KEDUDUKAN_ID").",
					   JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID").",
					   BANK_ID= ".$this->getField("BANK_ID").",
					   NIP_LAMA= '".$this->getField("NIP_LAMA")."',
					   NIP_BARU= '".$this->getField("NIP_BARU")."',
					   NAMA= '".$this->getField("NAMA")."',
					   GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."',
					   GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."',
					   TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
					   TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
					   JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
					   STATUS_KAWIN= ".$this->getField("STATUS_KAWIN").",
					   SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."',
					   GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."',
					   EMAIL= '".$this->getField("EMAIL")."',
					   ALAMAT= '".$this->getField("ALAMAT")."',
					   RT= '".$this->getField("RT")."',
					   RW= '".$this->getField("RW")."',
					   TELEPON= '".$this->getField("TELEPON")."',
					   KODEPOS= '".$this->getField("KODEPOS")."',
					   STATUS_PEGAWAI= ".$this->getField("STATUS_PEGAWAI").",
					   KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."',
					   ASKES= '".$this->getField("ASKES")."',
					   TASPEN= '".$this->getField("TASPEN")."',
					   NPWP= '".$this->getField("NPWP")."',
					   NIK= '".$this->getField("NIK")."',
					   FOTO= '".$this->getField("FOTO")."',
					   FOTO_SETENGAH= '".$this->getField("FOTO_SETENGAH")."',
					   NO_REKENING= '".$this->getField("NO_REKENING")."',					 
					   TANGGAL_PENSIUN= ".$this->getField("TANGGAL_PENSIUN").",
					   TIPE_PEGAWAI_ID= '".$this->getField("TIPE_PEGAWAI_ID")."',
					   AGAMA_ID= ".$this->getField("AGAMA_ID").",
					   VALIDASI= ".$this->getField("VALIDASI").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					   SK_KONVERSI_NIP=  '".$this->getField("SK_KONVERSI_NIP")."',
					   TANGGAL_VALIDASI= NOW()
				WHERE  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function deletefile($reqNama,$reqLink,$reqTipe)
	{
		$str = "UPDATE PEGAWAI_FILE
		SET
		".$reqNama." = '', 
		".$reqLink." = '',
		".$reqTipe." = ''
		WHERE PEGAWAI_FILE_ID= ".$this->getField("PEGAWAI_FILE_ID")."
		AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
		"; 

		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }
    
 //    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	// {
	// 	$str = "
	// 	SELECT P.PEGAWAI_ID, P.TEMP_VALIDASI_ID,
	// 	 P.NIP_LAMA, P.NIP_BARU, P.NAMA, P.TIPE_PEGAWAI_ID, P.GELAR_DEPAN, P.GELAR_BELAKANG, P.STATUS_PEGAWAI, 
	// 	 P.TEMPAT_LAHIR, P.TANGGAL_LAHIR, P.TANGGAL_PENSIUN, 
	// 	 P.JENIS_KELAMIN, P.JENIS_PEGAWAI_ID, P.STATUS_KAWIN, 
	// 	 GOL_RUANG, TO_CHAR(TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, JABATAN, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
 //         PENDIDIKAN, TAHUN,
	// 	 P.KARTU_PEGAWAI, P.SUKU_BANGSA, P.GOLONGAN_DARAH, P.ASKES, P.TASPEN, P.ALAMAT, P.NPWP, P.NIK, P.RT, P.RW, P.EMAIL, 
	// 	 P.PROPINSI_ID, P.KABUPATEN_ID, P.KECAMATAN_ID, P.KELURAHAN_ID, 
	// 	 ambil_propinsi(P.PROPINSI_ID) PROPINSI_NAMA,
	// 	 ambil_kabupaten(P.PROPINSI_ID, P.KABUPATEN_ID) KABUPATEN_NAMA,
	// 	 ambil_kecamatan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID) KECAMATAN_NAMA,
	// 	 ambil_kelurahan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID,P.KELURAHAN_ID) KELURAHAN_NAMA,
	// 	 P.BANK_ID, P.NO_REKENING, TAHUN, P.AGAMA_ID, P.SK_KONVERSI_NIP,
	// 	 P.TELEPON, P.KODEPOS, P.KEDUDUKAN_ID, P.SATKER_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) NMSATKER, P.PERUBAHAN_DATA, CASE WHEN COALESCE(P.FOTO_BLOB, X.FOTO_BLOB) IS NULL THEN NULL ELSE 1 END FOTO_BLOB, CASE WHEN COALESCE(P.FOTO_BLOB_OTHER, X.FOTO_BLOB_OTHER) IS NULL THEN NULL ELSE 1 END FOTO_BLOB_OTHER ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
	// 	FROM validasi.PEGAWAI P
	// 	LEFT JOIN public.PEGAWAI X ON P.PEGAWAI_ID = X.PEGAWAI_ID
	// 	LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID 
	// 	LEFT JOIN PANGKAT_TERAKHIR A ON P.PEGAWAI_ID = A.PEGAWAI_ID
	// 	LEFT JOIN JABATAN_TERAKHIR B ON P.PEGAWAI_ID = B.PEGAWAI_ID
	// 	LEFT JOIN PENDIDIKAN_TERAKHIR C ON P.PEGAWAI_ID = C.PEGAWAI_ID
	// 	WHERE P.PEGAWAI_ID IS NOT NULL
	// 	"; 
		
	// 	while(list($key,$val) = each($paramsArray))
	// 	{
	// 		$str .= " AND $key = '$val' ";
	// 	}
		
	// 	$str .= $statement." ".$sOrder;
	// 	$this->query = $str;
				
	// 	return $this->selectLimit($str,$limit,$from); 
 //    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		
		SELECT P.PEGAWAI_ID, P.TEMP_VALIDASI_ID,
		 P.NIP_LAMA, P.NIP_BARU, P.NAMA, P.TIPE_PEGAWAI_ID, P.GELAR_DEPAN, P.GELAR_BELAKANG, P.STATUS_PEGAWAI, 
		 P.TEMPAT_LAHIR, P.TANGGAL_LAHIR, P.TANGGAL_PENSIUN, 
		 P.JENIS_KELAMIN, P.JENIS_PEGAWAI_ID, P.STATUS_KAWIN, 
		 GOL_RUANG, TO_CHAR(TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
          C.PENDIDIKAN_NAMA PENDIDIKAN, C.LULUS TAHUN,
		 P.KARTU_PEGAWAI, P.SUKU_BANGSA, P.GOLONGAN_DARAH, P.ASKES, P.TASPEN, P.ALAMAT, P.NPWP, P.NIK, P.RT, P.RW, P.EMAIL, 
		 P.PROPINSI_ID, P.KABUPATEN_ID, P.KECAMATAN_ID, P.KELURAHAN_ID, 
		 ambil_propinsi(P.PROPINSI_ID) PROPINSI_NAMA,
		 ambil_kabupaten(P.PROPINSI_ID, P.KABUPATEN_ID) KABUPATEN_NAMA,
		 ambil_kecamatan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID) KECAMATAN_NAMA,
		 ambil_kelurahan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID,P.KELURAHAN_ID) KELURAHAN_NAMA,
		 P.BANK_ID, P.NO_REKENING, P.AGAMA_ID, P.SK_KONVERSI_NIP,
		 P.TELEPON, P.KODEPOS, P.KEDUDUKAN_ID, P.SATKER_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) NMSATKER, P.PERUBAHAN_DATA,
		  CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 1 END FOTO_BLOB, 
		  CASE WHEN FOTO_BLOB_OTHER IS NULL THEN NULL ELSE 1 END FOTO_BLOB_OTHER
		 ,P.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		 , COALESCE(B.JABATAN_FUNG, B.JABATAN_STRUK, B.JABATAN_PELAKSANA,'') ||' - '|| COALESCE(S.NAMA, '') JABATAN
		 ,COALESCE(PJ.LINK_FILE_FOTO,PA.LINK_FILE_FOTO) LINK_FILE_FOTO
		 ,COALESCE(PJ.LINK_FILE_KARPEG,PA.LINK_FILE_KARPEG) LINK_FILE_KARPEG
		 ,COALESCE(PJ.LINK_FILE_ASKES,PA.LINK_FILE_ASKES) LINK_FILE_ASKES
		 ,COALESCE(PJ.LINK_FILE_TASPEN,PA.LINK_FILE_TASPEN) LINK_FILE_TASPEN
		 ,COALESCE(PJ.LINK_FILE_NPWP,PA.LINK_FILE_NPWP) LINK_FILE_NPWP
		 ,COALESCE(PJ.LINK_FILE_NIK,PA.LINK_FILE_NIK) LINK_FILE_NIK
		 ,COALESCE(PJ.LINK_FILE_SK,PA.LINK_FILE_SK) LINK_FILE_SK
		 ,COALESCE(PJ.PEGAWAI_FILE_ID,PA.PEGAWAI_FILE_ID)PEGAWAI_FILE_ID
		FROM validasi.validasi_pegawai_data P
		LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID 
		LEFT JOIN PANGKAT_TERAKHIR A ON P.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN 
		(	SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, B.NAMA ESELON, C.NAMA JABATAN_FUNG,D.NAMA JABATAN_STRUK,E.NAMA JABATAN_PELAKSANA, A.TMT_JABATAN,A.KELAS_JABATAN,A.BUP,G.TIPE_PEGAWAI_NEW_ID,G.NAMA TIPE_PEGAWAI_NAMA 
			FROM PEGAWAI_JABATAN A 
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
			LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
			LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
			LEFT JOIN TIPE_PEGAWAI_NEW G ON G.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (PEGAWAI_JABATAN_ID) PEGAWAI_JABATAN_ID
				FROM PEGAWAI_JABATAN A
				GROUP BY A.PEGAWAI_ID
			) F ON F.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
		) B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
		LEFT JOIN
		(
			SELECT A.PEGAWAI_PENDIDIKAN_RIWAYAT_ID, A.PEGAWAI_ID, A.NAMA_SEKOLAH, B.NAMA PENDIDIKAN_NAMA,A.TAHUN_LULUS LULUS
			FROM PEGAWAI_PENDIDIKAN_RIWAYAT A
			LEFT JOIN PEGAWAI_PENDIDIKAN B ON B.PEGAWAI_PENDIDIKAN_ID = A.PEGAWAI_PENDIDIKAN_ID
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (PEGAWAI_PENDIDIKAN_RIWAYAT_ID) PEGAWAI_PENDIDIKAN_RIWAYAT_ID
				FROM PEGAWAI_PENDIDIKAN_RIWAYAT A
				GROUP BY A.PEGAWAI_ID
			) C ON C.PEGAWAI_PENDIDIKAN_RIWAYAT_ID = A.PEGAWAI_PENDIDIKAN_RIWAYAT_ID
			
		) C ON A.PEGAWAI_ID = C.PEGAWAI_ID 
		LEFT JOIN PEGAWAI_FILE PJ ON PJ.TEMP_VALIDASI_ID = P.TEMP_VALIDASI_ID
		LEFT JOIN PEGAWAI_FILE PA ON PA.PEGAWAI_ID = P.PEGAWAI_ID
		WHERE P.PEGAWAI_ID IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    function selectByParamsData($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT P.PEGAWAI_ID,
		 NIP_LAMA, NIP_BARU, P.NAMA, TIPE_PEGAWAI_ID, GELAR_DEPAN, GELAR_BELAKANG, STATUS_PEGAWAI, 
		 TEMPAT_LAHIR, TANGGAL_LAHIR, TANGGAL_PENSIUN, 
		 JENIS_KELAMIN, JENIS_PEGAWAI_ID, STATUS_KAWIN, 
		 GOL_RUANG, TO_CHAR(TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, JABATAN, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
         PENDIDIKAN, TAHUN,
		 KARTU_PEGAWAI, SUKU_BANGSA, GOLONGAN_DARAH, ASKES, TASPEN, P.ALAMAT, NPWP, NIK, RT, RW, P.EMAIL, 
		 P.PROPINSI_ID, P.KABUPATEN_ID, P.KECAMATAN_ID, P.KELURAHAN_ID, 
		 ambil_propinsi(P.PROPINSI_ID) PROPINSI_NAMA,
		 ambil_kabupaten(P.PROPINSI_ID, P.KABUPATEN_ID) KABUPATEN_NAMA,
		 ambil_kecamatan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID) KECAMATAN_NAMA,
		 ambil_kelurahan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID, P.KELURAHAN_ID) KELURAHAN_NAMA,
		 BANK_ID, NO_REKENING, TAHUN, P.AGAMA_ID, P.SK_KONVERSI_NIP,
		 P.TELEPON, P.KODEPOS, KEDUDUKAN_ID, P.SATKER_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) NMSATKER, CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 1 END FOTO_BLOB, CASE WHEN FOTO_BLOB_OTHER IS NULL THEN NULL ELSE 1 END FOTO_BLOB_OTHER
		FROM PEGAWAI P
		LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID 
		LEFT JOIN PANGKAT_TERAKHIR A ON P.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN JABATAN_TERAKHIR B ON P.PEGAWAI_ID = B.PEGAWAI_ID
		LEFT JOIN PENDIDIKAN_TERAKHIR C ON P.PEGAWAI_ID = C.PEGAWAI_ID
		WHERE P.PEGAWAI_ID IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }


    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		
		SELECT
		A.STATUS_PEGAWAI, A.STATUS_BERLAKU,
			A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU,  
			A.NAMA, A.TIPE_PEGAWAI_ID,  
			A.NIP_BARU NIP_BARU_CARI,  ambil_satker_nama_dynamic(A.SATKER_ID) SATKER_NAMA,
			  A.SATKER_ID,  A.SATKER, A.STATUS_PEGAWAI_NAMA,  A.TIPE_PEGAWAI_NAMA, 
			C.ESELON_ID,
			B.PANGKAT_ID,   B.GOL_RUANG,
			C.ESELON,
			C.JABATAN
			, AMBIL_SATKER_INDUK(A.SATKER_ID) SATKER_INDUK_NAMA
			, A.GELAR_DEPAN, A.NAMA_SAJA, A.GELAR_BELAKANG
			, D.PENDIDIKAN_NAMA, D.TAHUN
			, B.MASA_KERJA_TAHUN, B.MASA_KERJA_BULAN, B.TMT_PANGKAT
		FROM
		(
		SELECT	
			CASE
			WHEN CURRENT_DATE <= COALESCE(G.TANGGAL_AKHIR,NOW()) AND CURRENT_DATE >= G.TANGGAL_MULAI THEN 1
			WHEN G.PEGAWAI_ID IS NOT NULL THEN 2
			ELSE 0
			END STATUS_BERLAKU,
			A.STATUS_PEGAWAI,
			A.PEGAWAI_ID, NIP_LAMA, NIP_BARU, 
			(CASE WHEN TRIM(COALESCE(GELAR_DEPAN, '')) = '' THEN '' ELSE TRIM(GELAR_DEPAN) || '. ' END) || A.NAMA || (CASE WHEN TRIM(COALESCE(GELAR_BELAKANG, '')) = '' THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
			A.GELAR_DEPAN, A.NAMA NAMA_SAJA, A.GELAR_BELAKANG,
			A.TIPE_PEGAWAI_ID, TP.NAMA TIPE_PEGAWAI_NAMA,
			A.NIP_BARU NIP_BARU_CARI,    A.SATKER_ID,   E.NAMA SATKER
			, SP.NAMA STATUS_PEGAWAI_NAMA 
			, A.PANGKAT_RIWAYAT_ID, A.JABATAN_RIWAYAT_ID, A.PENDIDIKAN_RIWAYAT_ID
		FROM PEGAWAI A 
		LEFT JOIN (SELECT PEGAWAI_ID, TANGGAL_MULAI, TANGGAL_AKHIR FROM HUKUMAN_TERAKHIR X) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
		LEFT JOIN STATUS_PEGAWAI SP ON A.STATUS_PEGAWAI = SP.STATUS_PEGAWAI_ID 
		LEFT JOIN TIPE_PEGAWAI TP ON A.TIPE_PEGAWAI_ID = TP.TIPE_PEGAWAI_ID 
		INNER JOIN SATKER E ON A.SATKER_ID = E.SATKER_ID
		) A
		LEFT JOIN (SELECT A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, A.PANGKAT_ID, A.MASA_KERJA_TAHUN, A.MASA_KERJA_BULAN, B.KODE GOL_RUANG, A.TMT_PANGKAT FROM PANGKAT_RIWAYAT A LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID) B ON A.PEGAWAI_ID = B.PEGAWAI_ID AND A.PANGKAT_RIWAYAT_ID = B.PANGKAT_RIWAYAT_ID
		LEFT JOIN (SELECT A.JABATAN_RIWAYAT_ID, A.PEGAWAI_ID, A.ESELON_ID, B.NAMA ESELON, A.NAMA JABATAN, A.TMT_JABATAN FROM JABATAN_RIWAYAT A LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID) C ON A.PEGAWAI_ID = C.PEGAWAI_ID AND A.JABATAN_RIWAYAT_ID = C.JABATAN_RIWAYAT_ID
		LEFT JOIN
		(
			SELECT A.PENDIDIKAN_RIWAYAT_ID, A.PEGAWAI_ID, A.PENDIDIKAN_ID, B.NAMA PENDIDIKAN_NAMA
			, TO_CHAR(A.TANGGAL_STTB, 'YYYY') TAHUN
			FROM PENDIDIKAN_RIWAYAT A
			INNER JOIN PENDIDIKAN B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID WHERE 1=1
		) D ON A.PEGAWAI_ID = D.PEGAWAI_ID AND A.PENDIDIKAN_RIWAYAT_ID = D.PENDIDIKAN_RIWAYAT_ID
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

    function selectByParamsMonitoringAdmin($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.STATUS_PEGAWAI,
			A.PEGAWAI_ID,A.NIP_LAMA, A.NIP_BARU,  
			A.NAMA, A.TIPE_PEGAWAI_NEW_ID, A.TEMPAT_LAHIR,A.TANGGAL_LAHIR,A.JENIS_KELAMIN, 
			 ambil_satker_nama_dynamic(A.SATKER_ID) SATKER_NAMA,
			  A.SATKER_ID,  A.SATKER,  
			C.ESELON_ID,
			B.PANGKAT_ID,   B.GOL_RUANG,
			C.ESELON,
			COALESCE(C.JABATAN_FUNG, C.JABATAN_STRUK, C.JABATAN_PELAKSANA) JABATAN
			, AMBIL_SATKER_INDUK(A.SATKER_ID) SATKER_INDUK_NAMA
			, A.STATUS_PEGAWAI_NAMA,C.KELAS_JABATAN
			, B.TMT_PANGKAT
			, A.TELEPON,A.ALAMAT, C.TIPE_PEGAWAI_NAMA,C.TIPE_PEGAWAI_NEW_ID
		FROM
		(
			SELECT	
				A.STATUS_PEGAWAI,
				A.PEGAWAI_ID, NIP_LAMA, NIP_BARU, 
				(CASE WHEN TRIM(COALESCE(GELAR_DEPAN, '')) = '' THEN '' ELSE TRIM(GELAR_DEPAN) || '. ' END) || A.NAMA || (CASE WHEN TRIM(COALESCE(GELAR_BELAKANG, '')) = '' THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
				A.TIPE_PEGAWAI_NEW_ID,
				 A.SATKER_ID,   E.NAMA SATKER
				, A.PANGKAT_RIWAYAT_ID, A.JABATAN_RIWAYAT_ID, A.PENDIDIKAN_RIWAYAT_ID,A.TEMPAT_LAHIR,A.TANGGAL_LAHIR,A.JENIS_KELAMIN, SP.NAMA STATUS_PEGAWAI_NAMA,A.TELEPON,A.ALAMAT
			FROM PEGAWAI A 
			LEFT JOIN STATUS_PEGAWAI SP ON A.STATUS_PEGAWAI = SP.STATUS_PEGAWAI_ID 
			INNER JOIN SATKER E ON A.SATKER_ID = E.SATKER_ID
		) A
		LEFT JOIN (SELECT A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, A.PANGKAT_ID, B.KODE GOL_RUANG,A.TMT_PANGKAT FROM PANGKAT_RIWAYAT A LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID) B ON A.PEGAWAI_ID = B.PEGAWAI_ID AND A.PANGKAT_RIWAYAT_ID = B.PANGKAT_RIWAYAT_ID
		LEFT JOIN 
		(	SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, B.NAMA ESELON, C.NAMA JABATAN_FUNG,D.NAMA JABATAN_STRUK,E.NAMA JABATAN_PELAKSANA, A.TMT_JABATAN,A.KELAS_JABATAN,A.BUP,G.TIPE_PEGAWAI_NEW_ID,G.NAMA TIPE_PEGAWAI_NAMA 
			FROM PEGAWAI_JABATAN A 
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
			LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
			LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
			LEFT JOIN TIPE_PEGAWAI_NEW G ON G.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (PEGAWAI_JABATAN_ID) PEGAWAI_JABATAN_ID
				FROM PEGAWAI_JABATAN A
				GROUP BY A.PEGAWAI_ID
			) F ON F.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
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

    function getCountByParams($paramsArray=array(), $statement="")
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM validasi.validasi_pegawai_data WHERE PEGAWAI_ID IS NOT NULL ".$statement; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->select($str);
		$this->query = $str; 
		if($this->firstRow()) 
			return $this->getField("rowcount"); 
		else 
			return 0; 
    }

    function selectByParamsServer($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY LINK_SERVER_ID")
	{
		$str = "
		SELECT LINK_SERVER_ID, LINK_SERVER, FOLDER, JENIS
		FROM LINK_SERVER
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

     function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY PEGAWAI_FILE_ID")
	{
		$str = "
		SELECT A.PEGAWAI_FILE_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE_FOTO ,
		A.LINK_FILE_FOTO ,
		A.NAMA_FILE_KARPEG ,
		A.LINK_FILE_KARPEG ,
		A.NAMA_FILE_ASKES ,
		A.LINK_FILE_ASKES ,
		A.NAMA_FILE_TASPEN ,
		A.LINK_FILE_TASPEN ,
		A.NAMA_FILE_NPWP ,
		A.LINK_FILE_NPWP ,
		A.NAMA_FILE_NIK ,
		A.LINK_FILE_NIK ,
		A.NAMA_FILE_SK ,
		A.LINK_FILE_SK ,
		A.TIPE_FILE
		FROM PEGAWAI_FILE A
		LEFT JOIN validasi.validasi_pegawai_data B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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