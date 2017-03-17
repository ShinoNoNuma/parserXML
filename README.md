# parserXML
App XMLParser

How to use :

	    	1 - Clone a git repository :

	        	git clone https://github.com/samyyounsi/parserXML.git
                       
           	 2 - chmod directory permission for tmp folder:
                
               	 	chmod -R 777 parserXML

			3 - Create a MySQL Database

			    mysql -u root -p
			    CREATE DATABASE IF NOT EXISTS parsexml;

			4 - Edit the file app/Config/database.php

			5 - Create a mysql tables and column

			     app/Console/cake schema create  

			6 - App XMLParser is ready, go to http://localhost/parserXML

			7 - If you want launch the cron in a terminal :

			     php ./app/webroot/cron.php /cron/parse_all_xml

Notice : If you want to parse a xml file, you are require upload your xml file in application.
		 It's possible to upload multiple xml files. 
		 The cron parsed all xml file upload in xml folder.
		 The file flux.xml is a demo xml file.
		 I use the framework cakephp 2.6.
