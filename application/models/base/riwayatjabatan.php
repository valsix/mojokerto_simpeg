<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatJabatan extends Entity{ 

	var $query;

	function RiwayatJabatan()
	{
		$this->Entity(); 
	}
	
    function insert()
	{
		//TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("JABATAN_RIWAYAT_ID", $this->getNextId("JABATAN_RIWAYAT_ID","JABATAN_RIWAYAT")); 

		$str = "INSERT INTO JABATAN_RIWAYAT
		(
			JABATAN_RIWAYAT_ID, PEGAWAI_ID, NO_SK, TANGGAL_SK, NAMA,  TMT_JABATAN, ESELON_ID, 
			TMT_ESELON,PEJABAT_PENETAP_ID, NO_PELANTIKAN, TANGGAL_PELANTIKAN, TUNJANGAN, BULAN_DIBAYAR,
			KETERANGAN_BUP, ANGKA_KREDIT, TENTANG_JABATAN, JENIS_JABATAN, KODE_JABATAN, SATKER,
			LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("JABATAN_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("TANGGAL_SK")."
			, '".$this->getField("NAMA")."'
			, ".$this->getField("TMT_JABATAN")."
			, ".$this->getField("ESELON_ID")."
			, ".$this->getField("TMT_ESELON")."
			, '".$this->getField("PEJABAT_PENETAP_ID")."'
			, '".$this->getField("NO_PELANTIKAN")."'
			, ".$this->getField("TANGGAL_PELANTIKAN")."
			, '".$this->getField("TUNJANGAN")."'
			, ".$this->getField("BULAN_DIBAYAR")."
			, '".$this->getField("KETERANGAN_BUP")."'
			, ".$this->getField("ANGKA_KREDIT")."
			, '".$this->getField("TENTANG_JABATAN")."'
			, '".$this->getField("JENIS_JABATAN")."'
			, '".$this->getField("KODE_JABATAN")."'
			, '".$this->getField("SATKER")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->query = $str;
		$this->id= $this->getField("JABATAN_RIWAYAT_ID");

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("JABATAN_RIWAYAT", "INSERT", $str);

		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "UPDATE JABATAN_RIWAYAT
		SET    
			NO_SK= '".$this->getField("NO_SK")."'
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TMT_JABATAN= ".$this->getField("TMT_JABATAN")."
			, ESELON_ID= '".$this->getField("ESELON_ID")."'
			, TMT_ESELON= ".$this->getField("TMT_ESELON")."
			, PEJABAT_PENETAP_ID= '".$this->getField("PEJABAT_PENETAP_ID")."'
			, NO_PELANTIKAN= '".$this->getField("NO_PELANTIKAN")."'
			, TANGGAL_PELANTIKAN= ".$this->getField("TANGGAL_PELANTIKAN")."
			, TUNJANGAN= '".$this->getField("TUNJANGAN")."'
			, BULAN_DIBAYAR= ".$this->getField("BULAN_DIBAYAR")."
			, KETERANGAN_BUP= '".$this->getField("KETERANGAN_BUP")."'
			, ANGKA_KREDIT= ".$this->getField("ANGKA_KREDIT")."
			, TENTANG_JABATAN= '".$this->getField("TENTANG_JABATAN")."'
			, JENIS_JABATAN= '".$this->getField("JENIS_JABATAN")."'
			, KODE_JABATAN= '".$this->getField("KODE_JABATAN")."'
			, SATKER= '".$this->getField("SATKER")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE JABATAN_RIWAYAT_ID= '".$this->getField("JABATAN_RIWAYAT_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("JABATAN_RIWAYAT", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM JABATAN_RIWAYAT
        WHERE JABATAN_RIWAYAT_ID = '".$this->getField("JABATAN_RIWAYAT_ID")."'";
		$this->query = $str;
		// echo$str; exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("JABATAN_RIWAYAT", "DELETE", $str);

        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT JABATAN_RIWAYAT_ID, PEGAWAI_ID, a.PEGAWAI_ID AS ID_PEGAWAI,
				(SELECT x.TIPE_PEGAWAI_ID 
				FROM PEGAWAI x
				WHERE x.PEGAWAI_ID = a.PEGAWAI_ID
				) TIPE_PEGAWAI,
				a.SATKER_ID,
				A.JABATAN_FUNGSIONAL_ID, C.NAMA NAMA_FUNG, NO_SK, a.ESELON_ID, B.NAMA ESELON, PEJABAT_PENETAP,
				TANGGAL_SK, TMT_JABATAN, 
				TMT_ESELON, a.NAMA, NO_PELANTIKAN,  KETERANGAN_BUP,
				TANGGAL_PELANTIKAN, a.TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, TANGGAL_UPDATE,
				case 
				when PEJABAT_PENETAP is NULL 
				then (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)
				else PEJABAT_PENETAP
				end NMPEJABATPENETAP,
				FOTO_BLOB, TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN, a.MATA_PELAJARAN, LINK_FILE_APPS,ANGKA_KREDIT,JENIS_JABATAN,TENTANG_JABATAN,KODE_JABATAN,SATKER
                FROM JABATAN_RIWAYAT a
                LEFT JOIN  ESELON B ON a.ESELON_ID = B.ESELON_ID
				LEFT JOIN  JABATAN_FUNGSIONAL C ON a.JABATAN_FUNGSIONAL_ID = C.JABATAN_FUNGSIONAL_ID
                WHERE 1 = 1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_JABATAN ";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM JABATAN_RIWAYAT a
                LEFT JOIN  ESELON B ON a.ESELON_ID = B.ESELON_ID
				LEFT JOIN  JABATAN_FUNGSIONAL C ON a.JABATAN_FUNGSIONAL_ID = C.JABATAN_FUNGSIONAL_ID
                WHERE 1 = 1".$statement; 
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		// echo $str;exit;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }

} 
?>