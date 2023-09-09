#!/bin/bash

# Source database credentials from a configuration file
CONFIG_FILE="env"

if [ -f "$CONFIG_FILE" ]; then
    source "$CONFIG_FILE"
else
    echo "Configuration file '$CONFIG_FILE' not found."
    exit 1
fi

# Backup directory and filename
BACKUP_DIR="/path/to/backup/directory"
BACKUP_FILENAME="backup_$(date +\%Y\%m\%d_\%H\%M\%S).sql"

# MySQL dump command
mysqldump -u$DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/$BACKUP_FILENAME

# Check if the dump was successful
if [ $? -eq 0 ]; then
    echo "Database backup completed successfully."

    # Copy the backup to another server using scp
    SCP_DESTINATION="username@remote_server:/path/to/remote/directory"
    scp $BACKUP_DIR/$BACKUP_FILENAME $SCP_DESTINATION

    # Check if the scp command was successful
    if [ $? -eq 0 ]; then
        echo "Backup copied to remote server."
    else
        echo "Error copying backup to remote server."
    fi
else
    echo "Error creating database backup."
fi
