#!/bin/sh

# Change DBPASSWORD, DBUSER, DBHOST and DBNAME to match the values
# your mysql_db_info file on the webdev server.
mysql --password='ZMuXUrVmDR0a' --user='kdzhou' --host='dbdev.cs.uiowa.edu' 'db_kdzhou'
