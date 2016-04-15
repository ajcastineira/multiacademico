function NuevoAjax(){
        var xmlhttp=false;
        try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
                try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }catch(E){
                        xmlhttp = false;
                }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}

function Cargar(url){
        var contenido, preloader;
        contenido = document.getElementById('contenido');
        preloader = document.getElementById('preloader');
        //creamos el objeto XMLHttpRequest
        ajax=NuevoAjax(); 
        //peticionamos los datos, le damos la url enviada desde el link
        ajax.open("GET", url,true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
                        preloader.innerHTML = "Cargando...";
                        //modificamos el estilo de la div, mostrando una imagen de fondo
                        preloader.style.background = "url('loading.gif') no-repeat"; 
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
                                //mostramos los datos dentro de la div
                                contenido.innerHTML = ajax.responseText; 
                                preloader.innerHTML = "Cargado.";
                                preloader.style.background = "url('loaded.gif') no-repeat";
                        }else if(ajax.status==404){
                                preloader.innerHTML = "La página no existe";
                        }else{
                                //mostramos el posible error
                                preloader.innerHTML = "Error:".ajax.status; 
                        }
                }
        }
        ajax.send(null);
}