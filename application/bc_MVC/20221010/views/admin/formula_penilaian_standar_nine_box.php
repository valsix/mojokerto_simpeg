<?
include_once("functions/date.func.php");

$this->load->model("base-data/FormulaPenilaian");

$reqId= $this->input->get("reqId");

$set= new FormulaPenilaian();
$set->selectbyparamsformulapenilaian(array("A.FORMULA_PENILAIAN_ID"=>$reqId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNama= $set->getField('NAMA');

$statement= " AND A.FORMULA_PENILAIAN_ID = ".$reqId;
$set= new FormulaPenilaian();
$set->selectbyparamsformulapenilaiannineboxstandart(array(), -1,-1, $statement);
// echo $set->query;exit;
$set->firstRow();
$tempToleransiY= $set->getField("TOLERANSI_Y");
$tempToleransiX= $set->getField("TOLERANSI_X");

$reqSkpX0= $set->getField("SKP_X0");
$reqSkpY0= $set->getField("SKP_Y0");
$reqGmX0= $set->getField("GM_X0");
$reqGmY0= $set->getField("GM_Y0");
$reqSkpX1= $set->getField("SKP_X1");
$reqSkpY1= $reqSkpInfoY1= $reqSkpX0+1;
$reqGmX1= $set->getField("GM_X1");
$reqGmInfoX1= $reqGmY0+1;
$reqGmY1= $set->getField("GM_Y1");
$reqSkpX2= $set->getField("SKP_X2");
$reqSkpY2= $reqSkpInfoY2= $reqSkpX1+1;
$reqGmX2= $set->getField("GM_X2");
$reqGmInfoX2= $reqGmY1+1;
$reqGmY2= $set->getField("GM_Y2");

if($reqSkpY0 == "") $reqSkpY0= 0;
if($reqGmX0 == "") $reqGmX0= 0;
if($reqSkpY1 == "") $reqSkpY1= 0;
if($reqGmX1 == "") $reqGmX1= 0;
if($reqSkpY2 == "") $reqSkpY2= 0;
if($reqGmX2 == "") $reqGmX2= 0;

$tempOptionValueY=$tempToleransiY;
if($tempToleransiY < 0)
{
    $tempOptionY= "-";
    $tempOptionValueY= $tempToleransiY * -1;
}
else
{
    $tempOptionY= "+";
}

$tempOptionValueX=$tempToleransiX;
if($tempToleransiX < 0)
{
    $tempOptionX= "-";
    $tempOptionValueX= $tempToleransiX * -1;
}
else
{
    $tempOptionX= "+";
}
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

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Standar Nine Box</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label col-lg-12 col-sm-12">Nama Formula : <?=$reqNama?></label>
	        		</div>

	        		<div class="table-responsive">
	        			<table class="table table-bordered">
	        				<tr>
					    		<th colspan="5">Potensi</th>
					    		<th colspan="5">Kompetensi</th>
					    	</tr>
					    	<tr>
					    		<td style="width:50px">Kurang</td>
					    		<td style="width:5px">:</td>
					    		<td style="width:50px"><input class="easyui-numberspinner" id="reqSkpY0" value="<?=$reqSkpY0?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    		<td style="width:25px; text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqSkpX0" name="reqSkpX0" value="<?=$reqSkpX0?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    		<td style="width:50px">Kurang</td>
					    		<td style="width:5px">:</td>
					    		<td style="width:50px"><input class="easyui-numberspinner" id="reqGmX0" value="<?=$reqGmX0?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    		<td style="width:25px; text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqGmY0" name="reqGmY0" value="<?=$reqGmY0?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    	</tr>
					    	<tr>
					    		<td>Sedang</td>
					    		<td>:</td>
					    		<td><input type="hidden" id="reqSkpY1" value="<?=$reqSkpY1?>" /><label id="reqInfoSkpY1"><?=$reqSkpInfoY1?></label></td>
					    		<td style="text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqSkpX1" name="reqSkpX1" value="<?=$reqSkpX1?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    		<td>Sedang</td>
					    		<td>:</td>
					    		<td><input type="hidden" id="reqGmX1" value="<?=$reqGmX1?>" /><label id="reqInfoGmX1"><?=$reqGmInfoX1?></label></td>
					    		<td style="text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqGmY1" name="reqGmY1" value="<?=$reqGmY1?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    	</tr>

					    	<tr>
					    		<td>Baik</td>
					    		<td>:</td>
					    		<td><input type="hidden" id="reqSkpY2" value="<?=$reqSkpY2?>" /><label id="reqInfoSkpY2"><?=$reqSkpInfoY2?></label></td>
					    		<td style="text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqSkpX2" name="reqSkpX2" value="<?=$reqSkpX2?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    		<td>Baik</td>
					    		<td>:</td>
					    		<td><input type="hidden" id="reqGmX2" value="<?=$reqGmX2?>" /><label id="reqInfoGmX2"><?=$reqGmInfoX2?></label></td>
					    		<td style="text-align:center">s/d</td>
					    		<td><input class="easyui-numberspinner" id="reqGmY2" name="reqGmY2" value="<?=$reqGmY2?>" style="width:44px;" data-options=" min: 0, max: 200" /></td>
					    	</tr>
	        			</table>
	        		</div>

	        	</div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {

		$('#reqOptionY, #reqOptionX').change(function() {
	        setValueToleransi();
	    });
	    
	    $('#reqOptionValueY, #reqOptionValueX').keyup(function() {
	        setValueToleransi();
	    });
	    
	    $('#reqSkpX0,#reqSkpX1,#reqSkpX2').keyup(function() {
	        var id= $(this).attr('id');
	        id= id.replace("reqSkpX", "");
	        setSkp(id);
	    });
	    
	    $('#reqGmY0,#reqGmY1,#reqGmY2').keyup(function() {
	        var id= $(this).attr('id');
	        id= id.replace("reqGmY", "");
	        setGm(id);
	    });
	    
	    $('#reqOptionValueY,#reqOptionValueX').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	    });

		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_admin_json/formulapenilaianstandarninebox";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Nama is required'
							}
						}
					},
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
					cache: false,
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;

			        	inforesponse= response.message;
			        	inforesponsedata = inforesponse.split("-");

			        	inforesponseid= inforesponsedata[0];
			        	inforesponsepesan= inforesponsedata[1];

			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: inforesponsepesan,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "admin/index/formula_penilaian_standar_nine_box?reqId=<?=$reqId?>";
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

	function setValueToleransi()
	{
	    var reqOptionY= reqOptionValueY= reqOptionX= reqOptionValueX= "";
	    reqOptionY= $("#reqOptionY").val();
	    reqOptionValueY= $("#reqOptionValueY").val();
	    reqOptionX= $("#reqOptionX").val();
	    reqOptionValueX= $("#reqOptionValueX").val();
	    
	    if(reqOptionY == "+")
	    {
	        reqToleransiY= parseFloat(checkNan(reqOptionValueY));
	    }
	    else
	    {
	        reqToleransiY= -1 * parseFloat(checkNan(reqOptionValueY));
	    }
	    $("#reqToleransiY").val(reqToleransiY);
	    
	    if(reqOptionX == "+")
	    {
	        reqToleransiX= parseFloat(checkNan(reqOptionValueX));
	    }
	    else
	    {
	        reqToleransiX= -1 * parseFloat(checkNan(reqOptionValueX));
	    }
	    $("#reqToleransiX").val(reqToleransiX);
	}

	function setSkp(value)
	{
	    tempIndex= parseInt(value)+1;
	    $('#reqInfoSkpY'+tempIndex).text(parseFloat(checkNan($('#reqSkpX'+value).val())) + 1);
	    // perubahan awal
	    $('#reqSkpY'+tempIndex).val(parseFloat(checkNan($('#reqSkpX'+value).val())) + 1);
	    // perubahan tutup
	}

	function setGm(value)
	{
	    tempIndex= parseInt(value)+1;
	    $('#reqInfoGmX'+tempIndex).text(parseFloat(checkNan($('#reqGmY'+value).val())) + 1);
	    // perubahan awal
	    $('#reqGmX'+tempIndex).val(parseFloat(checkNan($('#reqGmY'+value).val())) + 1);
	    // perubahan tutup
	}

	function checkNan(value)
	{
	    if(typeof value == "undefined" || isNaN(value) || value == "")
	    return 0;
	    else
	    return value;
	}
</script>