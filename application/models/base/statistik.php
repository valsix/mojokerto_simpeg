<? 
include_once(APPPATH.'/models/Entity.php');

class Statistik extends Entity{ 

	var $query;

	function Statistik()
	{
		$this->Entity(); 
	}

	function selectByParamsGolonganPangkat($statement='', $sOrder="ORDER BY A.PANGKAT_ID")
	{
		$str = "
		SELECT A.PANGKAT_ID, COALESCE(KODE, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM pangkat A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, PANGKAT_ID
		FROM
		(
			SELECT  A.PEGAWAI_ID, B.PANGKAT_ID
			FROM pegawai A
			LEFT JOIN
			(
				SELECT A.PANGKAT_RIWAYAT_ID, A.PANGKAT_ID
				FROM pangkat_riwayat A
			) B ON A.PANGKAT_RIWAYAT_ID = B.PANGKAT_RIWAYAT_ID
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE STATUS_PEGAWAI IN (1,2)
			".$statement."
		) A
		WHERE 1=1
		GROUP BY PANGKAT_ID
		) B ON A.PANGKAT_ID = B.PANGKAT_ID
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsEselon($statement='', $sOrder="ORDER BY A.ESELON_ID")
	{
		$str = "
		SELECT A.ESELON_ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM eselon A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, ESELON_ID
		FROM
		(
			SELECT  A.PEGAWAI_ID, B.ESELON_ID
			FROM pegawai A
			LEFT JOIN
			(
				SELECT A.JABATAN_RIWAYAT_ID, A.ESELON_ID
				FROM JABATAN_RIWAYAT A
				WHERE A.ESELON_ID IS NOT NULL AND A.ESELON_ID NOT IN (99)
			) B ON A.JABATAN_RIWAYAT_ID = B.JABATAN_RIWAYAT_ID
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE STATUS_PEGAWAI IN (1,2)
			".$statement."
		) A
		WHERE 1=1
		GROUP BY ESELON_ID
		) B ON A.ESELON_ID = B.ESELON_ID
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		//echo $str;exit;
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsPendidikan($statement='', $sOrder="ORDER BY A.PENDIDIKAN_ID")
	{
		$str = "
		SELECT A.PENDIDIKAN_ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM pendidikan A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, PENDIDIKAN_ID
		FROM
		(
			SELECT  A.PEGAWAI_ID, B.PENDIDIKAN_ID
			FROM pegawai A
			LEFT JOIN
			(
				SELECT A.PENDIDIKAN_RIWAYAT_ID, A.PENDIDIKAN_ID
				FROM pendidikan_riwayat A
			) B ON A.PENDIDIKAN_RIWAYAT_ID = B.PENDIDIKAN_RIWAYAT_ID
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE STATUS_PEGAWAI IN (1,2)
			--".$statement."
		) A
		WHERE 1=1
		GROUP BY PENDIDIKAN_ID
		) B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsJenisKelamin($statement='', $sOrder="ORDER BY A.ID")
	{
		$str = "
		SELECT A.ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM
		(
			SELECT 'L' ID, 'Laki-Laki' NAMA
			UNION ALL
			SELECT 'P' ID, 'Perempuan' NAMA
		) A
		LEFT JOIN
		(
			SELECT COUNT(1) JUMLAH, JENIS_KELAMIN
			FROM
			(
				SELECT A.PEGAWAI_ID, A.JENIS_KELAMIN
				FROM pegawai A
				INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
				WHERE STATUS_PEGAWAI IN (1,2)
				".$statement."
			) A
			WHERE 1=1
			GROUP BY JENIS_KELAMIN
		) B ON A.ID = B.JENIS_KELAMIN
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsAgama($statement='', $sOrder="ORDER BY A.AGAMA_ID")
	{
		$str = "
		SELECT A.AGAMA_ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM agama A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, AGAMA_ID
		FROM
		(
			SELECT  A.PEGAWAI_ID, A.AGAMA_ID
			FROM pegawai A
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE STATUS_PEGAWAI IN (1,2)
			".$statement."
		) A
		WHERE 1=1
		GROUP BY AGAMA_ID
		) B ON A.AGAMA_ID = B.AGAMA_ID
		WHERE 1=1
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsUmur($statement='', $sOrder="ORDER BY A.ID")
	{
		$str = "
		SELECT A.ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM
		(
			SELECT 1 ID, '< 30' NAMA
			UNION ALL
			SELECT 2 ID, '30 - 39' NAMA
			UNION ALL
			SELECT 3 ID, '40 - 49' NAMA
			UNION ALL
			SELECT 4 ID, '50 - 55' NAMA
			UNION ALL
			SELECT 5 ID, '> 55' NAMA
		) A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, ID
		FROM
		(
			SELECT A.PEGAWAI_ID--, MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) UMUR_BULAN_PEGAWAI
			, A.TANGGAL_LAHIR
			, CASE
			WHEN MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) >= 0 AND MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) < 360 THEN 1
			WHEN MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) >= 360 AND MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) < 480 THEN 2
			WHEN MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) >= 480 AND MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) < 600 THEN 3
			WHEN MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) >= 600 AND MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) < 660 THEN 4
			WHEN MONTHS_BETWEEN(A.TANGGAL_LAHIR, CURRENT_DATE) >= 660 THEN 5
			END ID
			FROM pegawai A
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE STATUS_PEGAWAI IN (1,2)
			".$statement."
		) A
		WHERE 1=1
		GROUP BY ID
		) B ON A.ID = B.ID
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsTipePegawai($statement='', $sOrder="ORDER BY A.TIPE_PEGAWAI_ID")
	{
		$str = "
		SELECT A.TIPE_PEGAWAI_ID, COALESCE(NAMA, 'Data Tidak terdefinsi') NAMA, COALESCE(B.JUMLAH,0) JUMLAH
		FROM
		(
			SELECT
			TIPE_PEGAWAI_ID::NUMERIC TIPE_PEGAWAI_ID
			, CASE WHEN TIPE_PEGAWAI_ID = '11' THEN 'Pejabat ' WHEN TIPE_PEGAWAI_ID LIKE '2%' THEN 'Fungsional Khusus/' ELSE '' END || NAMA NAMA
			FROM tipe_pegawai
			WHERE 1=1 AND LENGTH(TIPE_PEGAWAI_ID) > 1
			--SELECT 11 TIPE_PEGAWAI_ID, 'Pejabat Struktural' NAMA
			/*UNION ALL
			SELECT 12 TIPE_PEGAWAI_ID, 'Pelaksana' NAMA
			UNION ALL
			SELECT 21 TIPE_PEGAWAI_ID, 'Pendidikan / Fungsional Tertentu' NAMA
			UNION ALL
			SELECT 22 TIPE_PEGAWAI_ID, 'Kesehatan / Fungsional Tertentu' NAMA
			UNION ALL
			SELECT 23 TIPE_PEGAWAI_ID, 'Lain-lain / Fungsional Tertentu' NAMA*/
		) A
		LEFT JOIN
		(
		SELECT COUNT(1) JUMLAH, TIPE_PEGAWAI_ID
		FROM
		(
			SELECT CAST(A.TIPE_PEGAWAI_ID AS NUMERIC) TIPE_PEGAWAI_ID
			FROM pegawai A
			INNER JOIN satker C ON A.SATKER_ID = C.SATKER_ID
			WHERE 1=1 --AND STATUS_PEGAWAI IN (1,2)
			".$statement."
		) A
		WHERE 1=1
		GROUP BY TIPE_PEGAWAI_ID
		) B ON A.TIPE_PEGAWAI_ID = B.TIPE_PEGAWAI_ID
		"; 
		
		$str .= " ".$sOrder;
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

}