<style>
		input[type="text"], input[type="password"]{
			border: none;
			border-bottom: 2px solid black;
			margin-top: 3%;
		}
		input[type="text"]:focus{
			border-bottom-color: dodgerblue;
		}
		input[type="password"]:focus{
			border-bottom-color: dodgerblue;
		}
		input[type="submit"]{
			border-radius: 40px 0px 40px 0px;
			border-color: black;
			font-weight: bold;
		}
		input:required{
			background: url(../images/asterisk.png) right center no-repeat transparent;
		}
		input:focus:valid{
			border-bottom-color: green;
			background: url(../images/valid.png) right center no-repeat transparent;
		}
		input:focus:invalid{
			border-bottom-color: red;
			background: url(../images/invalid.png) right center no-repeat transparent;
		}
		legend{
			background-color: #A5A5A5; 
			border: 1px solid black;
			font-weight: bold;
		}
		label{
			padding: 3px;
			color: white;
			border-radius: 600px 100px 100px 300px;
			border-color: white;
			background-color: #570342;
		}
		h2{
 			color: #570342;
 			text-align: center;
 			font-size: 25pt;
		}
		h3{
			color: #570342;
			margin-left: 50px;
		}
		ul{
			list-style-type: none;
		}

		.listButtons li {
			display: inline-block;
			width: 150px;
			color: #570342;
			font-weight: bold;
			font-size: 18pt;
		}
		.blockRight{
			float: right;
			width: 46%;
			height: 400px;
			overflow: auto;
			border: 2px solid #570342;
		}
		.blockLeft{
			float: left;
			width: 52%;
			height: 400px;
			overflow: auto;
			background-color: #E6E6E6;
		}
		footer{
			position: absolute;
			margin-top: 415px; 
			width: 99%;
		}
</style>