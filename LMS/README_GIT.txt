-----------------------------------------
-----------------------------------------
Set up GitHub Account
-----------------------------------------
1. http://github.com
2. setup username and password.
3. email brown23.jason@yahoo.com your username.  He is the owner and will 
	set up your account as Collaborator.  This will give you the ability to commit.
-----------------------------------------
-----------------------------------------
Install Software Update to Eclipse for Git
-----------------------------------------
1. Upgrade Eclipse to the latest.
2. In Eclipse Follow the Menu Help => Install New Software...
	In the Work with:  Copy and paste the following.
	Eclipse Kepler repository - http://download.eclipse.org/releases/kepler/
	Search for "Eclipse Git Team Provider"  --- This is Egit 
	Install the latest version by selecting the option (do NOT select the "Source Code" version) 
3. Window => Show perspective => Git Repository Exploring
4.  Select the "Clone Git Repository and add a clone to this view" icon.  
5. Fill out the information:
	URI: https://brown23@github/brown23/LMS.git
	Host: github.com
	Repository path: brown23/LMS.git
	
	Authentication
	user:  yourusername
	Password: obviouslyYourPassword
	
6. Branch Selection verify master is selected and click next. 
7. Directory should be where ever your Xampp/htdocs is located.
   For xampp to run your webpages correctly this is the most important piece
   your pages need to be in this folder.  You can run any other IDE if your project is
   this folder. Click next
8. Window => Show perspective => PHP (I am assuming you've set up according to README_PHPeclipse.txt and PHPeclipse is already installed)
9.	File => New => PHP Project 
10.  Create a PHP Project 
	Project name:  This can be any project name, it does not need to be the same as the 
	github project name.  
11. Make sure default location in NOT checked and select the folder inside your Xamp/htdocs location.  It should be named LMS.
	

At this point you should have the project correctly installed on your local host.  To test follow the README_PHPeclipse.txt instructions.
When you have XAMPP installed you can type

localhost/LMS/LMS/index.html  to see the website 
or
localhost/LMS/LMS/testscript_dbase_connect.php to ensure you are connected to the database.

-----------------------------------------
-----------------------------------------
How to commit changes
-----------------------------------------
1. Right Click on the project (LMS)
2. Team => Share Project  => Next
3. Select the repository.  Should be c:\.....\workpace\LMS.git
4. Select finish
5. Right Click on the project (LMS)
6. Team => Commit
7. Input a comment with a description on the changes you made.
8. Select commit.