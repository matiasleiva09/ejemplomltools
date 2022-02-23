<?
abstract class Utils
{
	public function getFechaVisualABase($xFecha)
	{
	   $vStrFecha = str_replace('/', '-', $xFecha);
	   return date('Y-m-d', strtotime($vStrFecha));
	}
}
?>