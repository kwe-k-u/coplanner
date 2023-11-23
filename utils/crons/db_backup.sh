#!/bin/bash

# Path to the .env file
ENV_FILE="/var/www/html/easygo_v2/utils/.env"
#Today's date
DATE=$(date +"%y%m%d")
# Backup folder
BACKUP_ROOT="/var/www/html/easygo_v2/utils/cron/backup_files"
BACKUP_DIR="$BACKUP_ROOT/backup_$DATE"
# DEFAULT LOG
SYS_LOG="/var/log/apache2"
# easyGo logs
EASY_LOG="/var/www/html/easygo_v2/logs"
# Filename for database backup
FILENAME="db_backup.sql"


# Check if the .env file exists
if [ -f "$ENV_FILE" ]; then
    # Use grep and awk to extract database credentials
    DB_USER=$(grep -i "DB_USERNAME" $ENV_FILE | awk -F "=" '{print $2}' | tr -d '[:space:]')
    DB_PASSWORD=$(grep -i "DB_PASSWORD" $ENV_FILE | awk -F "=" '{print $2}' | tr -d '[:space:]')
    DB_NAME=$(grep -i "DB_NAME" $ENV_FILE | awk -F "=" '{print $2}' | tr -d '[:space:]')
else
    echo "Error: .env file not found at $ENV_FILE"
    exit 1
fi


# Create the backup folder
mkdir -p "$BACKUP_DIR"


# MySQL dump command to export the database to the backup folder
mysqldump -u$DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/$FILENAME
# Copy error logs to the backup folder
cp -u $SYS_LOG/error.log $BACKUP_DIR/

# if there are javascript error logs copy them
if [-f "$EASY_LOG/js_error20$DATE.log"]; then
    cp -u $EASY_LOG/js_error20$DATE.log $BACKUP_DIR/js_error20$DATE.log
fi

# if there are sql logs copy them
if [-f "$EASY_LOG/sql_queries-20$DATE.log"]; then
    cp -u $EASY_LOG/sql_queries-20$DATE.log $BACKUP_DIR/sql_queries-20$DATE.log
fi
# # if there are php error logs copy them
# if [-f "$EASY_LOG/$DATE.log"]; then
#     cp -u $EASY_LOG/$DATE.log $BACKUP_DIR/
# fi

# if there are email logs copy them
if [-f "$EASY_LOG/email-20$DATE.log"]; then
    cp -u $EASY_LOG/email-20$DATE.log $BACKUP_DIR/email-20$DATE.log
fi

# if there are slack logs copy them
if [-f "$EASY_LOG/slack_logs-20$DATE.log"]; then
    cp -u $EASY_LOG/slack_logs-20$DATE.log $BACKUP_DIR/slack_logs-20$DATE.log
fi



# zip the folder to send
zip -r "$BACKUP_ROOT/backup_$DATE.zip" "$BACKUP_DIR/"
echo "$DATE backup run successfully"