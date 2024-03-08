<? 
  include_once(APPPATH.'/models/Entity.php');

  class TrigerCpnsPnsPangkatGajiTambahan extends Entity{ 

	var $query;

    function TrigerCpnsPnsPangkatGajiTambahan()
	{
      $this->Entity(); 
    }

    function setTriger()
    {
    	$str = "SELECT validasi.cpns_pns_pangkat_gaji_tambahan('".$this->getField("MODE")."', ".$this->getField("PEGAWAI_ID").")";

    	$this->select($str);
    	$this->query = $str;
    }	    
  } 
?>