<? 
  include_once(APPPATH.'/models/Entity.php');

  class HapusData extends Entity{ 

    var $query;
    function HapusData()
    {
      $this->Entity(); 
    }

  function insertHapusData()
  {
    $this->setField("HAPUS_DATA_ID", $this->getNextId("HAPUS_DATA_ID","validasi.HAPUS_DATA")); 
    
        $str = "
        INSERT INTO validasi.HAPUS_DATA (
           HAPUS_DATA_ID, TEMP_VALIDASI_ID, HAPUS_NAMA, 
           LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
        VALUES (
          ".$this->getField("HAPUS_DATA_ID").",
          ".$this->getField("TEMP_VALIDASI_ID").",
          '".$this->getField("HAPUS_NAMA")."',
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
      UPDATE validasi.HAPUS_DATA
      SET    
      PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
      WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
      "; 
      $this->query = $str;
      return $this->execQuery($str);
    }

    function delete()
    {
      $str = "DELETE FROM validasi.HAPUS_DATA
      WHERE 
      TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
      AND HAPUS_NAMA= '".$this->getField("HAPUS_NAMA")."'
      "; 

      $this->query = $str;
      return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
      SELECT HAPUS_DATA_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.PENDIDIKAN_ID, 
      A.NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
      JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN, 
      PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR, 
      B.NAMA NMPENDIDIKAN,
      CASE WHEN STATUS_KELUARGA = 1 THEN 'Kandung' WHEN STATUS_KELUARGA = 2 THEN 'Tiri' ELSE  'Angkat' END KELUARGA,
      CASE WHEN STATUS_KELUARGA = 1 THEN 'AK' WHEN STATUS_KELUARGA = 2 THEN 'AT' ELSE 'AA' END KELUARGA_LAP,
      CASE WHEN STATUS_TUNJANGAN = 1 THEN 'Dapat' ELSE 'Tidak' END TUNJANGAN,
      CASE WHEN JENIS_KELAMIN = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END KELAMIN
      ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
      FROM validasi.validasi_pegawai_anak A
      LEFT JOIN PENDIDIKAN B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID
      WHERE 1 = 1
      "; 

      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ".$sOrder;
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>