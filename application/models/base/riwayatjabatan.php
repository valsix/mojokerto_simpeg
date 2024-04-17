<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatJabatan extends Entity{ 

	var $query;

	function RiwayatJabatan()
	{
		$this->Entity(); 
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