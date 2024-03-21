<? 
include_once(APPPATH.'/models/Entity.php');

class Saudara extends Entity{ 

	var $query;

	function Saudara()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT SAUDARA_ID, PEGAWAI_ID, NAMA, 
				   TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, 
				   PEKERJAAN, ALAMAT, KODEPOS, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
				   TELEPON, a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID,
				   (SELECT x.NAMA FROM PROPINSI x WHERE x.PROPINSI_ID = a.PROPINSI_ID) NMPROPINSI,
				   AMBIL_KABUPATEN(a.PROPINSI_ID, a.KABUPATEN_ID) NMKABUPATEN,
				   AMBIL_KECAMATAN(a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID) NMKECAMATAN,
				   AMBIL_KELURAHAN(a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID) NMKELURAHAN
				FROM SAUDARA a WHERE 1=1"; 
		
		$str .= $statement." ORDER BY TANGGAL_LAHIR asc";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>