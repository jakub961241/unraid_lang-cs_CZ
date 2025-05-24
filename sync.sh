#!/bin/bash
IFS=$'\n'; set -f
for f in $(find ../lang-en_US -name '*.txt'); do
    echo "$f"
    f1=$(realpath --relative-to=../lang-en_US "$f")
    ../translation-manager/bin/sync "$f" ./"$f1" ./"$f1"
done
unset IFS; set +f
