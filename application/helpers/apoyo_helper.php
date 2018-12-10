<?php
function Today()
{
	$fecha=getdate();
	return $fecha["year"]."-".($fecha["mon"]<10?0:"").$fecha["mon"]."-".($fecha["mday"]<10?0:"").$fecha["mday"];
}
function Hoy()
{
	return DateToMx(Today());
}
function DateToMySQL($fecha)
{
	if(strlen($fecha)==10)
		return substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
	return "";
}
function DateToMx($fecha)
{
	if(strlen($fecha)==10)
		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
	return "";
}
function AddDays($fecha,$dias)
{
	$fecha=date_create($fecha);
	date_add($fecha, date_interval_create_from_date_string($dias.' days'));
	return date_format($fecha, 'Y-m-d');
}
function Refill($dato,$largo,$relleno,$rellenaXIzquierda=true)
{
	while(strlen($dato)<$largo)
	{
		if($rellenaXIzquierda)
			$dato=$relleno.$dato;
		else
			$dato.=$relleno;
	}
	return $dato;
}
function Day($fecha) { return substr($fecha,8,2); }
function Month($fecha) { return substr($fecha,5,2); }
function Year($fecha) { return substr($fecha,0,4); }
function MonthYear($fecha) { return substr($fecha,0,4)."-".substr($fecha,5,2); }
function NextMonthYear($fecha)
{
	if(Month($fecha)=="12")
		return (intval(Year($fecha))+1)."-01";
	return Year($fecha)."-".((intval(Month($fecha))+1)<10?"0":"").(intval(Month($fecha))+1);
}
function ReplaceMonth($cadena)
{
	$currMonth=getdate(date_create()->getTimestamp())["month"];
	$currMonth_1=getdate(date_add(date_create(),date_interval_create_from_date_string("-1 month"))->getTimestamp())["month"];
	$currMonth_2=getdate(date_add(date_create(),date_interval_create_from_date_string("-2 month"))->getTimestamp())["month"];
	$currMonth_3=getdate(date_add(date_create(),date_interval_create_from_date_string("-3 month"))->getTimestamp())["month"];
	$mesesRee=array($currMonth,		$currMonth_1,	$currMonth_2,	$currMonth_3);
	$mesesAnt=array("_CURR_MONTH_",	"_MONTH-1_",	"_MONTH-2_",	"_MONTH-3_");
	$cadena=str_replace($mesesAnt,$mesesRee,$cadena);
	$mes=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$month=array("January","February","March","April","May","June","July","August","September","October","November","December");
	$cadena=str_replace($month,$mes,$cadena);
	return $cadena;
}
function CreatePassword() {
	$largo = 8;
	$value = "";
	for( $aux = 0; $aux < $largo; $aux++ ) {
		$type = rand( 1, 3);
		if( 1 == $type ) { $value .= chr( rand( 42, 57 ) ); }
		else if( 2 == $type ) { $value .= chr( rand( 65, 90 ) ); }
		else { $value .= chr( rand( 97, 122 ) ); }
	}
	return $value;
}
function EncryptPassword( $value ) { return base64_encode( sha1( $value ) ); }
?>