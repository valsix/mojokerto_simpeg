<? 
include_once(APPPATH.'/models/Entity.php');

class Penghargaan extends Entity{ 

	var $query;

	function Penghargaan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PENGHARGAAN_ID", $this->getNextId("PENGHARGAAN_ID","PENGHARGAAN")); 

		$str = "INSERT INTO PENGHARGAAN (
				   PENGHARGAAN_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP,
				   NAMA, NO_SK, TANGGAL_SK, 
				   TAHUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("PENGHARGAAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("PEJABAT_PENETAP_ID")."',
				  '".$this->getField("PEJABAT_PENETAP")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("TAHUN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE PENGHARGAAN
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP_ID    = '".$this->getField("PEJABAT_PENETAP_ID")."',
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   NO_SK     = '".$this->getField("NO_SK")."',
					   TANGGAL_SK    = ".$this->getField("TANGGAL_SK").",
					   TAHUN    = '".$this->getField("TAHUN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PENGHARGAAN_ID          = '".$this->getField("PENGHARGAAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM PENGHARGAAN
                WHERE 
                  PENGHARGAAN_ID = '".$this->getField("PENGHARGAAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PENGHARGAAN_ID, PEGAWAI_ID, 
				case 
				when PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
				else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID, 
				NAMA, NO_SK, TANGGAL_SK,TAHUN, 
				case when PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
				else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID,
			   	(SELECT x.NAMA 
                FROM PEJABAT_PENETAP x
                WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
               	) NMPEJABAT,
               	case when NAMA = '1' then 'Satya Lencana Karya Satya X (Perunggu)'
               	when NAMA = '2' then 'Satya Lencana Karya Satya XX (Perak)'
               	when NAMA = '3' then 'Satya Lencana Karya Satya XXX (Emas)'
               	end  NMPENGHARGAAN,
               	(SELECT x.JABATAN 
                FROM PEJABAT_PENETAP x
                WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
               	) NMPEJABATPENETAP, FOTO_BLOB
				FROM PENGHARGAAN a WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TAHUN, TANGGAL_SK ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>