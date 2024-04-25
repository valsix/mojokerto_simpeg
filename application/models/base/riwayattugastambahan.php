<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatTugasTambahan extends Entity{ 

	var $query;

	function RiwayatTugasTambahan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("JABATAN_TAMBAHAN_ID", $this->getNextId("JABATAN_TAMBAHAN_ID", "jabatan_tambahan")); 

		$str = "
		INSERT INTO jabatan_tambahan 
		(
			JABATAN_TAMBAHAN_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, NO_SK, ESELON_ID
			, TANGGAL_SK, TMT_JABATAN, TMT_ESELON, NAMA, NO_PELANTIKAN, KETERANGAN_BUP, TANGGAL_PELANTIKAN, TUNJANGAN
			, BULAN_DIBAYAR, SATKER_ID, TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN, TANGGAL_BERAKHIR
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("JABATAN_TAMBAHAN_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("PEJABAT_PENETAP_ID")."'
			, '".$this->getField("PEJABAT_PENETAP")."'
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("ESELON_ID")."
			, ".$this->getField("TANGGAL_SK")."
			, ".$this->getField("TMT_JABATAN")."
			, ".$this->getField("TMT_ESELON")."
			, '".$this->getField("NAMA")."'
			, '".$this->getField("NO_PELANTIKAN")."'
			, '".$this->getField("KETERANGAN_BUP")."'
			, ".$this->getField("TANGGAL_PELANTIKAN")."
			, ".$this->getField("TUNJANGAN")."
			, ".$this->getField("BULAN_DIBAYAR")."
			, '".$this->getField("SATKER_ID")."'
			, ".$this->getField("TMT_JABATAN_FUNGSIONAL")."
			, ".$this->getField("TMT_TUGAS_TAMBAHAN")."
			, ".$this->getField("TANGGAL_BERAKHIR")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->id= $this->getField("JABATAN_TAMBAHAN_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("jabatan_tambahan", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE jabatan_tambahan
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, PEJABAT_PENETAP_ID= '".$this->getField("PEJABAT_PENETAP_ID")."'
			, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
			, NO_SK= '".$this->getField("NO_SK")."'
			, ESELON_ID= ".$this->getField("ESELON_ID")."
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TMT_JABATAN= ".$this->getField("TMT_JABATAN")."
			, TMT_ESELON= ".$this->getField("TMT_ESELON")."
			, NAMA= '".$this->getField("NAMA")."'
			, NO_PELANTIKAN= '".$this->getField("NO_PELANTIKAN")."'
			, KETERANGAN_BUP= '".$this->getField("KETERANGAN_BUP")."'
			, TANGGAL_PELANTIKAN= ".$this->getField("TANGGAL_PELANTIKAN")."
			, TUNJANGAN= ".$this->getField("TUNJANGAN")."
			, BULAN_DIBAYAR= ".$this->getField("BULAN_DIBAYAR")."
			, SATKER_ID= '".$this->getField("SATKER_ID")."'
			, TMT_JABATAN_FUNGSIONAL= ".$this->getField("TMT_JABATAN_FUNGSIONAL")."
			, TMT_TUGAS_TAMBAHAN= ".$this->getField("TMT_TUGAS_TAMBAHAN")."
			, TANGGAL_BERAKHIR= ".$this->getField("TANGGAL_BERAKHIR")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE JABATAN_TAMBAHAN_ID= '".$this->getField("JABATAN_TAMBAHAN_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("jabatan_tambahan", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM jabatan_tambahan
        WHERE JABATAN_TAMBAHAN_ID = '".$this->getField("JABATAN_TAMBAHAN_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("jabatan_tambahan", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			JABATAN_TAMBAHAN_ID, PEGAWAI_ID, a.PEGAWAI_ID ID_PEGAWAI
			,
			(
				SELECT x.TIPE_PEGAWAI_ID 
				FROM PEGAWAI x
				WHERE x.PEGAWAI_ID = a.PEGAWAI_ID
			) TIPE_PEGAWAI
			, A.SATKER_ID, A.JABATAN_FUNGSIONAL_ID, C.NAMA NAMA_FUNG, NO_SK, a.ESELON_ID, B.NAMA ESELON, PEJABAT_PENETAP
			, TANGGAL_SK, TMT_JABATAN, TMT_ESELON, a.NAMA, NO_PELANTIKAN,  KETERANGAN_BUP
			, TANGGAL_PELANTIKAN, a.TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, TANGGAL_UPDATE
			,
			case when PEJABAT_PENETAP= NULL then (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID) else  PEJABAT_PENETAP end NMPEJABATPENETAP
			, FOTO_BLOB, TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN,A.TANGGAL_BERAKHIR
		FROM jabatan_tambahan A
		LEFT JOIN eselon B ON a.ESELON_ID = B.ESELON_ID
		LEFT JOIN jabatan_fungsional C ON a.JABATAN_FUNGSIONAL_ID = C.JABATAN_FUNGSIONAL_ID
		WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_JABATAN ";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>