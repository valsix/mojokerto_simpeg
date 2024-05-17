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
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PEGAWAI_ID", $this->getNextId("PEGAWAI_ID","PEGAWAI"));

		$str = "
		INSERT INTO PEGAWAI
		(
			PEGAWAI_ID, NIP_LAMA, NIP_BARU, NAMA, GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR
			, TANGGAL_LAHIR, JENIS_KELAMIN, AGAMA_ID, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH
			, TELEPON, EMAIL, ALAMAT, RT, RW, KODEPOS, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID
			, KELURAHAN_ID, BANK_ID, NO_REKENING, SATKER_ID, TIPE_PEGAWAI_ID, TUGAS_TAMBAHAN_NEW
			, STATUS_PEGAWAI, TANGGAL_PENSIUN, JENIS_PEGAWAI_ID, KEDUDUKAN_ID, KARTU_PEGAWAI, ASKES
			, TASPEN, NPWP, NIK, KTP_PNS, KK, KTP_PASANGAN, DRH
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,FOTO_BLOB,FOTO_BLOB_OTHER
		) 
		VALUES
		(
			'".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("NIP_LAMA")."'
			, '".$this->getField("NIP_BARU")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("GELAR_DEPAN")."'
			, '".$this->getField("GELAR_BELAKANG")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, '".$this->getField("JENIS_KELAMIN")."'
			, ".$this->getField("AGAMA_ID")."
			, '".$this->getField("STATUS_KAWIN")."'
			, '".$this->getField("SUKU_BANGSA")."'
			, '".$this->getField("GOLONGAN_DARAH")."'
			, '".$this->getField("TELEPON")."'
			, '".$this->getField("EMAIL")."'
			, '".$this->getField("ALAMAT")."'
			, '".$this->getField("RT")."'
			, '".$this->getField("RW")."'
			, '".$this->getField("KODEPOS")."'
			, ".$this->getField("PROPINSI_ID")."
			, ".$this->getField("KABUPATEN_ID")."
			, ".$this->getField("KECAMATAN_ID")."
			, ".$this->getField("KELURAHAN_ID")."
			, ".$this->getField("BANK_ID")."
			, '".$this->getField("NO_REKENING")."'
			, '".$this->getField("SATKER_ID")."'
			, ".$this->getField("TIPE_PEGAWAI_ID")."
			, '".$this->getField("TUGAS_TAMBAHAN_NEW")."'
			, '".$this->getField("STATUS_PEGAWAI")."'
			, ".$this->getField("TANGGAL_PENSIUN")."
			, ".$this->getField("JENIS_PEGAWAI_ID")."
			, ".$this->getField("KEDUDUKAN_ID")."
			, '".$this->getField("KARTU_PEGAWAI")."'
			, '".$this->getField("ASKES")."'
			, '".$this->getField("TASPEN")."'
			, '".$this->getField("NPWP")."'
			, '".$this->getField("NIK")."'
			, '".$this->getField("KTP_PNS")."'
			, '".$this->getField("KK")."'
			, '".$this->getField("KTP_PASANGAN")."'
			, '".$this->getField("DRH")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
			, '".$this->getField("FOTO_BLOB")."'
			, '".$this->getField("FOTO_BLOB_OTHER")."'
		)
		"; 	
		// echo $str;exit();
		$this->id = $this->getField("PEGAWAI_ID");
		$this->query = $str;
		$this->setlogdata("pegawai", "INSERT", $str);
		return $this->execQuery($str);
    }

	function update()
	{
		$str = "		
		UPDATE PEGAWAI
		SET    
		GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."'
		, GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."'
		, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
		, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
		, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
		, AGAMA_ID= ".$this->getField("AGAMA_ID")."
		, STATUS_KAWIN= ".$this->getField("STATUS_KAWIN")."
		, SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."'
		, GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."'
		, TELEPON= '".$this->getField("TELEPON")."'
		, EMAIL= '".$this->getField("EMAIL")."'
		, ALAMAT= '".$this->getField("ALAMAT")."'
		, RT= '".$this->getField("RT")."'
		, RW= '".$this->getField("RW")."'
		, KODEPOS= '".$this->getField("KODEPOS")."'
		, PROPINSI_ID= ".$this->getField("PROPINSI_ID")."
		, KABUPATEN_ID= ".$this->getField("KABUPATEN_ID")."
		, KECAMATAN_ID= ".$this->getField("KECAMATAN_ID")."
		, KELURAHAN_ID= ".$this->getField("KELURAHAN_ID")."
		, BANK_ID= ".$this->getField("BANK_ID")."
		, NO_REKENING= '".$this->getField("NO_REKENING")."'
		, SATKER_ID= '".$this->getField("SATKER_ID")."'
		, TIPE_PEGAWAI_ID= ".$this->getField("TIPE_PEGAWAI_ID")."
		, TUGAS_TAMBAHAN_NEW= '".$this->getField("TUGAS_TAMBAHAN_NEW")."'
		, STATUS_PEGAWAI= '".$this->getField("STATUS_PEGAWAI")."'
		, TANGGAL_PENSIUN= ".$this->getField("TANGGAL_PENSIUN")."
		, JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID")."
		, KEDUDUKAN_ID= ".$this->getField("KEDUDUKAN_ID")."
		, KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."'
		, ASKES= '".$this->getField("ASKES")."'
		, TASPEN= '".$this->getField("TASPEN")."'
		, NPWP= '".$this->getField("NPWP")."'
		, NIK= '".$this->getField("NIK")."'
		, KTP_PNS= '".$this->getField("KTP_PNS")."'
		, KK= '".$this->getField("KK")."'
		, KTP_PASANGAN= '".$this->getField("KTP_PASANGAN")."'
		, DRH= '".$this->getField("DRH")."'
		, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
		, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
		, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		, FOTO_BLOB= '".$this->getField("FOTO_BLOB")."'
		, FOTO_BLOB_OTHER= '".$this->getField("FOTO_BLOB_OTHER")."'
		WHERE PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		$this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

    function updatefoto()
	{
		$str = "		
		UPDATE PEGAWAI
		SET    		
		FOTO_BLOB= '".$this->getField("FOTO_BLOB")."'
		WHERE PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		$this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }
    function updatefotosetengah()
	{
		$str = "		
		UPDATE PEGAWAI
		SET    		
		FOTO_BLOB_OTHER= '".$this->getField("FOTO_BLOB_OTHER")."'
		WHERE PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		$this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

	function callDUK()
	{
        $str = "
        select pinsertduk('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."', '".$this->getField("TIPEPEGAWAI")."')
		";
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }	

	function selectByParamsDUK($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT 
			A.SATKER_ID, A.DUK, A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU NIP_BARU, A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR
			, A.JENIS_KELAMIN, A.STATUS_PEGAWAI, A.GOL_RUANG, A.TMT_PANGKAT
			, A.JABATAN, A.TMT_JABATAN, A.ESELON, A.TMT_ESELON, A.MASA_KERJA_TAHUN, A.MASA_KERJA_BULAN, A.DIKLAT_STRUKTURAL
			, A.TAHUN_DIKLAT, A.JUMLAH_DIKLAT_STRUKTURAL || '/' || A.JUMLAH_DIKLAT_NONSTRUKTURAL JUMLAH_DIKLAT
			, A.PENDIDIKAN, A.TAHUN_LULUS, A.NAMA_SEKOLAH, A.USIA, A.AGAMA--, B.NAMA SATKER_NAMA, C.TIPE_PEGAWAI_ID
		FROM duk A
		--LEFT JOIN satker B ON A.SATKER_ID = B.SATKER_ID
		--INNER JOIN pegawai C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		WHERE 1 = 1
 		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
	
		$str .= $statement." ORDER BY DUK";
		$this->query = $str;
		// echo $str;exit;
		
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsDUKCetak($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT 
			A.SATKER_ID, A.DUK, A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU NIP_BARU, A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR
			, A.JENIS_KELAMIN, A.STATUS_PEGAWAI, A.GOL_RUANG, A.TMT_PANGKAT
			, A.JABATAN, A.TMT_JABATAN, A.ESELON, A.TMT_ESELON, A.MASA_KERJA_TAHUN, A.MASA_KERJA_BULAN, A.DIKLAT_STRUKTURAL
			, A.TAHUN_DIKLAT, A.JUMLAH_DIKLAT_STRUKTURAL || '/' || A.JUMLAH_DIKLAT_NONSTRUKTURAL JUMLAH_DIKLAT
			, A.PENDIDIKAN, A.TAHUN_LULUS, A.NAMA_SEKOLAH, A.USIA, A.AGAMA,
			(select tanggal_mulai|| '/' || tanggal_selesai || '/' || JUMLAH_JAM from DIKLAT_STRUKTURAL x where a.pegawai_id=x.pegawai_id order by tanggal_mulai desc limit 1 ) DIKLAT_STRUKTURAL_DETIL
		FROM duk A
		--LEFT JOIN satker B ON A.SATKER_ID = B.SATKER_ID
		LEFT JOIN (
			SELECT DIKLAT_STRUKTURAL_ID, PEGAWAI_ID, TEMPAT, 
				   PENYELENGGARA, ANGKATAN, TAHUN, 
				   NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   TANGGAL_STTPP, JUMLAH_JAM, a.DIKLAT_ID,
				   (SELECT x.NAMA FROM DIKLAT x WHERE x.DIKLAT_ID = a.DIKLAT_ID) NAMADIKLAT, FOTO_BLOB
				FROM DIKLAT_STRUKTURAL a WHERE 1=1
		) C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		--INNER JOIN pegawai C ON A.PEGAWAI_ID = C.PEGAWAI_ID
		WHERE 1 = 1
 		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
	
		$str .= $statement." ORDER BY a.DIKLAT_STRUKTURAL";
		$this->query = $str;
		// echo $str;exit;
		
		return $this->selectLimit($str,$limit,$from); 
    }

	function selectmonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='')
	{
		$str = "
		SELECT
			A.PEGAWAI_ID, NIP_LAMA, A.FORMAT_NIP_BARU NIP_BARU, A.VNAMA_LENGKAP NAMA, A.TEMPAT_LAHIR
			, A.TANGGAL_LAHIR, A.JENIS_KELAMIN, A1.NAMA STATUS_PEGAWAI, B.GOL_RUANG, B.TMT_PANGKAT
			, C.ESELON, C.JABATAN, C.TMT_JABATAN, MP.NAMA JENIS_MAPEL, D.NAMA AGAMA
			, Z.JABATAN_TAMBAHAN_NAMA, Z.TMT_JABATAN_AKHIR, A.TELEPON, A.ALAMAT, E.NAMA SATKER
			, A.VTMT_PENSIUN TMT_PENSIUN, F.LULUS, F.PENDIDIKAN, A.SATKER_ID
			, G1.HUKUMAN_STATUS_TERAKHIR, SUBSTRING(C.ESELON_ID::TEXT, 1,1) STATUS_ESELON
			, A.TUGAS_TAMBAHAN_NEW, A.FOTO_BLOB
		FROM pegawai A
		LEFT JOIN status_pegawai A1 ON A1.STATUS_PEGAWAI_ID = A.STATUS_PEGAWAI
		LEFT JOIN
		(
			SELECT A.PANGKAT_RIWAYAT_ID, A.PANGKAT_ID, B.KODE GOL_RUANG, A.TMT_PANGKAT
			FROM pangkat_riwayat A
			LEFT JOIN pangkat B ON A.PANGKAT_ID = B.PANGKAT_ID
		) B ON A.PANGKAT_RIWAYAT_ID = B.PANGKAT_RIWAYAT_ID
		LEFT JOIN
		(
			SELECT A.JABATAN_RIWAYAT_ID, COALESCE(A.ESELON_ID,99) ESELON_ID, B.NAMA ESELON, A.TMT_JABATAN, A.NAMA JABATAN
			FROM jabatan_riwayat A
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
		) C ON A.JABATAN_RIWAYAT_ID = C.JABATAN_RIWAYAT_ID
		LEFT JOIN AGAMA D ON  A.AGAMA_ID = D.AGAMA_ID
		INNER JOIN SATKER E ON A.SATKER_ID = E.SATKER_ID
		LEFT JOIN
		(
			SELECT
			A.PENDIDIKAN_RIWAYAT_ID, TO_CHAR(A.TANGGAL_STTB, 'YYYY') LULUS, A1.NAMA PENDIDIKAN
			FROM pendidikan_riwayat A
			INNER JOIN PENDIDIKAN A1 ON A.PENDIDIKAN_ID = A1.PENDIDIKAN_ID
		) F ON A.PENDIDIKAN_RIWAYAT_ID = F.PENDIDIKAN_RIWAYAT_ID
		LEFT JOIN
		(
			SELECT
			A.HUKUMAN_ID, A.TANGGAL_MULAI, A.TANGGAL_AKHIR
			FROM hukuman A
		) G ON A.HUKUMAN_ID = G.HUKUMAN_ID
		LEFT JOIN
		(
			SELECT
			A.HUKUMAN_ID
			, CASE
			WHEN CURRENT_DATE >= TANGGAL_MULAI AND TANGGAL_AKHIR IS NULL THEN 1
			WHEN CURRENT_DATE <= TANGGAL_AKHIR AND CURRENT_DATE >= TANGGAL_MULAI THEN 1
			ELSE 0
			END HUKUMAN_STATUS_TERAKHIR
			FROM hukuman A
			WHERE TINGKAT_HUKUMAN_ID IN (2,3)
		) G1 ON A.HUKUMAN_ID = G1.HUKUMAN_ID
		LEFT JOIN jenis_mapel MP ON  MP.JENIS_MAPEL_ID = A.JENIS_MAPEL_ID
		LEFT JOIN
		(
			SELECT A.JABATAN_TAMBAHAN_ID, A.NAMA JABATAN_TAMBAHAN_NAMA, A.TMT_JABATAN TMT_JABATAN_AKHIR
			FROM jabatan_tambahan A
		) Z ON A.JABATAN_TAMBAHAN_ID = Z.JABATAN_TAMBAHAN_ID
		WHERE 1=1
		";
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		
		$str .= $statement." ".$orderby;
		$this->query = $str;
		// echo $str;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }

	function selectByParamsMonitoring2($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by C.ESELON_ID asc')
	{
		$str = "
		SELECT
		A.PEGAWAI_ID, NIP_LAMA, A.FORMAT_NIP_BARU NIP_BARU
		, A.VNAMA_LENGKAP NAMA
		, A.TEMPAT_LAHIR, A.JENIS_KELAMIN, TANGGAL_LAHIR, STATUS_PEGAWAI
		FROM pegawai A
		WHERE 1=1
		"; 

		/*$str = "
		SELECT
		HUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) HUKUMAN_STATUS_TERAKHIR,
		A.PEGAWAI_ID, NIP_LAMA, AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU, 
		(CASE WHEN GELAR_DEPAN IS NULL THEN '' ELSE GELAR_DEPAN || '. ' END) || A.NAMA || (CASE WHEN GELAR_BELAKANG IS NULL THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
		TEMPAT_LAHIR, JENIS_KELAMIN, 
		TANGGAL_LAHIR, STATUS_PEGAWAI,
		B.GOL_RUANG,
		CASE 
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '2' THEN '#fb5858'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '3' THEN '#778ff7'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '4' THEN '#5bdd73'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '5' THEN '#FF9'
			WHEN hUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) IS NOT NULL AND HUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) != '0' THEN '#F00' 
			WHEN TUGAS_TAMBAHAN_NEW IS NOT NULL THEN '#F00' 
		END WARNA
		FROM PEGAWAI A  
		LEFT JOIN PANGKAT_TERAKHIR B ON A.PEGAWAI_ID = B.PEGAWAI_ID
		LEFT JOIN JABATAN_TERAKHIR C ON cast (A.PEGAWAI_ID as varchar) = C.PEGAWAI_ID
		WHERE 1=1
		"; */
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		
		$str .= $statement." ".$orderby;
		$this->query = $str;
		//echo $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsForm($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by C.ESELON_ID asc')
	{
		/*TO_CHAR(B.TMT_PANGKAT, 'DD MON YYYY') TMT_PANGKAT,
		TO_CHAR(C.TMT_JABATAN, 'DD MON YYYY') TMT_JABATAN,
		TO_CHAR(TANGGAL_LAHIR, 'DD MON YYYY') TANGGAL_LAHIR, */
		$str = "
		SELECT
		HUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) HUKUMAN_STATUS_TERAKHIR,
		AMBIL_SATKER_NAMA_DELIMETER(cast (A.SATKER_ID as varchar), '<br>') SATKER_NAMA_MONITORING,
		AMBIL_SATKER_INDUK(A.SATKER_ID) SATKERINDUK,
		SUBSTRING(cast(C.ESELON_ID as varchar), 0,1) STATUS_ESELON, A.KARTU_PEGAWAI, A.TASPEN,
		CASE
			WHEN current_date <= G.TANGGAL_AKHIR AND current_date >= G.TANGGAL_MULAI THEN 1
			ELSE 0
		END STATUS_BERLAKU,  
		C.ESELON_ID, A.PEGAWAI_ID, NIP_LAMA, AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU, 
		(CASE WHEN GELAR_DEPAN IS NULL THEN '' ELSE GELAR_DEPAN || '. ' END) || A.NAMA || (CASE WHEN GELAR_BELAKANG IS NULL THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
		A.TIPE_PEGAWAI_ID, Y.USIA_TAHUN, NIP_BARU NIP_BARU_CARI, GELAR_DEPAN, GELAR_BELAKANG,
		TEMPAT_LAHIR, JENIS_KELAMIN, 
		(SELECT NAMA FROM STATUS_PEGAWAI X WHERE X.STATUS_PEGAWAI_ID = A.STATUS_PEGAWAI) STATUS_PEGAWAI,
		B.GOL_RUANG,
		B.MASA_KERJA_TAHUN, B.MASA_KERJA_BULAN,
		B.KREDIT,
		CASE
			WHEN B.PANGKAT_ID = 14 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 21)
			WHEN B.PANGKAT_ID = 24 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 31)
			WHEN B.PANGKAT_ID = 34 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 41)
			WHEN B.PANGKAT_ID = 45 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 45)
			ELSE (SELECT KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = B.PANGKAT_ID + 1)
		END GOL_RUANG_BARU,
		CASE
			WHEN B.PANGKAT_ID = 14 THEN 21
			WHEN B.PANGKAT_ID = 24 THEN 31
			WHEN B.PANGKAT_ID = 34 THEN 41
			WHEN B.PANGKAT_ID = 45 THEN 45
			ELSE B.PANGKAT_ID + 1
		END PANGKAT_ID_BARU,
		C.ESELON,
		C.JABATAN,
		F.PENDIDIKAN_RIWAYAT_ID,
		B.PANGKAT_RIWAYAT_ID,
		B.TMT_PANGKAT,
		C.TMT_JABATAN,
		C.TUNJANGAN, C.KREDIT KREDIT_JABATAN,
		TANGGAL_LAHIR, 
		D.NAMA AGAMA,
		A.TELEPON,
		A.ALAMAT,
		E.NAMA SATKER,
		CASE 
			WHEN A.TIPE_PEGAWAI_ID = '11' AND ( SUBSTRING(cast (C.ESELON_ID as varchar),1,1) = '1' OR SUBSTRING(cast (C.ESELON_ID as varchar),1,1) = '2' ) THEN 
			'01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (60 * 12) + 1),  'MM-YYYY')
			WHEN A.TIPE_PEGAWAI_ID = '21' OR ( A.TIPE_PEGAWAI_ID = '22' AND UPPER(C.JABATAN) LIKE '%DOKTER%' )  THEN 
			'01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (60 * 12) + 1),  'MM-YYYY')
			ELSE
			'01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (58 * 12) + 1),  'MM-YYYY')
		END TMT_PENSIUN,
		PENDIDIKAN, PENDIDIKAN_ID, NMJURUSAN, NO_STTB, NAMA_SEKOLAH, KEPALA, TEMPAT, TANGGAL_STTB,
		LULUS, 
		CASE 
			WHEN A.PEGAWAI_ID = E.PEGAWAI_ID THEN E.SATKER_ID 
			ELSE 'A' 
		END PEGAWAI_PEJABAT,
		CASE 
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '2' THEN '#fb5858'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '3' THEN '#778ff7'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '4' THEN '#5bdd73'
			WHEN substring(CAST(C.ESELON_ID AS VARCHAR), 1, 1) = '5' THEN '#FF9'
			WHEN hUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) IS NOT NULL AND HUKUMAN_STATUS(cast (A.PEGAWAI_ID as numeric)) != '0' THEN '#F00' 
			WHEN TUGAS_TAMBAHAN_NEW IS NOT NULL THEN '#F00' 
		END WARNA,
		A.SATKER_ID,Z.TMT_JABATAN_AKHIR,Z.JABATAN_TAMBAHAN_NAMA,A.TUGAS_TAMBAHAN_NEW,MP.NAMA JENIS_MAPEL
		FROM PEGAWAI A  
		LEFT JOIN (SELECT PANGKAT_RIWAYAT_ID, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, TMT_PANGKAT, GOL_RUANG, PEGAWAI_ID, PANGKAT_ID, KREDIT FROM PANGKAT_TERAKHIR) B ON A.PEGAWAI_ID = B.PEGAWAI_ID
		LEFT JOIN (SELECT PEGAWAI_ID, TMT_JABATAN, ESELON, JABATAN, TUNJANGAN, KREDIT, coalesce(ESELON_ID, 99) ESELON_ID FROM JABATAN_TERAKHIR) C ON cast (A.PEGAWAI_ID as varchar) = C.PEGAWAI_ID
		LEFT JOIN AGAMA D ON  A.AGAMA_ID = D.AGAMA_ID
		LEFT JOIN JENIS_MAPEL MP ON  MP.JENIS_MAPEL_ID = A.JENIS_MAPEL_ID
		LEFT JOIN (SELECT PEGAWAI_ID, TANGGAL_MULAI, TANGGAL_AKHIR FROM HUKUMAN_TERAKHIR X) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
		LEFT JOIN (SELECT COUNT(1) JUMLAH_HUKUMAN, PEGAWAI_ID FROM HUKUMAN GROUP BY PEGAWAI_ID) H ON A.PEGAWAI_ID = H.PEGAWAI_ID
		LEFT JOIN 
		(   
			SELECT A.PEGAWAI_ID, A.NAMA JABATAN_TAMBAHAN_NAMA, TMT_JABATAN_AKHIR
			FROM JABATAN_TAMBAHAN A        
			INNER JOIN 
			(
				SELECT A.PEGAWAI_ID, MAX (A.TMT_JABATAN) TMT_JABATAN_AKHIR
				FROM JABATAN_TAMBAHAN A
				GROUP BY A.PEGAWAI_ID
			) B ON B.PEGAWAI_ID  = A.PEGAWAI_ID AND A.TMT_JABATAN = B.TMT_JABATAN_AKHIR
		) Z ON Z.PEGAWAI_ID = A.PEGAWAI_ID  AND A.TUGAS_TAMBAHAN_NEW IS NOT NULL
		LEFT JOIN 
		(
			SELECT PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, TAHUN LULUS, PENDIDIKAN, PENDIDIKAN_ID, NMJURUSAN, NO_STTB, NAMA_SEKOLAH, KEPALA, TEMPAT, TANGGAL_STTB FROM PENDIDIKAN_TERAKHIR X
		) F ON A.PEGAWAI_ID = F.PEGAWAI_ID,
		SATKER E,
		(
			SELECT PEGAWAI_ID,
			CASE WHEN ( cast(TO_CHAR(current_date, 'MM') as int)-cast(TO_CHAR(TANGGAL_LAHIR, 'MM') as int ))<0 THEN 
			cast(TO_CHAR(current_date, 'YYYY') as int )-cast(TO_CHAR(TANGGAL_LAHIR, 'YYYY')as int)-1
			ELSE cast(TO_CHAR(current_date, 'YYYY') as int)-cast(TO_CHAR(TANGGAL_LAHIR, 'YYYY') as int) END USIA_TAHUN
			FROM PEGAWAI
		) Y

		WHERE                     
		A.SATKER_ID = E.SATKER_ID
		AND A.PEGAWAI_ID = Y.PEGAWAI_ID
	 				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		
		$str .= $statement." ".$orderby;
		$this->query = $str;
		//echo $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			P.TANGGAL_PINDAH, P.KETERANGAN_PINDAH, P.PEGAWAI_ID, S.NAMA NMSATKER, P.PROPINSI_ID, P.KABUPATEN_ID, 
			CASE 
			WHEN JENIS_KELAMIN='L' THEN 'Laki-Laki'
			WHEN JENIS_KELAMIN='P' THEN  'Perempuan'
			END KELAMIN,
			(SELECT NAMA FROM STATUS_PEGAWAI X WHERE X.STATUS_PEGAWAI_ID = P.STATUS_PEGAWAI) STATUS_PEG,
			(SELECT NAMA FROM JENIS_PEGAWAI X WHERE X.JENIS_PEGAWAI_ID = P.JENIS_PEGAWAI_ID) JENIS_PEG,
			(SELECT x.NAMA FROM AGAMA x WHERE x.AGAMA_ID = P.AGAMA_ID) AGAMA,
			P.AGAMA_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) SATKER_FULL,
			(SELECT x.NAMA FROM KEDUDUKAN x WHERE x.KEDUDUKAN_ID = P.KEDUDUKAN_ID) KEDUDUKAN,
			CASE 
			WHEN STATUS_KAWIN = 1 THEN 'Belum Kawin'
			WHEN STATUS_KAWIN = 2 THEN 'Kawin'
			WHEN STATUS_KAWIN = 3 THEN 'Janda'
			WHEN STATUS_KAWIN = 4 THEN 'Duda' 
			END KAWIN,
			S.ALAMAT ALAMATSATKER, 
			S.PROPINSI_ID PROPSATKER, S.KABUPATEN_ID KABSATKER,
			S.KECAMATAN_ID KECSATKER, S.KELURAHAN_ID KELSATKER,
			S.TELEPON TELEPONSATKER, S.KODEPOS KODEPOSSATKER,
			P.KECAMATAN_ID, P.KELURAHAN_ID, P.SATKER_ID, 
			KEDUDUKAN_ID, JENIS_PEGAWAI_ID, BANK_ID, 
			NIP_LAMA, NIP_BARU, P.NAMA, 
			GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH,
			P.EMAIL, P.ALAMAT, RT, RW, P.TELEPON, P.KODEPOS, STATUS_PEGAWAI, KARTU_PEGAWAI, ASKES, TASPEN,
			NPWP, NIK, FOTO, FOTO_SETENGAH, NO_REKENING, TANGGAL_MATI, TANGGAL_PENSIUN, TANGGAL_TERUSAN, TANGGAL_UPDATE, TIPE_PEGAWAI_ID,
			A.GOL_RUANG, TO_CHAR(A.TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, JABATAN, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
			C.PENDIDIKAN, C.TAHUN, FOTO_BLOB, FOTO_BLOB_OTHER,
			DOSIR_KARPEG, FORMAT_KARPEG, 
			UKURAN_KARPEG, DOSIR_ASKES, FORMAT_ASKES, 
			UKURAN_ASKES, DOSIR_TASPEN, FORMAT_TASPEN, 
			UKURAN_TASPEN, DOSIR_NPWP, FORMAT_NPWP, 
			UKURAN_NPWP,
			C.JURUSAN, P.SATKER_ID_LAMA,
			LINK_FILE_APPS_KARPEG, LINK_FILE_APPS_ASKES, LINK_FILE_APPS_TASPEN, LINK_FILE_APPS_NPWP, LINK_FILE_APPS_DRH, LINK_FILE_APPS_KTP,LINK_FILE_APPS_KK,LINK_FILE_APPS_ISTRI,LINK_FILE_APPS_SUAMI,P.KK,P.KTP_PNS,P.DRH,P.KTP_PASANGAN,P.TUGAS_TAMBAHAN_NEW,P.JENIS_MAPEL_ID
		FROM PEGAWAI P
		LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID 
		LEFT JOIN PANGKAT_TERAKHIR A ON P.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN JABATAN_TERAKHIR B ON P.PEGAWAI_ID = cast(B.PEGAWAI_ID as bigint)
		LEFT JOIN PENDIDIKAN_TERAKHIR C ON P.PEGAWAI_ID = C.PEGAWAI_ID
		WHERE P.PEGAWAI_ID IS NOT NULL 
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY KEDUDUKAN_ID ASC";

		
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsCheckFoto($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT 
			A.PEGAWAI_ID,  A.FOTO_BLOB, A.FOTO_BLOB_OTHER
		FROM PEGAWAI A
		WHERE 1 = 1
 		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
	
		$str .= $statement." ";
		$this->query = $str;
		// echo $str;exit;
		
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>