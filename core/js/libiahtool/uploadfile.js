/*
 *   AUTHOR: MATIAS LEIVA
 *   EMAIL: matiasleiva09@gmail.com
 */

function UploadFile()
{
    this.id="";
    this.idinput="";
    this.titulo="";
    this.archivo="";
    this.conAjax=false;
    this.pagina="";
    this.onUpload=
    (
        function(dato)
        {
        
        }
    );
    this.construirRapido=
    (
        function(xTitulo,xId,xIdInput,xArchivo,xConAjax,xPagina)
        {
            this.id=xId;
            this.idinput=xIdInput;
            this.titulo=xTitulo;
            this.archivo=xArchivo;
            this.conAjax=xConAjax;
            this.pagina=xPagina;
            this.render();
        }
    );
    this.obtenerValorArchivo=(
        function()
        {
               return document.getElementById(this.idinput).files[0];      
        }
    );
    this.valorImagen= 
    (
        function(valor)
        {
            if($.trim(valor)!="")
               document.getElementById(this.idinput+'_imagen').src=valor;
            else
               document.getElementById(this.idinput+'_imagen').src="core/js/libiahtool/images/camera.png"; 
        }
    );
    this.obtenerValor=
    (
        function()
        {
            if(!this.conAjax)
               return document.getElementById(this.idinput).files[0]; 
            else
            {
                var imagen = "";
                imagen ="" +document.getElementById(this.idinput+'_imagen').src;
                var aimagen=imagen.split("/");
                var resultado=aimagen[(aimagen.length -1)];
                if(resultado=="camera.png")
                  return "";
                else
                  return resultado;
            }
        }
    );
    this.render=
    (
        function()
        {
            var instancia=this;
            var imagen="";
            if(this.archivo=="")
               imagen="core/js/libiahtool/images/camera.png";
            else
               imagen=this.archivo;
            var html='<form action method="post" name="form'+ this.id +'" enctype="multipart/form-data">';
            html+='<div class="image-upload">';
            html+='<label for="'+this.idinput+'" class="thumbnail">';
            if(this.titulo!="")
                html+='<center><h5>' +this.titulo + '</h5></center>';
            html+='<img src="'+imagen+'" id="'+this.idinput+'_imagen"  alt ="Click aquí para subir tu foto" title ="Click aquí para subir tu foto" >';
            html+='</label>';
            html+='<input id="'+this.idinput+'" name="' + this.idinput+ '" type="file"/>';
            html+='</div></form>';
            $("#" + this.id).html(html);
            
            $("#" + this.idinput).change(
                function($archivo)
                {
                   // $("#"+instancia.idinput+"_imagen").attr("src",$(this).val());   
                   if(instancia.conAjax)
                   {
                         var ajax = new Ajax();
                         var parametros = new FormData();
                         parametros.append("modo","cargararchivo");
                         parametros.append("imagen",instancia.obtenerValorArchivo());
                         var img = document.getElementById(instancia.idinput + "_imagen");
                         img.src="libiahtool/images/cargando.gif";
                         ajax = $.ajax(
                            {
                                async : false,
                                type : "POST",
                                url : instancia.pagina,
                                data : parametros,
                                dataType : "json",
                                contentType: false,
                                processData: false
                            });
                            ajax.done(function(resultado)
                            {
                                if(resultado["fotosubida"]!="")
                                {
                                   img.src=resultado["path"] + resultado["fotosubida"];
                                }
                            });
                            ajax.error(function(XMLHttpRequest, textStatus, errorThrown)
                            {
                                img.src="";
                            });
                   }
                   else
                   {
                       var input = document.getElementById(this.id);
                       var fReader = new FileReader();
                       fReader.readAsDataURL(input.files[0]);
                       fReader.onloadend = function(event)
                       {
                           var img = document.getElementById(instancia.idinput + "_imagen");
                            img.src = event.target.result;
                        }
                   }
                  
                   instancia.onUpload($(this).val()); 
                }
            );
        }
    );
}