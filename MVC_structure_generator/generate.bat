mkdir public
mkdir app
mkdir app\Config
mkdir app\Core
mkdir app\Controllers
mkdir app\Views
mkdir app\Models

copy MVC_structure_generator\DBAbstractModel.php app\Models\DBAbstractModel.php
echo Archivo DBAbstractModel.php copiado exitosamente.

copy MVC_structure_generator\BaseController.php app\Controllers\BaseController.php
echo Archivo BaseController.php copiado exitosamente.

copy MVC_structure_generator\Router.php app\Core\Router.php
echo Archivo Router.php copiado exitosamente.

copy MVC_structure_generator\composer.json .\composer.json
echo Archivo composer.json creado exitosamente.

composer install

echo Instalación de dependencias completada.
