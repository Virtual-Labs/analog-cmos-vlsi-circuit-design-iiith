<?php

echo $_POST["comp"] ;

$token = strtok($_POST["comp"] , "_");
$i = 0;
while ($token != false)
{
	$comp_value[$i++] = $token;
	$token = strtok("_");
}

$file = "inv22_new.sp";
$f = fopen($file , "w");
//---------------------------------------------------
// Writing the spice code -----------------------------
//---------------------------------------------------
fwrite($f , "*inverter\n");
fwrite($f , ".include '180nm_bulk.txt'\n");
fwrite($f , "M1 out Vb1 in 0 NMOS l=$comp_value[0] w=$comp_value[1]\n");
fwrite($f , "cl out 0 $comp_value[2]p\n");
fwrite($f , "M2 out Vb Vdd Vdd PMOS l=$comp_value[7] w=$comp_value[8]\n"); 
fwrite($f , "M3 Vb Vb Vdd Vdd PMOS l=$comp_value[9] w=$comp_value[10]\n"); 
fwrite($f , "Ib Vb 0 $comp_value[3]m\n");
fwrite($f , "Vdd Vdd 0 1.8\n");
fwrite($f , "vin in 0 ac $comp_value[5]m\n"); 
fwrite($f , "Vb1 Vb1 0 dc $comp_value[4]\n");
fwrite($f , ".ac dec 50 10meg 1000meg\n");
fwrite($f , ".save V(out) V(in)\n");
fwrite($f , ".end\n");
fclose($f);
echo "Done";
//-----------------------------------------------------
`ngspice -b  inv22_new.sp -r rawfile`;
`cat rawfile |tr [:blank:] "\n" >  outfile`;
//`rm rawfile`;

//$array = file("outfile");

//$i = 0 ;
//while ( $array[$i] != "Values:\n" && $i < 50 )
//{
//	echo $_REQUEST["name"]; 
//	$i++ ;
//}

//$i++;
//	echo  $array[$i];


//<applet code="exp1_out.class" width="1000" height="600" Align="Middle" name= "exp1_out">
?>


