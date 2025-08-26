#!/usr/bin/env bash
set -euo pipefail
REPO="alafsi/souqpro-khidmapro-demos"
cd "$(dirname "$0")/.."
# Requires: gh auth login (already)
if ! gh auth status >/dev/null 2>&1; then
  echo "GitHub CLI is not authenticated. Run: gh auth login" >&2
  exit 1
fi
if gh repo view "$REPO" >/dev/null 2>&1; then
  echo "Remote repo exists: $REPO"
  git remote remove origin >/dev/null 2>&1 || true
  git remote add origin "https://github.com/$REPO.git"
else
  gh repo create "$REPO" --public --source . --remote origin --description "SouqPro & KhidmaPro demo kits (Laravel, RTL, Apple-inspired UI)" --push
fi
# Ensure main branch is default and push
git branch -M main
git push -u origin main
echo "Done. Repo: https://github.com/$REPO"
