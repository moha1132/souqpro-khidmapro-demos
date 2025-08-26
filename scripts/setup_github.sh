#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
USER_NAME=${GITHUB_USER:-$(gh api user -q .login)}
REPO_NAME=${GITHUB_REPO_NAME:-souqpro-khidmapro-demos}
FULL_REPO="$USER_NAME/$REPO_NAME"

if gh repo view "$FULL_REPO" >/dev/null 2>&1; then
  echo "Remote repo exists: $FULL_REPO"
  git remote remove origin >/dev/null 2>&1 || true
  git remote add origin "https://github.com/$FULL_REPO.git"
else
  if ! gh repo create "$FULL_REPO" --public --source . --remote origin --description "SouqPro & KhidmaPro demo kits (Laravel, RTL, Apple-inspired UI)" --push; then
    TS=$(date +%Y%m%d-%H%M%S)
    ALT="$USER_NAME/${REPO_NAME}-$TS"
    echo "Name taken, creating: $ALT"
    gh repo create "$ALT" --public --source . --remote origin --description "SouqPro & KhidmaPro demo kits (Laravel, RTL, Apple-inspired UI)" --push
    FULL_REPO="$ALT"
  fi
fi

git branch -M main
# Ensure we push latest state
git push -u origin main

echo "Done. Repo: https://github.com/$FULL_REPO"
