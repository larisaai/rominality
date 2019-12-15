# Rominality

Rominality represents the sound of underground minimal techno music. We are trying to create a community based web service where producers can sell their music and the users can go and listen to their favourite artist and sponsoring him by buying his songs. 

The users can create an account and listen to the songs offered in the newsfeed (Latest releases) section on the home page. At the same time they can engage with each other by liking songs for future purchase or by commenting on them to show their appreciaton for the artist and the genre.

Meanwhile, producers can sell teir own music by uploading their song on the platform. They can also include different tags that would make the discovery of their songs much faster on the platform. <b>Play, share and enjoy music.</b>

# How to get started

This project includes an SQL file that must be installed before using the platform. The reason for that is because our platform is using a MySQL database for all the important data on the platform. This sql file can be found in the folder 'sql dump'.

In order to be able to set it up we need a service that can run our SQL file. We reccomend using <b>PhpMyAdmin</b> but it is to you whatever option you choose(MySQL Workbench etc.). Because our project is created locally, we reccomend using <b>XAMPP to run the MySQL and the Apache server locally</b>. The XAMPP app comes together with the PhpMyAdmin for database administration.

# Installing XAMPP

You can find and install XAMPP by following <a href="https://www.apachefriends.org/download.html">this link</a>. Pick the instalation specific for your Operating System and download the installer. After the download has finished please follow the reccomended steps for the instalation process. 

# Start MySQL and Apache HTTP Server

After the instalation process has ended please go to the installed folder and find XAMPP Control Panel and open it. After opening it you will see different options from which you need to select Apache and MySQL and press start. 

If everything goes well you should see both of the services having green colors under the Module tab. 

If anything goes wrong don't hesitate to take a look <a href="https://www.wikihow.com/Install-XAMPP-for-Windows">here for Windows</a> or <a href="https://www.webucator.com/how-to/how-install-start-test-xampp-on-mac-osx.cfm">here for Mac</a>.

# PhpMyAdmin

After this step you have to go to your preffered browser(we reccomend using <a href="https://www.google.com/chrome/?brand=CHBD&gclid=CjwKCAiA58fvBRAzEiwAQW-hzd54qlKiob-U9wJxUHyjaIGvr-SrrmACJylLwdEimOtytSWnteptHRoCt48QAvD_BwE&gclsrc=aw.ds">Google Chrome browser</a>). Write in the searchbar of your browser 'localhost' and a page with XAMPP should appear. In the top right corner click on PhpMyAdmin. In the same window you should see now PhpMyAdmin database administrator GUI. 

# Importing the database

<b>Now you are ready to import our project.</b> Please click under the PhpMyAdmin logo in the top left corner on <i>new</i> as in <i>new database</i>. Please call the new database 'rominimal' with the collation 'utf8mb4_general_ci'. If you use another name, the database connection won't work. Click on Create. (All of this can be done by writing the SQL command 'CREATE DATABASE rominimal;' and then CTRL+ENTER or CMD+ENTER)

# Populate the database

Now you have an empty database that needs to be populated with data. Please click on the 'rominimal' database in order to use it. After clicking on the database, above you will notice some tabs from which one of them is called Import. Click on import. Click on 'add file'. 

In order to pupulate the database with the right data you need to go to our project folder and take the file from SQL dump folder. After selecting the database click on go. If everything ran smoothely and everything looks green it means that the database is all set up. Now we need to go and run the website on the Apache server that we started earlier.

Please clone or download our link of the project from <a href="https://github.com/larisaai/rominality">this</a> github respository and paste it in the XAMPP folder that you will create -> htdocs -> 'rominality' in order to be able to see it live on the server. Now please go back to your browser and in the search bar look for localhost/rominality.

Now your project should be up and running. Thank you very much for your patience. <b>Play, share and enjoy music.</b>
