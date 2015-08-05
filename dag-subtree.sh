#!/bin/bash

# Ensure git subsplit is installed.
if [ ! type "git subsplit" >/dev/null 2>&1 ]; then

    echo "To run this command, you must first install git subsplit."
    echo "Visit: https://github.com/dflydev/git-subsplit"
    exit 1

fi

COMPONENTS=false
BUNDLES=false
FULL=false

# Parse incoming arguments
while [[ $# > 0 ]]
do
key="$1"
case $key in
    --components)
    COMPONENTS=true
    shift
    ;;
    --bundles)
    BUNDLES=true
    shift
    ;;
    --full)
    FULL=true
    shift
    ;;
esac
shift
done

components=("Field" "Option" "Prototype" "Resource")
bundles=("FieldBundle" "OptionBundle" "PrototypeBundle" "ResourceBundle" "SettingsBundle")

# These are here so we can easily, and selectively split certain pieces without running the whole thing.

#components=()
#bundles=()
#bridges=()

git subsplit init git@gitlab.med.upenn.edu:dag-framework/Framework.git
git subsplit update

if [ "$COMPONENTS" = true ]; then
    for component in "${components[@]}"
    do
        echo "Splitting ${component} component"
        git subsplit publish "src/Component/${component}:git@gitlab.med.upenn.edu:dag-framework/${component}.git" --heads="master 1.0"
    done
fi

if [ "$BUNDLES" = true ]; then
    for bundle in "${bundles[@]}"
    do
        echo "Splitting ${bundle} bundle"
        git subsplit publish "src/Bundle/${bundle}:git@gitlab.med.upenn.edu:dag-framework/${bundle}.git" --heads="master 1.0"
    done
fi
