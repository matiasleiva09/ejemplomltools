/*
 *  CONTIENE LOS SCRIPT PARA
 *  REALIZAR LAS LLAMADAS POR AJAX
 *  matias leiva
 */
function Ajax()
{
	this.request = null;
	this.asincronico = true;
	this.pagina = "";
	this.parametros = "";
	this.id = "";
	this.serializable = false;
	this.arraySerializable = null;
	this.inicializar = (function()
	{
		if (window.XMLHttpRequest)
		{
			this.request = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			this.request = new ActiveXObject("Microsoft.XMLHTTP");
		}
	});

	this.post = (function()
	{
		// hago un request por si es ie o el resto
		this.request.open("POST", this.pagina, this.asincronico);
		$("#" + this.id).html("<center><img src='libiahtool/images/cargando.gif' height='25px' width='25px' /></center>");
		var id = this.id;
		var serializable = this.serializable;
		var arraySerializable = new Array();
		this.request.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				if (!serializable)
				{
					$("#" + id).html(this.responseText);
				}
				else
				{
					var ArraySerializableAux1 = this.responseText.split(";");
					var strSer = null;
					var indice = null;
					var valor = null;
					for (var i = 0; i < (ArraySerializableAux1.length - 1); i++)
					{
						strSer = ArraySerializableAux1[i].split("=");
						indice = (strSer[0].toString());
						valor = (strSer[1].toString());
						arraySerializable[indice] = valor;
						strSer = null;
						indice = null;
						valor = null;
					}
					ArraySerializableAux1 = null;
				}
			}
		}
		this.request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		this.request.send(this.parametros);
		this.arraySerializable = arraySerializable;
		/*
		 * if(this.serializable) { var html=$("#" + id).html(); var
		 * ArraySerializableAux1=html.split(";"); var strSer=null; var
		 * indice=null; var valor=null; for(var i=0;i<(ArraySerializableAux1.length-1);i++) {
		 * strSer = ArraySerializableAux1[i].split("=");
		 * indice=(strSer[0].toString()); valor=(strSer[1].toString());
		 * this.arraySerializable[indice]=valor; strSer=null; indice=null;
		 * valor=null; } ArraySerializableAux1=null;
		 * window.alert(this.arraySerializable['descripcionTipoDocumento']); }
		 * $("#" + id).html("");
		 */
	});

	this.get = (function()
	{
		this.request.open("GET", this.pagina + "?" + this.parametros, this.asincronico);
		$("#" + this.id).html("<center><img src='libiahtool/images/cargando.gif' height='25px' width='25px' /></center>");
		var id = this.id;
		this.request.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				$("#" + id).html(this.responseText);
			}
		}
		this.request.send(null);
	});
};

// REALIZAMOS AJAX VIA GET
