
# TICKETS System

Welcome to the TICKETS system project repository. This project is designed to provide a customer service ticketing system where users can log issues, track their status, and receive support. The project is built with PHP and MySQL and utilizes a LAMP stack environment for deployment.

## Features

- **User Registration and Login**: Users can create accounts, log in, and manage their profiles.
- **Ticket Submission**: Authenticated users can submit support tickets.
- **Ticket Tracking**: Users can track the status of their submitted tickets through unique ticket numbers.
- **Admin Panel**: Administrators can manage tickets, user accounts, and view system activities.
- **Role Management**: The system distinguishes between regular users and administrators, allowing for role-based access control.
- **User Management**: Admins can create, edit, and delete user accounts, switching roles between USER and ADMIN as needed.

## Setup and Installation

The system runs on a LAMP stack (Linux, Apache, MySQL, PHP). Follow the installation guide on `ndla.no` for setting up a virtual machine and installing the necessary components. Here are the necessary steps to set up and work with the project from this repository.

*IMPORTANT NOTE!
Before you begin, ensure you have met the following requirements:
* You have a `Linux` machine, preferably [Ubuntu](https://ubuntu.com/), to set up the LAMP stack.
* You have installed the latest versions of [PHP](https://www.php.net/), [Apache](https://httpd.apache.org/), and [MariaDB](https://mariadb.org/) (or [MySQL](https://www.mysql.com/)) on your machine.
* You have installed [Composer](https://getcomposer.org/) to manage PHP dependencies.

## Detailed LAMP Stack Setup on Ubuntu

1. **Update Package Repository**
   ```bash
   $ sudo apt update

2. **Install Apache2**
Install the Apache web server:

$ sudo apt install apache2

3. **Install MariaDB (MySQL Alternative)**
Install MariaDB which is a drop-in replacement for MySQL:

$ sudo apt install mariadb-server mariadb-client

4. **Secure MariaDB Installation**
Run the security script to set the root password, remove anonymous users, disallow remote root access, and remove the test databases:

$ sudo mysql_secure_installation

5. **Install PHP**
Install PHP along with common extensions:

$ sudo apt install php libapache2-mod-php php-mysql php-cli

6. **Start/Restart Apache2 and MariaDB**
To ensure both services are up and running, use the following commands:

$ sudo systemctl start apache2
$ sudo systemctl start mariadb

...Or if they were already running and you need to restart them:

$ sudo systemctl restart apache2
$ sudo systemctl restart mariadb


7. **Enable Services to Start on Boot**
Enable both Apache and MariaDB to start automatically upon system boot:

$ sudo systemctl enable apache2
$ sudo systemctl enable mariadb


8. **Adjust Firewall Settings**
  If you have UFW firewall running, allow traffic to Apache:

$ sudo ufw allow in "Apache Full"


9. **Test Your Installation**
To test your Apache installation, open your web browser and navigate to http://localhost/. You should see the Apache Ubuntu default page.
To test PHP processing, create a test PHP file in the web root directory:

$ echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/phpinfo.php

Now navigate to http://localhost/phpinfo.php in your web browser. You should see a page displaying information about your PHP configuration.

10. **Configure Apache to Prioritize PHP Files**
Configure Apache to look for .php files first when searching for directory index files by editing the dir.conf file:

$ sudo nano /etc/apache2/mods-enabled/dir.conf

Move the index.php entry to the first position in the list, then save and exit the file. After all this restart Apache to apply changes by typing:

$ sudo systemctl restart apache2

11. **Accessing MariaDB**
To log into MariaDB, use the following command:

$ sudo mysql -u root -p

    You will be prompted for the root password that you set up during the mysql_secure_installation step.

Now that your LAMP stack is installed and configured, you can proceed to create databases, set up web applications, or host websites.

---

Once you are sure you have all necessary components installed in your Linux machine, you can continue to the next chapter - INSTALLING OF THE SYSTEM 'TICKETS' self;

## Installing "TICKETS"

To get the "TICKETS" system up and running on your Apache server, follow the steps below:

1. **Clone the Repository into the Web Directory**

 First, you need to navigate to the Apache server's root directory where websites are served from. Typically, this is the `htdocs` directory in XAMPP or the `var/www/html` directory in a standard Apache setup on Linux.

  For XAMPP on Windows:
   you would navigate to the following file directory by typing this command in command terminal:
   
   $ cd c:\xampp\htdocs\

... and for standard Apache on Linux:

  $ cd /var/www/html/

Once in the appropriate directory, use the following command to clone the repository:

$ git clone https://github.com/SirSalieri/TICKETS

This will create a TICKETS directory inside your web server's root directory. If you're using a virtual host or an alias, ensure that the TICKETS directory is within the path specified for the virtual host or alias.

At the end:

Enter the newly cloned repository to begin setting up the application. Type the command:

$ cd TICKETS

...Or you can simply open this folder in Virtual Studio Code program where you can work on this project and develop it in your own way.


After you have cloned the repository to your server/local environment on your device, you can start installing necessary components in terminal prompt in VSC to input them in project.

2. First component you have to install is Composer. You install Composer by running this command in terminal:

$ composer install

3. After installing Composer, you have to make sure you have imported a database to your project. You do this in several steps:
1.1 First, log in to the MySQL/MariaDB console by typing this in your terminal:
   $ sudo mysql -u root -p
1.2 Afterwards, create a new database, and name it 'unity_pulse!!:
   CREATE DATABASE unity_pulse;
   EXIT;
1.3 For the last, import the provided database schema and data that is found in this repository by typing this command:
   $ mysql -u root -p your_database_name < DATABASE/MIKES_OPPDRAG_db.sql
4. After all these installation steps, there might be necessary to check configuration settings that are located at the in the [includes] directory. Mainly, check if connect.php is configured to connect to right database with correct credentials. This is VERY IMPORTANT step since if you dont have correct connection-info, all the pages that are trying to fetch that info for transfering data to database and recieveing it back, WILL NOT BE ABLE TO WORK PROPERLY!

5. At the end, you should restart Apache to make the `.htaccess` and other configurations take effect. You do that by typing this command in you command prompt:
       $ sudo service apache2 restart
Once you are done with all this steps, you will hopefully be ready to move on - start testing and using this project.

## Usage

To use this project's content, you should access the system through the web server's configured domain or IP. Log in with the provided demo user credentials, or register a new account to begin.


## Contact

If you want to contact me you can reach me at mihailokoprivica480@gmail.com.
---

Thank you for visiting the TICKETS system repository. We hope it serves your customer service and support needs effectively!

