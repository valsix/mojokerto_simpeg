<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

// $folder = $this->config->item('simpeg');

/*$set= new InfoData();
$set->selectbyparamspendidikan(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqTahunLulus= $set->getField('TAHUN');*/

$set= new InfoData();
$arragama= [];
$set->selectbyagama();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("NAMA");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arragama, $arrdata);
}
unset($set);

$set= new InfoData();
$arrsatuankerja= [];
$set->selectbysatuankerja();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("SATKER_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arrsatuankerja, $arrdata);
}
unset($set);

$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNipBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= datetimeTodatePageCheck($set->getField('LAST_TMT_PANGKAT'));
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqSatker= $set->getField('SATKER_ID');
$reqTmtJabatan= datetimeTodatePageCheck($set->getField('LAST_TMT_JABATAN'));
$reqTanggalLahir= datetimeTodatePageCheck($set->getField('TGL_LAHIR'));
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqJurusanTerkahir= $set->getField('LAST_DIK_JURUSAN');
$reqTahunLulus= $set->getField('LAST_DIK_TAHUN');

// echo $reqTmtJabatan;exit;
$reqMode="update";
// $reqMode="insert";
$readonly = "readonly";
?>
<style type="text/css">
	   select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #F3F6F9;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="app/index/pegawai_data_fip">FIP</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Riwayat Pangkat</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Riwayat Pangkat</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
            	<div class="card-body">
            		<table class="table_list" id="link-table" width="100%" cellspacing="1">
            			<thead>
            				<tr class="">
								<th>Pangkat</th>
								<th>TMT Pangkat</th>
								<th>No. Nota</th>
								<th>Tgl. Nota</th>
								<th>No. SK</th>
								<th>Tgl. SK</th>
								<th>Pejabat Penetap</th>
								<th>Jenis KP</th>
								<th>Kredit</th>
								<th>Ms. Kerja</th>
								<th>Keterangan</th>
							</tr>
            			</thead>
					  <tbody>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17291&amp;reqMode=view">link data</a>
					      </td>
					      <td>III/a</td>
					      <td>01-02-1996</td>
					      <td></td>
					      <td>01-01-1900</td>
					      <td>813.3/317/042/1996</td>
					      <td>14-03-1996</td>
					      <td>GUBERNUR KDH TK.I JATIM</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>0-0</td>
					      <td>CPNS</td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17292&amp;reqMode=view">link data</a>
					      </td>
					      <td>III/a</td>
					      <td>01-11-1997</td>
					      <td></td>
					      <td>01-01-1900</td>
					      <td>821.13/14/45/042/1997</td>
					      <td>30-10-1997</td>
					      <td>GUBERNUR KDH TK.I JATIM</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>1-9</td>
					      <td>PNS</td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17294&amp;reqMode=view">link data</a>
					      </td>
					      <td>III/b</td>
					      <td>01-04-2000</td>
					      <td></td>
					      <td>01-01-1900</td>
					      <td>823.3/415/415-031/2000</td>
					      <td>28-02-2000</td>
					      <td>BUPATI KDH TK.II MOJOKERTO</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>0-0</td>
					      <td></td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17295&amp;reqMode=view">link data</a>
					      </td>
					      <td>III/c</td>
					      <td>01-05-2001</td>
					      <td></td>
					      <td></td>
					      <td>823.3/1707/406-206/2001</td>
					      <td>03-08-2001</td>
					      <td>BUPATI MOJOKERTO</td>
					      <td>Reguler</td>
					      <td></td>
					      <td>-</td>
					      <td>KP</td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17293&amp;reqMode=view">link data</a>
					      </td>
					      <td>III/d</td>
					      <td>01-10-2005</td>
					      <td>CG6502001448</td>
					      <td>15-07-2005</td>
					      <td>823.3/2658/416-206/2005</td>
					      <td>09-08-2005</td>
					      <td>BUPATI MOJOKERTO</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>9-8</td>
					      <td></td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17296&amp;reqMode=view">link data</a>
					      </td>
					      <td>IV/a</td>
					      <td>01-10-2009</td>
					      <td>CG 23516001324</td>
					      <td>13-07-2009</td>
					      <td>823.4/1853/212/2009</td>
					      <td>21-07-2009</td>
					      <td>GUBERNUR JAWA TIMUR</td>
					      <td>Reguler</td>
					      <td></td>
					      <td>13-8</td>
					      <td>KP</td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=17297&amp;reqMode=view">link data</a>
					      </td>
					      <td>IV/b</td>
					      <td>01-10-2013</td>
					      <td>CG-23516001215</td>
					      <td>15-08-2013</td>
					      <td>823.4 / 1905 / 212 / 2013</td>
					      <td>26-08-2013</td>
					      <td>GUBERNUR JAWA TIMUR</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>17-8</td>
					      <td>KENAIKAN PANGKAT</td>
					    </tr>
					    <tr style="background-color: white; cursor: pointer;" onmouseover="ChangeColor(this, true);" onmouseout="ChangeColor(this, false);" class="">
					      <td style="display: none;">
					        <a href="pangkat_detil.php?reqPegawaiId=235160400017&amp;reqPANGKAT_RIWAYAT_ID=81059&amp;reqMode=view">link data</a>
					      </td>
					      <td>IV/c</td>
					      <td>01-10-2017</td>
					      <td>AA-23516000227</td>
					      <td>08-09-2017</td>
					      <td>00071/KEP/AA/15001/17</td>
					      <td>19-09-2017</td>
					      <td>PRESIDEN</td>
					      <td>Reguler</td>
					      <td>0</td>
					      <td>21-8</td>
					      <td>KENAIKAN PANGKAT</td>
					    </tr>
					  </tbody>
					</table>
            	</div>
            	<div class="card-footer">
            		<button class="btn btn-light-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
            		<button class="btn btn-light-warning"><i class="fa fa-pen" aria-hidden="true"></i> Edit</button>
            		<button class="btn btn-light-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
            		<button class="btn btn-light-success"><i class="fa fa-save" aria-hidden="true"></i> Simpan</button>
            		<button class="btn btn-light-danger"><i class="fa fa-undo" aria-hidden="true"></i> Batal</button>
            	</div>
	        	<div class="card-body">

	        		<div class="row">
		        		<div class="col-md-12">
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">STLUD</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<select class="form-control">
			        					<option>1</option>
			        					<option>2</option>
			        					<option>3</option>
			        				</select>
			        			</div>
			        			<label class="col-form-label text-right col-lg-1 col-sm-12">No. STLUD</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="123" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal STLUD</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTanggalLahir" placeholder="Select date" value="<?=$reqTanggalLahir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Gol/Ruang</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<select class="form-control">
			        					<option>III/a</option>
			        					<option>III/b</option>
			        				</select>
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">TMT Gol</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">No. Nota</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Nota</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="" />
			        			</div>
			        		</div>	
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">No. SK</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal SK</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="" />
			        			</div>
			        		</div>	

			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pj. Penetap</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<select class="form-control">
			        					<option>Bupati Mojokerto</option>
			        				</select>
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jenis KP</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<select class="form-control">
			        					<option>Reguler</option>
			        				</select>
			        			</div>
			        		</div>	

			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kredit</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="123" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-1 col-sm-12">Masa Kerja</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<div class="form-group row">
					        			<!-- <label class="col-form-label text-right col-lg-3 col-sm-12">Masa Kerja</label> -->
					        			<div class="col-lg-3 col-sm-12">
					        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="5" />
					        			</div>
					        			<label class="col-form-label text-left col-lg-3 col-sm-12">th</label>
					        			<div class="col-lg-3 col-sm-12">
					        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="8" />
					        			</div>
					        			<label class="col-form-label text-left col-lg-3 col-sm-12">bl</label>
					        		</div>	
			        			</div>
			        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gaji Pokok</label>
			        			<div class="col-lg-2 col-sm-12">
			        				<input type="text" class="form-control" name="reqNama" id="reqNama" placeholder="" value="123" />
			        			</div>
			        		</div>

			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" name="reqAlamat" cols="46" placeholder="Masukkan alamat" > <?=$reqKeterangan?></textarea>
			        			</div>
			        		</div>
		        		</div>
		        	</div>
	        		
	        	</div>

	        	<!-- <div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div> -->
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	$('#ktagamaid').select2({
		placeholder: "Pilih agama"
	});

	$('#ktsatuankerjad').select2({
		placeholder: "Pilih Satuan Kerja"
	});
	
	$('#ktjeniskelamin').select2({
		placeholder: "Pilih jenis kelamin"
	});

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggallahir').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_data_json/indentitaspegawai";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					/*reqEmail: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					reqSatuanKerjaNama: {
						validators: {
							notEmpty: {
								message: 'Please select an option'
							}
						}
					},*/
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
			)
		.on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				var formData = new FormData(document.querySelector('form'));
				$.ajax({
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;
			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: response.message,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "app/index/pegawai_data";
			        	});
			        },
			        error: function(xhr, status, error) {
			        	var err = JSON.parse(xhr.responseText);
			        	Swal.fire("Error", err.message, "error");
			        },
			        complete: function () {
			        	KTUtil.btnRelease(formSubmitButton);
			        }
			    });
			})
		.on('core.form.invalid', function() {
			Swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
	});

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->