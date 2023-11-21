---
marp: true
title: '🏊‍♂️ Swimm'
author: __AUTHOR__@santeacademie.com
paginate: true
theme: santeacademie
class: invert teal 
header: '![height:30px](https://sante.ac/logo-white-label)'
footer: '**🏊‍♂️ Swimm**'
---
<!-- _paginate: skip -->
<!-- _footer: '' -->
<!-- _class: invert teal top -->

![bg right:33%](https://media.istockphoto.com/id/497538394/fr/photo/homme-travaillant-avec-ordinateur-portable-sous-marine.jpg?s=1024x1024&w=is&k=20&c=hm3GrXehMxu2IpxFlUvwNJNAMQyHaZBJSAtlFJzVexg=)

# 🏊‍♂️ Swimm

##### Comment naviguer dans le code et la documentation sans naufrage ?

> Merci ChatGPT pour cette problématique à portée humoristique

---

# Swimm

- Permet de rédiger de la documentation
- L'intègre à une PR
- Lie la doc à des snippets de code
- Rends automatique sa revue
- Préviens les abonnés par email

---

# Type de documentation

<!-- Swimm agira sur la partie technique mais -->
<!-- Swimm peut s'assurer que le readme reste à jour -->
<!-- Swimm peut s'assurer que le commentaire reste à jour -->
* Commentaires dans le code (IDE)
* Documentation de démarrage (Readme)
* Documentation d'api (Openapi)
* Documentation fonctionnelle (Notion)
* Documentation d'architecture
* Documentation technique

---

# Pourquoi documenter ?

* Améliorer la **maintenabilité** et la **clarté** <!-- - Celui qui écrit n'est pas forcément celui qui écrira à l'avenir (offrir une seconde lecture du code) -->
* Faciliter la **collaboration** <!-- - onboarding, debug, etc. -->
* Eviter les **bottelnecks de connaissances** <!-- - untel est malade donc c'est la merde -->

---

# Comment SWIMM fonctionne

1. Rédaction de la doc sur votre feature branch (Swimm ou IDE)
2. Création de la PR
3. Le bot Swimm détectera des *out-of-sync*
4. On valide la PR

---

# Démo


---

# Process: doc-review

> Objectif: intégrer la documentation au coeur du processus de livraison

- Quoi: Idéalement, prévoir sa bonne tenue et son contenu lors des groomings
- Quand: Revue de doc intégrée à la revue technique
- Qui: Ecrite par le dev, validé par les reviewers

---

# Q/A

---
<!-- _class: invert flat slate center -->
<!-- _footer: '' -->
<!-- _paginate: 'skip' -->
<style scoped>section{text-align:center;}</style>

![height:300px](https://i.giphy.com/media/LkjlH3rVETgsg/giphy.webp)
