	Install XAMPP
-----------------------------------------
1.	XAMPP is bundle of open source software. XAMPP consists of integrated Apache server, MySQL, PHP and Perl, hence called XAMPP.
2.	Download and install XAMPP from http://www.apachefriends.org/en/xampp.html . The specific link for the latest download is http://www.apachefriends.org/en/xampp-windows.html#641 . You can download “installer” or “zip”. Installer is easier to install.
3.	Once XAMPP is installed and launched. A common console is open for managing Apache and MySQL.
-----------------------------------------
-----------------------------------------
	PHPeclipse (a plug-in to Eclipse for PHP)
-----------------------------------------
1.	In Eclipse, go to Windows => Preferences. In the left column. There is no PHPeclipse tab, indicating that the current eclipse does not support PHP and a PHP plug-in is required.
2.	Visit http://sourceforge.net/project/showfiles.php?group_id=57621 to download PHPeclipse-1.2.1. We download PHPeclipse-1.2.1 because, our Eclipse version on Eclipse3.3.x.
3.	A zipper version is downloaded to the location specified.
4.	Now unzip to find two folders extracted namely “features” and “plug-in”.
5.	Copy the contents (not the folder) of “features” and paste them into “C:/Program Files/eclipse/ features”. (In my case, there were 3 folder to be copied)
6.	Copy the contents (no the folder) of “plug-in” and paste them into “C:/Program Files/ eclipse/plug-in”. (In my case, there were 17 folders copied)
7.	Ensure that there is no file/folder deleted in the above process.
8.	Restart eclipse and go to, Windows => Preferences. Now, in the left column, PHPeclipse tab should be available.
-----------------------------------------
-----------------------------------------
	Integrate XAMPP to Eclipse
-----------------------------------------
I DON'T have XAMPP integrated.  If you can figure out how to integrate write a better tutorial and let the team know you've figured
it out.  Its not necessary to have it integrated.  All you have to do is have Xampp, Apache and MySql running and view your changes in 
an actual web browser and not the eclipse browser. 

1.	If an auto configure has not taken place, manually the components of XAMPP has to be configured in Eclipse.
2.	Go to, Windows => Preferences => PHPeclipse =>PHP External Tools. 
3.	Here Apache, MySQL and XAMPP will be seen. Their respective location has to be configured.
-----------------------------------------
-----------------------------------------
Check for a simple project
-----------------------------------------
This is where you would import the Git Version our project.  I'm leaving this piece of the tutorial so you can see a simplified set
up.  This might be helpful.  Skip to ahead to setup the dbase or pull from the repository.  Both have to be done but it doesn't matter the order
I recommend setting up the database.

1.	Open Eclipse
2.	Windows =>Open Perspectives => others =>PHP
3.	Now you should see the XAMPP bar on the top of the window with icons to start/stop XAMPP/MySQL/Apache.
4.	Create a new PHP project. File =>
Give a proper Project name.
IMPORTANT:  Uncheck “use default location” and browse this path “C:\xampp\htdocs\<Project folder>”. Project folder should be newly created at that location.
5.	So all your project file will go into “C:\xampp\htdocs\<Project folder>”.
6.	Now create a new HTML page under this project and edit the file.
7.	Start XAMPP using the icon in eclipse.
8.	Right click on the HTML page and click “open PHP browser”.
9.	The result would be negative. In the browser path, edit the path to include the <Project folder> created which will be missing in the default browser path.
a.	E.g. http://localhost /Test.html to http://localhost/NewFolder/Test.html. Here NewFolder is the <Project Folder>.

-----------------------------------------
-----------------------------------------
Set up myPhpAdmin and create MySql Database
-----------------------------------------
1. Start Xampp
2. Start Apache
3  Start MySql ensure all three are running
4. Open any web browser and input localhost
5. Xampp for Windows should display.  (You might have to select the language)
6. Select a link for security in the middle of the screen.  " http://localhost/security/xamppsecurity.php" 
	You will be allowed to change your password (even if none is set)
7. For test purposes change password to "test123" otherwise you'll have to change the password in scripts that access the database
8. Stop MySql, Apache and Xampp, then Restart all three.
9. input localhost/phpmyadmin/ into web browser.  
10. type in username and password....should be root and test123 
11. select "Database"
12. create database by typing in "library_management_system" then selecting create.
13. select "library_management_system"
14. select "SQL"
15. copy and paste text from "README_DB_SETUP.txt" into query box.
16. select "Go"

At this point you should have 3 tables. 
Pull the project from the LMS repository if you haven't done so already!

Run the testscript_dbase_connect.php to make sure you can connect to the database.



