<?
function htmlToPdfIndex($container) {
  return '
<!DOCTYPE html>
<html>
<style>
.container {
	border: 2px solid black;
	width: 750px;
	height: 105mm;
	vertical-align: middle;
	margin :0 auto;
}
#left{    
 margin-left:10px;
 margin-top:10px;
 
 float: left;  
}  
 #right{    
  margin-right:10px;
  margin-top:10px;
  
 
 float: right;  
 }
.title {
	color: black;
	font-size: 20px;
	text-align: center;

}
.content {
	font-size: 14px;font-style: italic;
	width: 500px;
	margin-left: auto;
	margin-right: auto;
	text-align:justify;
}
.data {   text-decoration: underline; font-weight:bold; }
.signature {
  float:right;
}


.simple-table {
  font-family: arial, sans-serif;
  font-size:10px;
  table-layout: fixed ;
  width: 100% ;
}

.simple-table td {
  width: 33% ;
}

.simple-table td, th {
  border: 1px solid black;
  text-align: left;
  collapse:
}
</style>
<body>
<div class="container">
  ' . $container . '
</div>
</body>
</html>';
}
?>