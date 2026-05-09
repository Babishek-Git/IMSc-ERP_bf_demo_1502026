<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>IMSc - IOAS</title>

    <!-- Bootstrap core CSS -->
    
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    
</head>
<body class="text-center">
    
    <main class="form-signin">


<link href="{!! url('assets/login-assets/css/bootstrap.css') !!}" rel="stylesheet" type="text/css" media="all" />
<link href="{!! url('assets/login-assets/css/style.css') !!}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="{!! url('assets/login-assets/css/style4.css') !!}">
<link href="{!! url('assets/login-assets/css/fontawesome-all.css') !!}" rel="stylesheet">
<link href="{!! url('assets/login-assets/fonts/fonts.css') !!}" rel="stylesheet">
<link href="{!! url('assets/login-assets/bootstrap-dialog/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
<link href="{!! url('assets/login-assets/bootstrap-dialog/css/bootstrap-dialog.min.css') !!}" rel="stylesheet">
<link href="{!! url('assets/login-assets/Stepwizard/BSMagic-min.css') !!}" rel="stylesheet">

<script src="{!! url('assets/login-assets/js/jquery-2.2.3.min.js') !!}"></script>
<script src="{!! url('assets/login-assets/bootstrap.min-4.1.3.js') !!}"></script>
<script src="{!! url('assets/login-assets/js/chosen.jquery.min.js') !!}"></script>
<script src="{!! url('assets/login-assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('assets/login-assets/bootstrap-dialog/js/bootstrap-dialog.min.js') !!}"></script>

<style>
html 
{
    height: 100%;
	margin:1px;
}
.bodystyle 
{
    /*background-image:url("images/login_background_ps6.png");*/   /*  option 2  */
	/*background-image:url("images/login_blue_ps1.png"); Existing*/   /*  selected option 1  */
	/*background-image:url("images/login_with_pink_img.png");*/
	/*background-image:url("images/login_with_pink.png");*/   /* option 3  */
	background-image:url('images/login_bg.png');
    background-repeat: no-repeat;
    background-size: 100% 100%;
	background-position:center;
}
.loginbg{
    background: url("images/BARCLogo.png") ;/*url({!! url('images/login_blue_ps1.png') !!}");*/
}
</style>
<body bgcolor="#000000">
<div class="bodystyle">
	<div class="loginsection" align="center" style="display:block;">
		
		
	</div>
</div>
<style>
#myModal{
    box-sizing:border-box;
    padding:0px !important;
    height: 425px;
}
.login-modal{
    width:400px !important;
    border-radius:5px;
    height: 425px;
}
.login-bradius{
    border-radius:0px 0px 0px 0px;
}
.modal-backdrop.in {
  filter: alpha(opacity=50);
  opacity: 0.8;
}


.login-wrap {
  position: relative;
  background: #000232;
  border-radius: 5px;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 20px !important;
  /*-webkit-box-shadow: 0px 10px 34px -15px rgba(255, 255, 255, 0.6);
  -moz-box-shadow: 0px 10px 34px -15px rgba(255, 255, 255, 0.6);
  box-shadow: 0px 10px 34px -15px rgba(255, 255, 255, 0.6);*/
  border:2px solid #028899;
  height: 420px;
  
}
.login-wrap .img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin: 0 auto;
    margin-bottom: 0px;
  margin-bottom: 20px;
  background-size: cover;
background-repeat: no-repeat;
background-position: center center;
margin-top:12px;

}

.form-control {
  height: 35px;
  background: rgba(0, 0, 0, 0.05);
  color: #fff !important;
  font-size: 16px;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 0;
  border: none;
    border-bottom-color: currentcolor;
    border-bottom-style: none;
    border-bottom-width: medium;
  border-bottom: 1px solid #00bcd4;
  padding-left: 30px;
  padding-right: 0;
  letter-spacing: 1px;
  -webkit-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  font-family: 'Poiret One', cursive;
}

.form-control:focus{
	color:#000;
	border-top:none !important;
	border-left:none !important;
	border-right:none !important;
	outline:0px;
	border-bottom: 1px solid #00bcd4;
}

.form-group {
  position: relative;
}

.form-group .icon span {
  color: #fff;
}
*, ::before, ::after {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.d-flex {
  display: -webkit-box !important;
  display: -ms-flexbox !important;
  display: flex !important;
}
.justify-content-center {
  -webkit-box-pack: center !important;
  -ms-flex-pack: center !important;
  justify-content: center !important;
}
.align-items-center {
  -webkit-box-align: center !important;
  -ms-flex-align: center !important;
  align-items: center !important;
}
.form-group .icon {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 20px;
  height: 48px;
  background: transparent;
  font-size: 18px;
}
.login-wrap h3 {
  font-weight: 600;
  font-size: 28px;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.login-wrap p {
  color: #fff;
  font-family: "Lato", Arial, sans-serif;
  font-size: 12px;
  margin-top:4px;
  margin-bottom:20px;
  font-style:italic;
}
.text-center {
  text-align: center !important;
}
.ibtn{
    color:#000232 !important;
}
.modal-header{
	display:none;
}
.modal-dialog {
  width: 400px;
  margin-top:20px;
}
.modal-body{
	min-height:410px;
	padding:0px;
	overflow:hidden;
	
}
.login-modal{
	-webkit-box-shadow: 0 0px 114px rgba(0, 0, 0,1);
	box-shadow: 0 0px 114px rgba(0, 0, 0,1);
	height:420px;
	width: 400px;
  margin-top:0px;
  margin-bottom:0px;
  margin-left:0px;
  margin-left:0px;
  top:0px;
  overflow:hidden;
}
.logo-title{
	color:#fff;
	letter-spacing: 0.4px;
	/*letter-spacing: 1px;
	font-size: 18px;*/
	/*font-family:"Roboto Condensed";
	font-size:20px;*/
	/*font-family:Georgia, "Times New Roman", Times, serif;
	font-size:18px;*/
	/*font-family:*/
	font-weight:200;
	font-family:Roboto;
	font-size:18px;
	font-family:Georgia, verdana;
}
.logo-subtitle{
  color:#fff;
	letter-spacing: 0.4px;
  font-weight:200;
	font-family:Roboto;
	font-size:15px;
	font-family:Georgia, verdana;
}
h7{
	text-align:center;
	font-size:12px;
}
.btn.btn-info{
  color: #000;
}
</style>


<script>
    var FormStr = "{{ route('login.perform') }}";
    var LoginModalCont = '<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
    LoginModalCont += '<div class="modal-dialog login-modal" role="document">';
    LoginModalCont += '<div class="modal-content clearfix semi-transparent-modal">';
    LoginModalCont += '<section class="ftco-section">';
    LoginModalCont += '<div class="container">';
    LoginModalCont += '<div class="row justify-content-center">';
    LoginModalCont += '<div class="col-md-12 col-lg-12 no-padding-lr">';
    LoginModalCont += '<div class="login-wrap py-5">';
    LoginModalCont += '<div class="img d-flex align-items-center justify-content-center loginbg"></div>';
    LoginModalCont += '<h5 class="text-center mb-2 logo-title">IMSc Office Automation System</h5>';
    LoginModalCont += '<h5 class="text-center mb-0 logo-subtitle">Taramani, Chennai.</h5>';
    LoginModalCont += '<h4 class="mb-0 logo-font">&nbsp;</h4>';
    LoginModalCont += '<form action="'+FormStr+'" method="post" class="login-form">';
    LoginModalCont += '<div class="input-group mb-3">';
    LoginModalCont += '<div class="input-group-prepend">';
    LoginModalCont += '<span class="input-group-text" id="basic-addon1"><span class="fa fa-user"></span></span>';
    LoginModalCont += '</div>';
    LoginModalCont += '<input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username" aria-label="Username" autocomplete"off">';
    LoginModalCont += '</div>';
    LoginModalCont += '<div class="input-group mb-3">';
    LoginModalCont += '<div class="input-group-prepend">';
    LoginModalCont += '<span class="input-group-text" id="basic-addon1"><span class="fa fa-key"></span></span>';
    LoginModalCont += '</div>';
    LoginModalCont += '<input type="password" class="form-control" name="password" id ="password" placeholder="Enter Your Password" aria-label="Username" autocomplete"off">';
    LoginModalCont += '</div>';
    LoginModalCont += '<div class="form-group" align="center">';
    LoginModalCont += '<button type="submit" class="btn btn-info navbar-btn" role="button" name="submit" id="submit">LOGIN</button><input type="hidden" name="_token" value="{{ csrf_token() }}" />';
    LoginModalCont += '</div>';
    LoginModalCont += '</form>';
    LoginModalCont += '</div>';
    LoginModalCont += '</div>';
    LoginModalCont += '</div>';
    LoginModalCont += '</div>';
    LoginModalCont += '</section>';
    LoginModalCont += '</div>';
    LoginModalCont += '</div>';
    LoginModalCont += '</div>';
    //alert(LoginModalCont);
	BootstrapDialog.show({
		message: LoginModalCont,
		closable: true,
		closeByBackdrop: false,
		closeByKeyboard: false,
	});
	function autoResizeDiv(){
		var x = document.getElementsByClassName("bodystyle");
			x[0].style.height = (window.innerHeight*100/100)+"px";
		var z = document.getElementsByClassName("loginsection");
			z[0].style.paddingTop = (window.innerHeight*94/275)+"px";
		var ht1 = document.getElementsByClassName("loginsection");
		var h1 = ht1[0].style.height
	}
	window.onresize = autoResizeDiv;
	autoResizeDiv();
</script>
</main>
    

</body>
</html>
