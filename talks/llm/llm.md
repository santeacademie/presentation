---
marp: true
title: 'LLM Like a boss'
author: jessym@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
footer: '**LLM Like a boss**'
---
<!-- _paginate: skip -->
<!-- _footer: '' -->
<!-- _class: invert top -->
<!-- This is a "speaker note" -->

![bg right:33%](https://images.pexels.com/photos/3009205/pexels-photo-3009205.jpeg)

# LLM Like a boss

##### "Tout vient à point à qui a un LLM."

> Daoui

---
<!-- 
- Développeur Britanniqu
- Créateur de Django e
- Directeur architecte chez EventBrite
-->

# LLM
> @[Simon Willison](https://simonwillison.net)
- https://github.com/simonw/llm
- 1.5k ⭐️
- version 0.11 (Sep 19)

![bg right:33%](https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Simon_Willison_%282929211382%29_%28cropped%29.jpg/440px-Simon_Willison_%282929211382%29_%28cropped%29.jpg)

---
# Install
<!-- _class: invert top amber -->

```bash
pip3 install llm # or brew install llm
```

--- 

# Configure
<!-- _class: invert top teal -->
```bash
llm keys set openai
```

---
# Global usage
<!-- _class: invert top slate -->

* `llm 'Donne moi 10 noms de langages de programmation'`

* `llm 'Donne moi 10 noms de langages de programmation' --no-stream`

* `llm 'Donne moi 10 noms de langages de programmation' -m gpt4`

---
<!-- _class: invert top pink -->
# Shell usage

* `echo 'Donne moi 10 noms de langages de programmation' | llm`

* `llm "Dis moi en plus à propos de mon OS: $(uname -a)"`

* `cat myscript.php | llm 'explique le code'`

---

# Completion prompts
<!-- _class: invert top amber -->
```bash
llm -m gpt-3.5-turbo-instruct 'Guide pour apprivoiser un écureuil sauvage:'
```

---


# System prompt
<!-- _class: invert top teal -->

```bash
llm 'SQL pour calculer les ventes totales par mois' \
--system 'Vous êtes un grille-pain sensible qui connaît SQL et parle beaucoup de tartines'
```

```bash
curl -s 'https://www.santeacademie.com/' | \
llm -s 'Suggère moi des thématiques pour ce contenu en tant que tableau JSON'
```

```bash
git diff | llm -s 'Décris moi les modifications'
```

---

# Templates
<!-- _class: invert top slate -->
```bash
# Write system template
llm -s 'write php tests for this code' --save phptest

# Use system template
cat utils.php | llm -t phptest
```

---

# Example
<!-- _class: invert top amber -->

```bash
#!/bin/bash

# call: ~/autotest.sh ./Service .php 2 ./tests/
input_dir=$(echo $1 | sed 's:/*$::')        # Arg1: Input directory
file_ext=${2:-.php}                         # Arg2: File extension filter (default: .php)
depth=${3:-1}                               # Arg3: Depth (default: 1)
output_dir=$(echo $4 | sed 's:/*$::')       # Arg4: Output directory (default: tests/)
model=${5:-gpt-4}                           # Arg5: LLM Model name or alias (default: gpt-4)

# Write output dir
mkdir -p "${output_dir:-tests}"

while IFS= read -r file; do
    alter_path="${output_dir:-tests}/$(dirname "$file")"
    alter_file="${file#./}"
    alter_path="${output_dir:-tests}/$(dirname "$alter_file")"
    alter_file="${output_dir:-tests}/${alter_file}"
    alter_file="${alter_file/.php/Test.php}"

    mkdir -p $alter_path && echo "Writing test for class $file into $alter_file"
    test_class=$(cat "$file" | llm -m $model --no-stream 'write php tests for this code, just the code please, no introduction but with <?php')
    echo "$test_class" > $alter_file
done < <(find "$input_dir" -type f -name "*$file_ext" -maxdepth $depth)


``````

---

# Idées
<!-- _class: invert top teal -->

* Nom de fonction explicite => Demander d'écrire la fonction
* Résoudre un bug de logique
* Génération de documentation
* Détecter les anti-patterns
* ...

---

# Python API
<!-- _class: invert top pink -->
```python
import llm

model = llm.get_model("gpt-3.5-turbo")

model.key = 'YOUR_API_KEY_HERE'

response = model.prompt("Donne moi cinq noms surprenants pour mon chat")

print(response.text())
```

---
<!-- _class: invert flat pink center -->
<!-- _footer: '' -->
<!-- _paginate: 'skip' -->
<style scoped>section{text-align:center;}</style>

![height:300px](https://i.imgur.com/CVAWdaB.gif)
