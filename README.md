
<h1>Proyecto IAW - CFGS Administración de Sistemas Informárticos y Redes</h1>
<h2>Videoclub con Laravel</h2>
___
En esta aplicación se pone en práctica lo aprendido de Laravel. Creamos un CRUD básico donde el usuario puede ver, crear, editar y eliminar recursos y donde dependiendo de qué permisos de usuario tenga (si es administrador o si está registrado), podrá o no realizar todas las acciones.

<h3>Instalación</h3>

Hay varias formas de llevar a cabo un proyecto. En mi caso he escogido **Valet**, para **macOS Big Sur** (Laragon para Windows), que incorpora un servidor Apache o Nginx para las tareas de la base de datos y viene con un entorno de desarrollo muy cómodo de configurar.

**Resumen de pasos**
1. Instalar Homebrew
2. Actualizar Homebrew: `brew update`
3. Instalar PHP con Homebrew: `brew install php`
4. Instalación de Composer
5. Instalar Laravel Valet: composer global require laravel/valet`
6. Agregar Composer al PATH: `export PATH="$PATH:$HOME/.composer/vendor/bin"`
7. Completar la instalación de Laravel Valet:`valet install`
8. Crear un proyecto de Laravel: `laravel new nombre-proyecto`
9. Crear un proyecto de Laravel especificando la versión: `composer create-project laravel/laravel nombre-proyecto "8.*"`


Una vez hemos creado el proyecto con `composer create-project `, tenemos en nuestro directorio todo lo que laravel necesita para funcionar.

<h3>Vistas</h3>

Laravel utiliza el gestor de plantillas ***blade*** que permite una integración con PHP.

La estructura de las vistas es:
```
views
│   
└───auth //Aquí tenemos las vistas de autentificación
│   │
│   │
│   └───passwords 
│   
└───erros //Podemos modificar las vistas de los errores del servidor. Blade las detecta automáticamente
│
└───layouts 
│   │
│   │   master.blade.php //Esta es la estructura base del proyecto. Lo que hace blade es insertar el resto vistas en las secciones que le indiquemos.
│ 
└───partials //Partes de la maquetación que nos interesa tener diferenciadas.
│   │
│   │   navbar.blade.php
│   │   session-status.blade.php
│ 
└───movies //Es el recurso que administramos en este proyecto, dentro están todas las vistas necesarias para que el controlador y las rutas de recurso funcionen.
│   │
│   │   index.blade.php
│   │   create.blade.php
│   │   show.blade.php
│   │   edit.blade.php
└──────────────────────

```

<h3>Controladores y rutas</h3>


La creación de un controlador de tipo recurso se hace con el comando `php artisan make:controller MovieController --resource --model=Movie`.
Este comando nos crea las funciones que necesitaremos para tratar el recurso a través de las rutas y su controlador, habiendo creado previamente el modelo de este recurso y la tabla en la base de datos.

En las rutas lo indicaremos así:
```
Route::resource('peliculas', MovieController::class)
    ->parameters(['peliculas' => 'movie'])
    ->names('movies');
```
Con esta línea de código estamos creando rutas en nuestra aplicación para todas las funciones del controlador (index, show, create, edit y delete). Además le damos el nombre __movies__ para poder llamarlas desde las vistas:

`<a href="{{ route('movies.index') }}">Índice películas</a>`

<h3>Usuarios y permisos</h3>

Ya tenemos las rutas creadas pero son accesibles por cualquier usuario. Para restringir el acceso, tenemos que crear un usuario que Laravel. A su vez tenemos acceso a las rutas auth, que tenemos que ingresar en __`web.php`__ con la línea `Auth::routes()`. Podemos excluir algunas de las vistas, como index y show. De esta forma si el usuario intenta acceder a `movies.create`, se le dirige al a la vista del login. 

Con un campo en la tabla users, podemos decir si el usuario es administrador con un booleano y luego comprobarlo en la aplicación con la función:
```
    public function isAdmin()
    {
        if ($this->is_admin == 1) {
            return true;
        }
        return false;
    }
```
<h3>Formularios y validación</h3>

Un problema en cualquier aplicación web es la inyección de código en nuestra base de datos. Para ello Laravel cuenta con varias medidas de protección.

La excepción `MassAssignmentException` es una forma en la que el ORM (*Object-Relational-Model*) nos protege. Una vulnerabilidad de asignación masiva ocurre cuando un usuario envía un parametro inesperado mediante una solicitud y dicho parametro realiza un cambio en la base de datos que no esperabas. Por ejemplo, un usuario podría, utilizando Chrome Developer Tools o herramientas similares, agregar un campo oculto llamado is_admin con el valor de 1 y enviar la solicitud de registro de esta manera. Si no tienes cuidado con esto entonces cualquier usuario podría convertirse en administrador de tu aplicación, con consecuencias nefastas para tu sistema.

Para evitar esto, dentro del modelo agregamos la propiedad `$fillable` y asignamos como valor un array con las columnas que queremos permitir que puedan ser cargadas de forma masiva:

También tenemos disponible la propiedad `$guarded`. Al igual que `$fillable`, esta propiedad tendrá como valor un array, pero en este caso las columnas que indicamos son las que no queremos que puedan ser cargadas de forma masiva:

<h3>Traducciones</h3>

Para traducir nuestra aplicación, tenemos que ir al directorio `resources/lang`.Dentro un directorio de traducción en inglés.

<br>El paso a seguir es replicar ese directorio y ponerle en nombre "es". La comunidad de GitHub ha traducido ya los archivos y no hay que hacerlo a mano. De forma paralela, si tenemos más cosas que traducir, se crea un *lang*.json con las traducciones necesarias. Luego en las vistas usamos la directiva blade `@lang('Traduccion')` para que, según el valor de la variable de entorno `locale='es'` (es este caso español), recoja esa traducción.  


