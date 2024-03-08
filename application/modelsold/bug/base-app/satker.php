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

class Satker extends Entity{ 

	var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function Satker()
	{
      $this->Entity(); 
    }
	
	function insert()
	{
		
		/*Auto-generate primary key(s) by next max value (integer) */
		//$this->setField("SATKER_ID", getMaxIdTree($this->getField("SATKER_ID_PARENT"))); 

		$str = "INSERT INTO SATKER (
				   SATKER_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID_PARENT, 
				   KODE, NAMA, SIFAT, 
				   ALAMAT, TELEPON, FAXIMILE, 
				   KODEPOS, EMAIL, ESELON_ID, KEPALA_JABATAN) 
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
				  ".$this->getField("ESELON_ID").",
				  '".$this->getField("KEPALA_JABATAN")."'
				)"; 
		//echo $str;exit;
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update($var="")
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE SATKER
				SET    
					";
		if($var == 'alamat'){
		$str .="
					   PROPINSI_ID      = ".$this->getField("PROPINSI_ID").",
					   KABUPATEN_ID    	= ".$this->getField("KABUPATEN_ID").",
					   KECAMATAN_ID     = ".$this->getField("KECAMATAN_ID").",
					   KELURAHAN_ID     = ".$this->getField("KELURAHAN_ID").",					   
					   ALAMAT        	= '".$this->getField("ALAMAT")."',
					   TELEPON       	= '".$this->getField("TELEPON")."',
					   FAXIMILE      	= '".$this->getField("FAXIMILE")."',
					   KODEPOS   		= '".$this->getField("KODEPOS")."',
					   EMAIL            = '".$this->getField("EMAIL")."'
		";
		}
		if($var == 'satker'){
		$str .="		
					   NAMA       = '".$this->getField("NAMA")."',
					   SIFAT      = '".$this->getField("SIFAT")."',
					   ESELON_ID  = ".$this->getField("ESELON_ID").",
					   PANGKAT_ID = ".$this->getField("PANGKAT_ID").",
					   KEPALA_JABATAN= '".$this->getField("KEPALA_JABATAN")."',
					   PEGAWAI_ID = ".$this->getField("PEGAWAI_ID")."
					   
		";
		}
		
		$str .="
				WHERE  SATKER_ID          = '".$this->getField("SATKER_ID")."'
				"; 
		
		//echo $str;exit;
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function updateKepalaJabatan()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE SATKER
				SET
				KEPALA_JABATAN= '".$this->getField("KEPALA_JABATAN")."'
				WHERE SATKER_ID= '".$this->getField("SATKER_ID")."'
				";
		
		//echo $str;exit;
		$this->query = $str;
		return $this->execQuery($str);
    }
	 
	function updateLokasiKerja()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE SATKER
				SET    
					   PROPINSI_ID      = ".$this->getField("PROPINSI_ID").",
					   KABUPATEN_ID    	= ".$this->getField("KABUPATEN_ID").",
					   KECAMATAN_ID    	= ".$this->getField("KECAMATAN_ID").",
					   KELURAHAN_ID    	= ".$this->getField("KELURAHAN_ID").",				   				
					   ALAMAT        	= '".$this->getField("ALAMAT")."',
					   TELEPON       	= '".$this->getField("TELEPON")."',
					   FAXIMILE      	= '".$this->getField("FAXIMILE")."',
					   KODEPOS   		= '".$this->getField("KODEPOS")."',
					   EMAIL            = '".$this->getField("EMAIL")."',
					   KODE= '".$this->getField("KODE")."',
					   WEB= '".$this->getField("WEB")."'
				WHERE  SATKER_ID        = '".$this->getField("SATKER_ID")."'
				"; 
		//echo $str;
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM SATKER
                WHERE 
                  SATKER_ID = '".$this->getField("SATKER_ID")."'"; 
				  
		$this->query = $str;
        //return $this->execQuery($str);
    }
	
	function deleteAll()
	{
        $str = "DELETE FROM SATKER
                WHERE 
                  SATKER_ID LIKE '".$this->getField("SATKER_ID")."%'"; 
		//echo $str;exit;
		$this->query = $str;
        return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","KECAMATAN_ID"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
	function selectByParamsPejabat($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT  C.ESELON_ID, A.PEGAWAI_ID, NIP_LAMA, AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU, GELAR_DEPAN ||  (CASE GELAR_DEPAN WHEN NULL THEN '' ELSE ' ' END) || A.NAMA || (CASE GELAR_BELAKANG WHEN NULL THEN '' ELSE ' ' END) || GELAR_BELAKANG NAMA,
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
                     A.PEGAWAI_ID = B.PEGAWAI_ID(+) AND
                     A.PEGAWAI_ID = C.PEGAWAI_ID(+) AND
                     A.PEGAWAI_ID = F.PEGAWAI_ID(+) AND
        			 A.STATUS_PEGAWAI IN (1,2) "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
				
		$str .= $statement." ";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }
	
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{//AMBIL_SATKER_NAMA_DYNAMIC(A.SATKER_ID) SATKER_FULL,
		$str = "
				SELECT SATKER_ID, PROPINSI_ID, KABUPATEN_ID, 
                   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID_PARENT, 
                   KODE KODE_SATKER, NAMA, SIFAT, WEB,
				   ALAMAT, TELEPON, FAXIMILE, 
                   KODEPOS, EMAIL, KEPALA_JABATAN, A.PANGKAT_ID,
				   AMBIL_SATKER_NAMA_DYNAMIC(A.SATKER_ID) SATKER_FULL, AMBIL_SATKER_NAMA(A.SATKER_ID) SATKER_NAMA,
                   A.ESELON_ID, (SELECT B.NAMA FROM ESELON B WHERE A.ESELON_ID = B.ESELON_ID) ESELON, 
                   A.PEGAWAI_ID PEGAWAI_ID, (SELECT C.NAMA FROM PEGAWAI C WHERE A.PEGAWAI_ID = C.PEGAWAI_ID) NAMA_PEGAWAI,
                    (SELECT C.NIP_BARU FROM PEGAWAI C WHERE A.PEGAWAI_ID = C.PEGAWAI_ID) NIP_BARU,
                     (SELECT D.NAMA FROM PANGKAT D WHERE A.PANGKAT_ID = D.PANGKAT_ID) NAMA_PANGKAT,
                     (SELECT D.KODE FROM PANGKAT D WHERE A.PANGKAT_ID = D.PANGKAT_ID) KODE,  TMT_JABATAN
                FROM SATKER A                
                WHERE SATKER_ID IS NOT NULL
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY SATKER_ID ASC";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsSatkerCombo($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT SATKER_ID, A.NAMA, SIFAT, CASE SIFAT WHEN '1' THEN 'Wakil Kepala' WHEN '2' THEN 'Sekretariat/TU' WHEN '3' THEN 'Bawahan' ELSE 'Fungsional' END SIFAT_NAMA
				, A.ESELON_ID, B.NAMA ESELON_NAMA
				, CONCAT('<a onClick=\"window.top.OpenDHTMLPopUp(''master_satker_add.php?reqMode=insert&reqParamKey=',A.SATKER_ID,'''', ',''SIMPEG - Sistem Informasi Kepegawaian''', ',''880'',', '''495'')\" title=\"Tambah Sub-item\"><img src=\"images/icn_add.gif\"></a><a onClick=\"window.top.OpenDHTMLPopUp(''master_satker_add.php?reqMode=update&reqParamKey=',A.SATKER_ID,'''', ',''SIMPEG - Sistem Informasi Kepegawaian''', ',''880'',', '''495'')\" title=\"Edit Skpd\"><img src=\"images/icn_edit.gif\"></a><a href=\"javascript:confirmAction(''?reqMode=delete&reqParamKey=',A.SATKER_ID, ''',''1'')\" title=\"Delete\"><img src=\"images/icn_delete.png\"') LINK_URL
				FROM SATKER A
				LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
				WHERE 1=1
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY SATKER_ID ASC";
		$this->query = $str;
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function getCountByParamsSatkerCombo($paramsArray=array(), $statement="")
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT 
		FROM SATKER A
		LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
		WHERE 1=1 "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement;
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
	
	function selectByParamsSatkerPilih($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT SATKER_ID, A.NAMA SATKER_NAMA, AMBIL_SATKER_NAMA(A.SATKER_ID) NAMA, SIFAT, CASE SIFAT WHEN '1' THEN 'Wakil Kepala' WHEN '2' THEN 'Sekretariat/TU' WHEN '3' THEN 'Bawahan' ELSE 'Fungsional' END SIFAT_NAMA
				, A.ESELON_ID, B.NAMA ESELON_NAMA
				, CONCAT('<input type=''button'' value=''Pilih'' onClick=\"pilihSatker(''',SATKER_ID,''',''',AMBIL_SATKER_NAMA(A.SATKER_ID),''');\">') LINK_URL
				, CASE WHEN KEPALA_JABATAN != '' AND KEPALA_JABATAN IS NOT NULL
				THEN CONCAT('<input type=''button'' value=''Pilih'' onClick=\"pilihSatker(''',SATKER_ID,''',''',A.KEPALA_JABATAN,''');\">') END LINK_URL_JABATAN
				FROM SATKER A
				LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
				WHERE 1=1
				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY SATKER_ID ASC";
		$this->query = $str;
		//echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function getCountByParamsSatkerPilih($paramsArray=array(), $statement="")
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT 
		FROM SATKER A
		LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
		WHERE 1=1 "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement;
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
	
	function selectMaxIdSatker($satker_id)
	{
		$str = "SELECT SATKER_GENERATE('".$satker_id."') LASTID
				";
		$this->select($str); 
		//echo $str;
		if($this->firstRow()) 
			return $this->getField("LASTID"); 
		else 
			return $satker_id."01"; 
	}
	function selectByParamsEdit($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT A.SATKER_ID, A.PROPINSI_ID, A.KABUPATEN_ID, 
				   AMBIL_PROPINSI(A.PROPINSI_ID) NMPROPINSI,
				   AMBIL_KABUPATEN(A.PROPINSI_ID, A.KABUPATEN_ID) NMKABUPATEN,
				   AMBIL_KECAMATAN(A.PROPINSI_ID, A.KABUPATEN_ID, A.KECAMATAN_ID) NMKECAMATAN,
				   AMBIL_KELURAHAN(A.PROPINSI_ID, A.KABUPATEN_ID, A.KECAMATAN_ID, B.KELURAHAN_ID) NMKELURAHAN,
				   AMBIL_SATKER(A.SATKER_ID) NMSATKER,
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
    
	function selectByParamsLike($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT SATKER_ID, PROPINSI_ID, KABUPATEN_ID, 
				   KECAMATAN_ID, KELURAHAN_ID, SATKER_ID_PARENT, 
				   KODE, NAMA, SIFAT, 
				   ALAMAT, TELEPON, FAXIMILE, 
				   KODEPOS, EMAIL
				FROM SATKER WHERE SATKER_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY KODE ASC";
		//echo $str;
		return $this->selectLimit($str,$limit,$from); 
    }	
    /** 
    * Hitung jumlah record berdasarkan parameter (array). 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","KECAMATAN_ID"=>"yyy") 
    * @return long Jumlah record yang sesuai kriteria 
    **/ 
    function getCountByParamsSatkerId($statement="")
	{
		$str = "SELECT SATKER_ID AS ROWCOUNT FROM SATKER A WHERE 1=1 ".$statement;
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return "";
    }
	
	function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(SATKER_ID) AS ROWCOUNT FROM SATKER WHERE SATKER_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }

    function getCountByParamsLike($paramsArray=array())
	{
		$str = "SELECT COUNT(SATKER_ID) AS ROWCOUNT FROM SATKER WHERE SATKER_ID IS NOT NULL "; 
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
	
	function getMaxIdTree($satker_id)
	{
		$str = "SELECT SATKER_GENERATE('".$satker_id."') ROWCOUNT "; 

		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
  } 
?>