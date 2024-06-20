#!/bin/bash

# Check if the directory argument is provided
if [ -z "$1" ]; then
  echo "Usage: $0 path/from/here"
  exit 1
fi

# Directory to start the search
DIR="$1"

# Function to convert image to .webp
convert_to_webp() {
    local file="$1"
    local output="${file%.*}.webp"
    cwebp "$file" -o "$output" -m 6
    echo "$file $output"
}

# Export the function to be used in find command
export -f convert_to_webp

# Change to the directory of the script
cd "$(dirname "$0")"

# Find all files that are not .webp and execute the convert function
find "$DIR" -type f ! -name "*.webp" \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" -o -iname "*.gif" -o -iname "*.bmp" \) -exec bash -c 'convert_to_webp "$0"' {} \;
