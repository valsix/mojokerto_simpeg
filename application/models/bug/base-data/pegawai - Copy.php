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

		$this->setField("PEGAWAI_ID", $this->getNextId("PEGAWAI_ID","PEGAWAI")); 		
		$str = "INSERT INTO PEGAWAI (
				   PEGAWAI_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID, 
				   KEDUDUKAN_ID, JENIS_PEGAWAI_ID, BANK_ID, 
				   NIP_LAMA, NIP_BARU, NAMA, 
				   GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH,
				   EMAIL, ALAMAT, RT, RW, TELEPON, KODEPOS, STATUS_PEGAWAI, KARTU_PEGAWAI, ASKES, TASPEN,
				   NPWP, NIK, FOTO, FOTO_SETENGAH, NO_REKENING, TANGGAL_MATI, TANGGAL_PENSIUN, TANGGAL_TERUSAN, TIPE_PEGAWAI_ID,
				   AGAMA_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, SK_KONVERSI_NIP)
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
				  '".$this->getField("SK_KONVERSI_NIP")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		$this->pegawai_id 	  = $this->getField("PEGAWAI_ID");
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE PEGAWAI
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
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					  SK_KONVERSI_NIP=  '".$this->getField("SK_KONVERSI_NIP")."'
				WHERE  PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    
    
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		
	
		SELECT P.PEGAWAI_ID,
		 NIP_LAMA, NIP_BARU, P.NAMA, TIPE_PEGAWAI_ID, GELAR_DEPAN, GELAR_BELAKANG, STATUS_PEGAWAI, 
		 TEMPAT_LAHIR, TANGGAL_LAHIR, TANGGAL_PENSIUN, 
		 JENIS_KELAMIN, JENIS_PEGAWAI_ID, STATUS_KAWIN, 
		 GOL_RUANG, TO_CHAR(TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
         C.PENDIDIKAN_NAMA PENDIDIKAN, C.LULUS TAHUN,
		 KARTU_PEGAWAI, SUKU_BANGSA, GOLONGAN_DARAH, ASKES, TASPEN, P.ALAMAT, NPWP, NIK, RT, RW, P.EMAIL, 
		 P.PROPINSI_ID, P.KABUPATEN_ID, P.KECAMATAN_ID, P.KELURAHAN_ID, 
		 ambil_propinsi(P.PROPINSI_ID) PROPINSI_NAMA,
		 ambil_kabupaten(P.PROPINSI_ID, P.KABUPATEN_ID) KABUPATEN_NAMA,
		 ambil_kecamatan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID) KECAMATAN_NAMA,
		 ambil_kelurahan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID, P.KELURAHAN_ID) KELURAHAN_NAMA,
		 BANK_ID, NO_REKENING,  P.AGAMA_ID, P.SK_KONVERSI_NIP,
		 P.TELEPON, P.KODEPOS, KEDUDUKAN_ID, P.SATKER_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) NMSATKER, CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 1 END FOTO_BLOB, CASE WHEN FOTO_BLOB_OTHER IS NULL THEN NULL ELSE 1 END FOTO_BLOB_OTHER
		  , COALESCE(B.JABATAN_FUNG, B.JABATAN_STRUK, B.JABATAN_PELAKSANA,'') ||' - '|| COALESCE(S.NAMA, '') JABATAN
		FROM PEGAWAI P
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
	
	
     function selectByParamsDataCombo($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.*, A.NIP_BARU ||' - '|| A.NAMA PEGAWAI_INFO,COALESCE(C.JABATAN_FUNG, C.JABATAN_STRUK, C.JABATAN_PELAKSANA) JABATAN
		,B.GOL_RUANG,D.NAMA SATKER_NAMA
		, AMBIL_SATKER_INDUK(A.SATKER_ID) SATKER_INDUK_NAMA
		, CASE WHEN A.STATUS_PEGAWAI = 4 OR  A.STATUS_PEGAWAI = 5 THEN E.GOL_PPPK ELSE B.GOL_RUANG END GOL_RUANG
		, CASE WHEN A.STATUS_PEGAWAI = 4 OR  A.STATUS_PEGAWAI = 5 THEN E.TMT_PPPK ELSE B.TMT_PANGKAT END TMT_PANGKAT
		FROM PEGAWAI A
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
		) B ON A.PEGAWAI_ID = B.PEGAWAI_ID 
		INNER JOIN 
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
		LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
		LEFT JOIN
		(
			SELECT A.RIWAYAT_KONTRAK_ID, A.PEGAWAI_ID, A.GOLONGAN_PPPK_ID, B.NAMA GOL_PPPK,A.TMT_SK TMT_PPPK
			FROM RIWAYAT_KONTRAK A
			INNER JOIN GOLONGAN_PPPK B ON A.GOLONGAN_PPPK_ID = B.GOLONGAN_PPPK_ID
			
		) E ON A.PEGAWAI_ID = E.PEGAWAI_ID
		WHERE A.PEGAWAI_ID IS NOT NULL
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
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM PEGAWAI WHERE PEGAWAI_ID IS NOT NULL ".$statement; 
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
	
	
    function getCountByParamsAsn($paramsArray=array(), $statement="")
    {
    	$str = "SELECT COUNT(1) AS ROWCOUNT FROM pegawai A
    	INNER JOIN STATUS_PEGAWAI B ON B.STATUS_PEGAWAI_ID = A.STATUS_PEGAWAI
    	WHERE PEGAWAI_ID IS NOT NULL ".$statement; 
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

      function selectByParamsHitungJenisJabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.JENIS_JABATAN_ID")
	{
		$str = "
		SELECT A.JENIS_JABATAN_ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM
		(
			SELECT 1 JENIS_JABATAN_ID, 'Struktural' NAMA
			UNION ALL
			SELECT 2 JENIS_JABATAN_ID, 'Fungsional' NAMA
			UNION ALL
			SELECT 3 JENIS_JABATAN_ID, 'Pelaksana' NAMA
		) A
		LEFT JOIN
		(
			SELECT COUNT(1) JUMLAH,JENIS_JABATAN_ID
			FROM
			(
				SELECT A.*,C.JENIS_JABATAN_ID
				FROM PEGAWAI A
				INNER JOIN
				( 
				  SELECT A.PEGAWAI_ID,A.JENIS_JABATAN_ID
				  FROM PEGAWAI_JABATAN A
				  INNER JOIN JENIS_JABATAN B  ON B.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
				  WHERE A.JENIS_JABATAN_ID IN (1,2,3)
				) C ON C.PEGAWAI_ID =A.PEGAWAI_ID
				WHERE 1=1 
			) A
			WHERE STATUS_PEGAWAI =2
			GROUP BY JENIS_JABATAN_ID
		) B ON A.JENIS_JABATAN_ID = B.JENIS_JABATAN_ID	
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }


    function selectByParamsGrafikGolPns($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY C.GOL_RUANG ")
	{
		$str = "
		select C.PANGKAT_ID,C.GOL_RUANG, COUNT(C.GOL_RUANG) JUMLAH from 
		PEGAWAI A
		INNER JOIN STATUS_PEGAWAI B ON B.STATUS_PEGAWAI_ID = A.STATUS_PEGAWAI 
		INNER JOIN 
		(
			SELECT  A.PEGAWAI_ID, B.PANGKAT_ID, B.KODE GOL_RUANG
			FROM PANGKAT_RIWAYAT A 
			LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
			INNER JOIN 
			(
			SELECT A.PEGAWAI_ID,MAX (A.PANGKAT_RIWAYAT_ID) PANGKAT_RIWAYAT_ID
			FROM PANGKAT_RIWAYAT A
			GROUP BY A.PEGAWAI_ID
			) F ON F.PANGKAT_RIWAYAT_ID = A.PANGKAT_RIWAYAT_ID

		) C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." GROUP BY  C.GOL_RUANG,C.PANGKAT_ID  ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsGrafikGolPPPK($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.GOLONGAN_PPPK_ID,GOLONGAN_PPPK,CASE WHEN JUMLAH = 0 THEN NULL ELSE JUMLAH END JUMLAH FROM GOLONGAN_PPPK A
		LEFT JOIN (
		SELECT A.GOLONGAN_PPPK_ID,A.KODE GOLONGAN_PPPK, COUNT(B.RIWAYAT_KONTRAK_ID) JUMLAH
		FROM GOLONGAN_PPPK A
		LEFT JOIN RIWAYAT_KONTRAK B ON A.GOLONGAN_PPPK_ID = B.GOLONGAN_PPPK_ID
			LEFT JOIN 
			(
			SELECT A.PEGAWAI_ID, MAX (RIWAYAT_KONTRAK_ID) RIWAYAT_KONTRAK_ID
			FROM RIWAYAT_KONTRAK A
			GROUP BY A.PEGAWAI_ID
			) F ON F.RIWAYAT_KONTRAK_ID = B.RIWAYAT_KONTRAK_ID
			GROUP BY A.GOLONGAN_PPPK_ID,A.KODE
		) B ON B.GOLONGAN_PPPK_ID=A.GOLONGAN_PPPK_ID
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }


    function selectByParamsJenisKelaminPns($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY NAMA")
	{
		$str = "
		SELECT CASE WHEN JENIS_KELAMIN = 'L' THEN 'Laki-Laki' WHEN JENIS_KELAMIN = 'P' THEN 'Perempuan' END JENIS_KELAMIN,A.NAMA, count(*) JUMLAH  FROM 
		( 
			SELECT JENIS_KELAMIN,B.NAMA FROM PEGAWAI A
			INNER JOIN STATUS_PEGAWAI B ON A.STATUS_PEGAWAI = B.STATUS_PEGAWAI_ID AND A.STATUS_PEGAWAI IN (1,2)
			WHERE JENIS_KELAMIN IS NOT NULL

		) A
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." GROUP BY JENIS_KELAMIN,NAMA ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParamsJenisKelaminPPPK($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY NAMA")
	{
		$str = "
		SELECT CASE WHEN JENIS_KELAMIN = 'L' THEN 'Laki-Laki' WHEN JENIS_KELAMIN = 'P' THEN 'Perempuan' END JENIS_KELAMIN,A.NAMA, count(*) JUMLAH  FROM 
		( 
			SELECT JENIS_KELAMIN,B.NAMA FROM PEGAWAI A
			INNER JOIN STATUS_PEGAWAI B ON A.STATUS_PEGAWAI = B.STATUS_PEGAWAI_ID AND A.STATUS_PEGAWAI IN (5)
			WHERE JENIS_KELAMIN IS NOT NULL

		) A
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." GROUP BY JENIS_KELAMIN,NAMA ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsUmur($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" order by umur")
	{
		$str = "
		
		SELECT count(*) JUMLAH, A.* FROM 
		(  
			SELECT CASE
			 when UMUR < 30  then '< 30'
			 when UMUR = 30  then '30'
			 when UMUR >= 30 and UMUR <=39  then '30-39'
			 when UMUR >= 40 and UMUR <=49  then '40-49'
			 when UMUR >= 50 and UMUR <=55  then '35-45'
			 when UMUR > 55   then '55'
			END as UMUR 
			FROM
			(
				SELECT nama, date_part('year',age(tanggal_lahir)) umur,tanggal_lahir 
				FROM pegawai
				where tanggal_lahir is not null
			)a
		) a
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." group by UMUR  ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsPendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY TINGKAT_PENDIDIKAN_ID ")
	{
		$str = "
		SELECT  A.TINGKAT_PENDIDIKAN_ID,NAMA,CASE WHEN JUMLAH = 1 THEN NULL ELSE JUMLAH END JUMLAH FROM 
		(  
			SELECT A.TINGKAT_PENDIDIKAN_ID,NAMA,count(*) JUMLAH
			FROM TINGKAT_PENDIDIKAN A
			LEFT JOIN PEGAWAI_PENDIDIKAN_RIWAYAT B ON A.TINGKAT_PENDIDIKAN_ID::numeric=B.TINGKAT_PENDIDIKAN_ID::numeric
			GROUP BY A.TINGKAT_PENDIDIKAN_ID,NAMA
		) A

		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByTipePegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT  A.JENIS_JABATAN_ID,CASE WHEN JENIS_JABATAN_ID = 4 THEN 'JPT' ELSE NAMA END NAMA,CASE WHEN JUMLAH = 1 THEN NULL ELSE JUMLAH END JUMLAH FROM 
		( 
			SELECT A.JENIS_JABATAN_ID,A.NAMA,count(*) JUMLAH 
			FROM JENIS_JABATAN A
			LEFT JOIN PEGAWAI_JABATAN B ON A.JENIS_JABATAN_ID = B.JENIS_JABATAN_ID 
			WHERE A.JENIS_JABATAN_ID IN (1,3,4)
			GROUP BY  A.JENIS_JABATAN_ID,A.NAMA
		) A

		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsStatistikStruktural($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT  A.TIPE_PEGAWAI_NEW_ID,NAMA,CASE WHEN JUMLAH = 1 THEN NULL ELSE JUMLAH END JUMLAH FROM 
		(
			SELECT A.TIPE_PEGAWAI_NEW_ID,A.NAMA,COUNT(1) JUMLAH FROM TIPE_PEGAWAI_NEW  A
			LEFT JOIN PEGAWAI_JABATAN B ON A.TIPE_PEGAWAI_NEW_ID = B.TIPE_PEGAWAI_NEW_ID 
			WHERE TIPE_PEGAWAI_NEW_ID_PARENT = '1'
			GROUP BY A.TIPE_PEGAWAI_NEW_ID,A.NAMA
		) A 
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