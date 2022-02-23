/*
 *   PROTOTIPOS PARA LA CREACION DE LAS GRILLAS
 *
 */
 //ESTA FUNCION LA TUVE QUE PONER PORQUE SINO ME HACIA LIO LOS PROTOTIPOS CON JQUERY
/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */
 function Columna()
 {
     this.nombre="";
	 this.alineacion="";
	 this.nombreDato="";
	 this.numericoeditable=false;
	 this.crearRapido=
	 (
		 function(xNombre,xAlineacion,xNombreDato)
		 {
			this.nombre=xNombre;
			this.alineacion = xAlineacion;
			this.nombreDato = xNombreDato;
		 }
	 );
	 this.render=
	 (
	    function ()
		{
		   var stringCol="";
		   stringCol="<th align='" + this.alineacion + "'  class='columna'>";
		   stringCol+=this.nombre;
		   stringCol+="</td>";
		   return stringCol;
		}
	 );
 }
 
 function Grilla()
 {
	 this.id="";
	 this.limitePorPagina=18;
	 this.paginaActual=1;
	 this.columnas = new Array();
	 this.pagina="";
	 this.parametros="";
	 this.agregar=true;
	 this.editar=true;
	 this.nombreElementos="Item";
	 this.buscar=true;
	 this.exportar=true;
	 this.datos=new Array();
	 this.request=null;
	 this.datosFiltrados=null;
	 this.borrar=true;
	 this.idhead=
	 (
		function()
		{
			return this.id+"head";
		}
	 );
	 this.idbody=
	 (
	    function()
	    {
	        return this.id+"body";
	    }
	 );
	 this.idgrilla=
	 (
		function()
		{
			return this.id+"_1"
		}
	 );
	 this.iditems=
	 (
	    function()
	    {
	    	return this.id+"_items";
	    }
	 );
	 this.idtxtFiltro=
     (
	    function()
	    {
	    	return this.id+"_txtfiltro";
	    }
	 );
	 this.idBtnFiltrar=
	 (
	    function()
	    {
	    	return this.id+"_txtbtnfiltrar";
	    }
	 );
	 this.idBtnX=
		 (
			function()
			{
				return this.id+"_btnX";
			}
		 );
	 this.idBtnAgregar=
	 (
		function()
		{
			return this.id+"_btnagregar";
		}
	 );
	 this.idBtnPrimero=
	 (
			function()
			{
				return this.id+"_btnprimero";
			}
	 );
	 this.idBtnUltimo=
	 (
		 function()
		 {
			return this.id+"_btnultimo";
		 }
	 );
	 this.idBtnSiguiente=
	 (
		 function()
		 {
			 return this.id+"_btnsiguiente";
		 }
	 );
	 this.idBtnAtras=
	 (
		 function()
	     {
			return this.id+"_btnatras";
		 }
	 );
	 this.idTxtPagina=
     (
		 function()
		 {
			return this.id+"_txtpagina";
	     }
	  );
		 
	 this.htmlOperacionesGrilla=
	 (
		function()
		{
			var strHtml="<table border='0' cellspacing='0' cellpading='0' width='100%'>";
			strHtml+="<tr>";
			strHtml+="<td width='50%'>"
			if(this.agregar)
			{
				strHtml+="<input type='button' name='"+this.idBtnAgregar()+"' id='"+this.idBtnAgregar()+"' value='Agregar'";
				strHtml+="  class='boton'/>";
			}
			strHtml+="</td>";
			strHtml+="<td width='50%' align='right'>";
			if(this.buscar)
			{
				strHtml+="<input type='input' name='"+ this.idtxtFiltro() +"' id='"+this.idtxtFiltro()+"' value='' />";
				strHtml+="<input type='button' name='"+ this.idBtnFiltrar() +"' id='"+ this.idBtnFiltrar() +"' value='Filtrar'";
				strHtml+=" class='boton'/>";
				strHtml+="<input type='button' name='"+ this.idBtnX() +"' id='"+ this.idBtnX() +"' value='X'";
				strHtml+=" class='boton'/>";
			}
			strHtml+="</td>";
			strHtml+="</tr>";
			strHtml+="</table>"
			return strHtml;
		}
	 );
	 
	 this.getDataHtml=
	 (
	     function ()
		 {
			  var ajax = new Ajax();
			  ajax.id=this.idbody();
			  ajax.pagina = this.pagina;
			  ajax.asincronico=true;
			  ajax.parametros=this.parametros;
			  ajax.cargarEnDiv();
		 }
	 );
	 this.getDataJSON=
	 (
			   function ()
			   {
				   var instancia=this;
				   $("#" + this.idbody()).html("<center><img src='core/js/libiahtool/images/cargando.gif' height='25px' width='25px' /></center>");
				   $("#" + this.iditems()).html(this.nombreElementos + "/s: 0");
				   this.request=$.ajax(
	 	             {
	 	            	   type: "POST",
	 	            	   async:false,
	 	            	   url:this.pagina,
	 	            	   data: this.parametros,
	 	            	   dataType: "json",
	 	            });
	 	            this.request.done
	 	            (
	 	               function(data)
	 	               {   
	 	            	  instancia.datos=data["registros"];
	 	            	  var strhtml="";
	 	            	  if(instancia.datos.length > 0)
	 					  {
	 					
	 						 $("#"+instancia.idbody()).html(instancia.cargarContenidoGrilla(instancia.datos,1,instancia));
	 						 $("#" +instancia.iditems()).html(instancia.nombreElementos+"/s: " + instancia.datos.length);
	 					  }
	 					  else
	 					  {
	 						  $("#"+instancia.idbody()).html("");
	 						  $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s: 0");
	 					  }
	 	               }
	 	            );
					 this.request.error
		            (
		               function(XMLHttpRequest, textStatus, errorThrown)
		               {
						   $("#"+instancia.idbody()).html("Se ha producido un error: " +String(errorThrown));
						   $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s: 0");
		               }
		            );
			   }
	 );
	 
	this.agregarGrilla=
	 (
		function(dato)
	    {
		 
	    }
	 )
	 this.editarGrilla=
	 (
	    function(dato)
	    {
	    	
	    }
	 );
	this.borrar=
	(
	    function(dato)
	    {
	    	
	    }
	);
	this.cantidadPaginas=
	(
	   function(cantidad,limitePorPagina)
	   {
		   var entero=parseInt(cantidad/limitePorPagina);
		   var decimal=getPartNumber((cantidad/limitePorPagina),'fracc',1);
		  // if(decimal >=5)
		  if(decimal>0)
			   entero++;
		   return entero;
	   }
	);
	this.recargar=
	(
	    function()
		{
			$("#"+this.idBtnX()).trigger('click'); 
			 this.getDataJSON();
		}
	);
	this.cargarContenidoGrilla=
	(
	    function (datos,pagina,instancia)
	    {
		    var strhtml="";
		   // var cantidadpaginas=(datos.length / instancia.limitePorPagina);
		    var i=((pagina*instancia.limitePorPagina) - instancia.limitePorPagina); 
		    var fin=((pagina * instancia.limitePorPagina) -1);
		    if(datos.length==fin)
			   fin=fin - 1;
		    else if(datos.length < fin)
				fin = datos.length -1;
		/*	else if(datos.length > fin)
			    fin = datos.length -1;*/
		    for(;i<=fin;i++)
	        {
			     strhtml+="<tr class='fila'>";
			     for(var j=0;j<instancia.columnas.length;j++)
			     {
					if(instancia.numericoeditable)
					{
					   
						strhtml+="<td class='item' align='"+instancia.columnas[j].alineacion+"' id='seleccionar"+i+"'>";
						strhtml+='<div class="input-group">';
						strhtml+='<div class="input-group-btn">';
						strhtml+='<button type="button" class="btn btn-default" id="btnmenos'+instancia.columnas[j].nombreDato+i+'">-</button>';
						strhtml+='</div>';
						strhtml+='<input type="text" name="'+instancia.columnas[j].nombreDato+i+'"  class="form-control" value="' + datos[i][instancia.columnas[j].nombreDato] +'" />';
						strhtml+='<div class="input-group-btn">';
					    strhtml+='<button type="button" class="btn btn-default"  id="btnmas'+instancia.columnas[j].nombreDato+i+'">+</button>';
						strhtml+='</div>';
						strhtml+='</div>';
						strhtml+='</td>';
					}
					else
					{
						strhtml+="<td class='item' align='"+instancia.columnas[j].alineacion+"' id='seleccionar"+i+"'>"+ datos[i][instancia.columnas[j].nombreDato]+"</td>";
					}
					
			     }
			     if(instancia.borrar)
				 {
			    	 strhtml+="<td class='item' id='borrar"+i+"'><img src='core/js/libiahtool/images/edittrash.png' /></td>";
				 }
			     strhtml+="</tr>";
		     }
		     return strhtml;
	     }
	   );
	
	 this.render=
	 (
	     function()
	     {  
	    	   var strtabla=this.htmlOperacionesGrilla();
	    	   strtabla+="<table  cellspacing='0' cellpading='0' width='100%' class='tabla' id='" + this.idgrilla()+"'>";
	    	   strtabla+="<thead id='"+this.id+"head' class='columna'></thead>";
	    	   strtabla+="<tbody id='"+this.id+"body' class='filanotover'></tbody>";
	    	   strtabla+="</table>";
	    	   strtabla+=this.renderFoot();
	    	   $("#"+this.id).html(strtabla);
	    	   this.renderHead();
	    	   this.getDataJSON();
	    	   var datos=this.datos;
			   var ultimapagina=this.cantidadPaginas(datos.length,this.limitePorPagina);
			   //DESPUES DE PROGRAMAR TODO ESTO ME DOY CUENTA ¬¬
			   var instancia=this;
			   var filtrado=false;
			   $("#"+this.idBtnAtras()).click
			   (
				  function()
				  {
					  var anterior=instancia.paginaActual -1;
					  if(anterior >=1)
					  {
						  $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,anterior,instancia));
						  instancia.paginaActual=anterior;
						  $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
					  }  
				  }
			   );
			   $("#"+this.idBtnSiguiente()).click
			   (
					function()
				    {
						var siguiente=instancia.paginaActual + 1;
						if(siguiente<=ultimapagina)
						{
						    $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,siguiente,instancia));
							instancia.paginaActual=siguiente;
							$("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
						}  
					}
			  );
			   $("#"+this.idTxtPagina()).keypress(
			    		function(e)
			    		{
				             if(event.which === 13)
				             { 
				            	var vPaginaIngresada=$.trim($(this).val());
			    	            if(!isNaN(vPaginaIngresada) && datos.length > 0)
			    	            {
			    	            	if(vPaginaIngresada >=1 && vPaginaIngresada <=ultimapagina)
			    	        	    {
			    	        		    $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,vPaginaIngresada,instancia));
									    instancia.paginaActual=vPaginaIngresada;
			    	        	    }
			    	            }
			    	         }
				        }
			    );
			  $("#"+this.idBtnUltimo()).click
			  (
				  function()
				  {
		              
					  if(datos.length >0 && instancia.paginaActual < ultimapagina)
					  {
					      $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,ultimapagina,instancia));
					      instancia.paginaActual=ultimapagina;
					      $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
					  } 
				  }
			  );
			  $("#"+this.idBtnPrimero()).click
			  (
				  function()
				  {
					  
					  if(datos.length > 0 && instancia.paginaActual > 1)
					  {
					      $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,1,instancia));
					      instancia.paginaActual=1;
					      $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
					  }
				  }
			  );
					  
	    	   $("#"+this.idBtnX()).click
	    	   (
	    		   function()
	    		   {
	    			   filtrado=false;
					   $("#"+ instancia.idtxtFiltro()).val("");
	    			   instancia.paginaActual=1;
	    			   datos=instancia.datos;
	    			   ultimapagina=instancia.cantidadPaginas(datos.length,instancia.limitePorPagina);
	    			   if(ultimapagina==0)
	    				   ultimapagina=1;
	    			   if(datos.length > 0)
	    			   {
	    				   $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,1,instancia));
	 					   $("#" + instancia.iditems()).html(instancia.nombreElementos+"/s: " + datos.length);
	 				   }
	 				   else
	 				   {
	 					  $("#"+instancia.idbody()).html("");
	 					  $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s: 0");
	 				   }
	    			   $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
	    		   }
	    		);
	    	   $("#"+this.idBtnFiltrar()).click
	    	   (
	    		   function()
	    		   {
						  var filtro= new String($.trim($("#"+ instancia.idtxtFiltro()).val()));
	    			      if(instancia.datos.length > 0 && filtro!=new String(""))
	 					  {
	    				     filtrado=true;
							 var datosAux=new Array();
	    				     var indice=0;
	    				     var indiceCol=0;
	    				     var encontrado=false;
	    				     instancia.paginaActual=1;
	    				     for(var i=0;i<instancia.datos.length;i++)
	    				     {
	    				    	 while(indiceCol<instancia.columnas.length && !encontrado)
	 							 {
	    				    		 if(String(instancia.datos[i][instancia.columnas[indiceCol].nombreDato]).indexOf(filtro)!==-1)
	 							     {
	    				    		    datosAux[indice]=instancia.datos[i];
	    				    		    encontrado=true;
	    				    		    indice++;
	 							     }
	 							     indiceCol++;
	 							 }
	    				    	 indiceCol=0;
	    				    	 encontrado=false;
	    				     }
	    				     datos=datosAux;
	    				     if(datos.length==0)
	    				     {
	    				    	  ultimapagina=1;
	    				    	  $("#"+instancia.idbody()).html("");
		 						  $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s: 0");
		 						  $("#" +instancia.idTxtPagina()).val(instancia.paginaActual);
	    				     }
	    				     else
	    				     {
	    				    	 ultimapagina=instancia.cantidadPaginas(datos.length,instancia.limitePorPagina);
	 	    				     if(ultimapagina==0)
	 	    				    	 ultimapagina=1;
	 	 						 $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(datos,1,instancia));
	 	 						 $("#" + instancia.iditems()).html(instancia.nombreElementos+"/s: " + datos.length);
	 	 						 $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
	    				     }
	    				   
	 					  }
	 					  else
	 					  {
	 						  $("#"+instancia.idbody()).html("");
	 						  $("#"+instancia.iditems()).html(instancia.nombreElementos+"/s: 0");
	 						  $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
	 					  }
	    		   }
	    	   );
	    	   
	    	   $("#" + this.idBtnAgregar()).click
               (
                   function()
                   {
                	  instancia.agregarGrilla(null);
                   }       
               );
	    	   $(document).on('click',' #' + this.idbody() + ' tr> td', 
	    			   function() 
		                {
		                    var indice = $(this).attr("id");
							if(!filtrado)
							    datos=instancia.datos;
		                    if(indice!=null && indice.indexOf("seleccionar") ==0)
		                    {
		                    	instancia.editarGrilla(datos[indice.substring(11)]);
		                    }
		                    
		                }   
	    	   ); 
	    	   
	    	   $(document).on('click',' #' + this.idbody() + ' tr> td', 
	    			   function() 
		                {
		                    var indice = $(this).attr("id");
							if(!filtrado)
							    datos=instancia.datos;
		                    if(indice!=null && indice.indexOf("borrar") ==0)
		                    {
		                    	if(confirm("Desea borrar el ítem seleccionado?"))
		                    	{
		                    	     var borro=instancia.borrar(datos[indice.substring(6)]);
									 if(borro)
									 {
		                    	         datos.splice(indice.substring(6),1);
		                    	         instancia.datos=datos;
		                    	         ultimapagina=instancia.cantidadPaginas(datos.length,instancia.limitePorPagina);
		                    	         instancia.paginaActual=1;
		                    	         $("#"+ instancia.idbody()).html(instancia.cargarContenidoGrilla(instancia.datos,1,instancia));
		                    	         $("#" + instancia.iditems()).html(instancia.nombreElementos+"/s: " + instancia.datos.length);               	   
		 	 						     $("#" + instancia.idTxtPagina()).val(instancia.paginaActual);
									 }
		                    	}
		                    }
		                }   
	    	   ); 
	     }
	 );
	
	 this.renderHead=
	 (
	     function ()
		 {
			 //UNA VEZ QUE CREE EL TAG TABLE AHORA VOY POR LAS COLUMNAS
			 var strtabla="";
			 strtabla="<tr>";
			 //RENDERIZO LAS COLUMNAS
			 var columna;
			 for(columna in this.columnas)
			 {
				strtabla+=this.columnas[columna].render();
			 }
			 if(this.borrar)
			 {
				 strtabla+="<th  class='columna'></td>";
		     }
			 strtabla+="</tr>";
			 $("#"+this.idhead()).html(strtabla);
		 }
	 );
	 this.renderFoot=
	 (
		 function ()
		 {
				var strHtml="<table border='0' cellspacing='0' cellpading='0' width='100%'>";
				strHtml+="<tr>";
				strHtml+="<td width='50%'>"
				strHtml+="</td>";
				strHtml+="<td width='50%' align='right'>";
				strHtml+="<div id='" + this.iditems() +"'></div>";
				strHtml+="<input type='button' name='"+ this.idBtnPrimero()+"' id="+this.idBtnPrimero()+" value='<<' />";
				strHtml+="<input type='button' name='"+ this.idBtnAtras()+"' id="+this.idBtnAtras()+" value='<' />";
				strHtml+="<input type='text' name='"+ this.idTxtPagina()+"' id="+this.idTxtPagina()+" value='" + this.paginaActual +"' size='4' />";
				strHtml+="<input type='button' name='"+ this.idBtnSiguiente()+"' id="+this.idBtnSiguiente()+" value='>' />";
				strHtml+="<input type='button' name='"+ this.idBtnUltimo()+"' id="+this.idBtnUltimo()+" value='>>' />";
				strHtml+="</td>";
				strHtml+="</tr>";
				strHtml+="</table>"
				return strHtml;
		 }
	 ); 
 }