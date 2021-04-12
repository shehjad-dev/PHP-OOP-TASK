Step-1: First Download the code

Step-2: Setup XAMPP for using localhost server,
        You can have any other options installed like wamp, lamp, mamp.

Step-3: We need to create a DB and table 
        No worries you can import the db file in your phpmyadmin dashboard
        The db file = 'reports.sql' is in the DB folder 

Step-4: Now go to step-1 if you have not downloaded the code
        And now place the folder inside the htdocs folder.
        (note: The htdocs folder will be in your xampp installation directory)

Step-4: Run the PROJECT
        First open 'xampp-control.exe' from your xampp installation directory 
        and start Apache and MySQL
        Now open up your browser and search for - http://localhost/PHP-OOP-TASK-master/
        The project should run correctly

Step-5: Details about the project
        User can input 9 fields and there is validation for each of them
        After all of the validations are fulfilled then these inputs get stored in the database along with 2 other input 
        which are filled from the backend.
        Then there is the Reports page where you can actually view all the stored inputs as in a table.
        There is also a search input field through which you can search for report with specific id.


Step-6: Not important
        Up until now the project should run smoothly
        but if you delete any row from the database manually then the the ID field get all messed up.
        So there are two extra txt files in 'SQL COMMANDS/Fix_ID_when_row_deleted' which will help to redeem your ID serial in the DB.
        If you delete any 1 row or multiple rows from DB then copy the code from FixID-1.txt and paste it in you SQL input section.
        If you delete all the rows then copy the code from FixID-2.txt and paste it in you SQL input section.

        Thanks you.
