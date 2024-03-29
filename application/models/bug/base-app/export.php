<? 
  
  include_once(APPPATH.'/models/Entity.php');

  class Export extends Entity{ 

	var $query;

    function Export()
	{
      $this->Entity(); 
    }

   
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_ID, B.NIP_BARU
		,B.NAMA NAMA_PEGAWAI
		,AMBIL_SATKER_INDUK(B.SATKER_ID) SATKER_INDUK_NAMA
		,A.TANGGAL_SELESAI,A.TANGGAL_MULAI,A.NO_PIAGAM,A.TANGGAL_PIAGAM
		,A.NAMA,A.LAMA
		, CASE WHEN A.TIPE = 1 THEN 'DIKLAT TEKNIS' WHEN A.TIPE = 2 THEN 'DIKLAT FUNGSIONAL' 
			ELSE  'SEMINAR/WORKSHOP/MAGANG/SEJENISNYA' END TIPE_NAMA
		, A.INSTANSI_ID
		, C.NAMA INSTANSI_NAMA 
		, A.PENYELENGGARA
		FROM KURSUS A
		INNER JOIN PEGAWAI B ON B.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN INSTANSI C ON C.INSTANSI_ID = A.INSTANSI_ID
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

    function selectByParamsDiklat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_ID, B.NIP_BARU
		,B.NAMA NAMA_PEGAWAI
		,AMBIL_SATKER_INDUK(B.SATKER_ID) SATKER_INDUK_NAMA
		, A.PEGAWAI_DIKLAT_ID, A.DIKLAT_ID
		, A.NOMOR, A.TANGGAL, A.TAHUN,C.NAMA DIKLAT_NAMA
		FROM PEGAWAI_DIKLAT A
		INNER JOIN PEGAWAI B ON B.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN DIKLAT C ON C.DIKLAT_ID = A.DIKLAT_ID
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

    function selectByParamsPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
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
			, D.PENDIDIKAN_NAMA, A.STATUS_PEGAWAI_NAMA,C.KELAS_JABATAN,E.GOL_PPPK,E.TMT_PPPK
			, B.TMT_PANGKAT
			, CASE WHEN A.STATUS_PEGAWAI = 4 OR  A.STATUS_PEGAWAI = 5 THEN E.GOL_PPPK ELSE B.GOL_RUANG END GOL_RUANG_P
			, CASE WHEN A.STATUS_PEGAWAI = 4 OR  A.STATUS_PEGAWAI = 5 THEN E.TMT_PPPK ELSE B.TMT_PANGKAT END TMT_PANGKAT_P
			, A.TELEPON,A.ALAMAT,C.BUP,F.NAMA_SEKOLAH,F.PENDIDIKAN_NAMA,F.LULUS,C.TMT_JABATAN, C.TIPE_PEGAWAI_NAMA,C.TIPE_PEGAWAI_NEW_ID
			, G.GOLONGAN_PPPK
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
		LEFT JOIN
		(
			SELECT A.PENDIDIKAN_RIWAYAT_ID, A.PEGAWAI_ID, A.PENDIDIKAN_ID, B.NAMA PENDIDIKAN_NAMA
			FROM PENDIDIKAN_RIWAYAT A
			INNER JOIN PENDIDIKAN B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID WHERE 1=1
		) D ON A.PEGAWAI_ID = D.PEGAWAI_ID AND A.PENDIDIKAN_RIWAYAT_ID = D.PENDIDIKAN_RIWAYAT_ID
		LEFT JOIN
		(
			SELECT A.RIWAYAT_KONTRAK_ID, A.PEGAWAI_ID, A.GOLONGAN_PPPK_ID, B.NAMA GOL_PPPK,A.TMT_SK TMT_PPPK
			FROM RIWAYAT_KONTRAK A
			INNER JOIN GOLONGAN_PPPK B ON A.GOLONGAN_PPPK_ID = B.GOLONGAN_PPPK_ID
			
		) E ON A.PEGAWAI_ID = E.PEGAWAI_ID
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
			
		) F ON A.PEGAWAI_ID = F.PEGAWAI_ID 
		LEFT JOIN 
		(	SELECT  A.PEGAWAI_ID,A.GOLONGAN_PPPK_ID,B.KODE GOLONGAN_PPPK
			FROM RIWAYAT_KONTRAK A
			LEFT JOIN GOLONGAN_PPPK B ON A.GOLONGAN_PPPK_ID = B.GOLONGAN_PPPK_ID
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (RIWAYAT_KONTRAK_ID) RIWAYAT_KONTRAK_ID
				FROM RIWAYAT_KONTRAK A
				GROUP BY A.PEGAWAI_ID
			) F ON F.RIWAYAT_KONTRAK_ID = A.RIWAYAT_KONTRAK_ID
		) G ON A.PEGAWAI_ID = G.PEGAWAI_ID  
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

    function selectByParamsTipePegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT * FROM TIPE_PEGAWAI_NEW
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