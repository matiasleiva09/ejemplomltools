// JavaScript Document
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
function ItemComboBox()
{
	this.idItem = "";
	this.valor = "";
	this.padre="";
	this.seleccionado = false;
	this.request = null;
	this.crearRapido=
	(
		function(xIdItem,xValor,xPadre,xSeleccionado)
		{
			this.idItem = xIdItem;
			this.valor = xValor;
			this.padre=xPadre;
			this.seleccionado = xSeleccionado;
		}
	);
	this.render = (function()
	{
		var vHtml = '<option value="' + this.idItem;
		if (this.seleccionado)
			vHtml += " select";
	    if(this.padre!="")
		   vHtml += '">' + this.valor + ' - ' + this.padre +'</option>';
		else
		 vHtml += '">' + this.valor + '</option>';
		return vHtml;
	});
}

function ComboBox()
{
	this.label = "";
	this.mostrarVacio = true;
	this.textoVacio = "Seleccione elemento";
	this.id = "";
	this.idInput = "";
	this.tipo = "SIMPLE";
	this.httpSource = null;
	this.source = new Array();
	this.seleccionado = false;
	this.obligatorio = true;
	this.parametros = null;
	this.pagina = null;
	this.hijo=null;
	this.tieneDatoPadre=false;
	this.construirRapido=
	(
	   function(xLabel,xMostrarVacion,xTextoVacio,xId,xIdInput,xTipo,xArray,xHttpSource,xObligatorio)
	   {
		   this.label=xLabel;
		   this.mostrarVacio=xMostrarVacion;
		   this.textoVacio=xTextoVacio;
		   this.id=xId;
		   this.idInput=xIdInput;
		   this.tipo=xTipo;
		   this.obligatorio=xObligatorio;
		   this.source=xArray;
		   this.httpSource=xHttpSource;
		   this.render();
	   }
	);
	this.desactivar=
	(
	   function()
	   {
		   document.getElementById(this.idInput).disabled = true;
	   }
	);
	this.activar=
	(
	   function()
	   {
		    document.getElementById(this.idInput).disabled = false;
	   }
	);
	this.obtenerValor = (function()
	{
		return $("#" + this.idInput + " option:selected").text();
	});
	
	this.obtenerId = (function()
	{
		return $("#" + this.idInput + " option:selected").attr("value");
	});
	
	this.pasarEstadoOk = (function()
	{
		$("#group" + this.idInput).removeClass("has-error").addClass("has-success");
		$("#" + this.id + '_' + this.idInput + "grafic").removeClass("glyphicon-remove").addClass("glyphicon-ok");
		this.seleccionado = true;
	});
	this.pasarEstadoError = (function()
	{
		$("#group" + this.idInput).removeClass("has-success").addClass("has-error");
		$("#" + this.id + '_' + this.idInput + "grafic").removeClass("glyphicon-ok").addClass("glyphicon-remove");
		this.seleccionado = false;
	});
	this.valor = (function(xValor)
	{
		if (this.obligatorio)
		{
			if ((!this.mostrarVacio && $.trim(xValor) != "") || (this.mostrarVacio && this.textoVacio != $.trim(xValor) && $.trim(xValor) != ""))
			{
				var encontrado=false;
				var i=0;
				while(i<this.source.length && !encontrado)
				{
					if(this.source[i]==xValor)
					{
					  encontrado=true;
					  $("#" + this.idInput).val(this.source[i]);
					}
					i++;
				}
				if(encontrado)
				    this.pasarEstadoOk();
			}
			else
			{
				this.pasarEstadoError();
			}
		}
		else
		{
			var encontrado=false;
				var i=0;
				while(i<this.source.length && !encontrado)
				{
					if(this.source[i]==xValor)
					{
					  encontrado=true;
					  $("#" + this.idInput).val(this.source[i]);
					  window.alert(this.source[i]);
					}
					i++;
				}
		}
	});
	this.evCambiar = (function(seleccionado)
	{
		
	});
	
	this.getDataJSON = (function()
	{
		var instancia = this;
		// $("#" + this.idbody()).html("<center><img
		// src='../../core/js/libiahtool/images/cargando.gif' height='25px'
		// width='25px' /></center>");
		this.request = $.ajax(
		{
			type : "POST",
			async : false,
			url : this.pagina,
			data : this.parametros,
			dataType : "json",
		});
		this.request.done(function(data)
		{
			instancia.datos = data["registros"];
			var strhtml = "";
			if (instancia.datos.length > 0)
			{
				instancia.source = new Array();
				for (var i = 0; i < instancia.datos.length; i++)
				{
					instancia.source[i] = new ItemComboBox();
					instancia.source[i].idItem = instancia.datos[i]["iditem"];
					instancia.source[i].valor = instancia.datos[i]["valor"];
					if(instancia.datos[i]["padre"]!=null)
					{
					  instancia.source[i].padre=instancia.datos[i]["padre"];
					  instancia.tieneDatoPadre=true;
					}
				}
				if(instancia.source.length ==1)
				{
					instancia.pasarEstadoOk();
				}
				
			}
			else
			{
				
			}
		});
		
		this.request.error(function(XMLHttpRequest, textStatus, errorThrown)
		{
			// $("#"+instancia.idbody()).html("Se ha producido un error: "
			// +String(errorThrown));
			// $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s:
			// 0");
			window.alert(textStatus);
		});
	});
	
	this.render = (function()
	{
		if (this.tipo != "SIMPLE")
		{
			this.getDataJSON();
		}
		var strHtml = "";
		strHtml = '<div id="group' + this.idInput + '" class="form-group';
		if (this.obligatorio)
		{
			if(this.source.length ==1 && this.mostrarVacio ==false)
			{
				// this.pasarEstadoOk();
		         strHtml += ' has-success has-feedback';
			} 
			else
			{
				strHtml += ' has-error has-feedback';
			}
		}
			
		strHtml += '">';
		strHtml += '<label for="' + this.idInput + '">' + this.label + '</label>';
		strHtml += '<select class="form-control input-sm" id="' + this.idInput + '">';
		if (this.mostrarVacio)
			strHtml += '<option value="" select>' + this.textoVacio + '</option>';
		
		var items;
		for (items in this.source)
			strHtml += this.source[items].render();
		strHtml += "</select>";
		
		if (this.obligatorio)
		{			
			if(this.source.length ==1 && this.mostrarVacio ==false)
			{
				 this.pasarEstadoOk();
				 strHtml += '<span class="glyphicon glyphicon-ok form-control-feedback" id="' + this.id + '_' + this.idInput + 'grafic"></span>';
			}
			else
			{
				strHtml += '<span class="glyphicon glyphicon-remove form-control-feedback" id="' + this.id + '_' + this.idInput + 'grafic"></span>';
			}
		}
		strHtml += '</div>';
		var instancia = this;
		$("#" + this.id).html(strHtml);
		$("#" + this.idInput).change(function()
		{
			instancia.evCambiar(instancia.obtenerValor());
			if(instancia.hijo!=null)
			{
				instancia.hijo.parametros="padre=" + instancia.obtenerId();
				instancia.hijo.render();
			}
			if(instancia.obligatorio)
			{
			   if (((instancia.obtenerValor() != instancia.textoVacio) && (instancia.obtenerValor() != "")) || (instancia.datos.length ==1 && instancia.mostrarVacio ==false))
			   {
				  instancia.pasarEstadoOk();
			   }
			   else
			   {
				 instancia.pasarEstadoError();
			   }
			}
		});
		
		$("#" + this.idInput).click(function()
		{
			instancia.evCambiar(instancia.obtenerValor());
			if(instancia.hijo!=null)
			{
				instancia.hijo.parametros="padre=" + instancia.obtenerId();
				instancia.hijo.render();
			}
			if (((instancia.obtenerValor() != instancia.textoVacio) && (instancia.obtenerValor() != "") && (instancia.obtenerValor() != "")) || (instancia.datos.length ==1 && instancia.mostrarVacio ==false))
			{
				instancia.pasarEstadoOk();
			}
			else
			{
				instancia.pasarEstadoError();
			}
		});
	});
	
}
