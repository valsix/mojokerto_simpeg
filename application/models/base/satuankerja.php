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
  // include_once('Entity.php');
  include_once(APPPATH.'/models/Entity.php');
  
  class SatuanKerja extends Entity{ 

	 var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function SatuanKerja()
	{
      $this->Entity(); 
    }

    function insert()
	{
		
		$str = "INSERT INTO SATKER (
				   SATKER_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID_PARENT, 
				   KODE, NAMA, SIFAT, 
				   ALAMAT, TELEPON, FAXIMILE, 
				   KODEPOS, EMAIL, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,ESELON_ID,PANGKAT_ID,PEGAWAI_ID,NAMA_JABATAN,TMT_JABATAN) 
				VALUES (
				  '".$this->getField("SATKER_ID")."',
				  ".$this->getField("PROPINSI_ID").",
				  ".$this->getField("KABUPATEN_ID").",
				  ".$this->getField("KECAMATAN_ID").",
				  ".$this->getField("KELURAHAN_ID").",
				  '".$this->getField("SATKER_ID_PARENT")."',
				  '".$this->getField("KODE")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("SIFAT")."',
				  '".$this->getField("ALAMAT")."',
				  '".$this->getField("TELEPON")."',
				  '".$this->getField("FAXIMILE")."',
				  '".$this->getField("KODEPOS")."',
				  '".$this->getField("EMAIL")."',				 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("ESELON_ID").",
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NAMA_JABATAN")."',
				  ".$this->getField("TMT_JABATAN")."
				)"; 

		// untuk buat log data
		$this->setlogdata($str);
	
		$this->query = $str;
		 // echo $str;exit();
		return $this->execQuery($str);
    }
	
	function insertbak()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("SATUAN_KERJA_ID", $this->getNextId("SATUAN_KERJA_ID","SATUAN_KERJA")); 

		$str = "
		INSERT INTO SATUAN_KERJA
		(
			SATUAN_KERJA_ID, SATUAN_KERJA_PARENT_ID, NAMA, NO_URUT, NAMA_SINGKAT, NAMA_PENANDATANGAN
			, TIPE_ID, NAMA_JABATAN, TIPE_JABATAN_ID, ESELON_ID, SATUAN_KERJA_INDUK, SATUAN_KERJA_URUTAN_SURAT
			, MASA_BERLAKU_AWAL, MASA_BERLAKU_AKHIR, STATUS_SEDIAAN, SATUAN_KERJA_SEDIAAN, RUMPUN_ID
			, KONVERSI, ID_SAPK, USER_LOGIN_ID, USER_LOGIN_PEGAWAI_ID
		) 
		VALUES
		(
			".$this->getField("SATUAN_KERJA_ID")."
			, ".$this->getField("SATUAN_KERJA_PARENT_ID")."
			, '".$this->getField("NAMA")."'
			, ".$this->getField("NO_URUT")."
			, '".$this->getField("NAMA_SINGKAT")."'
			, '".$this->getField("NAMA_PENANDATANGAN")."'
			, ".$this->getField("TIPE_ID")."
			, '".$this->getField("NAMA_JABATAN")."'
			, ".$this->getField("TIPE_JABATAN_ID")."
			, ".$this->getField("ESELON_ID")."
			, ".$this->getField("SATUAN_KERJA_INDUK")."
			, ".$this->getField("SATUAN_KERJA_URUTAN_SURAT")."
			, ".$this->getField("MASA_BERLAKU_AWAL")."
			, ".$this->getField("MASA_BERLAKU_AKHIR")."
			, '".$this->getField("STATUS_SEDIAAN")."'
			, ".$this->getField("SATUAN_KERJA_SEDIAAN")."
			, ".$this->getField("RUMPUN_ID")."
			, '".$this->getField("KONVERSI")."'
			, '".$this->getField("ID_SAPK")."'
			, '".$this->getField("USER_LOGIN_ID")."'
			, ".$this->getField("USER_LOGIN_PEGAWAI_ID")."
		)
		"; 	
		$this->id = $this->getField("SATUAN_KERJA_ID");
		$this->query = $str;
		return $this->execQuery($str);
    }


    function update()
	{
		$str = "		
		UPDATE SATUAN_KERJA
		SET    
		NAMA= '".$this->getField("NAMA")."'
		, NAMA_SINGKAT= '".$this->getField("NAMA_SINGKAT")."'
		, TIPE_ID= ".$this->getField("TIPE_ID")."
		, TIPE_JABATAN_ID= ".$this->getField("TIPE_JABATAN_ID")."
		, JENIS_JABATAN_ID= ".$this->getField("JENIS_JABATAN_ID")."
		, USER_LOGIN_ID= ".$this->getField("USER_LOGIN_ID")."
		, USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID")."
		, SATUAN_KERJA_URUTAN_SURAT= ".$this->getField("SATUAN_KERJA_URUTAN_SURAT")."
		, KODE= ".$this->getField("KODE")."
		, ESELON_ID= ".$this->getField("ESELON_ID")."
		, SATUAN_KERJA_MUTASI_STATUS= ".$this->getField("SATUAN_KERJA_MUTASI_STATUS")."
		, SATUAN_KERJA_INDUK_ID= ".$this->getField("SATUAN_KERJA_INDUK_ID")."
		, NAMA_PENANDATANGAN= ".$this->getField("NAMA_PENANDATANGAN")."
		, NAMA_JABATAN= ".$this->getField("NAMA_JABATAN")."
		, MASA_BERLAKU_AWAL= ".$this->getField("MASA_BERLAKU_AWAL")."
		, MASA_BERLAKU_AKHIR= ".$this->getField("MASA_BERLAKU_AKHIR")."
		, STATUS_SEDIAAN= '".$this->getField("STATUS_SEDIAAN")."'
		, SATUAN_KERJA_SEDIAAN= ".$this->getField("SATUAN_KERJA_SEDIAAN")."
		, RUMPUN_ID= ".$this->getField("RUMPUN_ID")."
		WHERE SATUAN_KERJA_ID= ".$this->getField("SATUAN_KERJA_ID")."
		";
		$this->query = $str;
		// echo $str;exit();
		return $this->execQuery($str);
    }

    function updatemaster()
	{
		$str = "		
		UPDATE SATKER
		SET    
		PROPINSI_ID       = ".$this->getField("PROPINSI_ID").",
		KABUPATEN_ID    = ".$this->getField("KABUPATEN_ID").",
		KECAMATAN_ID             = ".$this->getField("KECAMATAN_ID").",
		KELURAHAN_ID     = ".$this->getField("KELURAHAN_ID").",					   
		ALAMAT        = '".$this->getField("ALAMAT")."',
		TELEPON       = '".$this->getField("TELEPON")."',
		FAXIMILE      = '".$this->getField("FAXIMILE")."',
		KODEPOS   = '".$this->getField("KODEPOS")."',
		EMAIL             = '".$this->getField("EMAIL")."',
		NAMA  = '".$this->getField("NAMA")."',
		KODE  = '".$this->getField("KODE")."',
		SIFAT = '".$this->getField("SIFAT")."',
		ESELON_ID = '".$this->getField("ESELON_ID")."',
		PANGKAT_ID = ".$this->getField("PANGKAT_ID").",
		PEGAWAI_ID = ".$this->getField("PEGAWAI_ID").",
		LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
		LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
		LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE SATKER_ID= '".$this->getField("SATKER_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		return $this->execQuery($str);
    }
	
	function updatebak()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE SATUAN_KERJA
				SET    
					SATUAN_KERJA_ID= ".$this->getField("SATUAN_KERJA_ID").",
					SATUAN_KERJA_PARENT_ID= ".$this->getField("SATUAN_KERJA_PARENT_ID").",
					NAMA= '".$this->getField("NAMA")."',
					NO_URUT= ".$this->getField("NO_URUT").",
					NAMA_SINGKAT= '".$this->getField("NAMA_SINGKAT")."',
					NAMA_PENANDATANGAN= '".$this->getField("NAMA_PENANDATANGAN")."',
					TIPE_ID= ".$this->getField("TIPE_ID").",
					NAMA_JABATAN= '".$this->getField("NAMA_JABATAN")."',
					TIPE_JABATAN_ID= ".$this->getField("TIPE_JABATAN_ID").",
					ESELON_ID= ".$this->getField("ESELON_ID").",
					SATUAN_KERJA_INDUK= ".$this->getField("SATUAN_KERJA_INDUK").",
					SATUAN_KERJA_URUTAN_SURAT= ".$this->getField("SATUAN_KERJA_URUTAN_SURAT").",
					MASA_BERLAKU_AWAL= ".$this->getField("MASA_BERLAKU_AWAL").",
					MASA_BERLAKU_AKHIR= ".$this->getField("MASA_BERLAKU_AKHIR").",
					KONVERSI= '".$this->getField("KONVERSI")."',
					USER_LOGIN_ID= '".$this->getField("USER_LOGIN_ID")."',
					USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
					ID_SAPK= '".$this->getField("ID_SAPK")."'
				WHERE  SATUAN_KERJA_ID    	= ".$this->getField("SATUAN_KERJA_ID")."
				"; 
		$this->query = $str;
		return $this->execQuery($str);
    }

    function updateStatus()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE SATUAN_KERJA
				SET    
					   STATUS   	= ".$this->getField("STATUS")."
				WHERE  SATUAN_KERJA_ID    	= ".$this->getField("SATUAN_KERJA_ID")."
				"; 
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "
				UPDATE SATUAN_KERJA SET
					STATUS = '1'
				WHERE SATUAN_KERJA_ID = ".$this->getField("SATUAN_KERJA_ID")."
				";
		$this->query = $str;
		return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","MASTER_KATEGORI_METODE_EVALUASI_ID"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
	function selectByParamsTree($statement="", $parentId="0", $sOrder= "ORDER BY SATUAN_KERJA_PARENT_ID, NO_URUT")
	{
		$str = "		
		WITH RECURSIVE nodes(SATUAN_KERJA_ID, SATUAN_KERJA_PARENT_ID, STATUS, NAMA, NO_URUT, NAMA_SINGKAT, PATH) AS (
			SELECT SATUAN_KERJA_ID, SATUAN_KERJA_PARENT_ID, STATUS, NAMA, NO_URUT, NAMA_SINGKAT
			, A.SATUAN_KERJA_ID AS PATH
			FROM SATUAN_KERJA A WHERE A.SATUAN_KERJA_PARENT_ID = ".$parentId."
			UNION
			SELECT B.SATUAN_KERJA_ID, B.SATUAN_KERJA_PARENT_ID, B.STATUS, B.NAMA, B.NO_URUT, B.NAMA_SINGKAT
			, A.SATUAN_KERJA_ID AS PATH
			FROM SATUAN_KERJA B, nodes A WHERE B.SATUAN_KERJA_PARENT_ID = A.SATUAN_KERJA_ID
		)
		SELECT SATUAN_KERJA_ID, SATUAN_KERJA_PARENT_ID, STATUS, NAMA, NO_URUT, NAMA_SINGKAT FROM nodes
		"; 
		$str .= $sOrder;
		//echo $str;exit;
		$this->query = $str;
				
		return $this->selectLimit($str,-1,-1);
    }
	
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.SATUAN_KERJA_ID ASC')
	{
		$str = "
		SELECT
		A.*
		, ES.NAMA ESELON_NAMA
		, AMBIL_SATKER_NAMA_DYNAMIC(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_DETIL
		, AMBIL_SATKER_INDUK(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_INDUK
		, R.KETERANGAN RUMPUN_NAMA
		FROM SATUAN_KERJA A
		LEFT JOIN ESELON ES ON A.ESELON_ID = ES.ESELON_ID
		LEFT JOIN talent.rumpun R ON A.RUMPUN_ID = R.RUMPUN_ID
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }

    function selectByParamsMaster($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT A.SATKER_ID, A.PROPINSI_ID, A.KABUPATEN_ID, 
                   A.KECAMATAN_ID, A.KELURAHAN_ID, A.SATKER_ID_PARENT, 
                   A.KODE KODE_SATKER, A.NAMA, A.SIFAT,A.NAMA_JABATAN, 
                   A.ALAMAT, A.TELEPON, A.FAXIMILE, 
				   AMBIL_SATKER_NAMA(A.SATKER_ID) SATKER_FULL,
                   A.KODEPOS, A.EMAIL, A.PANGKAT_ID,
                   A.ESELON_ID, B.NAMA ESELON, 
                   A.PEGAWAI_ID PEGAWAI_ID, C.NAMA NAMA_PEGAWAI,
                    C.NIP_BARU NIP_BARU,
                     D.NAMA NAMA_PANGKAT, D.KODE  KODE,  
                     A.TMT_JABATAN,
					 E.GOLONGAN GOLONGAN, E.PENDIDIKAN PENDIDIKAN, E.DIKLAT DIKLAT, E.KURSUS KURSUS, 
					 E.PENGALAMAN_KERJA PENGALAMAN_KERJA,  E.PENGETAHUAN_KERJA PENGETAHUAN_KERJA, 
					 E.KETRAMPILAN_KERJA KETRAMPILAN_KERJA
					 , C.STATUS_PEGAWAI
                FROM SATKER A
                LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
                LEFT JOIN PEGAWAI C ON A.PEGAWAI_ID = C.PEGAWAI_ID
                LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				LEFT JOIN SATKER_PROFIL_JABATAN E on A.SATKER_ID=E.SATKER_ID
                WHERE A.SATKER_ID IS NOT NULL
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY A.SATKER_ID ASC";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsTreeMaster($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT A.SATKER_ID, A.PROPINSI_ID, A.KABUPATEN_ID, 
                   A.KECAMATAN_ID, A.KELURAHAN_ID, A.SATKER_ID_PARENT, 
                   A.KODE KODE_SATKER, A.NAMA, A.SIFAT,A.NAMA_JABATAN, 
                   A.ALAMAT, A.TELEPON, A.FAXIMILE, 
				   AMBIL_SATKER_NAMA(A.SATKER_ID) SATKER_FULL,
                   A.KODEPOS, A.EMAIL, A.PANGKAT_ID,
                   A.ESELON_ID, B.NAMA ESELON, 
                   A.PEGAWAI_ID PEGAWAI_ID, C.NAMA NAMA_PEGAWAI,
                    C.NIP_BARU NIP_BARU,
                     D.NAMA NAMA_PANGKAT, D.KODE  KODE,  
                     A.TMT_JABATAN,
					 E.GOLONGAN GOLONGAN, E.PENDIDIKAN PENDIDIKAN, E.DIKLAT DIKLAT, E.KURSUS KURSUS, 
					 E.PENGALAMAN_KERJA PENGALAMAN_KERJA,  E.PENGETAHUAN_KERJA PENGETAHUAN_KERJA, 
					 E.KETRAMPILAN_KERJA KETRAMPILAN_KERJA
					 , C.STATUS_PEGAWAI
					 , CASE WHEN A.SATKER_ID IS NULL THEN 
					 ''
					 ELSE
					 '<a onClick=\"openurl(''app/index/master_satker_add?reqId=' || TRIM(A.SATKER_ID) || '&reqMode=insert'')\" 
					 style=\"cursor:pointer\" title=\"Tambah\"><i class=\"fa fa-user-plus\"></i></a>'
					 '<a onClick=\"openurl(''app/index/master_satker_add?reqId=' || TRIM(A.SATKER_ID) || '&reqMode=update'')\" 
					 style=\"cursor:pointer\" title=\"Ubah\"><i class=\"fa fa-user-edit\"></i></a>'
					 -- '<a onClick=\"delete_data(''' || TRIM(A.SATKER_ID) || ''')\" 
					 -- style=\"cursor:pointer\" title=\"Hapus\"><i class=\"fa fa-trash\"></i></a>'
					 END
					 LINK_URL_INFO
                FROM SATKER A
                LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
                LEFT JOIN PEGAWAI C ON A.PEGAWAI_ID = C.PEGAWAI_ID
                LEFT JOIN PANGKAT D ON A.PANGKAT_ID = D.PANGKAT_ID
				LEFT JOIN SATKER_PROFIL_JABATAN E on A.SATKER_ID=E.SATKER_ID
                WHERE A.SATKER_ID IS NOT NULL
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY A.SATKER_ID ASC";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsData($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.SATUAN_KERJA_ID ASC')
	{
		/*A.SATUAN_KERJA_ID, A.SATUAN_KERJA_PARENT_ID, A.NAMA, A.NAMA_SINGKAT, A.TIPE_ID, A.NAMA_JABATAN, A.TIPE_JABATAN_ID, 
		A.ESELON_ID, A.SATUAN_KERJA_INDUK, A.SATUAN_KERJA_URUTAN_SURAT, A.MASA_BERLAKU_AWAL, 
		A.MASA_BERLAKU_AKHIR, A.KONVERSI, A.ID_SAPK
		, A.JENIS_JABATAN_ID, A.NAMA_PENANDATANGAN, A.KODE
		, A.SATUAN_KERJA_INDUK_ID
		, A.SATUAN_KERJA_MUTASI_STATUS*/
		$str = "
		SELECT
		A.*, ES.NAMA ESELON_NAMA
		, AMBIL_SATKER_NAMA_DYNAMIC(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_DETIL
		, AMBIL_SATKER_INDUK(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_INDUK
		, AMBIL_SATKER_NAMA(A.SATUAN_KERJA_URUTAN_SURAT) SATUAN_KERJA_URUTAN_SURAT_NAMA
		, AMBIL_SATKER_NAMA(A.SATUAN_KERJA_INDUK_ID) SATUAN_KERJA_INDUK_NAMA
		, AMBIL_SATKER_NAMA(A.SATUAN_KERJA_SEDIAAN) SATUAN_KERJA_SEDIAAN_NAMA
		FROM SATUAN_KERJA A
		LEFT JOIN ESELON ES ON A.ESELON_ID = ES.ESELON_ID
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }

    function selectdata($paramsArray=array(), $limit=-1, $from=-1, $statement='', $order=' ORDER BY A.SATKER_ID ASC ')
	{
		$str = "
		SELECT 
			A.*
		FROM satker A
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit();
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsTreeMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.satker_id ASC ')
	{
		$str = "
				SELECT 
					satker_id, satker_id_parent, NAMA
				FROM satker A
				WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit();
		return $this->selectLimit($str,$limit,$from); 
		
    }
	
    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(A.SATUAN_KERJA_ID) AS ROWCOUNT 
				FROM SATUAN_KERJA A
				WHERE 1 = 1 ".$statement; 
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }
	
	function getSatuanKerja($id='')
	{
		$str = "SELECT REPLACE(REPLACE(CAST(AMBIL_ID_SATUAN_KERJA_TREE_ARRAY(".$id.") AS TEXT), '{',''), '}','') ROWCOUNT";
		$this->query = $str;
		// echo $str;exit();
		$this->select($str); 
		if($this->firstRow())
		{
			if($this->getField("ROWCOUNT") == "")
			return $id;
			else
			return $id.",".$this->getField("ROWCOUNT"); 
		}
		else 
			return $id;  
    }

    function getSatuanKerjaTipe($id='', $tipeid="")
	{
		$str = "SELECT REPLACE(REPLACE(CAST(AMBIL_ID_SATUAN_KERJA_TREE_ARRAY_TIPE(".$id.", ".$tipeid.") AS TEXT), '{',''), '}','') ROWCOUNT";
		$this->query = $str;
		// echo $str;exit();
		$this->select($str); 
		if($this->firstRow())
		{
			if($this->getField("ROWCOUNT") == "")
			return $id;
			else
			return $id.",".$this->getField("ROWCOUNT"); 
		}
		else 
			return $id;  
    }


	function getMaxIdTree($satker_id)
	{
		$str = "SELECT SATKER_GENERATE('".$satker_id."') ROWCOUNT"; 

		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }	

    function selectByParamsUrutanPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='')
		{
			$str = "SELECT 
					  PEGAWAI_ID, SATKER_ID, NIP_LAMA, 
					  NIP_BARU, NAMA, USIA_TAHUN, TEMPAT_LAHIR, JENIS_KELAMIN, 
					  NMGOLRUANG, GOL_RUANG, ESELON, JABATAN, TMT_PANGKAT, TMT_JABATAN, TANGGAL_LAHIR, AGAMA,
					  TELEPON, ALAMAT, PENDIDIKAN
	                FROM URUTAN_PEGAWAI A
	                WHERE 1=1"; 
			
			while(list($key,$val) = each($paramsArray))
			{
				$str .= " AND $key = '$val' ";
			}
			
			$str .= $statement;
			$this->query = $str;
					
			return $this->selectLimit($str,$limit,$from); 
	    }


	function selectByParamsSatker($paramsArray=array(),$limit=-1,$from=-1, $statement="", $sOrder="ORDER BY SATKER_ID")
	{
		$str = "
		SELECT A.SATKER_ID, A.NAMA, AMBIL_SATKER_NAMA(A.SATKER_ID) SATKER
		FROM SATKER A
		WHERE 1=1
		"; 
		while(list($key,$val)=each($paramsArray)){
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement." ".$sOrder;
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectByParamsPejabat($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT  C.ESELON_ID, A.PEGAWAI_ID, NIP_LAMA, AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU,
		CASE
		WHEN GELAR_DEPAN IS NULL THEN '' else GELAR_DEPAN || ' '   END  || A.NAMA || 
		CASE
		WHEN GELAR_BELAKANG IS NULL THEN '' else ' ' || GELAR_BELAKANG  END  NAMA,
		B.GOL_RUANG,
		TO_CHAR(B.TMT_PANGKAT, 'DD MON YYYY') TMT_PANGKAT,
		C.ESELON,
		B.PANGKAT_ID,
		C.ESELON_ID,
		C.JABATAN,
		TO_CHAR(C.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
		A.SATKER_ID
		FROM PEGAWAI A,  
			(SELECT TMT_PANGKAT, GOL_RUANG, PEGAWAI_ID, PANGKAT_ID FROM PANGKAT_TERAKHIR) B,
			(SELECT PEGAWAI_ID, TMT_JABATAN, ESELON, JABATAN, COALESCE(ESELON_ID, 99) ESELON_ID FROM JABATAN_TERAKHIR) C,
			(SELECT PEGAWAI_ID, TAHUN LULUS, PENDIDIKAN FROM PENDIDIKAN_TERAKHIR X) F
		WHERE
		A.PEGAWAI_ID = B.PEGAWAI_ID AND
		A.PEGAWAI_ID = C.PEGAWAI_ID::bigint AND
		A.PEGAWAI_ID = F.PEGAWAI_ID AND
		A.STATUS_PEGAWAI IN (1,2)
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}

		$str .= $statement." ";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
	}

  } 
?>