<?
/* *******************************************************************************************************
MODUL NAME 			: MTSN LAWANG
FILE NAME 			: 
AUTHOR				: 
VERSION				: 1.0
MODIFICATION DOC	:
DESCRIPTION			: 
***************************************************************************************************** */

/***
 * Entity-base class untuk mengimplementasikan tabel kategori.
 * 
 ***/
include_once(APPPATH . '/models/Entity.php');

class KenaikanGajiBerkala extends Entity{ 

	var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function KenaikanGajiBerkala()
	{
      $this->Entity(); 
    }
	
    function insert()
	{
		$this->setField("ANJAB_ID", $this->getNextId("ANJAB_ID","ANJAB")); 

		$str = "INSERT INTO ANJAB (
				   ANJAB_ID, PERIODE, TANGGAL_BUAT) 
				VALUES (
				  ".$this->getField("ANJAB_ID").",
				  '".$this->getField("PERIODE")."',
				  CURRENT_DATE
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

	function insertKandidat()
	{
		$this->setField("ANJAB_DETIL_ID", $this->getNextId("ANJAB_DETIL_ID","ANJAB_DETIL")); 

		$str = "
				INSERT INTO ANJAB_DETIL (
				   ANJAB_DETIL_ID, ANJAB_ID, PEGAWAI_ID, 
				   SATKER_AWAL, SATKER_AKHIR) 
				VALUES ( ".$this->getField("ANJAB_DETIL_ID").", (SELECT ANJAB_ID FROM ANJAB WHERE STATUS = 1), ".$this->getField("PEGAWAI_ID").",
					(SELECT SATKER_ID FROM PEGAWAI WHERE PEGAWAI_ID = ".$this->getField("PEGAWAI_ID")."),
					 '".$this->getField("SATKER_AKHIR")."')		
				"; 

		//echo $str;
				
		$this->query = $str;
		return $this->execQuery($str);
    }

	function callKGB()
	{
        $str = "
				SELECT PINSERTKGB('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."')
		"; 
				  
		$this->query = $str;
		//echo $str;
        return $this->execQuery($str);
    }	
	
	function callKGBPendidikan()
	{
        $str = "
				SELECT PINSERTKGBPENDIDIKAN('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."')
		"; 
				  
		$this->query = $str;
		//echo $str;
        return $this->execQuery($str);
    }
	
	function updateNomorGenerateModif()
	{
		$str1= "
				UPDATE GAJI_RIWAYAT SET 
				NO_SK= '".$this->getField("NO_SK")."'
				WHERE GAJI_RIWAYAT_ID= ".$this->getField("GAJI_RIWAYAT_ID")."
				"; 
		$this->query = $str1;
		$this->execQuery($str1);
		//echo $str1;exit;
		$str= "
				UPDATE KGB SET 
				NOMOR_GENERATE= '".$this->getField("NOMOR_GENERATE")."',
				NO_SK= '".$this->getField("NO_SK")."'
				WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")." AND PERIODE= '".$this->getField("PERIODE")."'
				"; 
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function updateNomorGenerate()
	{
		$str= "
				UPDATE KGB SET 
				NOMOR_GENERATE= '".$this->getField("NOMOR_GENERATE")."',
				NO_SK= '".$this->getField("NO_SK")."'
				WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")." AND PERIODE= '".$this->getField("PERIODE")."'
				"; 
		$this->query = $str;
		return $this->execQuery($str);
    }
	
    function update()
	{
		$str= "
				UPDATE KGB
				SET NOMOR_GENERATE= '".$this->getField("NOMOR_GENERATE")."'
				WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")." AND PERIODE= '".$this->getField("PERIODE")."'
				"; 
		$this->query = $str;
		$this->execQuery($str);
		//echo $str;
		$str1= "
				UPDATE GAJI_RIWAYAT
				SET NO_SK= '".$this->getField("NO_SK")."'
				WHERE GAJI_RIWAYAT_ID= ".$this->getField("GAJI_RIWAYAT_ID")."
				"; 
		$this->query = $str1;
		//echo $str1;
		return $this->execQuery($str1);
    }
	
	function deletePegawaiPeriode()
	{
        $str = "DELETE FROM KGB
                WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")." AND PERIODE= '".$this->getField("PERIODE")."'
				"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
	
	function updateNomorGenerateNull()
	{
		$str= "
				UPDATE KGB
				SET NOMOR_GENERATE= NULL
				WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")." AND PERIODE= '".$this->getField("PERIODE")."'
				"; 
		$this->query = $str;
		//echo $str;
		return $this->execQuery($str);
    }
	
	function updateStatusKgb($statement)
	{
		$str = "UPDATE KGB X SET STATUS_KGB = '".$this->getField("STATUS_KGB")."'
		 		 WHERE EXISTS(SELECT 1 FROM KGB Y WHERE X.PEGAWAI_ID = Y.PEGAWAI_ID AND X.PERIODE = Y.PERIODE ".$statement.")
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function updateTanggalSkProsesKgb($statement)
	{
		$str = "UPDATE KGB X SET TANGGAL_SK_PROSES = NOW()
		 		 WHERE EXISTS(SELECT 1 FROM KGB Y WHERE X.PEGAWAI_ID = Y.PEGAWAI_ID AND X.PERIODE = Y.PERIODE ".$statement.")
				"; 
				$this->query = $str;
				// echo $str;exit();
		return $this->execQuery($str);
    }
	
	function updateStatusBatalKgb($statement)
	{
		$str = "UPDATE KGB X SET STATUS_KGB = NULL
		 		 WHERE EXISTS(SELECT 1 FROM KGB Y WHERE X.PEGAWAI_ID = Y.PEGAWAI_ID AND X.PERIODE = Y.PERIODE ".$statement.")
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function updateAnjabTerpilih()
	{

        $str1 = "UPDATE ANJAB_DETIL X SET TERPILIH = 0 
		 		 WHERE EXISTS(SELECT 1 FROM ANJAB Y WHERE X.ANJAB_ID = Y.ANJAB_ID AND STATUS = 1) AND X.SATKER_AKHIR = '".$this->getField("SATKER_AKHIR")."'
				"; 
				  
        $this->execQuery($str1);

		
        $str = "UPDATE ANJAB_DETIL SET TERPILIH = 1
                WHERE 
                  ANJAB_DETIL_ID = ".$this->getField("ANJAB_DETIL_ID").""; 
		$this->query = $str;
        return $this->execQuery($str);
    }

	function updateSesiAnjab()
	{
        $str1 = "UPDATE ANJAB SET STATUS = 0 "; 
				  
        $this->execQuery($str1);

        $str = "UPDATE ANJAB SET STATUS = 1
                WHERE 
                  ANJAB_ID = ".$this->getField("ANJAB_ID").""; 
		echo $str;		  
		$this->query = $str;
        return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM ANJAB
                WHERE 
                  ANJAB_ID = ".$this->getField("ANJAB_ID").""; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	
	function selectByParamsGajiRiwayatBak($paramsArray=array(),$limit=-1,$from=-1, $rowId="", $statement='')
	{
		$str = "
				SELECT
				SUBSTR(SATKER_ID,0,2) SATKER_ID_PARENT,
				(CASE WHEN GELAR_DEPAN IS NULL THEN '' ELSE GELAR_DEPAN || '. ' END) || F.NAMA || (CASE WHEN GELAR_BELAKANG IS NULL THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
				TEMPAT_LAHIR || ', ' || TO_CHAR(TANGGAL_LAHIR, 'DD-MM-YYYY') TTL, 
				NIP_BARU, P.NAMA || ' / (' || P.KODE || ')' PANGKAT, CASE WHEN F.TIPE_PEGAWAI_ID = '12' THEN 'Fungsional umum' ELSE E.JABATAN END PANGKATJABATAN, 
				AMBIL_SATKER_INDUK(D.SATKER_ID) SATKER_INDUK, 
				G.GAJI_POKOK GAJI_LAMA, 
				G.PEJABAT_PENETAP PEJABAT_LAMA, G.TANGGAL_SK TANGGAL_SK_LAMA,  G.NO_SK NO_SK_LAMA, G.TMT_SK TMT_LAMA, G.MASA_KERJA_TAHUN || ' - ' || G.MASA_KERJA_BULAN MASA_KERJA_LAMA, 
				A.GAJI_POKOK GAJI_BARU, A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN MASA_KERJA, 
				P.KODE GOL_RUANG, A.TMT_SK TMT_BARU, A.NO_SK
				FROM GAJI_RIWAYAT A
				LEFT JOIN PANGKAT P ON A.PANGKAT_ID = P.PANGKAT_ID  
				LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
				LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
				LEFT JOIN SATKER D ON F.SATKER_ID = D.SATKER_ID
				LEFT JOIN 
				(
				SELECT GAJI_RIWAYAT_ID, A.PEGAWAI_ID, CASE WHEN A.PEJABAT_PENETAP_ID IS NULL THEN A.PEJABAT_PENETAP ELSE C.JABATAN END PEJABAT_PENETAP,
						  D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, JENIS_KENAIKAN,
						  WILAYAH, KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, PANGKAT_ID
					 FROM GAJI_RIWAYAT A
						  INNER JOIN (  SELECT PEGAWAI_ID, MAX (TMT_SK) TMT_SK FROM GAJI_RIWAYAT WHERE GAJI_RIWAYAT_ID NOT IN (".$rowId.") GROUP BY PEGAWAI_ID) B ON A.PEGAWAI_ID = B.PEGAWAI_ID AND A.TMT_SK = B.TMT_SK
						  LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_ID = C.PEJABAT_PENETAP_ID
						  LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
				WHERE 1=1
				".$statement; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= " ";
		$this->query = $str;
		//echo $str;
		
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsGajiRiwayat($paramsArray=array(),$limit=-1,$from=-1, $rowId="", $statement='')
	{ 
		$str = "
				SELECT
				SUBSTR(F.SATKER_ID,0,2) SATKER_ID_PARENT,
				CONCAT( F.GELAR_DEPAN, (CASE WHEN F.GELAR_DEPAN IS NULL OR F.GELAR_DEPAN = '' THEN '' ELSE '. ' END), UPPER(F.NAMA) || (CASE WHEN F.GELAR_BELAKANG IS NULL OR F.GELAR_BELAKANG = '' THEN '' ELSE  ', ' END), F.GELAR_BELAKANG) NAMA,
				TEMPAT_LAHIR || ', ' || TO_CHAR(TANGGAL_LAHIR, 'DD-MM-YYYY') TTL, 
				AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU, P.NAMA || ' / (' || P.KODE || ')' PANGKAT, CASE WHEN F.TIPE_PEGAWAI_ID = '12' THEN 'Fungsional umum' ELSE E.JABATAN END PANGKATJABATAN, 
				AMBIL_SATKER_INDUK(D.SATKER_ID) SATKER_INDUK, AMBIL_SATKER(SUBSTR(D.SATKER_ID, 0, LENGTH(D.SATKER_ID) -2)) SATKER_TEMBUSAN,
				G.GAJI_POKOK GAJI_LAMA, 
				G.PEJABAT_PENETAP PEJABAT_LAMA, G.TANGGAL_SK TANGGAL_SK_LAMA,  G.NO_SK NO_SK_LAMA, G.TMT_SK TMT_LAMA, G.MASA_KERJA_TAHUN || ' - ' || G.MASA_KERJA_BULAN MASA_KERJA_LAMA, 
				A.GAJI_POKOK GAJI_BARU, A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN MASA_KERJA, 
				P.KODE GOL_RUANG, A.TMT_SK TMT_BARU, A.NO_SK,
				CASE WHEN AMBIL_SATKER(SUBSTR(D.SATKER_ID,0,4)) = 'SMP' OR AMBIL_SATKER(SUBSTR(D.SATKER_ID,0,4)) = 'SMA' THEN '1' ELSE '0' END SATKER_SMA_SMP,
				CASE WHEN POSITION('pada' IN E.JABATAN) > 0 THEN SUBSTR(E.JABATAN,0, POSITION('pada' in E.JABATAN)-1) ELSE E.JABATAN END JABATAN_PADA, 
				E.JABATAN, D.NAMA SATKER_NAMA, 
				CASE WHEN SUBSTR(D.SATKER_ID,0,2) = '01' THEN
				AMBIL_SATKER(AMBIL_SATKER_ID(D.SATKER_ID)) || ' ' || AMBIL_SATKER_INDUK(D.SATKER_ID)
				ELSE
				AMBIL_SATKER_INDUK(D.SATKER_ID) END SATKER,
				B.JABATAN PEJABAT_PENETAP, G.TMT_SK TMT_SK_LAMA, F.SATKER_ID
				, B.JABATAN PEJABAT_PENETAP_JABATAN
				FROM GAJI_RIWAYAT A
				LEFT JOIN PANGKAT P ON A.PANGKAT_ID = P.PANGKAT_ID  
				LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
				LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
				LEFT JOIN SATKER D ON F.SATKER_ID = D.SATKER_ID
				LEFT JOIN 
				(
				SELECT GAJI_RIWAYAT_ID, A.PEGAWAI_ID, CASE WHEN A.PEJABAT_PENETAP_ID IS NULL THEN A.PEJABAT_PENETAP ELSE C.JABATAN END PEJABAT_PENETAP,
						D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, JENIS_KENAIKAN,
						WILAYAH, KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, A.PANGKAT_ID, A.PEJABAT_PENETAP_ID
				   FROM GAJI_RIWAYAT A
						INNER JOIN (  SELECT PEGAWAI_ID, MAX (TMT_SK) TMT_SK FROM GAJI_RIWAYAT WHERE GAJI_RIWAYAT_ID NOT IN (".$rowId.") GROUP BY PEGAWAI_ID) B ON A.PEGAWAI_ID = B.PEGAWAI_ID AND A.TMT_SK = B.TMT_SK
						LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_ID = C.PEJABAT_PENETAP_ID
						LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
				LEFT JOIN PEJABAT_PENETAP B ON G.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
				WHERE 1=1
				".$statement; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= " ";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }
	
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT 
                DISTINCT PERIODE, A.PEGAWAI_ID, A.PANGKAT_ID, 
                   G.PEJABAT_PENETAP PEJABAT_PENETAP1, 
				   B.JABATAN PEJABAT_PENETAP,
				   A.NO_SK,
                   P.NAMA || ' / (' || P.KODE || ')' PANGKAT,   
                   A.TANGGAL_SK TANGGAL_SK_ASLI, ADD_MONTHS(A.TANGGAL_SK,-26) TANGGAL_SK, A.TMT_BARU, 
                   A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN MASA_KERJA,
                   A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN MASA_KERJA_LAMABAK, 
                   A.GAJI_BARU, A.NIP_LAMA, AMBIL_FORMAT_NIP_BARU(A.NIP_BARU) NIP_BARU, 
				   CONCAT( F.GELAR_DEPAN, (CASE WHEN F.GELAR_DEPAN IS NULL OR F.GELAR_DEPAN = '' THEN '' ELSE '. ' END), UPPER(F.NAMA) || (CASE WHEN F.GELAR_BELAKANG IS NULL OR F.GELAR_BELAKANG = '' THEN '' ELSE  ', ' END), F.GELAR_BELAKANG) NAMA,
				   A.NAMA NAMABAK, A.GOL_RUANG, A.SATKER_ID,
                   A.SATKER_ID_GENERATE, A.TANGGAL_PROSES, A.TMT_LAMA, 
                   G.NO_SK NO_SK_LAMA, G.TANGGAL_SK TANGGAL_SK_LAMA, G.TMT_SK TMT_SK_LAMA, G.MASA_KERJA_TAHUN || ' - ' || G.MASA_KERJA_BULAN MASA_KERJA_LAMA,
                   A.GAJI_LAMA, E.JABATAN, 
				   CASE WHEN POSITION('pada' IN E.JABATAN) > 0 THEN SUBSTR(E.JABATAN,0, POSITION('pada' in E.JABATAN)-1) ELSE E.JABATAN END JABATAN_PADA, 
				   CASE WHEN AMBIL_SATKER(SUBSTR(A.SATKER_ID,1,4)) = 'SMP' OR AMBIL_SATKER(SUBSTR(A.SATKER_ID,1,4)) = 'SMA' THEN '1' ELSE '0' END SATKER_SMA_SMP,
				   AMBIL_SATKER(SUBSTR(A.SATKER_ID, 1, LENGTH(A.SATKER_ID) -2)) SATKER_TEMBUSAN,
				   D.NAMA SATKER_NAMA, 
				   CASE WHEN SUBSTR(D.SATKER_ID,1,2) = '01' THEN
				   AMBIL_SATKER(AMBIL_SATKER_ID(D.SATKER_ID)) || ' ' || AMBIL_SATKER_INDUK(D.SATKER_ID)
				   ELSE
				   AMBIL_SATKER_INDUK(D.SATKER_ID) END SATKER,
				   E.ESELON ESELON, F.TEMPAT_LAHIR TEMPAT_LAHIR, F.TANGGAL_LAHIR TANGGAL_LAHIR,
				   A.STATUS_KGB, F.TELEPON, A.NOMOR_GENERATE
				   , G.PEJABAT_PENETAP_JABATAN
				   , A.TANGGAL_SK_PROSES
                FROM KGB A 
                LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
                LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
                LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
                LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
                LEFT JOIN GAJI_TERAKHIR G ON A.PEGAWAI_ID = G.PEGAWAI_ID
                LEFT JOIN PANGKAT P ON P.PANGKAT_ID = A.PANGKAT_ID
                WHERE 1 = 1
				AND LENGTH(A.SATKER_ID) > 0
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		
		$str .= $statement;
		$str .= " ORDER BY A.TMT_BARU DESC, PANGKAT_ID DESC";
		$this->query = $str;
		//echo $str;
		
		return $this->selectLimit($str,$limit,$from); 
    }

	function selectByParamsLamaBaru($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT 
					PERIODE, A.PEGAWAI_ID, A.SATKER_ID, A.STATUS_KGB, A.NOMOR_GENERATE,
					CONCAT( F.GELAR_DEPAN, (CASE WHEN F.GELAR_DEPAN IS NULL OR F.GELAR_DEPAN = '' THEN '' ELSE '. ' END), UPPER(F.NAMA) || (CASE WHEN F.GELAR_BELAKANG IS NULL OR F.GELAR_BELAKANG = '' THEN '' ELSE  ', ' END), F.GELAR_BELAKANG) NAMA,
					AMBIL_FORMAT_NIP_BARU(A.NIP_BARU) NIP_BARU, A.GOL_RUANG, E.JABATAN,
					CASE WHEN POSITION('pada' IN E.JABATAN) > 0 THEN SUBSTR(E.JABATAN,0, POSITION('pada' in E.JABATAN)-1) ELSE E.JABATAN END JABATAN_PADA, AMBIL_SATKER_INDUK(D.SATKER_ID) SATKER
					, CASE A.STATUS_KGB WHEN '3' THEN GL.NO_SK ELSE COALESCE(GB.NO_SK, GL.NO_SK) END NO_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.TANGGAL_SK ELSE COALESCE(GB.TANGGAL_SK, GL.TANGGAL_SK) END TANGGAL_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.TMT_SK ELSE COALESCE(GB.TMT_SK, GL.TMT_SK) END TMT_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.MASA_KERJA_TAHUN || ' - ' || GL.MASA_KERJA_BULAN ELSE COALESCE(GB.MASA_KERJA_TAHUN, GL.MASA_KERJA_TAHUN) || ' - ' || COALESCE(GB.MASA_KERJA_BULAN, GL.MASA_KERJA_BULAN) END MASA_KERJA_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.GAJI_POKOK ELSE COALESCE(GB.GAJI_POKOK, GL.GAJI_POKOK) END GAJI_POKOK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GB.NO_SK END NO_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.TANGGAL_SK END TANGGAL_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.TMT_SK ELSE A.TMT_BARU END TMT_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.MASA_KERJA_TAHUN || ' - ' || GB.MASA_KERJA_BULAN ELSE A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN END MASA_KERJA_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.GAJI_POKOK ELSE A.GAJI_BARU END GAJI_POKOK_BARU
					, '01' || '-' || BULAN ||'-'|| COALESCE( NULLIF(BUP,NULL) , 0 ) + TAHUN TANGGAL_PENSIUN
				FROM (SELECT DISTINCT * FROM KGB) A
				LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
				LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID 
					,A.GELAR_DEPAN
					,A.NAMA
					,A.GELAR_BELAKANG
					,lpad(EXTRACT(DAY FROM TANGGAL_LAHIR)::text,2,'0') HARI
					,lpad(extract(month from TANGGAL_LAHIR + interval '1' month)::text, 2, '0') BULAN
					,EXTRACT(month from TANGGAL_LAHIR) BULAN_CHECK
					,EXTRACT(YEAR FROM TANGGAL_LAHIR) TAHUN
					,EXTRACT(YEAR FROM TANGGAL_LAHIR + interval '1' year) TAHUN_DEPAN
					,BUP
					,TIPE_PEGAWAI_ID
					FROM PEGAWAI A
					LEFT JOIN PEGAWAI_JABATAN B ON A.PEGAWAI_JABATAN_ID = B.PEGAWAI_JABATAN_ID
				) F ON A.PEGAWAI_ID = F.PEGAWAI_ID 
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
					D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
					FROM GAJI_RIWAYAT A
					LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) GB ON A.PEGAWAI_ID = GB.PEGAWAI_ID AND GB.PERIODE_GAJI = PERIODE
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
					D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
					FROM GAJI_RIWAYAT A
					LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) GL ON A.PEGAWAI_ID = GL.PEGAWAI_ID AND GL.PERIODE_GAJI = TO_CHAR(A.TMT_LAMA, 'MMYYYY')
				LEFT JOIN PANGKAT P ON P.PANGKAT_ID = A.PANGKAT_ID
				WHERE 1 = 1
				AND LENGTH(A.SATKER_ID) > 0
				"; 
				
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		
		$str .= $statement;
		$str .= " ORDER BY A.TMT_BARU DESC, P.PANGKAT_ID DESC";
		$this->query = $str;
		//echo $str;
		
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsLamaBaruLawas($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT 
					PERIODE, A.PEGAWAI_ID, A.SATKER_ID, A.STATUS_KGB, A.NOMOR_GENERATE,
					CONCAT( F.GELAR_DEPAN, (CASE WHEN F.GELAR_DEPAN IS NULL OR F.GELAR_DEPAN = '' THEN '' ELSE '. ' END), UPPER(F.NAMA) || (CASE WHEN F.GELAR_BELAKANG IS NULL OR F.GELAR_BELAKANG = '' THEN '' ELSE  ', ' END), F.GELAR_BELAKANG) NAMA,
					AMBIL_FORMAT_NIP_BARU(A.NIP_BARU) NIP_BARU, A.GOL_RUANG, F.JABATAN,
					CASE WHEN POSITION('pada' IN F.JABATAN) > 0 THEN SUBSTR(F.JABATAN,0, POSITION('pada' in F.JABATAN)-1) ELSE F.JABATAN END JABATAN_PADA, AMBIL_SATKER_INDUK(D.SATKER_ID) SATKER
					, CASE A.STATUS_KGB WHEN '3' THEN GL.NO_SK ELSE COALESCE(GB.NO_SK, GL.NO_SK) END NO_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.TANGGAL_SK ELSE COALESCE(GB.TANGGAL_SK, GL.TANGGAL_SK) END TANGGAL_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.TMT_SK ELSE COALESCE(GB.TMT_SK, GL.TMT_SK) END TMT_SK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.MASA_KERJA_TAHUN || ' - ' || GL.MASA_KERJA_BULAN ELSE COALESCE(GB.MASA_KERJA_TAHUN, GL.MASA_KERJA_TAHUN) || ' - ' || COALESCE(GB.MASA_KERJA_BULAN, GL.MASA_KERJA_BULAN) END MASA_KERJA_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GL.GAJI_POKOK ELSE COALESCE(GB.GAJI_POKOK, GL.GAJI_POKOK) END GAJI_POKOK_LAMA
					, CASE A.STATUS_KGB WHEN '3' THEN GB.NO_SK END NO_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.TANGGAL_SK END TANGGAL_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.TMT_SK ELSE A.TMT_BARU END TMT_SK_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.MASA_KERJA_TAHUN || ' - ' || GB.MASA_KERJA_BULAN ELSE A.MASA_KERJA_TAHUN || ' - ' || A.MASA_KERJA_BULAN END MASA_KERJA_BARU
					, CASE A.STATUS_KGB WHEN '3' THEN GB.GAJI_POKOK ELSE A.GAJI_BARU END GAJI_POKOK_BARU
					, '01' || '-' || BULAN ||'-'|| COALESCE( NULLIF(BUP,NULL) , 0 ) + TAHUN TANGGAL_PENSIUN
				FROM (SELECT DISTINCT * FROM KGB) A
				LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID 
					,A.GELAR_DEPAN
					,A.NAMA
					,A.GELAR_BELAKANG
					,lpad(EXTRACT(DAY FROM TANGGAL_LAHIR)::text,2,'0') HARI
					,lpad(extract(month from TANGGAL_LAHIR + interval '1' month)::text, 2, '0') BULAN
					,EXTRACT(month from TANGGAL_LAHIR) BULAN_CHECK
					,EXTRACT(YEAR FROM TANGGAL_LAHIR) TAHUN
					,EXTRACT(YEAR FROM TANGGAL_LAHIR + interval '1' year) TAHUN_DEPAN
					,BUP
					,TIPE_PEGAWAI_ID
					,COALESCE(B.JABATAN_FUNG, B.JABATAN_STRUK, B.JABATAN_PELAKSANA) JABATAN
					FROM PEGAWAI A
					LEFT JOIN 
					(
						SELECT A.PEGAWAI_JABATAN_ID, C.NAMA JABATAN_FUNG,D.NAMA JABATAN_STRUK
						,E.NAMA JABATAN_PELAKSANA, A.TMT_JABATAN,A.KELAS_JABATAN
						,A.BUP
						FROM PEGAWAI_JABATAN A 
						LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
						LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
						LEFT JOIN JABATAN_STRUKTURAL_NEW D ON D.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
						LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
					) B ON A.PEGAWAI_JABATAN_ID = B.PEGAWAI_JABATAN_ID
				) F ON A.PEGAWAI_ID = F.PEGAWAI_ID 
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
					D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
					FROM GAJI_RIWAYAT A
					LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) GB ON A.PEGAWAI_ID = GB.PEGAWAI_ID AND GB.PERIODE_GAJI = PERIODE
				LEFT JOIN
				(
					SELECT DISTINCT
					A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
					D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
					FROM GAJI_RIWAYAT A
					LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				) GL ON A.PEGAWAI_ID = GL.PEGAWAI_ID AND GL.PERIODE_GAJI = TO_CHAR(A.TMT_LAMA, 'MMYYYY')
				LEFT JOIN PANGKAT P ON P.PANGKAT_ID = A.PANGKAT_ID
				WHERE 1 = 1
				AND LENGTH(A.SATKER_ID) > 0
				"; 
				
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		
		$str .= $statement;
		$str .= " ORDER BY A.TMT_BARU DESC, P.PANGKAT_ID DESC";
		$this->query = $str;
		//echo $str;
		
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsLike($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT ANJAB_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID, 
				   KEDUDUKAN_ID, JENIS_ANJAB_ID, BANK_ID, 
				   NIP_LAMA, NIP_BARU, NAMA, 
				   GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH,
				   EMAIL, ALAMAT, RT, RW, TELEPON, KODEPOS, STATUS_ANJAB, KARTU_ANJAB, ASKES, TASPEN,
				   NPWP, NIK, FOTO, NO_REKENING, TANGGAL_MATI, TANGGAL_PENSIUN, TANGGAL_TERUSAN, TANGGAL_UPDATE, TIPE_ANJAB
				FROM ANJAB WHERE ANJAB_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY KEDUDUKAN_ID ASC";
		return $this->selectLimit($str,$limit,$from); 
    }	

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(DISTINCT A.PEGAWAI_ID) ROWCOUNT 
		FROM KGB A 
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
		LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
		LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
		LEFT JOIN GAJI_TERAKHIR G ON A.PEGAWAI_ID = G.PEGAWAI_ID
		LEFT JOIN PANGKAT P ON P.PANGKAT_ID = A.PANGKAT_ID
		WHERE 1 = 1 ".$statement;
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		$this->query = $str;
		$this->select($str); 
		//echo $str;
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
	
	function getCountByParamsLamaBaru($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(1) ROWCOUNT 
		FROM (SELECT DISTINCT * FROM KGB) A
		LEFT JOIN SATKER D ON A.SATKER_ID = D.SATKER_ID
		LEFT JOIN JABATAN_TERAKHIR E ON A.PEGAWAI_ID = E.PEGAWAI_ID    
		LEFT JOIN PEGAWAI F ON A.PEGAWAI_ID = F.PEGAWAI_ID
		LEFT JOIN
		(
			SELECT DISTINCT
			A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
			D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
			FROM GAJI_RIWAYAT A
			LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
		) GB ON A.PEGAWAI_ID = GB.PEGAWAI_ID AND GB.PERIODE_GAJI = PERIODE
		LEFT JOIN
		(
			SELECT DISTINCT
			A.PEGAWAI_ID, TO_CHAR(TMT_SK, 'MMYYYY') PERIODE_GAJI,
			D.KODE GOL_RUANG, NO_SK, TANGGAL_SK, A.TMT_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
			FROM GAJI_RIWAYAT A
			LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
		) GL ON A.PEGAWAI_ID = GL.PEGAWAI_ID AND GL.PERIODE_GAJI = TO_CHAR(A.TMT_LAMA, 'MMYYYY')
		LEFT JOIN PANGKAT P ON P.PANGKAT_ID = A.PANGKAT_ID
		WHERE 1 = 1
		AND LENGTH(A.SATKER_ID) > 0 ".$statement;
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		$this->query = $str;
		$this->select($str); 
		//echo $str;
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
	
	function getCountByParamsGenerateNomor($periode='')
	{
		$str = "
		SELECT GENERATEZERO(CAST((COALESCE(CAST(MAX(NOMOR_GENERATE) AS INTEGER),'0') + 1) AS TEXT), 2) AS ROWCOUNT 
		FROM KGB WHERE 1=1 AND PERIODE = '".$periode."'";
		$this->select($str);
		$this->query = $str;
		//echo $str;exit;
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }

    function getCountByParamsKandidatPilih($paramsArray=array())
	{
		$str = "
			SELECT COUNT(NAMA) ROWCOUNT
			  FROM DAFTAR_URUTAN_PEGAWAI A
			 WHERE 1 = 1 AND 
			 NOT EXISTS(SELECT 1 FROM ANJAB X, ANJAB_DETIL Y WHERE X.ANJAB_ID = Y.ANJAB_ID AND X.STATUS = 1 AND Y.PEGAWAI_ID = A.PEGAWAI_ID)
		"; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }	

    function getCountByParamsKandidat($paramsArray=array())
	{
		$str = "
			SELECT COUNT(PEGAWAI_ID) ROWCOUNT FROM ANJAB_DETIL A, ANJAB B WHERE A.ANJAB_ID = B.ANJAB_ID AND B.STATUS = 1
		"; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '$val%' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }		

    function getCountByParamsMonitoring($paramsArray=array(), $statement="")
	{
		$str = "
				SELECT  COUNT(A.ANJAB_ID) ROWCOUNT
				FROM ANJAB A,  
					 (SELECT TMT_PANGKAT, GOL_RUANG, ANJAB_ID, PANGKAT_ID FROM PANGKAT_TERAKHIR) B,
					 (SELECT ANJAB_ID, TMT_JABATAN, ESELON, JABATAN, ESELON_ID FROM JABATAN_TERAKHIR) C,
                     AGAMA D,
                     SATKER E,
                     (SELECT ANJAB_ID, TAHUN LULUS, PENDIDIKAN FROM PENDIDIKAN_TERAKHIR X) F
                WHERE
                     A.ANJAB_ID = B.ANJAB_ID(+) AND
                     A.ANJAB_ID = C.ANJAB_ID(+) AND
                     A.AGAMA_ID = D.AGAMA_ID(+) AND
                     A.SATKER_ID = E.SATKER_ID AND
                     A.ANJAB_ID = F.ANJAB_ID(+)
					
				".$statement; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		//echo $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }	

    function getCountByParamsLike($paramsArray=array())
	{
		$str = "SELECT COUNT(ANJAB_ID) AS ROWCOUNT FROM ANJAB WHERE ANJAB_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }	
  } 
?>