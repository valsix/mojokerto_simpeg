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

$arrtabledata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tanggal", "field"=> "TANGGAL_INFO", "display"=>"",  "width"=>"")
    , array("label"=>"Penyelenggara", "field"=> "PENYELENGGARA", "display"=>"",  "width"=>"")

    , array("label"=>"validasiid", "field"=> "TEMP_VALIDASI_HAPUS_ID", "display"=>"1", "width"=>"")
    , array("label"=>"validasihapusid", "field"=> "TEMP_VALIDASI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "RIWAYAT_DIKLAT_TEKNIS_ID", "display"=>"1", "width"=>"")
);
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
<script type="text/javascript">
	 $(document).ready(function() {
	 	$(".option").click(function() {
	 		var valueHtml = $(this).html();
	 		$(".appendme").append('<div class="item"><div class="nama">'+valueHtml+' </div><div class="urutan"><select class=form-control><option>Asc</option><option>Desc</option></select></div><div class="aksi" ><i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i></div></div>');
	 	});

	 	$(".option2").click(function() {
	 		var valueHtml2 = $(this).html();
	 		// $(".appendme2").append('<div class="item"><div class="nama">'+valueHtml2+' </div><div class="urutan"><select class=form-control><option>Asc</option><option>Desc</option></select></div><div class="aksi" ><i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i></div></div>');
	 		$(".appendme2").append('<div class="item item-operasi"><div class="nama"><select class=form-control><option>NIP</option><option>NIP Baru</option></select></div><div class="operasi"><select class=form-control><option>=</option><option>!=</option></select></div><div class="isi"><input class=form-control></div><div class="aksi"><i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i></div></div>');
	 	});

	 });
</script>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Dynamic Report</a>
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
                    <h3 class="card-label">Dynamic Report</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
            	<div class="card-body">
            		<div class="row">
            			<div class="col-md-5">
            				<div class="area-dynaport appendme kursor" id="kursor">
								Silakan pilih field yang akan ditampilkan :
								<div class="item item-header">
									<div class="nama">Field</div>
									<div class="urutan">Urutan</div>
									<div class="aksi" >Aksi</div>
								</div>
								
								<!-- The custom context menu -->
								<div id="wrapper" class="menu">
									<ul id="menu">
										<li><a href="#">Pegawai</a>
											<ul>
												<li><a class="option appendbtn">NIP</a></li>
												<li><a class="option appendbtn">NIP Baru</a></li>
												<li><a class="option appendbtn">Nama</a></li>
											</ul>
										</li>
										<li><a href="#">Pangkat</a>
											<ul>
												<li><a class="option appendbtn">Gol. Ruang</a></li>
												<li><a class="option appendbtn">TMT Pangkat</a></li>
												<li><a class="option appendbtn">Nomor SK Pangkat</a></li>
											</ul>
										</li>
										<li><a class="option appendbtn">Jabatan</a></li>
										<li><a class="option appendbtn">Satker</a></li>
									</ul>
								</div>
							</div>
            			</div>
            			<div class="col-md-7">
            				
	            			<div class="area-dynaport appendme2 kursor" id="kursor2">
								Silakan pilih operasi yang akan ditampilkan :
								<div class="item item-operasi item-header">
									<div class="nama">Field</div>
									<div class="operasi">Operasi</div>
									<div class="isi">Isi</div>
									<div class="aksi">Aksi</div>
								</div>
								
								<!-- The custom context menu -->
								<div id="wrapper" class="menu2">
									<ul id="menu">
										<li><a class="option2 appendbtn">Tambah</a></li>
									</ul>
								</div>
							</div>
            			</div>
            		</div>
            		

					<script>
					    // select the menu element
					    const menu = document.querySelector(".menu"); 
					    // menu.style.display = "none"; 
					    var kursor =  document.getElementById("kursor");
					    // add an event listener for the right-click event on the document
					    kursor.addEventListener("contextmenu", (event) => {
							// prevent the default browser behavior
							event.preventDefault(); 
							// show the menu element
							menu.style.display = "block"; 
							// position the menu element near the cursor horizontally
							// menu.style.left = `${event.clientX}px`; 
							menu.style.left = `320px`; 
							// menu.style.left = event.pageX;

							// position the menu element near the cursor vertically
							// menu.style.top = `${event.clientY}px`; 
							menu.style.top = `40px`; 
							// menu.style.top = event.pageY; 

					    });

					    // add an event listener for the click event on the document
					    document.addEventListener("click", () => {
					    //   // hide the menu element
					      menu.style.display = "none"; 
					    });

					    // select all the option elements
					    const options = document.querySelectorAll(".option"); 


					    // add an event listener for the click event on each option element
					   //  options.forEach((option) => {
					   //  	option.addEventListener("click", (event) => {
					   //  		// var teks = document.getElementsByClassName(".option"); 
								// // alert(teks);

					   //      // get the text content of the clicked option
					   //      const text = event.target.textContent; 
					   //      if (text === "Option 1") {
					   //        // do something for option 1
					   //        console.log("Option 1 selected");
					   //      } else if (text === "Option 2") {
					   //        // do something for option 2
					   //        console.log("Option 2 selected");
					   //      } else if (text === "Option 3") {
					   //        // do something for option 3
					   //        console.log("Option 3 selected");
					   //      }
					   //    });
					   //  });
					</script>
					
					<script>
					    // select the menu element
					    const menu2 = document.querySelector(".menu2"); 
					    // menu.style.display = "none"; 
					    var kursor2 =  document.getElementById("kursor2");
					    // add an event listener for the right-click event on the document
					    kursor2.addEventListener("contextmenu", (event) => {
					    	// alert("haii");
							// prevent the default browser behavior
							event.preventDefault(); 
							// show the menu element
							menu2.style.display = "block"; 
							// position the menu element near the cursor horizontally
							// menu.style.left = `${event.clientX}px`; 
							menu2.style.left = `320px`; 
							// menu.style.left = event.pageX;

							// position the menu element near the cursor vertically
							// menu.style.top = `${event.clientY}px`; 
							menu2.style.top = `40px`; 
							// menu.style.top = event.pageY; 

					    });

					    // add an event listener for the click event on the document
					    document.addEventListener("click", () => {
					    //   // hide the menu element
					      menu2.style.display = "none"; 
					    });

					    // select all the option elements
					    const options2 = document.querySelectorAll(".option2"); 


					    // add an event listener for the click event on each option element
					   //  options.forEach((option) => {
					   //  	option.addEventListener("click", (event) => {
					   //  		// var teks = document.getElementsByClassName(".option"); 
								// // alert(teks);

					   //      // get the text content of the clicked option
					   //      const text = event.target.textContent; 
					   //      if (text === "Option 1") {
					   //        // do something for option 1
					   //        console.log("Option 1 selected");
					   //      } else if (text === "Option 2") {
					   //        // do something for option 2
					   //        console.log("Option 2 selected");
					   //      } else if (text === "Option 3") {
					   //        // do something for option 3
					   //        console.log("Option 3 selected");
					   //      }
					   //    });
					   //  });
					  </script>

            	</div>

	        	<div class="card-body area-button">
	        		<div class="row">
		        		<div class="col-md-12">
			        		<button class="btn btn-light-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
			        		<button class="btn btn-light-warning"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
		        		</div>
		        	</div>
	        	</div>

	        	<div class="card-body">
	                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
	                    <thead>
	                        <tr>
	                            <?php
	                            foreach($arrtabledata as $valkey => $valitem) 
	                            {
	                                echo "<th>".$valitem["label"]."</th>";
	                            }
	                            ?>
	                        </tr>
	                    </thead>
	                </table>
	            </div>
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

<script type="text/javascript">
	// $(".appendbtn").click(function () {
	//     var template = $("#appendTemplate").html();
	//     $(".appendme").append(template);
	// });



	// $(".appendbtn").click(function () {
	// 	$(".appendme").append('<tr><td>haiii_ </td></tr>');
	// });

	function dismiss(){
		document.getElementById('dismiss').parentNode.style.display='none';
	};
</script>

<!-- DATATABLE -->
<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrtabledata); ?>;
// console.log(arrdata);
var indexfieldid= arrdata.length - 1;
var indexvalidasiid= arrdata.length - 3;
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';

jQuery(document).ready(function() {
    var jsonurl= "json-data/info_data_json/jsondiklatteknis";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();
        // console.log(dataselected);
        // console.log(Object.keys(dataselected).length);
        fieldinfoid= arrdata[indexfieldid]["field"]
        fieldvalidasiid= arrdata[indexvalidasiid]["field"]
        fieldvalidasihapusid= arrdata[indexvalidasihapusid]["field"]
        valinfoid= dataselected[fieldinfoid];
        valinfovalidasiid= dataselected[fieldvalidasiid];
        valinfovalidasihapusid= dataselected[fieldvalidasihapusid];
        if (valinfovalidasiid == null)
        {
            valinfovalidasiid = '';
        }
    });

    $('#btnDelete').on('click', function (e) {
        if(valinfoid == "")
        {
            Swal.fire({
                text: "Pilih salah satu data Riwayat terlebih dahulu.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            });
        }
        else
        {
            urlAjax= "json-data/info_data_json/jsondiklatteknisdelete?&reqDetilId="+valinfoid;
            swal.fire({
                title: 'Apakah anda yakin untuk hapus data?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) { 
                if (result.value) {
                    $.ajax({
                        url : urlAjax,
                        type : 'DELETE',
                        dataType:'json',
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    swal.showLoading()
                                }
                            })
                        },
                        success : function(data) { 
                            swal.fire({
                                position: 'top-right',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                document.location.href = "app/index/pegawai_diklat_teknis?formulaid=<?=$formulaid?>";
                            });
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.hideLoading();
                            var err = JSON.parse(jqXHR.responseText);
                            Swal.fire("Error", err.message, "error");
                        }
                    });
                }
            });
        }
    });

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#btnAdd, #btnUbahData").on("click", function () {
        btnid= $(this).attr('id');

        if(valinfoid == "" && btnid == "btnUbahData")
        {
            Swal.fire({
                text: "Pilih salah satu data Riwayat terlebih dahulu.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            });
            return false;
        }

        if(btnid == "btnUbahData")
            vpilihid= valinfoid;
        else
            vpilihid= "";

        // varurl= "app/index/pegawai_diklat_teknis_add?formulaid=<?=$formulaid?>&reqRowId="+vpilihid;
        varurl= "app/index/pegawai_data_fip?formulaid=<?=$formulaid?>&reqRowId="+vpilihid;
        
        document.location.href = varurl;
    });

    $("#buttoncaridetil").on("click", function () {
        carijenis= "2";
        calltriggercari();
    });
    $("#triggercari").on("click", function () {

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            
        }
    });

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

function submitForm() {
   $("#ktloginformsubmitbutton").click(); 
}

var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

jQuery(document).ready(function(){
    jQuery('#ktloginform').submit(function(event){ 
        event.preventDefault();
           var formData = new FormData(document.querySelector('form'));
           var form = KTUtil.getById('ktloginform');
           var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
                KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
               $.ajax({
                url: 'json-data/info_data_json/jsondiklatteknisupload', 
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'POST',
                beforeSend: function() {
                    swal.fire({
                        title: 'Mohon tunggu sebentar..',
                        text: 'File sedang dalam proses upload..',
                        onOpen: function() {
                            swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                // console.log(response); return false;
                Swal.fire({
                    text: response.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                    }).then(function() {
                        location.reload();
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
       }); 
});

function btnUploadSk(reqPegawaiId,reqRowId)
{
    $("#reqLinkFileSk").click();
    $('#reqPegawaiId').val(reqPegawaiId);
    $('#reqRowId').val(reqRowId);
}

function btnUploadStlud(reqPegawaiId,reqRowId)
{
    $("#reqLinkFileStlud").click();
    $('#reqPegawaiId').val(reqPegawaiId);
    $('#reqRowId').val(reqRowId);
}


function btnDeleteFile (fileid,reqPegawaiId,reqRowId,reqMode) {
    if(fileid !== "")
    {
        urlAjax= "json-data/info_data_json/jsondiklatteknisdeletefile?reqFileId="+fileid+"&reqPegawaiId="+reqPegawaiId+"&reqRowId="+reqRowId+"&reqMode="+reqMode;
        swal.fire({
            title: 'Apakah anda yakin untuk hapus file?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then(function(result) { 
            if (result.value) {
                $.ajax({
                    url : urlAjax,
                    type : 'DELETE',
                    dataType:'json',
                    beforeSend: function() {
                        swal.fire({
                            title: 'Please Wait..!',
                            text: 'Is working..',
                            onOpen: function() {
                                swal.showLoading()
                            }
                        })
                    },
                    success : function(data) { 
                        swal.fire({
                            position: 'center',
                            icon: "success",
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            location.reload();
                        });
                    },
                    complete: function() {
                        swal.hideLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.hideLoading();
                        var err = JSON.parse(jqXHR.responseText);
                        Swal.fire("Error", err.message, "error");
                    }
                });
            }
        });
    }
}

</script>

