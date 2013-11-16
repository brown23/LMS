-----------------------------------------
-----------------------------------------
Set up GitHub Account
-----------------------------------------
1. http://github.com
2. setup username and password.
3. email brown23.jason@yahoo.com your username.  He is the owner and will 
	set up your account as Collaborator.  This will give you the ability to commit.
4. 
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
	user:  yourusername@youraddress.com
	Password: obviouslyYourPassword
	
6. Branch Selection verify master is selected and click next. 
7. Local Destination click Finish
8. Window => Show perspective => PHP (I am assuming you've set up according to README_PHPeclipse.txt and PHPeclipse is already installed)
9.	File => New => PHP Project 
10  Create a PHP Project 
	Project name:  LMS  (This must be the exact name of the project from the repository.  I had issues with this during my install)
	Click next then finish.  

You now have the source code and should run it to make sure its working.
-----------------------------------------
-----------------------------------------
How to commit changes
-----------------------------------------
1. Right Click on the project (LMS)
2. Team => Share Project  => Next
3. Select the repository.  Should be c:\.....\workpace\LMS.git
4. Select finish
5. 
