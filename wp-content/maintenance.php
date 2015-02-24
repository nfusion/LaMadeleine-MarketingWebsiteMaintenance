<!DOCTYPE html>
<html>
<head>
	<title>Site Maintenance</title>
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
	<style>
		*, *:before, *:after {
			box-sizing:border-box;
		}
		body, html {padding:0; margin:0;}
		body {background: url("maintenance/LM_Cloth_Tile.png"); font:16px Georgia,serif;}

		#header {
		  width: 100%;
		  min-width: 320px;
		  height: 70px;
		  padding: 8px 10px;
		  position: fixed;
		  z-index: 102;
		  text-align: center;
		  background: url("maintenance/header-bg-tile.jpg") 0 -10px repeat-x;
		  -webkit-box-shadow: rgba(0, 0, 0, 0.6) 0 2px 2px;
		  -moz-box-shadow: rgba(0, 0, 0, 0.6) 0 2px 2px;
		  box-shadow: rgba(0, 0, 0, 0.6) 0 2px 2px;
		}
		#header .header-wrapper {
		  max-width: 1140px;
		  margin: 0 auto;
		  position: relative;
		  overflow: hidden;
		}
		#header .logo {
		  width: 190px;
		  height: auto;
		  margin-top: 2px;
		}
		#header .tagline {
		  display: none;
		}
		#header {
		    height: 80px;
		    padding: 13px 15px;
		    position: relative;
			background-position: 0 0;
		}
		#header .logo {
		    width: 210px;
		    margin-top: 0;
		}
		#container {
		  width: 100%;
		  max-width: 1140px;
		  min-width: 320px;
		  min-height: 860px;
		  background: #fffdf0;
		  margin:0 auto;
		  color:#310D00;
		}

		#content {
			background: #fffdf0;
			padding:20px;
		}
		h1 {font-family:'Playfair Display',Georgia,serif; font-size:20px; text-transform: uppercase;}
	</style>
</head>
<body>
	<header id="header" role="banner">
		<div class="header-wrapper">
			<div class="logo-wrapper">
				<img class="logo" alt="La Madeleine Logo" src="http://lamadeleine.com/wp-content/themes/required-lamadeleine/img/header/logo.png">
			</div>
      	</div>
	</header>
	<div id="container">
	<div id="content">
		<h1>Site Under Maintenance</h1>
		<p>La Madeleine is currently undergoing scheduled site maintenance. Please check back in a few minutes! <em>Merci!</em></p>
	</div>
	</div>
</body>
</html>