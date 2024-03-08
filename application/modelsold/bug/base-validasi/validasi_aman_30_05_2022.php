<? 
  include_once(APPPATH.'/models/Entity.php');

  class Validasi extends Entity{ 

    var $query;
    function Validasi()
    {
      $this->Entity(); 
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.PEGAWAI_ID, A.FORM_FIP ASC")
  {
    $str= "
   SELECT
    A.PEGAWAI_ID, A.SATKER_ID, A.VALIDASI, CASE WHEN A.VALIDASI = 0 THEN 'DITOLAK' WHEN A.VALIDASI = 1 THEN 'VALIDASI' ELSE 'BELUM VALIDASI' END VALIDASI_INFO, A.NIP_BARU_VIEW, A.GROUP_NAMA, 
    A.SATKER, A.FORM_FIP, A.TIPE_PERUBAHAN_DATA, A.TANGGAL_PROSES, A.TANGGAL_VALIDASI,A.LINK_FORM,A.ROW_ID,TEMP_VALIDASI_ID
    FROM
    (
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Anak' FORM_FIP,
      CASE WHEN  A.ANAK_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_anak_add' LINK_FORM,A.ANAK_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.ANAK A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Anak' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_anak_add' LINK_FORM,B.ANAK_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN ANAK B ON A.TEMP_VALIDASI_ID = B.ANAK_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'ANAK'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Penguasaan Bahasa' FORM_FIP,
      CASE WHEN  A.BAHASA_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_bahasa_add' LINK_FORM,A.BAHASA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.BAHASA A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Penguasaan Bahasa' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_bahasa_add' LINK_FORM,B.BAHASA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN BAHASA B ON A.TEMP_VALIDASI_ID = B.BAHASA_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'BAHASA'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Cuti' FORM_FIP,
      CASE WHEN  A.CUTI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_cuti_add' LINK_FORM,A.CUTI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.CUTI A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Cuti' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_cuti_add' LINK_FORM,B.CUTI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN CUTI B ON A.TEMP_VALIDASI_ID = B.CUTI_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'CUTI'     
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Hukuman' FORM_FIP,
      CASE WHEN  A.HUKUMAN_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_hukuman_add' LINK_FORM,A.HUKUMAN_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HUKUMAN A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Hukuman' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_hukuman_add' LINK_FORM,B.HUKUMAN_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN HUKUMAN B ON A.TEMP_VALIDASI_ID = B.HUKUMAN_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'HUKUMAN'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Kursus' FORM_FIP,
      CASE WHEN  A.KURSUS_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_kursus_add' LINK_FORM,A.KURSUS_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.KURSUS A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Kursus' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_kursus_add' LINK_FORM,B.KURSUS_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN KURSUS B ON A.TEMP_VALIDASI_ID = B.KURSUS_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'KURSUS'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Organisasi' FORM_FIP,
      CASE WHEN  A.ORGANISASI_RIWAYAT_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_organisasi_add' LINK_FORM,A.ORGANISASI_RIWAYAT_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.ORGANISASI_RIWAYAT A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Organisasi' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_organisasi_add' LINK_FORM,B.ORGANISASI_RIWAYAT_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN ORGANISASI_RIWAYAT B ON A.TEMP_VALIDASI_ID = B.ORGANISASI_RIWAYAT_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'ORGANISASI_RIWAYAT'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Penghargaan' FORM_FIP,
      CASE WHEN  A.PENGHARGAAN_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penghargaan_add' LINK_FORM,A.PENGHARGAAN_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PENGHARGAAN A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Penghargaan' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penghargaan_add' LINK_FORM,B.PENGHARGAAN_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN PENGHARGAAN B ON A.TEMP_VALIDASI_ID = B.PENGHARGAAN_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'PENGHARGAAN'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Penilaian Potensi Diri' FORM_FIP,
      CASE WHEN  A.POTENSI_DIRI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penilaian_potensi_add' LINK_FORM,A.POTENSI_DIRI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.POTENSI_DIRI A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'FIP - 02, Penilaian Potensi Diri' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penilaian_potensi_add' LINK_FORM,B.POTENSI_DIRI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN POTENSI_DIRI B ON A.TEMP_VALIDASI_ID = B.POTENSI_DIRI_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'POTENSI_DIRI'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'Lain-lain, Penilaian Prestasi Kerja (SKP)' FORM_FIP,
      CASE WHEN  A.PENILAIAN_KERJA_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penilaian_prestasi_add' LINK_FORM,A.PENILAIAN_KERJA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PENILAIAN_KERJA A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      UNION ALL
      SELECT B.PEGAWAI_ID, C.SATKER_ID, A.VALIDASI,
      C.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(C.NIP_BARU),'') || ' - ' || C.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(C.SATKER_ID) SATKER,
      'Lain-lain, Penilaian Prestasi Kerja (SKP)' FORM_FIP,
      'HAPUS DATA' TIPE_PERUBAHAN_DATA,
      A.LAST_CREATE_DATE TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_penilaian_prestasi_add' LINK_FORM,B.PENILAIAN_KERJA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.HAPUS_DATA A
      INNER JOIN PENILAIAN_KERJA B ON A.TEMP_VALIDASI_ID = B.PENILAIAN_KERJA_ID
      INNER JOIN PEGAWAI C ON C.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE A.HAPUS_NAMA = 'PENILAIAN_KERJA'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Tambahkan Masa Kerja' FORM_FIP,
      CASE WHEN  A.TAMBAHAN_MASA_KERJA_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/tambahan_masa_kerja' LINK_FORM,A.TAMBAHAN_MASA_KERJA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.TAMBAHAN_MASA_KERJA A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Suami Istri' FORM_FIP,
      CASE WHEN  A.SUAMI_ISTRI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_suami_istri_add' LINK_FORM,A.SUAMI_ISTRI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.SUAMI_ISTRI A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
      AND CASE WHEN A.SUAMI_ISTRI_ID IS NULL THEN 1 ELSE (SELECT 1 FROM SUAMI_ISTRI X WHERE X.SUAMI_ISTRI_ID = A.SUAMI_ISTRI_ID) END = 1
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Orang Tua Laki - Laki' FORM_FIP,
      CASE WHEN  A.ORANG_TUA_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_orang_tua' LINK_FORM,A.ORANG_TUA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.ORANG_TUA A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1 AND A.JENIS_KELAMIN = 'L'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Orang Tua Perempuan' FORM_FIP,
      CASE WHEN  A.ORANG_TUA_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_orang_tua' LINK_FORM,A.ORANG_TUA_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.ORANG_TUA A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1 AND A.JENIS_KELAMIN = 'P'
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP , Diklat' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_diklat_add' LINK_FORM,A.PEGAWAI_DIKLAT_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PEGAWAI_DIKLAT A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 01, Identitas Pegawai' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_data' LINK_FORM,A.PEGAWAI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PEGAWAI A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
   UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Jabatan' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_jabatan_tipe_add' LINK_FORM,A.PEGAWAI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PEGAWAI_JABATAN A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Riwayat Kontrak' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_riwayat_kontrak_add' LINK_FORM,A.PEGAWAI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.RIWAYAT_KONTRAK A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
   UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, Riwayat Pendidikan' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/riwayat_pendidikan_add' LINK_FORM,A.PEGAWAI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PEGAWAI_PENDIDIKAN_RIWAYAT A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
	  
	UNION ALL
      SELECT A.PEGAWAI_ID, B.SATKER_ID, A.VALIDASI,
      B.NIP_BARU NIP_BARU_VIEW,
      COALESCE(AMBIL_FORMAT_NIP_BARU(B.NIP_BARU),'') || ' - ' || B.NAMA GROUP_NAMA,
      AMBIL_SATKER_NAMA(B.SATKER_ID) SATKER,
      'FIP - 02, SKP Pegawai' FORM_FIP,
      CASE WHEN  A.PEGAWAI_ID IS NULL THEN 'TAMBAH DATA' ELSE 'UBAH DATA' END TIPE_PERUBAHAN_DATA,
      COALESCE(A.LAST_UPDATE_DATE, A.LAST_CREATE_DATE) TANGGAL_PROSES, 
      A.TANGGAL_VALIDASI,
      'app/index/pegawai_skp_add' LINK_FORM,A.PEGAWAI_ID ROW_ID,TEMP_VALIDASI_ID
      FROM VALIDASI.PENILAIAN_KERJA_PEGAWAI A
      INNER JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
      WHERE 1=1
    ) A
    WHERE 1=1
    --AND ROW_ID IS NULL 
    "; 
    
    while(list($key,$val) = each($paramsArray))
    {
      $str .= " AND $key = '$val' ";
    }
    
    $str .= $statement." ".$sOrder;
    $this->query = $str;
        
    return $this->selectLimit($str,$limit,$from); 
    }

    function updateJabatanTipe()
      {
            $str = "
                        UPDATE validasi.PEGAWAI_JABATAN
                        SET    
                                 PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
                                 ESELON_ID    = ".$this->getField("ESELON_ID").",
                                 JENIS_JABATAN_ID             = ".$this->getField("JENIS_JABATAN_ID").",
                                 TIPE_PEGAWAI_NEW_ID     = '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
                                 JABATAN_FUNGSIONAL_NEW_ID     = '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
                                 JABATAN_PELAKSANA_NEW_ID     = '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
                                 JABATAN_STRUKTURAL_NEW_ID     = '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
                                 BUP     = ".$this->getField("BUP").",
                                 KELAS_JABATAN     = ".$this->getField("KELAS_JABATAN").",
                                 TMT_JABATAN     = ".$this->getField("TMT_JABATAN").",
                                 TANGGAL_SK     = ".$this->getField("TANGGAL_SK").",
                                 NO_SK     = '".$this->getField("NO_SK")."',
                                 TUGAS_TAMBAHAN_ID     = '".$this->getField("TUGAS_TAMBAHAN_ID")."',
                                 TUGAS_TAMBAHAN_NAMA     = '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
                                 VALIDASI = ".$this->getField("VALIDASI").",
                                 LAST_UPDATE_USER     = '".$this->getField("LAST_UPDATE_USER")."',
                                 LAST_UPDATE_DATE     = ".$this->getField("LAST_UPDATE_DATE").",
                                 LAST_UPDATE_SATKER   = '".$this->getField("LAST_UPDATE_SATKER")."',
                                 TANGGAL_VALIDASI= NOW()
                        WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
                        "; 
                        $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
    }

    function selectByParamsJabatanTipe($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
            SELECT PEGAWAI_JABATAN_ID, PEGAWAI_ID, A.ESELON_ID, A.JENIS_JABATAN_ID, 
            A.TIPE_PEGAWAI_NEW_ID, A.JABATAN_FUNGSIONAL_NEW_ID, A.JABATAN_PELAKSANA_NEW_ID, 
            A.JABATAN_STRUKTURAL_NEW_ID, A.BUP, A.KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, 
            NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA, VALIDASI, 
            VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI, 
            TEMP_VALIDASI_ID,B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA
            FROM validasi.validasi_pegawai_jabatan A
            LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
            LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
            LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
            LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
            LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
            LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
            WHERE 1=1
      "; 

      while(list($key,$val) = each($paramsArray))
      {
            $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ".$sOrder;
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

    function updatevalidasiAnak()
    {
            $str = "
            UPDATE validasi.ANAK
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
            NAMA= '".$this->getField("NAMA")."',
            TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
            TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
            JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
            STATUS_KELUARGA= ".$this->getField("STATUS_KELUARGA").",
            STATUS_TUNJANGAN= ".$this->getField("STATUS_TUNJANGAN").",
            PEKERJAAN= '".$this->getField("PEKERJAAN")."',
            AWAL_BAYAR= ".$this->getField("AWAL_BAYAR").",
            AKHIR_BAYAR= ".$this->getField("AKHIR_BAYAR").",
            TANGGAL_UPDATE= NOW() ,
            FOTO= '".$this->getField("FOTO")."',
            VALIDASI    = ".$this->getField("VALIDASI").",
            USER_APP_ID= ".$this->getField("USER_APP_ID").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                              // echo $str;exit;
            return $this->execQuery($str);
    }

     function selectByParamsAnak($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT ANAK_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.PENDIDIKAN_ID, 
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

    function updatebahasa()
      {
            $str = "          
            UPDATE validasi.BAHASA
            SET    
            PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
            JENIS    = '".$this->getField("JENIS")."',
            NAMA             = '".$this->getField("NAMA")."',
            KEMAMPUAN     = '".$this->getField("KEMAMPUAN")."',
            VALIDASI    = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER      = '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
            // echo $str;exit;
            return $this->execQuery($str);
    }

     function selectByParamsBahasa($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT BAHASA_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, JENIS, NAMA, KEMAMPUAN,
                  CASE WHEN JENIS = '1' THEN 'Asing' ELSE 'Daerah' END NMJENIS, 
                  CASE WHEN KEMAMPUAN = '1' THEN 'Aktif' ELSE 'Pasif' END MAMPU
                  ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_bahasa 
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
    }

    function updatecuti()
      {
            $str = "
            UPDATE validasi.CUTI
            SET    
            PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
            JENIS_CUTI    = ".$this->getField("JENIS_CUTI").",
            NO_SURAT             = '".$this->getField("NO_SURAT")."',
            TANGGAL_PERMOHONAN     = ".$this->getField("TANGGAL_PERMOHONAN").",
            TANGGAL_SURAT    = ".$this->getField("TANGGAL_SURAT").",
            LAMA    = ".$this->getField("LAMA").",
            TANGGAL_MULAI  = ".$this->getField("TANGGAL_MULAI").",
            TANGGAL_SELESAI = ".$this->getField("TANGGAL_SELESAI").",
            KETERANGAN        = '".$this->getField("KETERANGAN")."',
            CUTI_KETERANGAN= '".$this->getField("CUTI_KETERANGAN")."',
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER      = '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE      = ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER    = '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
    }

    function selectByParamsCuti($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT CUTI_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, JENIS_CUTI, 
               NO_SURAT, TANGGAL_PERMOHONAN, TANGGAL_SURAT, 
               LAMA, TANGGAL_MULAI, TANGGAL_SELESAI, CUTI_KETERANGAN, 
               KETERANGAN, 
               CASE JENIS_CUTI WHEN 1 THEN 'Cuti Tahunan' 
                              WHEN  2 THEN 'Cuti Besar' 
                              WHEN  3 THEN 'Cuti Sakit' 
                              WHEN  4 THEN 'Cuti Bersalin' 
                              WHEN  5 THEN 'CLTN' 
                              WHEN  6 THEN 'Perpanjangan CLTN' 
                              WHEN  7 THEN 'Cuti Menikah' 
                              ELSE 'Cuti karena alasan penting' 
                  END NMCUTI
                  ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_cuti 
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
     }

     function updatehukuman()
      {
            $str = "
            UPDATE validasi.HUKUMAN
            SET    
            PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
            PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
            PEJABAT_PENETAP_ID    = ".$this->getField("PEJABAT_PENETAP_ID").",
            JENIS_HUKUMAN_ID             = ".$this->getField("JENIS_HUKUMAN_ID").",
            TINGKAT_HUKUMAN_ID             = ".$this->getField("TINGKAT_HUKUMAN_ID").",
            PERATURAN_ID             = ".$this->getField("PERATURAN_ID").",
            NO_SK     = '".$this->getField("NO_SK")."',
            TANGGAL_SK    = ".$this->getField("TANGGAL_SK").",
            TMT_SK    = ".$this->getField("TMT_SK").",
            KETERANGAN  = '".$this->getField("KETERANGAN")."',
            BERLAKU  = ".$this->getField("BERLAKU").",
            TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
            TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER     = '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE     = ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER   = '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
     }


     function selectByParamsHukuman($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT 
            CASE
            WHEN NOW() <= a.TANGGAL_AKHIR AND NOW() >= a.TANGGAL_MULAI
            THEN 'Ya'
            ELSE 'Tidak'
            END STATUS_BERLAKU,
            HUKUMAN_ID, PEGAWAI_ID, 
            COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
            (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
            A.JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, A.TINGKAT_HUKUMAN_ID,
            TMT_SK, A.KETERANGAN, BERLAKU,
            CASE BERLAKU WHEN 1 THEN 'Ya' ELSE 'Tidak' END LAKU,
            B.JABATAN NMPEJABATPENETAP, C.NAMA NMTINGKATHUKUMAN, D.NAMA NMPERATURAN, 
            E.NAMA NMJENISHUKUMAN, A.TANGGAL_MULAI, A.TANGGAL_AKHIR
            ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_hukuman A 
            LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
            LEFT JOIN TINGKAT_HUKUMAN C ON A.TINGKAT_HUKUMAN_ID = C.TINGKAT_HUKUMAN_ID
            LEFT JOIN PERATURAN D ON A.PERATURAN_ID = D.PERATURAN_ID
            LEFT JOIN JENIS_HUKUMAN E ON A.JENIS_HUKUMAN_ID = E.JENIS_HUKUMAN_ID
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

      function updatekursus()
      {
            $str = "
                        UPDATE validasi.KURSUS
                        SET    
                                 PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
                                 TIPE= ".$this->getField("TIPE").",
                                 NAMA= '".$this->getField("NAMA")."',
                                 LAMA= ".$this->getField("LAMA").",
                                 TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
                                 NO_PIAGAM= '".$this->getField("NO_PIAGAM")."',
                                 INSTANSI_ID= ".$this->getField("INSTANSI_ID").",
                                 PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
                                 TAHUN= ".$this->getField("TAHUN").",
                                 VALIDASI = ".$this->getField("VALIDASI").",
                                 LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
                                 LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
                                 LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
                                 TANGGAL_VALIDASI= NOW()
                        WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
                        "; 
                        $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsKursus($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT KURSUS_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.NAMA,
                PENYELENGGARA, TANGGAL_MULAI, 
                NO_PIAGAM
                  , TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
                  , TIPE
                  , CASE WHEN TIPE = 1 THEN 'DIKLAT TEKNIS' WHEN TIPE = 2 THEN 'DIKLAT FUNGSIONAL' 
                    ELSE  'SEMINAR/WORKSHOP/MAGANG/SEJENISNYA' END TIPE_NAMA
                  , LAMA
                  , A.INSTANSI_ID
                  , B.NAMA INSTANSI_NAMA
                  , A.TAHUN
            FROM validasi.validasi_pegawai_kursus A
            LEFT JOIN INSTANSI B ON B.INSTANSI_ID = A.INSTANSI_ID
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

      function updateorganisasi()
      {
            $str = "
            UPDATE validasi.ORGANISASI_RIWAYAT
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            JABATAN= '".$this->getField("JABATAN")."',
            NAMA= '".$this->getField("NAMA")."',
            TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
            TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
            PIMPINAN= '".$this->getField("PIMPINAN")."',
            TEMPAT= '".$this->getField("TEMPAT")."',
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
            return $this->execQuery($str);
      }

      function selectByParamsOrganisasi($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, JABATAN, 
               NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
               PIMPINAN, TEMPAT
               ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_organisasi_riwayat
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

      function updatepenghargaan()
      {
            $str = "
                        UPDATE validasi.PENGHARGAAN
                        SET    
                                 PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
                                 PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
                                 PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
                                 NAMA= '".$this->getField("NAMA")."',
                                 NO_SK= '".$this->getField("NO_SK")."',
                                 TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
                                 TAHUN= ".$this->getField("TAHUN").",
                                 VALIDASI = ".$this->getField("VALIDASI").",
                                 LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
                                 LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
                                 LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
                                 TANGGAL_VALIDASI= NOW()
                        WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
                        "; 
                        $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsPenghargaan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT PENGHARGAAN_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, 
                  COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
                  (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
                  A.NAMA, NO_SK, TANGGAL_SK, 
                  TAHUN, B.NAMA NMPEJABAT,
                  CASE A.NAMA 
                  WHEN '1' THEN 'Satya Lencana Karya Satya X (Perunggu)' 
                  WHEN '2' THEN 'Satya Lencana Karya Satya XX (Perak)' 
                  WHEN '3' THEN 'Satya Lencana Karya Satya XXX (Emas)' 
                  ELSE A.NAMA END NMPENGHARGAAN,
                  TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
                  FROM validasi.validasi_pegawai_penghargaan A
                  LEFT JOIN PEJABAT_PENETAP B ON (A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID)
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

      function updatediklat()
      {
            $str = "
            UPDATE validasi.PEGAWAI_DIKLAT
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            NOMOR= '".$this->getField("NOMOR")."',
            TANGGAL= ".$this->getField("TANGGAL").",
            TAHUN= ".$this->getField("TAHUN").",
            DIKLAT_ID= ".$this->getField("DIKLAT_ID").",
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsDiklat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT PEGAWAI_DIKLAT_ID, A.DIKLAT_ID, PEGAWAI_ID, NOMOR, TANGGAL, TAHUN,B.NAMA DIKLAT_NAMA
            , A.TEMP_VALIDASI_ID
            , A.PERUBAHAN_DATA
            , A.TIPE_PERUBAHAN_DATA
            , A.TANGGAL_VALIDASI
            , A.VALIDASI
            , A.VALIDATOR
            FROM validasi.validasi_pegawai_diklat A
            LEFT JOIN DIKLAT B ON B.DIKLAT_ID = A.DIKLAT_ID
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
      }

      function updatepotensi()
      {
            $str = "
            UPDATE validasi.POTENSI_DIRI
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            TANGGUNG_JAWAB= '".$this->getField("TANGGUNG_JAWAB")."',
            MOTIVASI= '".$this->getField("MOTIVASI")."',
            MINAT= '".$this->getField("MINAT")."',
            TAHUN= '".$this->getField("TAHUN")."',
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsPotensi($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT POTENSI_DIRI_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, TANGGUNG_JAWAB, 
            MOTIVASI, MINAT, TAHUN
            ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_potensi_diri
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;

            return $this->selectLimit($str,$limit,$from); 
      }

      function updatemasakerja()
      {
            $str = "
            UPDATE validasi.TAMBAHAN_MASA_KERJA
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            PANGKAT_ID= ".$this->getField("PANGKAT_ID").",
            PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
            PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
            NO_SK= '".$this->getField("NO_SK")."',
            TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
            TMT_SK= ".$this->getField("TMT_SK").",
            TAHUN_TAMBAHAN= '".$this->getField("TAHUN_TAMBAHAN")."',
            BULAN_TAMBAHAN= '".$this->getField("BULAN_TAMBAHAN")."',
            TAHUN_BARU= '".$this->getField("TAHUN_BARU")."',
            BULAN_BARU= '".$this->getField("BULAN_BARU")."',
            GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsMasaKerja($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT TAMBAHAN_MASA_KERJA_ID, A.PEGAWAI_ID, A.NO_SK, 
             A.TANGGAL_SK, A.TMT_SK, A.TAHUN_TAMBAHAN, 
             A.BULAN_TAMBAHAN, A.TAHUN_BARU, A.BULAN_BARU, 
             TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
             , PANGKAT_ID, 
             COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
            (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
             COALESCE(A.PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP_INFO
             , A.GAJI_POKOK
            FROM validasi.validasi_pegawai_tambahan_masa_kerja A
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
      }

      function updatesuamiistri()
      {
            $str = "
            UPDATE validasi.SUAMI_ISTRI
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
            NAMA= '".$this->getField("NAMA")."',
            TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
            TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
            TANGGAL_KAWIN= ".$this->getField("TANGGAL_KAWIN").",
            KARTU= '".$this->getField("KARTU")."',
            SK_CERAI= '".$this->getField("SK_CERAI")."',
            BUKU_NIKAH= '".$this->getField("BUKU_NIKAH")."',
            STATUS_PNS= ".$this->getField("STATUS_PNS").",
            NIP_PNS= '".$this->getField("NIP_PNS")."',
            PEKERJAAN= '".$this->getField("PEKERJAAN")."',
            STATUS_TUNJANGAN= ".$this->getField("STATUS_TUNJANGAN").",
            STATUS_BAYAR= ".$this->getField("STATUS_BAYAR").",
            STATUS= ".$this->getField("STATUS").",
            BULAN_BAYAR= ".$this->getField("BULAN_BAYAR").",
            FOTO= '".$this->getField("FOTO")."',
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
            return $this->execQuery($str);
     }


     function selectByParamsSuamiIstri($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT SUAMI_ISTRI_ID, A.PEGAWAI_ID, A.PENDIDIKAN_ID, 
             B.GELAR_DEPAN ||  CASE B.GELAR_DEPAN WHEN NULL THEN '' ELSE ' ' END || B.NAMA || CASE B.GELAR_BELAKANG WHEN NULL THEN '' ELSE ' ' END || B.GELAR_BELAKANG NAMA_PEGAWAI,
             B.NIP_BARU NIP_PEGAWAI,
             A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, 
             A.TANGGAL_KAWIN, A.KARTU, A.BUKU_NIKAH NO_HP, A.SK_CERAI NO_AKTA_NIKAH, A.STATUS_PNS,
             CASE STATUS_PNS WHEN 1 THEN 'Ya' ELSE 'Tidak' END NMPNS,
             A.NIP_PNS, A.PEKERJAAN, A.STATUS_TUNJANGAN, 
             A.STATUS_BAYAR, A.BULAN_BAYAR,
             C.NAMA NMPENDIDIKAN, STATUS
             , CASE WHEN STATUS = '1' THEN 'nikah' WHEN STATUS = '2' THEN 'cerai' WHEN STATUS = '3' THEN 'meninggal' END STATUS_INFO
             ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,
             CASE WHEN A.FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
            FROM validasi.validasi_pegawai_suami_istri A
            LEFT JOIN PEGAWAI B ON A.PEGAWAI_ID = B.PEGAWAI_ID
            LEFT JOIN PENDIDIKAN C ON A.PENDIDIKAN_ID = C.PENDIDIKAN_ID
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
      }


      function updateorangtua()
      {
            $str = "
            UPDATE validasi.ORANG_TUA
            SET    
            PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
            JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
            NAMA= '".$this->getField("NAMA")."',
            TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
            TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
            PEKERJAAN= '".$this->getField("PEKERJAAN")."',
            ALAMAT= '".$this->getField("ALAMAT")."',
            KODEPOS= '".$this->getField("KODEPOS")."',
            PROPINSI_ID=  ".$this->getField("PROPINSI_ID").",
            KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
            KECAMATAN_ID=".$this->getField("KECAMATAN_ID").",
            KELURAHAN_ID=".$this->getField("KELURAHAN_ID").",
            TELEPON= '".$this->getField("TELEPON")."',
            VALIDASI = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            AND JENIS_KELAMIN=  '".$this->getField("JENIS_KELAMIN")."'
            "; 
            $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsAyah($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
            NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
            PEKERJAAN, ALAMAT, KODEPOS, 
            TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
            ambil_propinsi(PROPINSI_ID) PROPINSI_NAMA,
            ambil_kabupaten(PROPINSI_ID, KABUPATEN_ID) KABUPATEN_NAMA,
            ambil_kecamatan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID) KECAMATAN_NAMA,
            ambil_kelurahan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID) KELURAHAN_NAMA,
            TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_orang_tua_laki A
            WHERE 1=1
            "; 

            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }

            $str .= $statement." ".$sOrder;
            $this->query = $str;

            return $this->selectLimit($str,$limit,$from); 
      }

      function selectByParamsIbu($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
            NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
            PEKERJAAN, ALAMAT, KODEPOS, 
            TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
            ambil_propinsi(PROPINSI_ID) PROPINSI_NAMA,
            ambil_kabupaten(PROPINSI_ID, KABUPATEN_ID) KABUPATEN_NAMA,
            ambil_kecamatan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID) KECAMATAN_NAMA,
            ambil_kelurahan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID) KELURAHAN_NAMA,
            TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_orang_tua_perempuan A
            WHERE 1=1
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;

            return $this->selectLimit($str,$limit,$from); 
      }

      function updatepenilaiankerja()
      {
            $str = "
            UPDATE validasi.PENILAIAN_KERJA
            SET 
            PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
            PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
            TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
            TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
            TAHUN= ".$this->getField("TAHUN").",
            NILAI1= ".$this->getField("NILAI1").",
            NILAI2= ".$this->getField("NILAI2").",
            NILAI3= ".$this->getField("NILAI3").",
            NILAI4= ".$this->getField("NILAI4").",
            NILAI5= ".$this->getField("NILAI5").",
            NILAI6= ".$this->getField("NILAI6").",
            REKOMENDASI= '".$this->getField("REKOMENDASI")."',
            JUMLAH= ".$this->getField("JUMLAH").",
            RATA_RATA= ".$this->getField("RATA_RATA").",
            SASARAN_KERJA= ".$this->getField("SASARAN_KERJA").",
            SASARAN_KERJA_HASIL= ".$this->getField("SASARAN_KERJA_HASIL").",
            PERILAKU_HASIL= ".$this->getField("PERILAKU_HASIL").",
            NILAI_HASIL= ".$this->getField("NILAI_HASIL").",
            PEGAWAI_ID        = ".$this->getField("PEGAWAI_ID").",
            VALIDASI    = ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER      = '".$this->getField("LAST_UPDATE_SATKER")."',
            TANGGAL_VALIDASI= NOW()
            WHERE  TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
            "; 
            $this->query = $str;
            return $this->execQuery($str);
      }

      function selectByParamsPenilaiankerja($paramsArray=array(),$limit=-1,$from=-1, $statement='')
      {
            $str = "SELECT PENILAIAN_KERJA_ID, 
                        A.PEJABAT_PENETAP_ID, b.JABATAN PEJABAT_PENETAP,
                        TANGGAL_AWAL, TANGGAL_AKHIR, TANGGAL_AWAL || ' s/d ' || TANGGAL_AKHIR JANGKA_WAKTU, TAHUN,  NILAI1,
                        NILAI2, NILAI3, NILAI4, 
                        NILAI5, NILAI6, REKOMENDASI, encode(FOTO_BLOB, 'base64') FOTO_BLOB, PEGAWAI_ID,
                        JUMLAH, RATA_RATA, SASARAN_KERJA, SASARAN_KERJA_HASIL, PERILAKU_HASIL, NILAI_HASIL,
                        CASE WHEN NILAI_HASIL <= 50 AND NILAI_HASIL IS NOT NULL
                        THEN '(Buruk)'
                        WHEN NILAI_HASIL <= 60 AND NILAI_HASIL IS NOT NULL
                        THEN '(Sedang)'
                        WHEN NILAI_HASIL <= 75 AND NILAI_HASIL IS NOT NULL
                        THEN '(Cukup)'
                        WHEN NILAI_HASIL < 91 AND NILAI_HASIL IS NOT NULL
                        THEN '(Baik)'
                        WHEN NILAI_HASIL IS NOT NULL
                        THEN '(Sangat Baik)'
                        END NILAI_HASIL_NAMA
                        ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
                        FROM validasi.validasi_pegawai_penilaian_kerja A 
                        LEFT JOIN PEJABAT_PENETAP b ON A.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID
                        WHERE 1=1 "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $this->query = $str;
            $str .= $statement." ORDER BY TANGGAL_AKHIR ASC";
                        
            return $this->selectLimit($str,$limit,$from); 
      }

      function updatepegawai()
      {
            $str = "
            UPDATE validasi.PEGAWAI
            SET    
            PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
            KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
            KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
            KELURAHAN_ID= ".$this->getField("KELURAHAN_ID").",
            SATKER_ID= '".$this->getField("SATKER_ID")."',
            KEDUDUKAN_ID= ".$this->getField("KEDUDUKAN_ID").",
            JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID").",
            BANK_ID= ".$this->getField("BANK_ID").",
            NIP_LAMA= '".$this->getField("NIP_LAMA")."',
            NIP_BARU= '".$this->getField("NIP_BARU")."',
            NAMA= '".$this->getField("NAMA")."',
            GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."',
            GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."',
            TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
            TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
            JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
            STATUS_KAWIN= ".$this->getField("STATUS_KAWIN").",
            SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."',
            GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."',
            EMAIL= '".$this->getField("EMAIL")."',
            ALAMAT= '".$this->getField("ALAMAT")."',
            RT= '".$this->getField("RT")."',
            RW= '".$this->getField("RW")."',
            TELEPON= '".$this->getField("TELEPON")."',
            KODEPOS= '".$this->getField("KODEPOS")."',
            STATUS_PEGAWAI= ".$this->getField("STATUS_PEGAWAI").",
            KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."',
            ASKES= '".$this->getField("ASKES")."',
            TASPEN= '".$this->getField("TASPEN")."',
            NPWP= '".$this->getField("NPWP")."',
            NIK= '".$this->getField("NIK")."',
            FOTO= '".$this->getField("FOTO")."',
            FOTO_SETENGAH= '".$this->getField("FOTO_SETENGAH")."',
            NO_REKENING= '".$this->getField("NO_REKENING")."',                          
            TANGGAL_PENSIUN= ".$this->getField("TANGGAL_PENSIUN").",
            TIPE_PEGAWAI_ID= '".$this->getField("TIPE_PEGAWAI_ID")."',
            AGAMA_ID= ".$this->getField("AGAMA_ID").",
            VALIDASI= ".$this->getField("VALIDASI").",
            LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
            LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
            LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
            SK_KONVERSI_NIP=  '".$this->getField("SK_KONVERSI_NIP")."',
            TANGGAL_VALIDASI= NOW()
            WHERE  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
                        "; 
            $this->query = $str;
            // echo $str;exit;
            return $this->execQuery($str);
      }

      function selectByParamsPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT P.PEGAWAI_ID, P.TEMP_VALIDASI_ID,
            P.NIP_LAMA, P.NIP_BARU, P.NAMA, P.TIPE_PEGAWAI_ID, P.GELAR_DEPAN, P.GELAR_BELAKANG, P.STATUS_PEGAWAI, 
            P.TEMPAT_LAHIR, P.TANGGAL_LAHIR, P.TANGGAL_PENSIUN, 
            P.JENIS_KELAMIN, P.JENIS_PEGAWAI_ID, P.STATUS_KAWIN, 
            GOL_RUANG, TO_CHAR(TMT_PANGKAT, 'DD-MM-YYYY') TMT_PANGKAT, JABATAN, TO_CHAR(B.TMT_JABATAN, 'DD-MM-YYYY') TMT_JABATAN,
            PENDIDIKAN, TAHUN,
            P.KARTU_PEGAWAI, P.SUKU_BANGSA, P.GOLONGAN_DARAH, P.ASKES, P.TASPEN, P.ALAMAT, P.NPWP, P.NIK, P.RT, P.RW, P.EMAIL, 
            P.PROPINSI_ID, P.KABUPATEN_ID, P.KECAMATAN_ID, P.KELURAHAN_ID, 
            ambil_propinsi(P.PROPINSI_ID) PROPINSI_NAMA,
            ambil_kabupaten(P.PROPINSI_ID, P.KABUPATEN_ID) KABUPATEN_NAMA,
            ambil_kecamatan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID) KECAMATAN_NAMA,
            ambil_kelurahan(P.PROPINSI_ID, P.KABUPATEN_ID,P.KECAMATAN_ID,P.KELURAHAN_ID) KELURAHAN_NAMA,
            P.BANK_ID, P.NO_REKENING, TAHUN, P.AGAMA_ID, P.SK_KONVERSI_NIP,
            P.TELEPON, P.KODEPOS, P.KEDUDUKAN_ID, P.SATKER_ID, AMBIL_SATKER_NAMA(P.SATKER_ID) NMSATKER, P.PERUBAHAN_DATA,
            CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 1 END FOTO_BLOB, 
            CASE WHEN FOTO_BLOB_OTHER IS NULL THEN NULL ELSE 1 END FOTO_BLOB_OTHER
            ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.validasi_pegawai_data P
            LEFT JOIN SATKER S ON S.SATKER_ID = P.SATKER_ID 
            LEFT JOIN PANGKAT_TERAKHIR A ON P.PEGAWAI_ID = A.PEGAWAI_ID
            LEFT JOIN JABATAN_TERAKHIR B ON P.PEGAWAI_ID = B.PEGAWAI_ID
            LEFT JOIN PENDIDIKAN_TERAKHIR C ON P.PEGAWAI_ID = C.PEGAWAI_ID
            WHERE P.PEGAWAI_ID IS NOT NULL
            "; 
            
            while(list($key,$val) = each($paramsArray))
            {
                  $str .= " AND $key = '$val' ";
            }
            
            $str .= $statement." ".$sOrder;
            $this->query = $str;
                        
            return $this->selectLimit($str,$limit,$from); 
      }

      function updatekontrak()
      {
            $str = "
                        UPDATE validasi.RIWAYAT_KONTRAK
                        SET    
                                 PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
                                 NO_SK= '".$this->getField("NO_SK")."',
                                 TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
                                 TMT_SK= ".$this->getField("TMT_SK").",
                                 SELESAI_KONTRAK= ".$this->getField("SELESAI_KONTRAK").",
                                 MASA_BERLAKU= ".$this->getField("MASA_BERLAKU").",
                                 MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN").",
                                 MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN").",
                                 GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
                                 VALIDASI = ".$this->getField("VALIDASI").",
                                 PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
                                 PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
                                 GOLONGAN_PPPK_ID= ".$this->getField("GOLONGAN_PPPK_ID").",
                                 LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
                                 LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
                                 LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
                                 TANGGAL_VALIDASI= NOW()
                        WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
                        "; 
                        $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
     }

      function updateriwayatpendidikan()
      {
            $str = "
                        UPDATE validasi.PEGAWAI_PENDIDIKAN_RIWAYAT
                        SET    
                              PEGAWAI_ID= ".$this->getField("PEGAWAI_ID").",
                              PEGAWAI_PENDIDIKAN_ID= ".$this->getField("PEGAWAI_PENDIDIKAN_ID").",
                              TINGKAT_PENDIDIKAN_ID= ".$this->getField("TINGKAT_PENDIDIKAN_ID").",
                              TANGGAL_LULUS= ".$this->getField("TANGGAL_LULUS").",
                              TAHUN_LULUS= ".$this->getField("TAHUN_LULUS").",
                              NOMOR_IJAZAH= '".$this->getField("NOMOR_IJAZAH")."',
                              NAMA_SEKOLAH= '".$this->getField("NAMA_SEKOLAH")."',
                              GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."',
                              GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."',
                              PENDIDIKAN_CPNS= ".$this->getField("PENDIDIKAN_CPNS").",
                              VALIDASI    = ".$this->getField("VALIDASI").",
                              LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
                              LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
                              LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
                              TANGGAL_VALIDASI= NOW()
                        WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
                        "; 
                        $this->query = $str;
                        // echo $str;exit;
            return $this->execQuery($str);
    }



      function selectByParamsKontrak($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT A.RIWAYAT_KONTRAK_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.NO_SK,
                A.TANGGAL_SK, A.TMT_SK, A.MASA_BERLAKU,
                A.SELESAI_KONTRAK,COALESCE( A.MASA_BERLAKU, 0 ) ||' Tahun ' MASA_BERLAKU_TAHUN,A.MASA_KERJA_TAHUN,A.MASA_KERJA_BULAN
            , A.GAJI_POKOK
            , A.PEJABAT_PENETAP_ID
            , A.PEJABAT_PENETAP
            , A.GOLONGAN_PPPK_ID
            , TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            , B.KODE
            , COALESCE( A.MASA_KERJA_TAHUN, 0 ) ||' Tahun '|| '- ' || COALESCE( A.MASA_KERJA_BULAN, 0 ) || ' Bulan' MASA_KERJA

            FROM validasi.validasi_pegawai_kontrak A
            LEFT JOIN GOLONGAN_PPPK B ON B.GOLONGAN_PPPK_ID = A.GOLONGAN_PPPK_ID
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

      function selectByParamsPendidikanRiwayat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
      {
            $str = "
            SELECT A.PEGAWAI_PENDIDIKAN_RIWAYAT_ID, A.PEGAWAI_ID, A.PEGAWAI_PENDIDIKAN_ID, 
            A.TINGKAT_PENDIDIKAN_ID, A.TANGGAL_LULUS, A.TAHUN_LULUS, A.NOMOR_IJAZAH, 
            A.NAMA_SEKOLAH,A.GELAR_DEPAN, A.GELAR_BELAKANG, A.PENDIDIKAN_CPNS,B.NAMA PEGAWAI_PENDIDIKAN,C.NAMA TINGKAT_PENDIDIKAN, TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
            FROM validasi.VALIDASI_PENDIDIKAN_RIWAYAT A
            LEFT JOIN PEGAWAI_PENDIDIKAN B ON B.PEGAWAI_PENDIDIKAN_ID = A.PEGAWAI_PENDIDIKAN_ID
            LEFT JOIN TINGKAT_PENDIDIKAN C ON C.KODE = A.TINGKAT_PENDIDIKAN_ID
            WHERE 1=1

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