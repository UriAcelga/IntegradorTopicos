# 🐾 Mi Veterinaria - Sistema de Gestión Integral

Aplicación web desarrollada bajo el patrón **MVC (Model-View-Controller)** utilizando el framework **CodeIgniter**. El sistema gestiona la compleja red de relaciones entre mascotas, propietarios (amos) y profesionales veterinarios.

## 🧠 Desafíos Técnicos Resueltos

* **Relaciones Complejas (N:N):** Implementación de tablas intermedias para gestionar que una mascota pueda tener múltiples dueños a lo largo del tiempo y un dueño múltiples mascotas.
* **Lógica de Negocio Avanzada:** * Gestión de estados: Finalización de relación amo-mascota por venta o fallecimiento.
    * Control contractual: Seguimiento de ingresos y egresos del personal médico.
* **Integridad de Datos:** Validaciones en formularios de alta para asegurar la consistencia entre registros de amos y mascotas.
* **Consultas Cruzadas:** Filtros dinámicos para listar el historial de dueños de una mascota y viceversa.

## 🛠️ Stack Tecnológico

* **Framework:** CodeIgniter (PHP)
* **Base de Datos:** MySQL (Relacional)
* **Frontend:** Vistas dinámicas con PHP y maquetación responsiva.
* **Patrón de Diseño:** MVC estricto para separación de lógica y presentación.

## 📋 Funcionalidades Generales

* **CRUD Completo:** Gestión total de Mascotas, Amos y Veterinarios.
* **Módulo de Relaciones:** Registro inteligente de pares Amo-Mascota.
* **Historiales:** Visualización detallada de la trayectoria de vida de las mascotas y su relación con los profesionales.

## 🚀 Instalación

1. Clona este repositorio.
2. Configura tu servidor local (Apache/MySQL).
3. Importa el esquema de base de datos incluido para habilitar las relaciones N:N.
4. Ajusta los parámetros de conexión en la configuración del framework.
# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
