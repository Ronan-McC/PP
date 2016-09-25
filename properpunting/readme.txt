# Proper Punting

### Difference between online and local host code versions

To enable easy running of files on both localhost (testing) and web server (live) there is an environment variable, in externs.html in the includes folder, that controls the prefix of links. That is whether a link starts with 'http://localhost/properpunting' or 'http://www.properpunting.com'.

##### Local web server (localhost with xampp):

Set the environment variable to LOCAL with this code: "$environment = LOCAL;"
Also change line 4 of index.php to "header('Location: http://localhost/properpunting/user/login.php');".

##### Web server (properpunting.com):

Before uploading files to the web server through ftp ensure to change this to "$environment = WEB;".
Also change line 4 of index.php to "header('Location: http://www.properpunting.com/user/login.php');".

### Using FTP in sublime text

Open the folder on your machine containing the website's files in Sublime Text, through "File" -> "Open folder".
Work away on the files. When changes have been made and you want to make these live on the website right click on the folder name in Sublime Text, click "SFTP/FTP" and click "Upload folder". Ensure the environment settings are correct before doing this (outlined above).

### Regards from the Proper Punting team
