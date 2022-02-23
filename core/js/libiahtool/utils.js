/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
function fechaHoy() 
{
  var fecha = new Date();
  var mes = fecha.getMonth() + 1;
  var dia=fecha.getDate();
  var charMes = "";
  var chardia="";
  if(mes < 10)
     charMes="0" + mes;
  else
     charMes=mes;
  if(dia < 10)
     chardia="0" + dia;
  else
     chardia=dia;
	 
   return  chardia  + "/" + charMes + "/" + fecha.getFullYear();  
}

function fechaUnMesAtras() 
{
  var fechaaux= new Date();
  var fecha = new Date(fechaaux.getTime() - (30 * 24 * 3600 * 1000));
  var mes = fecha.getMonth() + 1;
  var dia=fecha.getDate();
  var charMes = "";
  var chardia="";
  if(mes < 10)
     charMes="0" + mes;
  else
     charMes=mes;
  if(dia < 10)
     chardia="0" + dia;
  else
     chardia=dia;
	 
   return  chardia  + "/" + charMes + "/" + fecha.getFullYear();  
}


function getPartNumber(number,part,decimals)
{
  if ((decimals <= 0) || (decimals == null)) decimals =1;
  decimals = Math.pow(10,decimals);
  
  var intPart = Math.floor(number);
  var fracPart = (number % 1)*decimals;
  fracPart = fracPart.toFixed(0);
  if (part == 'int')
    return intPart;
  else
    return fracPart;
}

function obtenerParametro(strParamName)
{
	  var strReturn = "";
	  var strHref = window.location.href;
	  var bFound=false;
	  
	  var cmpstring = strParamName + "=";
	  var cmplen = cmpstring.length;

	  if ( strHref.indexOf("?") > -1 )
	  {
	    var strQueryString = strHref.substr(strHref.indexOf("?")+1);
	    var aQueryString = strQueryString.split("&");
		var aParam=null;
	    for ( var iParam = 0; iParam < aQueryString.length; iParam++ )
		{
	      if (aQueryString[iParam].substr(0,cmplen)==cmpstring)
		  {
	          aParam = aQueryString[iParam].split("=");
	          strReturn = aParam[1];
	          bFound=true;
			  aParam=null;
	          break;
		  }
	    }
	  }
	  if (bFound==false) return null;
	  return strReturn;
	}