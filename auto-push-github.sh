#!/bin/bash

# Auto Git Push Script for EarnCashly Project
# This script pushes changes to GitHub automatically
# NOTE: Set GITHUB_TOKEN environment variable before running

# GitHub Configuration
GIT_NAME="Waqar Hossen"
USEREMAIL="ceh.waqar@gmail.com"
USERNAME="waqarhossen"

# Change to project directory
cd /root/earncasly

# Configure git user
git config user.name "$GIT_NAME"
git config user.email "$USEREMAIL"

# Check if remote exists, if not add it
if ! git remote | grep -q "origin"; then
    git remote add origin "https://github.com/${USERNAME}/earncashly.git"
fi

# Ensure we're on main branch
git branch -M main

# Check if there are any changes to commit
if [ -n "$(git status --porcelain)" ]; then
    # Stage all changes
    git add -A

    # Create commit with timestamp
    COMMIT_MSG="Auto-update: $(date '+%Y-%m-%d %H:%M:%S')"
    git commit -m "$COMMIT_MSG"

    # Push to GitHub (requires GITHUB_TOKEN env var)
    if [ -n "$GITHUB_TOKEN" ]; then
        git push https://${USERNAME}:${GITHUB_TOKEN}@github.com/${USERNAME}/earncashly.git main
    else
        echo "Error: GITHUB_TOKEN not set. Please export GITHUB_TOKEN first."
        exit 1
    fi

    echo "[$(date)] Successfully pushed to GitHub!"
else
    echo "[$(date)] No changes to commit."
fi