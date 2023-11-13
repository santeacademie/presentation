#!/bin/bash

# Add options:
# -d TALK_NAME, deletes the talks/[TALK_NAME] directory
# -l lists the talks in the talks directory, with an associated incremented number
# -i [Talk number] returns the name of the associated talk (relative to the list)

MARP_THEME="marp/santeacademie.css"
TALK_DIR="talks"
TALK_DIST="$TALK_DIR/talk.md.dist"
TALK_NAME=$1

# Function to list talks
list_talks() {
  local i=1
  for talk in "$TALK_DIR"/*; do
    if [ -d "$talk" ]; then
      echo "$i: $(basename "$talk")"
      ((i++))
    fi
  done
}

# Function to get talk name by number
get_talk_by_number() {
  local i=1
  local num=$1
  local found=""

  for talk in "$TALK_DIR"/*; do
    if [ -d "$talk" ]; then
      if [ "$i" -eq "$num" ]; then
        found="$(basename "$talk")"
        break
      fi
      ((i++))
    fi
  done

  echo "$found"
}

develop_talk() {
  PRES_DIR="$TALK_DIR/$1"
  PRES_SEED="$PRES_DIR/$1"
  PRES_MD="$PRES_SEED.md"
  PRES_HTML="$PRES_SEED.html"

  if [ ! -d "$PRES_DIR" ]; then
    mkdir "$PRES_DIR"
  fi

  if [ ! -e "$PRES_MD" ]; then
    cp "$TALK_DIST" "$PRES_MD"
  fi

  touch "$PRES_HTML"
  marp "$PRES_MD" -w --theme "$MARP_THEME" & sleep 2 && chrome "$PRES_HTML" && sleep 1 && code "$PRES_MD"
}

# Process options
while getopts ":d:li:h" opt; do
  case $opt in
    d)
      # Check if the argument is a number
      if [[ "${OPTARG}" =~ ^[0-9]+$ ]]; then
        TALK_NAME=$(get_talk_by_number "${OPTARG}")
        if [ -z "$TALK_NAME" ]; then
          echo "Error: No talk found with number ${OPTARG}."
          exit 1
        fi
      else
        TALK_NAME="${OPTARG}"
      fi

      # Proceed with deletion
      if [ -d "$TALK_DIR/$TALK_NAME" ]; then
        rm -rf "$TALK_DIR/$TALK_NAME"
        echo "Talk '$TALK_NAME' deleted."
      else
        echo "Error: Talk '$TALK_NAME' does not exist."
        exit 1
      fi
      exit
      ;;
    l)
      list_talks
      exit
      ;;
    i)
      if [[ "${OPTARG}" =~ ^[0-9]+$ ]]; then
        TALK_NAME=$(get_talk_by_number "${OPTARG}")
        if [ -z "$TALK_NAME" ]; then
          echo "Error: No talk found with number ${OPTARG}."
          exit 1
        fi
      else
        TALK_NAME="${OPTARG}"
      fi
      develop_talk $TALK_NAME
      exit 0
      ;;
    h)
      echo "Utilisation : $0 [OPTION]... [TALK_NAME]"
      echo "Options:"
      echo "  -d [TALK_NAME|NUMBER]  Supprime le talk spécifié par le nom ou le numéro."
      echo "  -l                     Liste tous les talks avec un numéro incrémenté."
      echo "  -i [TALK_NAME|NUMBER]  Lance le développement du talk spécifié par le nom ou le numéro."
      echo "  -h                     Affiche cette aide et quitte."
      exit
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      exit 1
      ;;
    :)
      echo "Option -$OPTARG requires an argument." >&2
      exit 1
      ;;
  esac
done

# Shift off the options and their arguments
shift $((OPTIND-1))

if [ $# -eq 0 ]; then
  echo "Error: Give me a talk name."
  exit 1
fi


develop_talk $TALK_NAME