<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once("functions/string.func.php");
include_once("functions/encrypt.func.php");

class globalfilepegawai
{
	function setriwayatfield($riwayattable, $kategorifileid="")
	{
		$vreturn= [];
		if($riwayattable == "PANGKAT_RIWAYAT")
		{
			$arrdata= [];
			$arrdata["riwayatfield"]= "";
			$arrdata["vriwayattable"]= $riwayattable;
			$arrdata["riwayatfieldinfo"]= "Cek EFile";
			$arrdata["labelupload"]= "Upload File";
			$arrdata["infolabel"]= "File";
			$arrdata["riwayatfieldtipe"]= "";
			$arrdata["riwayatfieldstyle"]= "";
			$riwayatfieldrequired= "1";
			$arrdata["riwayatfieldrequired"]= $riwayatfieldrequired;
			$arrdata["riwayatfieldrequiredinfo"]= $this->setfilerequiredinfo($riwayatfieldrequired);
			array_push($vreturn, $arrdata);

			$arrdata= [];
			$arrdata["riwayatfield"]= "stlud";
			$arrdata["vriwayattable"]= $riwayattable;
			$arrdata["riwayatfieldinfo"]= "Cek EFile";
			$arrdata["labelupload"]= "Upload STLUD File";
			$arrdata["infolabel"]= "File STLUD";
			$arrdata["riwayatfieldtipe"]= "";
			$arrdata["riwayatfieldstyle"]= "";
			$riwayatfieldrequired= "1";
			$arrdata["riwayatfieldrequired"]= $riwayatfieldrequired;
			$arrdata["riwayatfieldrequiredinfo"]= $this->setfilerequiredinfo($riwayatfieldrequired);
			array_push($vreturn, $arrdata);
		}
		else if($riwayattable == "PENDIDIKAN_RIWAYAT")
		{
			$arrdata= [];
			$arrdata["riwayatfield"]= "";
			$arrdata["vriwayattable"]= $riwayattable;
			$arrdata["riwayatfieldinfo"]= "Cek EFile";
			$arrdata["labelupload"]= "Upload SURAT";
			$arrdata["infolabel"]= "File";
			$arrdata["riwayatfieldtipe"]= "";
			$arrdata["riwayatfieldstyle"]= "";
			$riwayatfieldrequired= "1";
			$arrdata["riwayatfieldrequired"]= $riwayatfieldrequired;
			$arrdata["riwayatfieldrequiredinfo"]= $this->setfilerequiredinfo($riwayatfieldrequired);
			array_push($vreturn, $arrdata);

			$arrdata= [];
			$arrdata["riwayatfield"]= "stlud";
			$arrdata["vriwayattable"]= $riwayattable;
			$arrdata["riwayatfieldinfo"]= "Cek EFile";
			$arrdata["labelupload"]= "Upload Transkrip File";
			$arrdata["infolabel"]= "File Transkrip";
			$arrdata["riwayatfieldtipe"]= "";
			$arrdata["riwayatfieldstyle"]= "";
			$riwayatfieldrequired= "1";
			$arrdata["riwayatfieldrequired"]= $riwayatfieldrequired;
			$arrdata["riwayatfieldrequiredinfo"]= $this->setfilerequiredinfo($riwayatfieldrequired);
			array_push($vreturn, $arrdata);
		}
		else if (1==2){}
		else
		{
			$arrdata= [];
			$arrdata["riwayatfield"]= "";
			$arrdata["vriwayattable"]= $riwayattable;
			$arrdata["riwayatfieldinfo"]= "Cek EFile";
			$arrdata["labelupload"]= "Upload File";
			$arrdata["infolabel"]= "File";
			$arrdata["riwayatfieldtipe"]= "";
			$arrdata["riwayatfieldstyle"]= "";
			$riwayatfieldrequired= "1";
			$arrdata["riwayatfieldrequired"]= $riwayatfieldrequired;
			$arrdata["riwayatfieldrequiredinfo"]= $this->setfilerequiredinfo($riwayatfieldrequired);
			array_push($vreturn, $arrdata);
		}
		// print_r($vreturn);exit;

		return $vreturn;
	}

	function setfilerequired($arrvalid, $infofield)
	{
		$vreturn= "";
		if(in_array($infofield, $arrvalid))
			$vreturn= "1";

		return $vreturn;
	}

	function setfilerequiredinfo($val, $label="")
	{
		$vdefault= $label;
		if(empty($vdefault))
			$vdefault= ' *';

		$vreturn= "";
		if($val == "1")
			$vreturn= $vdefault;

		return $vreturn;
	}

	function simpanfilepegawai($vpost, $reqRowId, $reqLinkFile)
	{
		// print_r($vpost);exit;
		// print_r($reqLinkFile);exit;

		// kalau multi
		if(is_array($vpost["reqDokumenPilih"]))
		{
			// if(is_array($vpost["reqDokumenFileRiwayatTable"]))
			if(empty($reqRowId))
			{
				// print_r($vpost["reqDokumenPilih"]);exit;
				// print_r($reqLinkFile["name"][0]);exit;

				$reqStatusEfileField= $vpost["reqStatusEfileField"];
				$suratmasukpegawaiid= $vpost["reqRowId"];
				// echo $reqStatusEfileField;exit;
				$total_butuh_upload= $total_sudah_ada_file= 0;

				foreach ($vpost["reqDokumenPilih"] as $key => $value) {
					$vpostparam= [];
					$infobutuhupload= $vpost["infobutuhupload"][$key];
					$infodokumenpilih= $vpost["reqDokumenPilih"][$key];
					$infodokumenpath= $vpost["reqDokumenPath"][$key];
					$infodokumenfileharusupload= $vpost["reqDokumenFileHarusUpload"][$key];
					// untuk required

					if(!empty($infobutuhupload))
					{
						if(empty($infodokumenfileharusupload))
						{
							if($infodokumenpilih == "1" && !empty($reqLinkFile["name"][$key]))
							{
								$total_sudah_ada_file++;
							}
							else if($infodokumenpilih == "2" && !empty($infodokumenpath))
							{
								$total_sudah_ada_file++;
							}

							$total_butuh_upload++;
						}
					}

					$vlinkfile= $reqLinkFile;
					$vpostparam["reqDokumenPilih"]= $infodokumenpilih;
					$vpostparam["reqId"]= $vpost["reqPegawaiId"];
					$vpostparam["reqDokumenKategoriFileId"]= $vpost["reqDokumenKategoriFileId"][$key];
					$vpostparam["reqDokumenPath"]= $infodokumenpath;
					$vpostparam["reqDokumenFileId"]= $vpost["reqDokumenFileId"][$key];
					$vpostparam["reqDokumenFileKualitasId"]= $vpost["reqDokumenFileKualitasId"][$key];
					$vpostparam["indexfile"]= $key;
					$vpostparam["reqDokumenKategoriField"]= $vpost["reqDokumenKategoriField"][$key];
					$vpostparam["reqDokumenFileRiwayatTable"]= $vpost["reqDokumenRequiredTable"][$key];
					$vpostparam["reqDokumenFileRiwayatId"]= $vpost["reqDokumenFileRiwayatId"][$key];
					// print_r($vpostparam);exit;

					$this->simpanfilepegawaidb($vpostparam, $reqRowId, $vlinkfile);
				}

				// kalau ada status field, maka update status
				if(!empty($reqStatusEfileField))
				{
					// echo $total_butuh_upload." == ".$total_sudah_ada_file;exit;
					if($total_butuh_upload == $total_sudah_ada_file)
					{
						$CI = &get_instance();
						$CI->load->model("persuratan/SuratMasukPegawai");

						$set= new SuratMasukPegawai();

						$simpan= "";
						if($reqStatusEfileField == "bkd")
						{
							$simpan= "1";
							$set->setField("PEGAWAI_ID", $vpost["reqPegawaiId"]);
							$set->setField("FIELD", "STATUS_E_FILE_BKD");
							$set->setField("FIELD_NILAI", "1");
							$set->setField("FIELD_WHERE", "SURAT_MASUK_BKD_ID");
							$set->setField("FIELD_WHERE_NILAI", $vpost["reqId"]);
						}
						else if($reqStatusEfileField == "upt")
						{
							$simpan= "1";
							$set->setField("PEGAWAI_ID", $vpost["reqPegawaiId"]);
							$set->setField("FIELD", "STATUS_E_FILE_UPT");
							$set->setField("FIELD_NILAI", "1");
							$set->setField("FIELD_WHERE", "SURAT_MASUK_UPT_ID");
							$set->setField("FIELD_WHERE_NILAI", $vpost["reqId"]);
						}
						else if($reqStatusEfileField == "uptbkd")
						{
							$simpan= "1";
							$set->setField("PEGAWAI_ID", $vpost["reqPegawaiId"]);
							$set->setField("FIELD_NILAI", "1");
							$set->setField("FIELD_WHERE", "SURAT_MASUK_PEGAWAI_ID");
							$set->setField("FIELD_WHERE_NILAI", $suratmasukpegawaiid);
						}

						if(!empty($simpan))
						{
							if($reqStatusEfileField == "uptbkd")
							{
								$set->updatestatusuptbkdefile();
							}
							else
							{
								$set->updatestatusefile();
							}
						}
						// echo $vpost["reqId"]."-".$vpost["reqPegawaiId"]."-".$reqStatusEfileField."-".$total_butuh_upload." = ".$total_sudah_ada_file;exit;
					}
				}
			}
			else
			{
				foreach ($vpost["reqDokumenPilih"] as $key => $value) {
					$vpostparam= [];
					$vlinkfile= $reqLinkFile;
					$vpostparam["reqDokumenPilih"]= $vpost["reqDokumenPilih"][$key];
					$vpostparam["reqId"]= $vpost["reqId"];
					$vpostparam["reqDokumenKategoriFileId"]= $vpost["reqDokumenKategoriFileId"][$key];
					$vpostparam["reqDokumenPath"]= $vpost["reqDokumenPath"][$key];
					$vpostparam["reqDokumenFileId"]= $vpost["reqDokumenFileId"][$key];
					$vpostparam["reqDokumenFileKualitasId"]= $vpost["reqDokumenFileKualitasId"][$key];
					$vpostparam["indexfile"]= $key;
					$vpostparam["reqDokumenKategoriField"]= $vpost["reqDokumenKategoriField"][$key];
					$vpostparam["reqDokumenFileRiwayatTable"]= $vpost["reqDokumenRequiredTable"][$key];

					$this->simpanfilepegawaidb($vpostparam, $reqRowId, $vlinkfile);
				}
			}
		}
		else
		{
			$vpostparam= [];
			$vlinkfile= $reqLinkFile;
			$vpostparam["reqDokumenPilih"]= $vpost["reqDokumenPilih"];
			$vpostparam["reqId"]= $vpost["reqId"];
			$vpostparam["reqDokumenKategoriFileId"]= $vpost["reqDokumenKategoriFileId"];
			$vpostparam["reqDokumenPath"]= $vpost["reqDokumenPath"];
			$vpostparam["reqDokumenFileId"]= $vpost["reqDokumenFileId"];
			$vpostparam["reqDokumenFileKualitasId"]= $vpost["reqDokumenFileKualitasId"];
			$vpostparam["reqDokumenKategoriField"]= $vpost["reqDokumenKategoriField"];
			$vpostparam["reqDokumenFileRiwayatTable"]= $vpost["reqDokumenRequiredTable"];
			$vpostparam["indexfile"]= "";

			$this->simpanfilepegawaidb($vpostparam, $reqRowId, $vlinkfile);
		}
		// print_r($vpostparam);
		// exit;
	}

	function simpanfilepegawaidb($vpost, $reqRowId, $reqLinkFile)
	{
		// print_r($vpost);exit;
		$CI = &get_instance();
		$CI->load->model("base/PegawaiFile");

		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];
        $configlokasiupload= $configdata->config["lokasiupload"];
        $configserverlokal= $configdata->config["serverlokal"];
        // echo $configlokasiupload."-".$configserverlokal;exit;

		$LOGIN_USER= $CI->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$LOGIN_LEVEL= 99;
		$LOGIN_ID= $CI->session->userdata("adminuserid".$configvlxsessfolder);
		$LOGIN_PEGAWAI_ID= "";

		$reqDokumenPilih= $vpost["reqDokumenPilih"];
		$reqId= $vpost["reqId"];
		// $reqRowId= $vpost["reqRowId"];
		$reqDokumenKategoriFileId= $vpost["reqDokumenKategoriFileId"];
		$reqDokumenPath= $vpost["reqDokumenPath"];
		$indexfile= $vpost["indexfile"];
		$reqDokumenKategoriField= $vpost["reqDokumenKategoriField"];
		$reqDokumenFileRiwayatTable= $vpost["reqDokumenFileRiwayatTable"];

		if(empty($reqRowId))
		{
			$reqRowId= $vpost["reqDokumenFileRiwayatId"];
		}

		if(!empty($reqDokumenPilih))
		{
			if (is_numeric($indexfile))
			{
				$fileuploadexe= strtolower(getExtension($reqLinkFile['name'][$indexfile]));
			}
			else
			{
				$fileuploadexe= strtolower(getExtension($reqLinkFile['name']));
			}
			// echo $fileuploadexe;exit;

			$ambilriwayatfield= "";
			if(!empty($fileuploadexe))
			{
				$ambilriwayatfield= "1";
			}

			// kalau sama baru proses simpan
			// if($reqRiwayatId == $reqRowId || $ambilriwayatfield == "1")
			if($ambilriwayatfield == "1")
			{
				// echo $reqDokumenPilih;exit;
				// $reqRiwayatTable= $setfile->getField("RIWAYAT_TABLE");
				// $reqRiwayatField= $setfile->getField("RIWAYAT_FIELD");
				$reqRiwayatTable= $reqDokumenFileRiwayatTable;
				$reqRiwayatField= $reqDokumenKategoriField;

				$reqDokumenFileId= $vpost["reqDokumenFileId"];
				$reqKualitasFileId= $vpost["reqDokumenFileKualitasId"];
				$reqKategoriFileId= $reqDokumenKategoriFileId;
				
				if(empty($reqRowId) || $reqRowId == "-1")
					$reqRiwayatId= "";
				else
					$reqRiwayatId= $reqRowId;

				$reqPrioritas= "1";
				// print_r($reqDokumenFileId);exit;

				/*if($ambilriwayatfield == "1")
				{
					$reqRiwayatTable= $reqDokumenFileRiwayatTable;
					$reqRiwayatField= $reqDokumenKategoriField;
					$reqRiwayatId= $reqRowId;
				}*/
				// echo $reqRiwayatTable."xxx".$reqRiwayatField."xxx".$reqRiwayatId;exit;

				$setfile= new PegawaiFile();
				$setfile->selectnip(array(), -1,-1, " AND A.PEGAWAI_ID = ".$reqId);
				$setfile->firstRow();
				$vnipbaru= $setfile->getField("NIP_BARU");
				// echo $vnipbaru;exit;

				$setfile= new PegawaiFile();
				$setfile->setField("PEGAWAI_ID", $reqId);
				$setfile->setField("RIWAYAT_TABLE", $reqRiwayatTable);
				$setfile->setField("RIWAYAT_FIELD", $reqRiwayatField);
				$setfile->setField("FILE_KUALITAS_ID", ValToNullDB($reqKualitasFileId));
				$setfile->setField("KATEGORI_FILE_ID", $reqKategoriFileId);
				$setfile->setField("RIWAYAT_ID", ValToNullDB($reqRiwayatId));
				
				$setfile->setField("LAST_LEVEL", $LOGIN_LEVEL);
				$setfile->setField("LAST_USER", $LOGIN_USER);
				$setfile->setField("USER_LOGIN_ID", $LOGIN_ID);
				$setfile->setField("USER_LOGIN_PEGAWAI_ID", ValToNullDB($LOGIN_PEGAWAI_ID));
				$setfile->setField("LAST_DATE", "NOW()");

				$setfile->setField("IPCLIENT", sfgetipaddress());
				$setfile->setField("MACADDRESS", sfgetmac());
				$setfile->setField("NAMACLIENT", vgethostname());
				$setfile->setField("PRIORITAS", $reqPrioritas);

				$setfile->setField("PEGAWAI_FILE_ID", $reqDokumenFileId);

				$lokasi_folder= $configlokasiupload.$vnipbaru."/";
				// echo $lokasi_folder;exit;
				if(file_exists($lokasi_folder)){}
				else
				{
					makedirs($lokasi_folder);
				}

				// kalau nilai satu maka, upload data baru ke e file
				if($reqDokumenPilih == "1")
				{
					if (is_numeric($indexfile))
					{
						$fileName= basename($_FILES["reqLinkFile"]["name"][$indexfile]);
					}
					else
					{
						$fileName= basename($_FILES["reqLinkFile"]["name"]);
					}
					// $reqLinkFile["tmp_name"]
					$fileNameInfo = substr($fileName, 0, strpos($fileName, "."));
					$file_name = preg_replace( '/[^a-zA-Z0-9_]+/', '_', $fileNameInfo);

					if (is_numeric($indexfile))
					{
						$infoext= pathinfo($_FILES['reqLinkFile']['name'][$indexfile]);
					}
					else
					{
						$infoext= pathinfo($_FILES['reqLinkFile']['name']);
					}
					$ext= $infoext['extension'];

					$tglnow= date("Ymd");
					$vpathasli= $file_name;
					$namagenerate= generateRandomString().$tglnow.".".$ext;
					$vpathsimpan= $lokasi_folder.$namagenerate;
					$vnewpathsimpan= str_replace($configlokasiupload, "", $vpathsimpan);
					// echo $vpathsimpan;exit;
					// print_r($ext);exit;

					$setfile->setField('PATH', $vnewpathsimpan);
					$setfile->setField('PATH_ASLI', $vpathasli);
					$setfile->setField('EXT', $ext);

					$simpanfile= "";
					if (is_numeric($indexfile))
					{
						if (move_uploaded_file($_FILES["reqLinkFile"]["tmp_name"][$indexfile], $vpathsimpan))
						{
							$simpanfile= "1";
						}
					}
					else
					{
						if (move_uploaded_file($_FILES["reqLinkFile"]["tmp_name"], $vpathsimpan))
						{
							$simpanfile= "1";
						}
					}
					// $simpanfile= "1";

					// kalau kosong lewati
					if(empty($ext))
					{
						$simpanfile= "";
					}

					if ($simpanfile == "1")
					{
						if($setfile->newinsert())
						{
							// echo $setfile->query();
							// exit;
						}
					}
				}
				else if($reqDokumenPilih == "2")
				{
					/*if(empty($reqDokumenFileId))
					{
						$ext= strtolower(getExtension($reqDokumenPath));
						// kalau kosong lewati
						if(!empty($reqDokumenPath))
						{
							$reqDokumenPathAsli= str_replace(".$ext", "", str_replace("uploads/$reqId/", "", $reqDokumenPath));
							$reqDokumenPathAsli= str_replace(" ", "_", $reqDokumenPathAsli);
							$setfile->setField('PATH', $reqDokumenPath);
							$setfile->setField('PATH_ASLI', $reqDokumenPathAsli);
							$setfile->setField('EXT', $ext);

							if($setfile->noketinsert())
							{
								$reqDokumenFileId= $setfile->id;
								$setfile->setField("PEGAWAI_FILE_ID", $reqDokumenFileId);
								if($setfile->updateprioritas())
								{
								}
							}
						}
					}
					else
					{
						$statement= " AND A.PEGAWAI_FILE_ID = ".$reqDokumenFileId;
						$setfiledetil= new PegawaiFile();
						$setfiledetil->selectByParamsFile(array(), -1,-1, $statement, $reqId);
						// echo $setfiledetil->query;exit;
						$setfiledetil->firstRow();
						$reqUrlFile= $setfiledetil->getField("PATH");
						$reqPathAsli= $setfiledetil->getField("PATH_ASLI");
						// echo $reqUrlFile;exit;

						$setfile->setField("PATH", $reqUrlFile);
						$setfile->setField("PATH_ASLI", $reqPathAsli);

						if(!empty($reqPrioritas))
						{
							if($setfile->noketupdate())
							{
								// 	echo $setfile->query;exit;
								if($setfile->updateprioritas())
								{
									// 	echo $setfile->query;exit;
								}
							}
						}
					}*/
				}
			}

		}
	}

	function ambilfile($arrparam)
	{
		$CI = &get_instance();
		$configdata= $CI->config;
        $configlokasiupload= $configdata->config["lokasiupload"];
        $configserverlokal= $configdata->config["serverlokal"];

		$CI->load->model("base/PegawaiFile");

		$reqId= $arrparam["reqId"];
		$reqRowId= $arrparam["reqRowId"];
		$riwayattable= $arrparam["riwayattable"];
		$paramriwayatfield= $arrparam["paramriwayatfield"];
		$lihatquery= $arrparam["lihatquery"];

		if(is_array($riwayattable))
		{
			// $riwayattable= [];
			// array_push($riwayattable, "tes");
			// array_push($riwayattable, "xxx");
			// array_push($riwayattable, "yyy");

			$vtable= "";
			foreach ($riwayattable as $k => $v) {
				$vtable= getconcatseparator($vtable, $v, "','");
			}

			if(!empty($vtable))
			{
				$vtable= "'".$vtable."'";
				$statement= " AND A.RIWAYAT_TABLE IN (".$vtable.")";
			}
			// echo $vtable;exit;
		}
		else
		{
			$statement= " AND A.RIWAYAT_TABLE = '".$riwayattable."'";
		}

		if(!empty($reqRowId) && empty($paramriwayatfield))
		{
			$vriwayatid= "";
			if(!empty($infodetilparam))
			{
				foreach ($infodetilparam as $k => $v) {
					$vdetil= $v["ID_AYAH"];
					$vriwayatid= getconcatseparator($vriwayatid, $vdetil);
					$vdetil= $v["ID_IBU"];
					$vriwayatid= getconcatseparator($vriwayatid, $vdetil);
				}
			}
			// echo $vriwayatid;exit;
			if(!empty($vriwayatid))
				$statement.= " AND RIWAYAT_ID IN (".$vriwayatid.")";
			else
				$statement.= " AND A.RIWAYAT_ID = ".$reqRowId;
		}

		$arrparamriwayatfield= [];
		if(!empty($paramriwayatfield))
		{
			$statementparam= "";
			$arrparamriwayatfield= explode("," , $paramriwayatfield);
			foreach ($arrparamriwayatfield as $key => $value) 
			{
				if(empty($statementparam))
					$statementparam= "'".$value."'";
				else
					$statementparam.= ",'".$value."'";
			}
			$statement.= " AND A.RIWAYAT_FIELD IN (".$statementparam.")";
		}
		// echo $statement;exit;

		$statement.= "
		AND EXISTS
		(
			SELECT 1
			FROM
			(
				SELECT *
				FROM
				(
					SELECT
					A.PEGAWAI_FILE_ID
					, CASE WHEN A.RIWAYAT_TABLE = 'PERSURATAN.SURAT_MASUK_PEGAWAI'
					THEN
						ROW_NUMBER () OVER 
						(
							PARTITION BY A.RIWAYAT_TABLE, A.RIWAYAT_ID
							ORDER BY CASE WHEN COALESCE(NULLIF(A.PRIORITAS, ''), NULL) IS NULL THEN '2' ELSE A.PRIORITAS END::NUMERIC, A.LAST_DATE DESC
						)
					ELSE
						ROW_NUMBER () OVER 
						(
							PARTITION BY A.RIWAYAT_TABLE, A.RIWAYAT_FIELD, A.RIWAYAT_ID
							ORDER BY CASE WHEN COALESCE(NULLIF(A.PRIORITAS, ''), NULL) IS NULL THEN '2' ELSE A.PRIORITAS END::NUMERIC, A.LAST_DATE DESC
						)
					END INFOPOSISI
					FROM PEGAWAI_FILE A
					WHERE 1=1 AND A.PEGAWAI_ID = ".$reqId."
		";
					if(is_array($riwayattable))
					{
						$statement.= " AND A.RIWAYAT_TABLE IN (".$vtable.")";
					}
					else
					{
						$statement.= " AND A.RIWAYAT_TABLE = '".$riwayattable."'";
					}

					if(!empty($reqRowId) && empty($paramriwayatfield))
					{
						$vriwayatid= "";
						if(!empty($infodetilparam))
						{
							foreach ($infodetilparam as $k => $v) {
								$vdetil= $v["ID_AYAH"];
								$vriwayatid= getconcatseparator($vriwayatid, $vdetil);
								$vdetil= $v["ID_IBU"];
								$vriwayatid= getconcatseparator($vriwayatid, $vdetil);
							}
						}
						// echo $vriwayatid;exit;
						if(!empty($vriwayatid))
							$statement.= " AND RIWAYAT_ID IN (".$vriwayatid.")";
						else
							$statement.= " AND RIWAYAT_ID = ".$reqRowId;
					}

					if(!empty($paramriwayatfield))
					{
						// $statement.= " AND A.RIWAYAT_FIELD = '".$paramriwayatfield."'";
					}

		$statement.= "
					ORDER BY A.RIWAYAT_TABLE, A.RIWAYAT_FIELD, A.RIWAYAT_ID, CASE WHEN COALESCE(NULLIF(A.PRIORITAS, ''), NULL) IS NULL THEN '2' ELSE A.PRIORITAS END::NUMERIC, A.LAST_DATE DESC
				) X WHERE INFOPOSISI = 1
			) X WHERE A.PEGAWAI_FILE_ID = X.PEGAWAI_FILE_ID
		)";
		// echo $statement;exit;

		$sorderfile= "ORDER BY A.RIWAYAT_FIELD, CASE WHEN COALESCE(NULLIF(A.PRIORITAS, ''), NULL) IS NULL THEN '2' ELSE A.PRIORITAS END::NUMERIC, A.LAST_DATE DESC";

		$setfile= new PegawaiFile();
		$setfile->selectByParamsFile(array(), -1,-1, $statement, $reqId, $sorderfile);
		if(!empty($lihatquery))
		{
	  		echo $setfile->query;exit;
		}

		$arrfile= [];
		while($setfile->nextRow())
	  	{
	  		$reqDokumenFilePath= $setfile->getField("PATH");
	  		$vinforiwayattable= $setfile->getField("RIWAYAT_TABLE");
	  		if($vinforiwayattable == "NULL") $vinforiwayattable= "";

	  		$vdatainforiwayatfield= $setfile->getField("RIWAYAT_FIELD");
	  		$vdatainforiwayatid= $setfile->getField("RIWAYAT_ID");
	  		$vkey= $vinforiwayattable.";".$vdatainforiwayatid;
	  		$vkeydetil= $vkey.";".$vdatainforiwayatfield;

	  		$arrdata= [];

	  		$lokasi_folder= $configlokasiupload.$reqDokumenFilePath;
	  		$arrdata["vurl"]= $lokasi_folder;
	  		$arrdata["vriwayattable"]= $vinforiwayattable;
	  		$arrdata["riwayatfield"]= $vdatainforiwayatfield;
	  		$arrdata["vkey"]= $vkey;
	  		$arrdata["vkeydetil"]= $vkeydetil;
	  		array_push($arrfile, $arrdata);
	  	}
	  	// print_r($arrfile);exit;

	  	return $arrfile;
	}

	function enkripdekripkunci()
	{
		return "KuNc1";
	}

	function enkripdata($arrparam)
	{
		$reqdata= urldecode($arrparam["reqdata"]);
		$reqkunci= urldecode($arrparam["reqkunci"]);

		return mencrypt($reqdata, $reqkunci);
	}

	function dekripdata($arrparam)
	{
		$reqdata= urldecode($arrparam["reqdata"]);
		$reqkunci= urldecode($arrparam["reqkunci"]);

		return mdecrypt($reqdata, $reqkunci);
	}

}