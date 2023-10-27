PRZ=talks/$1/$1
touch "$PRZ.html"
chrome "$PRZ.html"
marp "$PRZ.md" -w --theme marp/santeacademie.css
