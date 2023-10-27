---
marp: true
title: 'LLM Like a boss'
author: JRK
paginate: true
theme: santeacademie
class: invert
header: '![height:30px](https://sante.ac/logo-white-label)'
footer: '**LLM Like a boss**'
---
<!-- _paginate: skip -->
<!-- _footer: '' -->

![bg right:33%](https://images.pexels.com/photos/3009205/pexels-photo-3009205.jpeg)
# LLM Like a boss
##### "Tout vient à point à qui a un LLM."
> Moi-même

---
# Install
<!-- _class: invert amber -->

```bash
pip3 install llm # or brew install llm
```

---
# Configure
<!-- _class: invert teal -->
```bash
llm keys set openai
```

---
# Global usage
<!-- _class: invert slate -->
```bash
llm 'Donne moi 10 noms de langages de programmation'
```
```bash
llm 'Donne moi 10 noms de langages de programmation' --no-stream
```
```bash
llm 'Donne moi 10 noms de langages de programmation' -m gpt4
```

---
<!-- _class: invert -->
## Shell usage
```bash
echo 'Donne moi 10 noms de langages de programmation' | llm
```
```bash
llm "Dis moi en plus à propos de mon OS: $(uname -a)"
```
```bash
cat myscript.php | llm 'explique le code'
```

---

# Completion prompts
```bash
llm -m gpt-3.5-turbo-instruct 'Pourquoi apprivoiser un écureuil sauvage:'
```

---


# System prompt

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

```bash
# Write system template
llm -s 'write php tests for this code' --save phptest

# Use system template
cat utils.php | llm -t phptest
```


---
<!-- _class: invert flat pink center -->
<!-- _footer: '' -->
<!-- _paginate: 'skip' -->
<style scoped>section{text-align:center;}</style>
# Merci !

![height:300px](https://i.imgur.com/CVAWdaB.gif)
