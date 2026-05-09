<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Work Contract Management System">
    <meta name="author" content="Lashron Technologies, Lashron.com">
    <meta name="generator" content="Lashron.com">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>IMSc-IOAS</title>

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

  .float-right {
    float: right;
  }


  body.loaded {
  overflow-y: auto;
}

.LoaderOverlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 100000000;
  display: none;
}
.LoaderOverlay .overlayDoor:before, .LoaderOverlay .overlayDoor:after {
  content: "";
  position: absolute;
  width: 50%;
  height: 100%;
  /* background: #111; */
  background: rgba(0,0,0,0.7);
  backdrop-filter: saturate(180%) blur(0px);
  transition: 0.5s cubic-bezier(0.77, 0, 0.18, 1);
  transition-delay: 0.8s;
}
.LoaderOverlay .overlayDoor:before {
  left: 0;
}
.LoaderOverlay .overlayDoor:after {
  right: 0;
}
.LoaderOverlay.loaded .overlayDoor:before {
  left: -50%;
}
.LoaderOverlay.loaded .overlayDoor:after {
  right: -50%;
}
.LoaderOverlay.loaded .overlayContent {
  opacity: 0;
  margin-top: -15px;
}
.LoaderOverlay .overlayContent {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  transition: 0.5s cubic-bezier(0.77, 0, 0.18, 1);
}
.LoaderOverlay .overlayContent .skip {
  display: block;
  width: 130px;
  text-align: center;
  margin: 50px auto 0;
  cursor: pointer;
  color: #fff;
  font-family: "Nunito";
  font-weight: 700;
  padding: 12px 0;
  border: 2px solid #fff;
  border-radius: 3px;
  transition: 0.2s ease;
}
.LoaderOverlay .overlayContent .skip:hover {
  background: #ddd;
  color: #444;
  border-color: #ddd;
}

.loader {
  width: 128px;
  height: 128px;
  border: 3px solid #03e7fb;
  border-bottom: 3px solid transparent;
  border-radius: 50%;
  position: relative;
  -webkit-animation: spin 1s linear infinite;
          animation: spin 1s linear infinite;
  display: flex;
  justify-content: center;
  align-items: center;
}
.loader .inner {
  width: 64px;
  height: 64px;
  border: 3px solid transparent;
  /* border-top: 3px solid #000; */
  background: rgba(0,0,0,0.3);
  background-image: url('{{ asset("images/BARCLogo.png") }}');
  border-radius: 50%;
  -webkit-animation: spinInner 2s linear infinite;
          animation: spinInner 2s linear infinite; 
  background-size:58px 58px;
  background-repeat:no-repeat;
}

@-webkit-keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@-webkit-keyframes spinInner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-720deg);
  }
}
@keyframes spinInner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-720deg);
  }
}
</style>
@include('layouts.partials.header')
</head>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();">
  
  <div class="LoaderOverlay" id="LoaderOverlay">
    <div class="overlayDoor"></div>
	    <div class="overlayContent">
        <div class="loader">
			    <div class="inner"></div>
		    </div>
	  </div>
  </div>

  @include('layouts.partials.menu')
  <main class="container">
    @yield('content')
  </main>
</body>
@include('layouts.partials.footer')
<script>
  $(document).ready(function() {
      $(document).ajaxStart(function() {
          $('#LoaderOverlay').show();
      });
      $(document).ajaxStop(function() {
          $('#LoaderOverlay').hide();
      });
      $(document).on('submit', 'form', function() {
          $('#LoaderOverlay').show();
      });
    
  })
</script>
</html>