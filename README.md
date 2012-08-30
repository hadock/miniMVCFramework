# El framework esta orientado principalmente al desarrollo de aplicaciones tipo BackEnd para las que
# generalmente se necesita de mas velocidad al desarrollar


# Los directorios son:
# - Controller
# Esta carpeta contiene la capa controladora, en ella existen arhivos (Librerias) necesarias para trabajar tales como:
# Cmaster.php, Cview.php y opcionalmente Clogin.php en el caso que quieras tomar como ejemplo un login
# todos los elementos contenidos en este directorio deben comenzar con la letra "C" seguidos de su nombre, al igual
# que la clase que contengan dentro
# Ejemplo
# Archivo Ccliente.php dentro de la carpeta controller
# La clase en su interior debe llamarse Ccliente y la funcion principal se debe llamar DefaultParams(), siendo esta
# la primera funcion que el framework carga pero no es obligatoria

# - Model
# Esta carpeta contiene todas librerias necesarias para realizar consultas a una base de datos Mysql los archivos son:
# Mdbhandler.php, Mdbconstantsquerys.php
# La primera de estas librerias, contiene funciones que ayudan al momento de manejar registro de la base de datos
# tales como insert, select, update, etc
# La segunda contiene consultas que se realizan durante todo momento en el sistema, mejor dicho consultas que son
# recurrentes o constantes y que el resultado de estas se necesitan en todo momento por la capa controladora

# - System
# en este directorio se encuentra el archivo de configuracion y parametros constantes, el conector a la base de datos y
# funciones que son recurrentes en el sistema tales como convertir fechas, etc.

# - Theme
# este directorio contiene el nombre del tema a utilizar para nuestra aplicacion, este tema debera tener una estructura
# definida y archivos obligatorios para el trabajo con ajax, especificamente con Jquery

# - tpapp
# en este directorio se almacenan aplicaciones o clases de terceros que queramos utilizar en nuestras clases

# index.php
# es el archivo principal, en este se pueden configurar que librerias cargar y cuales no.

# La forma de acceder a los metodos de una clase, es de la siguiente manera
# http://urldetuaplicacion/?load=objeto&action=metodo
# el objeto es el nombre del controlador sin la C
# el metodo es aquella función dentro de tu clase que quieras ejecutar
# este metodo debe retornar valores en un array que son tomados por la vista en la carpeta theme

# adicionalmente si necesitas utilizar una vista que no tiene el nombre de tu objeto debes adicionar a la url
# extraview=Vnombrevista, quedando la url de esta forma: 
# http://urldetuaplicacion/?load=objeto&action=metodo&extraview=Vnombrevista

# si la peticion que quieres realizar a tu aplicacion es en ajax, el acceso a esta debe ser de esta manera
# http://urldetuaplicacion/?load=objeto&action=metodo&ajaxRequest
# adicionando por GET la variable ajaxRequest, el resultado desde el servidor puede ser en Json o XML
