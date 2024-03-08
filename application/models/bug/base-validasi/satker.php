<? 
  include_once(APPPATH.'/models/Entity.php');

  class Satker extends Entity{ 

    var $query;
    function Satker()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
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

      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>