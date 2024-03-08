<? 
  include_once(APPPATH.'/models/Entity.php');

  class PegawaiVerifikator extends Entity{ 

	var $query;

    function PegawaiVerifikator()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI_JABATAN")); 
		
		$str = "INSERT INTO validasi.PEGAWAI_JABATAN (
						PEGAWAI_JABATAN_ID, PEGAWAI_ID, ESELON_ID, JENIS_JABATAN_ID, 
						TIPE_PEGAWAI_NEW_ID, JABATAN_FUNGSIONAL_NEW_ID, JABATAN_PELAKSANA_NEW_ID, 
						JABATAN_STRUKTURAL_NEW_ID, BUP, KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, 
						NO_SK, TUGAS_TAMBAHAN_ID, TUGAS_TAMBAHAN_NAMA,USER_APP_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,
						TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("PEGAWAI_JABATAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("ESELON_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
				  '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
				  '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
				  '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
				  '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
				  ".$this->getField("BUP").",
				  ".$this->getField("KELAS_JABATAN").",
				  ".$this->getField("TMT_JABATAN").",
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NO_SK")."',
				  '".$this->getField("TUGAS_TAMBAHAN_ID")."',
				  '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
				  ".$this->getField("USER_APP_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.PEGAWAI_JABATAN
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   ESELON_ID    = ".$this->getField("ESELON_ID").",
					   JENIS_JABATAN_ID             = ".$this->getField("JENIS_JABATAN_ID").",
					   TIPE_PEGAWAI_NEW_ID     = '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
					   JABATAN_FUNGSIONAL_NEW_ID     = '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
					   JABATAN_PELAKSANA_NEW_ID     = '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
					   JABATAN_STRUKTURAL_NEW_ID     = '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
					   BUP     = ".$this->getField("BUP").",
					   KELAS_JABATAN     = ".$this->getField("KELAS_JABATAN").",
					   TMT_JABATAN     = ".$this->getField("TMT_JABATAN").",
					   TANGGAL_SK     = ".$this->getField("TANGGAL_SK").",
					   NO_SK     = '".$this->getField("NO_SK")."',
					   TUGAS_TAMBAHAN_ID     = '".$this->getField("TUGAS_TAMBAHAN_ID")."',
					   TUGAS_TAMBAHAN_NAMA     = '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
					   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.PEGAWAI_JABATAN
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParamsPegawaiVerifikator($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.STATUS_PEGAWAI,
			A.PEGAWAI_ID, A.NIP_BARU,  
			A.NAMA, A.TIPE_PEGAWAI_ID,  
			ambil_satker_nama_dynamic(A.SATKER_ID) SATKER_NAMA,
			  A.SATKER_ID,  A.SATKER, A.STATUS_PEGAWAI_NAMA,  A.TIPE_PEGAWAI_NAMA, 
			C.ESELON_ID,
			B.PANGKAT_ID,   B.GOL_RUANG,
			C.ESELON,
			C.JABATAN,
			V.INFO_LINK,
			V.INFO_JENIS,
			V.INFO_TABLE,
			V.INFO_JENIS_UPDATE,
			V.INFO_STATUS,
			V.INFO_KETERANGAN,
			V.INFO_VALIDASI,
			V.TEMP_VALIDASI_ID,
			V.ROW_ID
		FROM
		(
			SELECT	
				A.STATUS_PEGAWAI,
				A.PEGAWAI_ID, NIP_LAMA, NIP_BARU, 
				(CASE WHEN TRIM(COALESCE(GELAR_DEPAN, '')) = '' THEN '' ELSE TRIM(GELAR_DEPAN) || '. ' END) || A.NAMA || (CASE WHEN TRIM(COALESCE(GELAR_BELAKANG, '')) = '' THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
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
		INNER JOIN validasi.validasi_perubahandatavalidasi('') V ON A.PEGAWAI_ID = V.PEGAWAI_ID
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