
<h1>Proyecto IAW</h1>
<h2>Videoclub con Laravel</h2>
___
En esta aplicación se pone en práctica lo aprendido de Laravel. Creamos un CRUD básico donde el usuario puede ver, crear, editar y eliminar recursos y donde dependiendo de qué permisos de usuario tenga (si es administrador o si está registrado), podrá o no realizar todas las acciones.

<h3>Instalación</h3>

Hay varias formas de llevar a cabo un proyecto. En mi caso he escogido **Valet**, para MacOs (Laragon para Windows), que incorpora un servidor Apache para las tareas de la base de datos y viene con un entorno de desarrollo muy cómodo de configurar.

Una vez hemos creado el proyecto con `composer create`, tenemos en nuestro directorio todo lo que laravel necesita para funcionar.

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

Creamos un controlador de tipo recurso con el comando `php artisan make:controller MovieController --resource`.
Este comando nos crea las funciones que necesitaremos para tratar el recurso a través de la base de datos y de las rutas, habiendo creado previamente el modelo de este recurso y la tabla en la base de datos.

En las rutas lo indicaremos así:
`
Route::resource('peliculas', MovieController::class)
    ->parameters(['peliculas' => 'movie'])
    ->names('movies');
`
Con esta línea de código estamos creando rutas en nuestra aplicación para todas las funciones del controlador (index, show, create, edit y delete). Además le damos el nombre __movies__ para poder llamarlas desde las vistas sin tener que usar la ruta en sí. 

P.e: `route('movies.index')`

<h3>Usuarios y permisos</h3>

Ya tenemos las rutas creadas pero son accesibles por cualquier usuario. Para restringir el acceso, tenemos que crear un usuario que Laravel. A su vez tenemos acceso a las rutas auth, que tenemos que ingresar en __`web.php`__ con la línea `Auth::routes()`.

Con un campo en la tabla users, podemos decir si el usuario es administrador con un booleano y luego comprobarlo en la aplicación con la función:
`
    public function isAdmin()
    {
        if ($this->is_admin == 1) {
            return true;
        }
        return false;
    }
`