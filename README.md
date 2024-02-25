# GestorPracticas

This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 17.1.1.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The application will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory.

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI Overview and Command Reference](https://angular.io/cli) page.
# GestorPracticasAngular

# Proyecto creado por Alejandro Álvarez y José Miguel Ruiz

Gestor de Prácticas
Descripción
El Gestor de Prácticas es una aplicación web diseñada para facilitar la gestión y seguimiento de las prácticas profesionales de los alumnos. Permite a los usuarios (alumnos) iniciar sesión, visualizar y registrar nuevas entradas de prácticas, incluyendo detalles como la fecha, el tipo de práctica, las horas dedicadas y cualquier observación relevante.

Datos para Logearse:
Usuario: Cathyvipi
clave: 12345

Usuario: xemi
clave: 12345

Características
Login de Usuario: Autenticación segura para acceder a la plataforma.
Visualización de Entradas: Los alumnos pueden ver un resumen de todas sus prácticas registradas.
Registro de Nuevas Prácticas: Interfaz intuitiva para añadir nuevas entradas de prácticas.
Gestión de Perfil: Los usuarios pueden actualizar su información personal y de contacto.
Tecnologías Utilizadas
Frontend: Angular 17.
Backend: PHP con MySQL para la gestión de la base de datos.
Estilos: CSS puro para una interfaz de usuario limpia y responsive.
Estructura del Proyecto

/proyecto-gestor-practicas
  /API
    - introducirTablaAlumno.POST.php
    - tablaAlumno.GET.php
    - login.POST.php
  /Componentes
    /login
      - login.component.ts
      - login.component.html
      - login.component.css
    /alumno-home-controller
      - alumno-home-controller.component.ts
      - alumno-home-controller.component.html
      - alumno-home-controller.component.css
    /alumno-tabla-controller
      - alumno-tabla-controller.component.ts
      - alumno-tabla-controller.component.html
      - alumno-tabla-controller.component.css
  /service
    - crud.service.ts
    - session.service.ts
  - README.md
Inicio Rápido
Clonar el Repositorio:


git clone https://tu-repositorio-aqui.git
Instalar Dependencias:

Desde el directorio raíz del proyecto, ejecuta:

npm install
Configuración de la Base de Datos:

Importa gestor_practicas.sql en tu sistema de gestión de bases de datos para crear las tablas necesarias.

Iniciar el Servidor de Desarrollo:

ng serve
Visita http://localhost:4200/ en tu navegador.

Configurar el Backend:

Asegúrate de que el servidor PHP está corriendo y accesible en la URL configurada en los servicios Angular.

Contribuir
Nos encantaría tu contribución para hacer de este proyecto algo aún mejor. Lee el archivo CONTRIBUTING.md para más detalles sobre cómo puedes contribuir.

Licencia
Este proyecto está bajo la Licencia MIT - ve el archivo LICENSE.md para más detalles.