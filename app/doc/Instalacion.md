Multiacademico
=======
Instalacion
-------------

 1. Clonar el repositorio usando el comando 

    Via Ssh : 
    git@bitbucket.org:arxisla/multiacademico.git
    Via HTPPS 
    https://pcimagenca@bitbucket.org/arxisla/multiacademico.git

 2. Descargar y descomprimir la Db https://bitbucket.org/arxisla/multiacademico/downloads

 3. Crear y montar la DB, usando cualquier gestor de base de datos recomendamos Mysql WorkBench Descarga [Aqui](http://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community-6.3.6-win32.msi)
	 

    Nota: en caso de dar error aumentar la memoria del servidor local mysql, editar archivo my.ini el parametro max_allowed_packet a 500M, el parametro se encuentra en dos partes del archivo, y reiniciar el servicio.

 4. Ejecutar En la carpeta raiz el comando "Composer Install" (debe tener previamente instalado composer)