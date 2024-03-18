<? 
include_once(APPPATH.'/models/Entity.php');

class LokasiKerja extends Entity{ 

	var $query;

	function LokasiKerja()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by SATKER_ID asc')
	{
		$str = "SELECT A.SATKER_ID, A.PROPINSI_ID, A.KABUPATEN_ID, 
				   AMBIL_PROPINSI(A.PROPINSI_ID) NMPROPINSI,
				   AMBIL_KABUPATEN(A.PROPINSI_ID, A.KABUPATEN_ID) NMKABUPATEN,
				   AMBIL_KECAMATAN(A.PROPINSI_ID, A.KABUPATEN_ID, A.KECAMATAN_ID) NMKECAMATAN,
				   AMBIL_KELURAHAN(A.PROPINSI_ID, A.KABUPATEN_ID, A.KECAMATAN_ID, B.KELURAHAN_ID) NMKELURAHAN,
				   AMBIL_SATKER(A.SATKER_ID) NMSATKER,
				   AMBIL_SATKER_NAMA_DYNAMIC(A.SATKER_ID) NMSATKERDETIL,
                   A.KECAMATAN_ID, A.KELURAHAN_ID, A.SATKER_ID_PARENT, 
                   A.KODE, A.NAMA, SIFAT, 
                   A.ALAMAT, A.TELEPON, A.FAXIMILE, 
                   A.KODEPOS, A.EMAIL
                FROM SATKER A
                JOIN PEGAWAI B ON A.SATKER_ID = B.SATKER_ID 
                WHERE A.SATKER_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY SATKER_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>