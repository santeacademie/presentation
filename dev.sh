#!/bin/bash

# Vscode installation: CMD+SHIFT+P then type "shell command" and install "code" in path

if [ $# -eq 0 ]; then
  echo "Error : give me a talk name."
  exit 1
fi

MARP_THEME="marp/santeacademie.css"

TALK_DIR="talks"
TALK_DIST="$TALK_DIR/talk.md.dist"

PRES_DIR="$TALK_DIR/$1"
PRES_SEED="$PRES_DIR/$1"
PRES_MD="$PRES_SEED.md"
PRES_HTML="$PRES_SEED.html"

if [ ! -d $PRES_DIR ]; then
  mkdir $PRES_DIR
fi

if [ ! -e $PRES_MD ]; then
  cp $TALK_DIST $PRES_MD
fi

touch $PRES_HTML
marp $PRES_MD -w --theme $MARP_THEME & sleep 2 && chrome $PRES_HTML && sleep 1 && code $PRES_MD
