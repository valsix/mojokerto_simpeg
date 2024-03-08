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
.appendme {
	border: 2px solid green;
	height: 30vh;
}
.appendme .item {
	/*border: 1px solid #ebedf3;*/
	/*padding: 5px;*/

	display: flex;
	display: -webkit-flex;
	flex-wrap: wrap;
}
.appendme .item:after {
	content: "";
	  clear: both;
	  display: table;
}
.appendme .item .nama {
	/*border: 1px solid red;*/
	border: 1px solid #ebedf3;
	float: left;
	width: calc(100% - 100px - 40px);
	padding: 4px 4px;
}
.appendme .item .urutan {
	/*border: 1px solid red;*/
	border: 1px solid #ebedf3;
	float: left;
	width: 100px;
	padding: 4px 4px;
}
.appendme .item .aksi {
	/*border: 1px solid red;*/
	border: 1px solid #ebedf3;
	float: left;
	width: 40px;
	height: 100%;
	padding: 6px 4px;

	display: flex;
	justify-content: center; /* align horizontal */
	align-items: center; /* align vertical */
}
.appendme .item .aksi i {
	color: red;
}
</style>
<style>
    /* style menu container */
    .menu {
      display: none;
      position: absolute;
      border: 1px solid black;
      background-color: rgb(244, 239, 210);
    }

    /* style menu items */
    .option {
      padding: 10px;
      cursor: pointer;
    }

    .option:hover {
      background-color: rgb(222, 159, 23);
    }
</style>
<style type="text/css">
	#wrapper.menu {
	  margin-left: 10px;
	  width: 150px;
	  height: 200px;
	  padding: 0px;
	  background-color: #D0D0D0;
	}

	.menu ul {
	  /*font-family: Veranda, Ariel, Sans-Serif;*/
	  /*font-size: 16px;*/
	  padding: 0px;
	  list-style: none;
	  letter-spacing: 2px;
	  text-align: center;
	}

	.menu ul li {
	  display: block;
	  position: relative;
	  width: 150px;
	}

	.menu li ul {
	  display: none;
	  margin: 0;
	}

	.menu ul li a {
	  display: block;
	  text-decoration: none;
	  /*background: gray;*/
	  color: #000;
	  border-top: 1px solid #666;
	  padding: 5px 15px 5px 15px;
	  margin-left: 1px;
	  white-space: nowrap;

	  /*border: 1px solid red;*/
	}

	.menu ul li a:hover {
	  background: #949494;
	}

	.menu li:hover ul {
	  display: block;
	  position: absolute;
	}

	.menu li:hover li {
	  float: left;
	  font-size: 11px;
	}

	.menu li:hover a {
	  background: #A0A0A0;
	}

	.menu li:hover li a:hover {
	  background: #C2C2C2;
	}

	.menu ul li ul {
	  position: absolute;
	  left: 100%;
	  top: 0;
	}
</style>
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
	 		$(".appendme").append('<div class="item"><div class="nama">'+valueHtml+' </div><div class="urutan">haii</div><div class="aksi" ><i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i></div></div>');
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
            			<div class="col-md-6">
            				<div class="area-dynaport appendme kursor" id="kursor">
								Silakan pilih field yang akan ditampilkan :
								
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
            			<div class="col-md-6">
            				<div class="area-dynaport appendme kursor" id="kursor2">
								Silakan pilih operasi yang akan ditampilkan :
								
								<!-- The custom context menu -->
								<div id="wrapper" class="menu">
									<ul id="menu">
										<li><a class="option appendbtn">Tambah</a></li>
									</ul>
								</div>
							</div>
            			</div>
            		</div>
            		<!-- <script type="text/html" id="appendTemplate">
					    <div>The div that should be appended</div>
					</script> -->

					<!-- <script
					  src="https://code.jquery.com/jquery-2.2.3.min.js"
					  integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
					  crossorigin="anonymous"></script> -->

					<!-- <table class="table-append">
						<tr>
							<td>
								
							</td>
						</tr>
					</table> -->
					
					
					<!-- <button class="appendbtn" type="button">Click to append</button> -->

					<!-- <div style="height: 100px; background-color: red;" oncontextmenu="window.alert('test');return false;"></div> -->

					<!-------->
					
					

					  <!-- Other contents of the page -->
					  <!-- <h1>Right Click to see the menu</h1> -->

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

					    var kursor2 =  document.getElementById("kursor2");
					    // add an event listener for the right-click event on the document
					    kursor2.addEventListener("contextmenu", (event) => {
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

            	</div>

	        	<div class="card-body">
	        		<div class="row">
		        		<div class="col-md-12">
			        		hai
		        		</div>
		        	</div>
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

