# Getting Started with VidyaVista App

The Web server is using PHP CGI 8.2.12
http://127.0.0.1:8000

This is an Online inetegrated platform for projects taken up by students of various institutions( colleges, universities and schools).

### To run the project 
1) Clone the repository
2) Delete the vendor folder
3) start xampp server
   Open project in your terminal and Run the following commands
   
5) install composer
6) write the command- 'bin/console cache:clear' in the terminal and press ENTER
7) write the command- 'symfony server:start' in the terminal and press ENTER

# composer
Composer is a dependency manager for PHP that allows you to manage your project's libraries and packages.

##Installation
If you don't have Composer installed, you can install it by following the official Composer installation guide.

##Usage
To install the project dependencies, navigate to the project directory and run:

composer install

##Configuration
Composer uses a composer.json file to manage project dependencies. Here is an example of what your composer.json file might look like:

##json
{
    "name": "your-project-name",
    "description": "A brief description of your project",
    "require": {
        "php": "^7.4 || ^8.0",
        "some/package": "^1.0"
    },
    "autoload": {
        "psr-4": {
            "YourNamespace\\": "src/"
        }
    }
}

##Updating Dependencies
To update your project's dependencies to their latest versions, run:

##bash

composer update
###Example
For example, to add a new package to your project, use the following command:

##bash
composer require vendor/package-name
For more information on using Composer, refer to the official documentation.


#Starting the Symfony Server
Symfony provides a built-in web server to facilitate development. To start the Symfony server, follow these steps:

##Prerequisites
Ensure you have the Symfony CLI installed. You can install it by following the official installation guide.

##Starting the Server
To start the Symfony server, navigate to your project directory and run:

##bash
symfony server:start
This will start the server, and you can access your application by visiting http://127.0.0.1:8000 in your web browser.

##Stopping the Server
To stop the server, run:

symfony server:stop

Using Composer to Start the Server
If you prefer to use Composer scripts to start the server, you can add a script to your composer.json file:

{
    "scripts": {
        "start-server": "symfony server:start"
    }
}
Then, you can start the server using:


composer run-script start-server
##Additional Server Options
The Symfony server provides additional options for customization. For example, you can specify a different port or bind address:


symfony server:start --port=8080 --bind=127.0.0.1
For more information about the Symfony server and its options, refer to the Symfony local web server documentation.


### Signup and start using the platform
## HAPPY CODING


![image](https://github.com/rajkrsingh9/ChirpChat/assets/143270207/8c48f461-3446-427c-b4ae-b72e84d497dc)

