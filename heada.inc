<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<title>Tu Codigo Postal</title>
<meta name="verify-v1" content="ruX0aIKVi1orZ4QQEgzTt3xXcIjmcj4k4zFsCJVP0E0="/>
<meta name="author" content="Pablo Lleó García"/>
<meta name="keywords" content=", españa, anuncios, clasificados, codigo postal, cp, mi codigo postal, anuncios, servicios, profesionales, servicios, particulares, comercios, Ferreterias, Parafarmacias, Restaurantes, Reformas, Clases Particulares, Panaderias, Agencias de Viajes, Agencias Inmobiliarias, Cocinas, Pastelerias, Ultramarinos, Supermercados, Supermercado, Charcuteria, Electricidad, Electrodomesticos, Ropa, Boutique, Farmacias, Gabinete de estetica, Rayos UVA, Gimnasios, Cafeterias, Bares, Bares de Copas, Pubs, Fontaneros, Cerrajeros, Electricistas, Servicio Domestico, Babysitter, Floristeria, Plantas,Drogerias, Mayoristas, Consultas Médicas, Tecnico de Ordenadores, Ordenadores, Pintores, Reparacion de Ordenadores, Pablo Lleó Garcia" />
<link rel="stylesheet" type="text/css" href="/css/style2.css"/>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js" ></script>
<script type="text/javascript" src="jquery.form.js" ></script>
<script type="text/javascript" src="jquery.validate.js" ></script>


<script type="text/javascript" src="dojo.js" ></script>
<script type="text/javascript" src="./jscripts/tiny_mce/jquery.tinymce.js"></script>




<script type="text/javascript">	
	






	$(document).ready(function() {
              
		
		var v = jQuery("#activi").validate({
		rules: {
			nsubact: {
                                required: function(element) {
                                return $("#csubactiv").val() == 0;
				}
			},
			cp: "required",
			nombre: "required",
			direccion: {
                                required: function(element) {
                                return $("#cactiv").val() != 5;
				}
			},
			poblacion: {
                                required: function(element) {
                                return $("#cactiv").val() != 5;
				}
			},
			telefono: "required",
			bdesc: "required",
			pweb: {
				url: true
			}


		},
		messages: {
			nsubact: "Debe introducir la subactividad",
			cp: "Debe introducir el codigo postal",
			nombre: "Debe introducir el Nombre",

                	direccion: "Debe introducir una direccion",
			poblacion:  "Debe introducir una poblacion",
			telefono: "Debe introducir el teléfono",
			bdesc: "Debe introducir una breve descripcion",
			pweb: {
				url: "Debe introducir la web correctamente",
			}

		}

	});
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : './jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect,|,search,replace,|,bullist,numlist,|,outdent,indent|,undo,redo,|,link,unlink,|,forecolor,backcolor",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,


			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js"

		});
   
         $("#cactiv").change(function () {
                    listasubact($(this).val());
                     }) .change(); 
         $("#csubactiv").change(function () {
                    escondersuba($(this).val());
                   }) .change(); 
	
     


});


	 


function listasubact(j)
{
	var feedUrl = 'select.php?o=' + j;
	var lista = 'csubactiv';
        var l = document.getElementById(lista);
	var bindArgs = {
		url:        feedUrl,
		handleAs:   "json",
		error:      function(type, errObj){},
		load:      function(data){
			// hemos recibido el XML correctamente

                        // Obtenemos la lista de elementos del XML
			// var items = data.getElementsByTagName('item');
                        
                        

                        // Obtenemos una referencia a la lista de poblaciones
			if (l){
                                // Borramos todos los elementos que pueda tener la lista...
				while (l.firstChild) {
 					 l.removeChild(l.firstChild);
				}
				// Y la llenamos con los elementos del XML

				for (i = 0; i < data.length; i++)
				{
					var nombre = data[i].subactividad;
					var id = data[i].csubactividad;
					var op = document.createElement ('option');
					op.innerHTML = nombre;
					op.setAttribute ('value', id);
					l.appendChild(op);
 
				}// fin for
					var op = document.createElement ('option');
					op.innerHTML = "Nueva Subactividad...";
					op.setAttribute ('value', 0);
					l.appendChild(op);

			}
		}
	}
 
	// Lanzar la peticion
    var requestObj = dojo.xhrGet(bindArgs);
    if (j == 5) { 
                 $('#ctipov').hide();
                 $('#cdireccion').hide();
                 $('#cdir').hide();
                 $('#cpob').hide();
                 $('#cpoblacion').hide();
                 $('#cnom').text("Nombre: ");
    }
    else {
                 $('#ctipov').show();
                 $('#cdireccion').show();
                 $('#cdir').show();
                 $('#cpob').show();
                 $('#cpoblacion').show();
                 $('#cnom').text("Nombre Empresa: ");
    }
    escondersuba(l.value)

}

function escondersuba(i){
    if (i == 0) { 
                 $('#cnsubact').show();
                 $('#csuba').show();
    }
    else {
                 $('#cnsubact').hide();
                 $('#csuba').hide();
    }
}

</script> 
<style type="text/css">
#activi { width: 955px; }
#activi label { float: left; width: 330px; }
#activi input { width: 330px; }
#activi input.error { border: 1px solid red; }
#activi label.error { font-color: red; font-style : italic; display: inline; }
#activi label.error { margin-left: 333px; }
#activi textarea {   height: 150px;  width: 300px; }
select.error {
        margin-left: 333px;
	border: 1px dotted red;
}



</style>


</head>
<body>

<div id="Titulo">

<h1>  <A href="./" style="text-decoration:none">  <img src="cp.png" height="85"  width="800" border=none alt=""></A> </h1> 
<h2> Comercios, Servicios Profesionales, Servicios entre particulares, Anuncios Clasificados....etc en tu Código Postal de España. </h2>

</div>
