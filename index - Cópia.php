<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Gráfico</title>
<script type="text/javascript" src="jquery.1.7.2.min.js"></script>
<script>
$(document).ready(function(){
//esconde a div com os valores
$("#content").hide();
var content = $('#content');
//pre carregando o gif  
loading = new Image(); loading.src = 'load.gif';  
$(".linhas").live('click', function(e){  
	e.preventDefault();
	content.html('<img class="load" src="load.gif" alt="carregando" />');
	var href = $(this).attr('href');  
	$.ajax({  
		url: href,  
		success:function(response){  
			$('#content').html(response);
		}  
	});  
});

//função para mostrar os valores que serão obtidos por ajax
$("#grafico line").click(function(e){
	$("#content").css({
	  "margin-left": e.pageX+5, //pega o valor X do clique do ponteiro
	  "margin-top": e.pageY-305,  //pega o valor Y do clique do ponteiro
    });
	$("#content").fadeIn(200); //ao clicar a div irá aparecer
	
	if(document.getElementById('content').style.display == 'block'){
	setTimeout(function(){//esconde a div depois de determinados os segundos
        document.getElementById('content').style.display = 'none';
      }, 8000);
	  $("#content").click(function(e){
		  $("#content").fadeOut("fast");
	  });}
	  
});
});
</script>
</head>

<body>
<form action="index.php" method="GET">
<input type="submit" value="2013" name="ano" >
<input type="submit" value="2014" name="ano" >
</form>
<?php 
	$conexao = mysql_connect("127.0.0.1", "root", "") or die(mysql_error()); 
	$db = mysql_select_db("bd_chiptronic", $conexao);
	$date = $_GET['ano'];
	$data = mysql_query('select * from tb_visitantes where data='.$date.'');
	$lndata = mysql_fetch_array($data);
	$datex = $lndata['data'];
?>
<svg id="grafico" width="600" height="200" style="padding:40px 40px 40px 50px;background:#fdfdfd;border:1px solid #eee">
<style type="text/css" media="all">
<![CDATA[

#content{
	position:absolute;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	width:auto;
	padding:8px;
	background:#fff;
	color:#000;
	border-radius:4px;
	border:1px solid #bbb;
	box-shadow:1px 1px 2px 0 rgba(0,0,0,0.25);
	-webkit-box-shadow:1px 1px 2px 0 rgba(0,0,0,0.25)}

/*texto*/
text{
	font-family:Arial, Helvetica, sans-serif;
	fill:#000;
	font-size:9px}

text.numeracao{font-size:8px}
	
circle{display:none}

/*linha*/
line{
	fill:none;
	stroke-linecap:round;
	transition:all 250ms ease}

/*linha do gráfico*/
line.linha-grafico{
	stroke:#1155cc;
	stroke-width:2}

line.linha-grafico:hover{
	cursor:pointer;
	stroke-width:3}

g:hover circle{
	display:block;
	cursor:pointer;
	stroke-opacity:0.6;
	stroke-width:10}

circle{
	fill:#1155cc;
	stroke:#1155cc}
	
/*animações*/
<?php  
$segundos = 200;
$sqlmes = mysql_query('select * from tb_visitantes where data='.$date.'');
while($lnmes = mysql_fetch_array($sqlmes)){
 $meses = $lnmes['mes_visitante'];
 $primeiras_letras = substr($meses,0,3);
?>
<?php echo 'g#'.$primeiras_letras.'{
	animation:animacao '.$segundos.'ms alternate;
	-moz-animation:animacao '.$segundos.'ms alternate;
	-webkit-animation:animacao '.$segundos.'ms alternate;
	-o-animation:animacao '.$segundos.'ms alternate;
	-ms-animation:animacao '.$segundos.'ms alternate}'."\n";
	$segundos = $segundos+200; 
}
?>

/*animcação*/
@-webkit-keyframes animacao{
	0%{opacity:0}
	60%{opacity:0}
	100%{opacity:1}
}
@-o-keyframes animacao{
	0%{opacity:0}
	60%{opacity:0}
	100%{opacity:1}
}
@-moz-keyframes animacao{
	0%{opacity:0}
	60%{opacity:0}
	100%{opacity:1}
}
@-ms-keyframes animacao{
	0%{opacity:0}
	60%{opacity:0}
	100%{opacity:1}
}
span.cresceu{color:#090}
span.decresceu{color:#F00}
]]>
</style>

<!--linhas horizontais-->
<g id="linhas-horizontais">
  <rect x="0" y="0" width="600" height="1" stroke="none" fill="#ddd"></rect>
  <rect x="0" y="50" width="600" height="1" stroke="none" fill="#ddd"></rect>
  <rect x="0" y="100" width="600" height="1" stroke="none" fill="#ddd"></rect>
  <rect x="0" y="150" width="600" height="1" stroke="none" fill="#ddd"></rect>
  <rect x="0" y="200" width="600" height="1" stroke="none" fill="#000"></rect>
  <text class="numeracao" text-anchor="end" x="-5" y="5">20.000</text>
  <text class="numeracao" text-anchor="end" x="-5" y="55">15.000</text>
  <text class="numeracao" text-anchor="end" x="-5" y="105">10.000</text>
  <text class="numeracao" text-anchor="end" x="-5" y="155">5.000</text>
  <text class="numeracao" text-anchor="end" x="-5" y="205">0</text>
</g>

<!--gráfico-->

<?php
if($date=='2013'){
	
	$jan = 0;//valor do x1
	$x2jan = 50;//valor do x2
	
	$sqlm = mysql_query('select * from tb_visitantes where data='.$date.'');
	$lnm = mysql_fetch_array($sqlm);
		$qtdm = $lnm['quantidade_visitante'];
				$nome_mes = $lnm['mes_visitante'];
		$qtdm2 = $qtdm/100;
		$primeiras_letras_1 = substr($nome_mes,0,3);
?>
<g transform="translate(0,200) scale(1,-1)">
  <polygon points="0,0 <?php echo $x2jan. ','.$qtdm2 ?> 
<?php
	$inicio = 0;
	$xf = 50;
	$i = 1;
	
	$sql = mysql_query('select * from tb_visitantes where cod_visitante >= 2 and data='.$date.'');
		$nummes = mysql_num_rows($sql);
	$totalmes = ($nummes*50)+50;
	while($ln = mysql_fetch_array($sql)){
	$qtd = $ln['quantidade_visitante']; 
	$visit = $qtd/100;
	$mes = $ln['mes_visitante'];
	$primeiras_letras_2 = substr($mes,0,3);
	
	$inicio = $inicio+50;
	$xf = $xf+50;
	
	$sqlx = mysql_query('select * from tb_visitantes where cod_visitante = '.$i.' and data='.$date.'');
	$lnx = mysql_fetch_array($sqlx);
	$qtd2 = $lnx['quantidade_visitante'];
	$qtd22 = $qtd2/100;
?>
<?php echo $xf ?>,<?php echo $visit.' ' ?>
<?php
	$i++; }
?>
<?php echo $totalmes ?>,0" style="fill:#dbe8ff;fill-opacity:0.5"/>
</g>
<g id="<?php echo $primeiras_letras_1 ?>"> 
  <a class="linhas" href="valores.php?cod_visitante=1" title="ver quantidade de visitantes">
  <g id="linhas-grafico" transform="translate(0,200) scale(1,-1)"> 
    <!--linha de janeiro-->
    <line class="linha-grafico" x1="<?php echo $jan ?>" y1="0" x2="<?php echo $x2jan ?>" y2="<?php echo $qtdm2 ?>"/>
    <!--círculo de janeiro-->
    <circle cx="<?php echo $x2jan ?>" cy="<?php echo  $qtdm2 ?>" r="3" />
  </g>
  </a>
</g>

<?php


} else if($date=='2014'){
	$jan = 0;//valor do x1
	$x2jan = 50;//valor do x2
	
	$sqlm = mysql_query('select * from tb_visitantes where data='.$date.'');
	$lnm = mysql_fetch_array($sqlm);
		$qtdm = $lnm['quantidade_visitante'];
		$nome_mes = $lnm['mes_visitante'];
		$qtdm2 = $qtdm/100;
		$primeiras_letras_1 = substr($nome_mes,0,3);
?>
	<g transform="translate(0,200) scale(1,-1)">
  <polygon points="0,0 <?php echo $x2jan. ','.$qtdm2 ?> 
	<?php
	$inicio = -50;
	$xf = 0;
	$i = 12;
	
	$sql = mysql_query('select * from tb_visitantes where cod_visitante >= 2 and data='.$date.'');
	$nummes = mysql_num_rows($sql);
	$totalmes = $nummes*50;
	while($ln = mysql_fetch_array($sql)){
	$qtd = $ln['quantidade_visitante']; 
	$visit = $qtd/100;
	$mes = $ln['mes_visitante'];
	$primeiras_letras_2 = substr($mes,0,3);
	$inicio = $inicio+50;
	$xf = $xf+50;
	
	$sqlx = mysql_query('select * from tb_visitantes where cod_visitante = '.$i.' and data='.$date.'');
	$lnx = mysql_fetch_array($sqlx);
	$qtd2 = $lnx['quantidade_visitante'];
	$qtd22 = $qtd2/100;
?>
<?php echo $xf ?>,<?php echo $visit.' ' ?>
<?php
	$i++; }
?>
<?php echo $totalmes ?>,0" style="fill:#dbe8ff;fill-opacity:0.5"/>
</g>
<g id="<?php echo $primeiras_letras_2 ?>">
  <a class="linhas" href="valores.php?cod_visitante=<?php echo $ln['cod_visitante'] ?>&qtd2=<?php echo $qtd2 ?>&ano=<?php echo $date ?>" title="ver quantidade de visitantes">
  <g transform="translate(0,200) scale(1,-1)"> 
    <!--linha de fevereiro-->
    <line class="linha-grafico" x1="<?php echo $inicio ?>" y1="<?php echo $qtd22 ?>" x2="<?php echo $xf ?>" y2="<?php echo $visit ?>"/>
    <!--círculo de fevereiro-->
    <circle cx="<?php echo $xf ?>" cy="<?php echo $visit ?>" r="4" />
  </g>
  </a>
</g>

	<?php
}
?> 







<!-- Começo Grafico 2013 -->


<?php
if($date=='2013'){
?>
<?php
	$inicio = 0;
	$xf = 50;
	$i = 1;
	
	$sql = mysql_query('select * from tb_visitantes where cod_visitante >= 2 and data='.$date.'');
	$numt = mysql_num_rows($sql);
	while($ln = mysql_fetch_array($sql)){
	$qtd = $ln['quantidade_visitante']; 
	$visit = $qtd/100;
	$mes = $ln['mes_visitante'];
	$primeiras_letras_2 = substr($mes,0,3);
	
	$inicio = $inicio+50;
	$xf = $xf+50;
	
	$sqlx = mysql_query('select * from tb_visitantes where cod_visitante = '.$i.' and data='.$date.'');
	$lnx = mysql_fetch_array($sqlx);
	$qtd2 = $lnx['quantidade_visitante'];
	$qtd22 = $qtd2/100;
?>
</g>
<!--divisão de mês-->
<g id="<?php echo $primeiras_letras_2 ?>">
  <a class="linhas" href="valores.php?cod_visitante=<?php echo $ln['cod_visitante'] ?>&qtd2=<?php echo $qtd2 ?>&ano=<?php echo $date ?>" title="ver quantidade de visitantes">
  <g transform="translate(0,200) scale(1,-1)"> 
    <!--linha de fevereiro-->
    <line class="linha-grafico" x1="<?php echo $inicio ?>" y1="<?php echo $qtd22 ?>" x2="<?php echo $xf ?>" y2="<?php echo $visit ?>"/>
    <!--círculo de fevereiro-->
    <circle cx="<?php echo $xf ?>" cy="<?php echo $visit ?>" r="4" />
  </g>
  </a>
</g>
<?php
	$i++; }
?>


<!-- Fim do grafico 2013 -->



<!-- começo do grafico 2014 -->






<?php } else if ($date == 2014){
	?>
<!--fim do preenchimento de objeto-->
	<?php
	$inicio = -50;
	$xf = 0;
	$i = 12;
	
	$sql = mysql_query('select * from tb_visitantes where cod_visitante >= 2 and data='.$date.'');
	while($ln = mysql_fetch_array($sql)){
	$qtd = $ln['quantidade_visitante']; 
	$visit = $qtd/100;
	$mes = $ln['mes_visitante'];
	$primeiras_letras_2 = substr($mes,0,3);
	
	$inicio = $inicio+50;
	$xf = $xf+50;
	
	$sqlx = mysql_query('select * from tb_visitantes where cod_visitante = '.$i.' and data='.$date.'');
	$lnx = mysql_fetch_array($sqlx);
	$qtd2 = $lnx['quantidade_visitante'];
	$qtd22 = $qtd2/100;
	
?>
<!--divisão de mês-->
<g id="<?php echo $primeiras_letras_2 ?>">
  <a class="linhas" href="valores.php?cod_visitante=<?php echo $ln['cod_visitante'] ?>&qtd2=<?php echo $qtd2 ?>&ano=<?php echo $date ?>" title="ver quantidade de visitantes">
  <g transform="translate(0,200) scale(1,-1)"> 
    <!--linha de fevereiro-->
    <line class="linha-grafico" x1="<?php echo $inicio ?>" y1="<?php echo $qtd22 ?>" x2="<?php echo $xf ?>" y2="<?php echo $visit ?>"/>
    <!--círculo de fevereiro-->
    <circle cx="<?php echo $xf ?>" cy="<?php echo $visit ?>" r="4" />
  </g>
  </a>
</g>
<?php
	$i++; }
?>
	<?php
	}?>
	
	
<!-- Fim do grafico 2014 -->
	
<div id="content"></div>
</svg>
<?php 
$compara = mysql_query('SELECT SUM( quantidade_visitante ) AS soma FROM tb_visitantes where data='.$date.'');
$cont = mysql_fetch_array($compara);
$valor_total = $cont["soma"];
echo number_format($valor_total,0,"",".");
?>
</body>
</html>