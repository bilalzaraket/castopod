To use the OC library to interact with Nextcloud and store data on it we need to perform the following steps:

** NextCloud doesn't support Windows installation **
See the following forums:

https://help.nextcloud.com/t/database-errors-on-first-setup/102024/18
https://help.nextcloud.com/t/installation-on-windows-7/4408
1- Install the Nextcloud server:

To Download the Nextcloud server we need to perform the following steps:
Note: I added some steps in each main step, which depend on each user's installation process, machine, OS, and other factors
1- Download and install XAMPP: Nextcloud requires a web server (In this case Apache), a database server (MySQL in this case), and PHP to run. XAMPP is an open-source platform that includes all these components. You can download XAMPP from the official Apache Friends website and follow the installation instructions.
download of XAMPP: https://sourceforge.net/projects/xampp/files/latest/download

2- Download the Nextcloud server: You can download the Nextcloud server from the official Nextcloud website. Make sure to download the latest stable version.
download of nextcloud server: https://sourceforge.net/projects/nextcloud-server.mirror/

3- Extract the Nextcloud server: After downloading the Nextcloud server, extract the contents of the downloaded archive to the htdocs folder in your XAMPP installation directory. Usually the htdocs folder is located at C:\xampp\htdocs.
Important notes to do:
- Now you can run the Apache server and the MySQL server from the XAMPP control panel.
- When extracting nextcloud to the `htdocs`, make sure to rename it to `nextcloud` for later use (sometimes it may not have this name)
4- Create a database for Nextcloud: Nextcloud requires a MySQL or MariaDB database to store its data. You can create a database for Nextcloud using the phpMyAdmin tool that comes with XAMPP. To access phpMyAdmin, open your web browser and navigate to http://localhost/phpmyadmin/. Click on the "Databases" tab and enter a name for your Nextcloud database. Make sure to select "utf8mb4_general_ci" as the collation.

Possible steps to do before step 5:
- In case this error appeared when trying to open http://localhost/nextcloud/ you may need to install composer as a first step in the `xampp/htdocs/nextcloud` directory. (composer install)
-  In case the following error appeared: `Composer autoloader not found, unable to continue. Check the folder "3rdparty". Running "git submodule update --init`
This error appears when the "3rdparty" folder is empty.
In this we need to run the following two lines using the terminal in the directory `xampp/htdocs/nextcloud`

git init
 git submodule add https://github.com/nextcloud/3rdparty
 
- The next error which appears frequently is when trying to open http://localhost/nextcloud/: 
"PHP module zip not installed.
Please ask your server administrator to install the module.
PHP module GD not installed.
Please ask your server administrator to install the module.
PHP modules have been installed, but they are still listed as missing?
Please ask your server administrator to restart the web server."

This error indicates that some php modules weren't added to the php folder. To solve this problem one can try to approaches:

The first approach is to enter the "php.ini" file found in xampp/php and uncomment extension=gd adn extension=zip  (remove the ";" from infront each) (should open the file as administrator)
If this didn't work, open the terminal as administrator and run:
sudo apt-get install php-gd
sudo apt-get install php-zip

In the xampp directory

5- Install Nextcloud: Open your web browser and navigate to http://localhost/nextcloud/. You should see the Nextcloud setup page. Enter a username and password for the admin account, and provide the database details that you created in the previous step. Follow the on-screen instructions to complete the installation.
To get the database details you can go to `C:\xampp\htdocs\nextcloud\data\nextcdb` which contains all this information.
