<!doctype html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body>
<?php 
	$conexao = mysql_connect("localhost", "root", "") or die(mysql_error()); 
	$db = mysql_select_db("bd_graph", $conexao);
?>
<?php
 $id_visitante=$_GET["cod_visitante"];
 $qtd2=$_GET["qtd2"];
 $date = $_GET['ano'];
 $sql = mysql_query('select * from tb_visitantes where cod_visitante='.$id_visitante.' and data='.$date.'');
 while($ln = mysql_fetch_array($sql)){
 $mes = $ln['mes_visitante'];
 $primeiras_letras_2 = substr($mes,0,3);
 $qtd = $ln['quantidade_visitante'];
  echo $primeiras_letras_2.'. ', number_format($qtd, 0, '', '.')." visitas";
 $totalcomp = ($qtd - $qtd2)/100;
 
 if($qtd < $qtd2){
  echo "<span class='decresceu'> ".$totalcomp."%</span>";
 }else{
  echo "<span class='cresceu'> ".$totalcomp."%</span>";
 }
 }
?>
</body>
</html>