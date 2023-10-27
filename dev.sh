if [ $# -eq 0 ]; then
  echo "Error : give me a talk name."
  exit 1
fi

PRZ=talks/$1/$1
touch "$PRZ.html"
chrome "$PRZ.html"
marp "$PRZ.md" -w --theme marp/santeacademie.css
