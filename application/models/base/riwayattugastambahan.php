<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatTugasTambahan extends Entity{ 

	var $query;

	function RiwayatTugasTambahan()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT JABATAN_TAMBAHAN_ID, PEGAWAI_ID, a.PEGAWAI_ID AS ID_PEGAWAI,
                   (SELECT x.TIPE_PEGAWAI_ID 
                    FROM PEGAWAI x
                    WHERE x.PEGAWAI_ID = a.PEGAWAI_ID
                   ) TIPE_PEGAWAI,
                   a.SATKER_ID,
                   A.JABATAN_FUNGSIONAL_ID, C.NAMA NAMA_FUNG, NO_SK, a.ESELON_ID, B.NAMA ESELON, PEJABAT_PENETAP,
                   TANGGAL_SK, TMT_JABATAN, 
                   TMT_ESELON, a.NAMA, NO_PELANTIKAN,  KETERANGAN_BUP,
                   TANGGAL_PELANTIKAN, a.TUNJANGAN, KREDIT, BULAN_DIBAYAR, SUDAH_DIBAYAR, TANGGAL_UPDATE,
                   case when PEJABAT_PENETAP= NULL then (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID) else  PEJABAT_PENETAP end NMPEJABATPENETAP,
                   FOTO_BLOB, TMT_JABATAN_FUNGSIONAL, TMT_TUGAS_TAMBAHAN,A.TANGGAL_BERAKHIR
                FROM JABATAN_TAMBAHAN a
                LEFT JOIN  ESELON B ON a.ESELON_ID = B.ESELON_ID
				LEFT JOIN  JABATAN_FUNGSIONAL C ON a.JABATAN_FUNGSIONAL_ID = C.JABATAN_FUNGSIONAL_ID
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