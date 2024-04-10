# Tm-Escapade

![Tm-Escapade](./assets/images/custom_img/marrak_1.jpg)

## Descripción


Tm-Escapade es una sofisticada aplicación web desarrollada en PHP puro , enriquecida con una completa plantilla de Bootstrap. Concebida como un proyecto personal y educativo.
Tm-Escapade ha sido meticulosamente diseñada para simular las operaciones y funcionalidades de una plataforma real de gestión de viajes. 
Aunque su propósito principal es educativo y no comercial, la aplicación ofrece una amplia gama de características que imitan de cerca las herramientas utilizadas por las agencias de viajes profesionales. Desde la gestión de paquetes turísticos hasta la administración de circuitos y complementos. 
Tm-Escapade proporciona una experiencia de usuario completa y satisfactoria, ideal para aprender sobre el desarrollo web y la creación de aplicaciones de gestión de contenido.



## Características Principales

- **Gestión de Paquetes**: Permite a las agencias de viajes crear, editar y gestionar una variedad de paquetes turísticos, con opciones flexibles para personalizar itinerarios, precios y disponibilidad.
- **Gestión de Circuitos**: Facilita la creación y administración de circuitos turísticos, con herramientas para gestionar destinos, actividades y fechas de salida.
- **Administración de Complementos**: Ofrece una plataforma para agregar y gestionar una amplia gama de complementos y servicios adicionales, desde traslados y excursiones hasta alojamiento y guías turísticos.
- **Panel de Administración Intuitivo**: Incorpora un panel de administración intuitivo y fácil de usar, construido con Metronic, que proporciona a los usuarios una experiencia fluida y eficiente en la gestión de contenidos y configuraciones.
- **Diseño Responsivo**: Diseñado con un enfoque en la accesibilidad y la usabilidad, Tm-Escapade ofrece una experiencia de usuario óptima en una variedad de dispositivos, desde computadoras de escritorio hasta dispositivos móviles.

## Tecnología Utilizada

- **PHP**: Tm-Escapade está desarrollado en PHP puro, aprovechando su flexibilidad y amplio soporte en el ámbito web.
- **Bootstrap**: Se utiliza la plantilla de Bootstrap "Aworld" para el diseño y la estructura visual de la aplicación, proporcionando un aspecto moderno y profesional.
- **Docker y Nginx**: La aplicación se ejecuta en un entorno Dockerizado con Nginx como servidor web, lo que garantiza una configuración flexible y escalable.

## Instalación y Configuración

1. Clona este repositorio en tu servidor web:

```bash
git clone https://github.com/T-zemmari/tm_escapade_docker.git
```

2. Antes de ejecutar el build del proyecto, asegúrate de tener Composer instalado y ejecuta el siguiente comando para instalar las dependencias que se encuentran en el archivo composer.json:

```bash
composer install
```

3. A continuación, puedes ejecutar el build del proyecto para construir las imágenes de Docker:

```bash
docker-compose up --build
```

3. Si todo sale bien podras acceder a la app desde http://localhost : 
4. Una vez accedas a la app quizas tengas algun error por culpa de la base de datos, con que lo primero seria entrar a phpmyadmin desde http://localhost:8082 y importar la tabla de prueba que se encuentra en : utils/tablas_ejemplos.
5. Las credenciales de la base de datos : (Tambien se encuentran en el archivo .env)

```bash
User:test_user,
Pass:test_user_2024
```




6. Para usar el panel administrador debes ir a http://localhost/admin/: 

-Para crear una cuenta debes introducir el siguiente codigo de registro.
```bash
Codigo de registro:Ta00,
```


