#!/bin/bash

# Auto Git Push Script for EarnCashly Project
# This script automatically pushes changes to GitHub

# GitHub Configuration
GIT_NAME="Waqar Hossen"
USEREMAIL="ceh.waqar@gmail.com"
USERNAME="waqarhossen"

# Load token from credential file (not tracked in git)
CREDENTIAL_FILE="/root/earncasly/.github-credentials"

if [ -f "$CREDENTIAL_FILE" ]; then
    source "$CREDENTIAL_FILE"
fi

# Change to project directory
cd /root/earncasly

# Configure git user
git config user.name "$GIT_NAME"
git config user.email "$USEREMAIL"

# Ensure we're on main branch
git branch -M main

# Check if there are any changes to commit
if [ -n "$(git status --porcelain)" ]; then
    # Stage all changes
    git add -A

    # Create commit with timestamp
    COMMIT_MSG="Auto-update: $(date '+%Y-%m-%d %H:%M:%S')"
    git commit -m "$COMMIT_MSG"

    # Push to GitHub
    if [ -n "$GITHUB_TOKEN" ]; then
        git push https://${USERNAME}:${GITHUB_TOKEN}@github.com/${USERNAME}/earncashly.git main
        echo "[$(date)] Successfully pushed to GitHub!"
    else
        echo "Error: GITHUB_TOKEN not found in $CREDENTIAL_FILE"
        exit 1
    fi
else
    echo "[$(date)] No changes to commit."
fi