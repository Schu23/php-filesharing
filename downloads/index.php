<?
session_start();
include '../functions/files.inc';
?>
<html> 
<head> 
<style type="text/css"> 
	A:hover{color:#fa8f00;} 
	a{text-decoration:none} 
</style> 
<title>MARCOS TAPAJOS DOWNLOAD PAGE !</title> 
<body>
<blink>
	<center>
		<h1>
			MARCOS TAPAJOS DOWNLOAD PAGE !
		</h1>
	</center>
</blink>

<table width="700" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" align="center"> 
  <tr bgcolor="#666666"> 
    <td width="450" align="center">
    		<b>
    			<font color="#FFFFFF">
    				File
    			</font>
    		</b>
    	</td> 
    <td width="150" align="center">
    		<b>
    			<font color="#FFFFFF">
    				Date
    			</font>
    		</b>
    	</td> 
    <td width="100" align="center">
    		<b>
    			<font color="#FFFFFF">
    				Size
    			</font>
    		</b>
    	</td> 
  </tr> 

<?php 
$list="../files";
$directory=realpath($_POST["id"]);
if ($dir=opendir("$list/".$directory)){ 
	while(($files=readdir($dir)) !== false){ 
		if ($files <> "." && $files <> ".." ){ 
			$size[] = filesize("$list/".$directory."/".$files); 
			$datetime[] = filemtime	("$list/".$directory."/".$files); 
			$file_name[] = $files; 
		} 
	} 
	closedir($dir); 
} 
 
$n_files = count($datetime); 
arsort($datetime); 
reset($datetime); 
$indice=0;
while (list ($key, $value) = each ($datetime)){ 
?>
  <form name="form<?echo $indice;?>" action="index.php" method="post">
  <tr> 
    <td>
    		<input type="hidden" name="id" value="<?echo $directory."/".$file_name[$key];?>">
     	<a href="<?php 
     		if (!is_dir($list."/".$directory."/".$file_name[$key])) {
     			echo "$list".$directory."/".$file_name[$key];
     		}
     		else {
     			echo "#\" onclick='form".$indice.".submit();'";
     		} ?>">
     		<?php echo $file_name[$key]; ?>
     	</a>
	</td> 
    <td align="center" >
		<?php if (!is_dir($list."/".$directory."/".$file_name[$key])){
			echo date("d/m/Y-H:s",$value);
		}
		else {
			echo ("Directory");
		} ?> 
    </td> 
    <td align="center" >
		<?php if (!is_dir($list."/".$directory."/".$file_name[$key])){
			echo HumanizeFileSize($size[$key]);
		}
		else {
			echo ("Directory");
		}?> 
    </td> 
  </tr> 
  </form>
<?php 
$indice++;
} 
clearstatcache();
?>
</table>
<br>
<br>
<center>
	<?
	$actual_id = explode ("/",$directory);
	for ($i=1;$i<sizeof($actual_id)-1;$i++){
		$new_id = $new_id."/".$actual_id[$i];
	}
	?>
	<form name="formback" action="index.php" method="post">
		<input type="hidden" name="id" value="<?echo ($new_id);?>" size="40" maxlength="40"/>
		Click <a href="#" onclick="formback.submit();">here</a> to back.
	<form>
</center>
</body> 
</html> 
