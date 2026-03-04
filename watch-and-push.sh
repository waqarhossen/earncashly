#!/bin/bash

# Auto Watch and Push Script for EarnCashly
# Watches for file changes and automatically pushes to GitHub

PROJECT_DIR="/root/earncasly"
PUSH_SCRIPT="$PROJECT_DIR/auto-push-github.sh"
LOG_FILE="$PROJECT_DIR/auto-push.log"

echo "Starting auto-push watcher for EarnCashly..."
echo "Log file: $LOG_FILE"
echo "Press Ctrl+C to stop"

# Debounce timer (wait this many seconds after last change before pushing)
DEBOUNCE_SECONDS=5

last_change=0

while true; do
    # Check for file changes using git status
    cd "$PROJECT_DIR"

    # Get list of changed files (excluding .git and log files)
    CHANGES=$(git status --porcelain 2>/dev/null | grep -v "auto-push.log" | grep -v ".git")

    if [ -n "$CHANGES" ]; then
        current_time=$(date +%s)

        # Check if enough time has passed since last change (debounce)
        if [ $((current_time - last_change)) -ge $DEBOUNCE_SECONDS ]; then
            echo "[$(date)] Changes detected, pushing to GitHub..." | tee -a "$LOG_FILE"
            echo "$CHANGES" | tee -a "$LOG_FILE"

            # Run the push script
            bash "$PUSH_SCRIPT" 2>&1 | tee -a "$LOG_FILE"

            last_change=$current_time
        fi
    fi

    # Check every 2 seconds
    sleep 2
done