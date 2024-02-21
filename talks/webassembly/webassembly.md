---
marp: true
title: 'Faire parler du derrière et du devant avec confiance'
author: julien@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
class: top teal
---
<!-- _class: teal invert -->
![bg right:66%](https://miro.medium.com/v2/resize:fit:1164/format:webp/1*N_H6bIuy78xXT3sfH73WPw.png)
# Wa, le turfu du js
---
<style scoped>figure {margin-right: 30px !important}</style>

# Qu'est-ce que le WebAssembly ?
- Un format de code binaire pour des modules exécutables dans le navigateur web
- Permettre l'exécution de code à des performances proches du natif
- Conçu pour fonctionner en harmonie avec JavaScript, complétant plutôt que remplaçant JavaScript
---

# Pourquoi WebAssembly ?
- Performance: Exécution plus rapide que JavaScript pour certaines tâches
- Sécurité: Exécution dans un sandbox pour une sécurité des plus mamma sita
- Portabilité: Le code compilé peut s'exécuter sur n'importe quel système d'exploitation ou appareil avec un navigateur compatible
- Langage: Permet d'utiliser des langages autres que JavaScript, comme C, C++, Rust
---

# Cas d'utilisation de WebAssembly
- Jeux sur navigateur
- Applications de calcul scientifique
- Traitement d'image et vidéo
- Émulateurs
- Applications de réalité augmentée et virtuelle
---

# Comment fonctionne WebAssembly ?
- Compilation: Le code source écrit dans des langages comme C/C++ ou Rust est compilé en WASM.
- Intégration Web: Le module WASM est chargé et exécuté dans le navigateur, souvent en conjonction avec JavaScript
- Interopérabilité: Interaction entre WASM et JavaScript pour manipuler le DOM, effectuer des appels réseau, etc
---


# DEMO

---

# Limitations
- Interopérabilité avec JavaScript: Coûts de performance potentiels lors des interactions entre WASM et JS
- Complexité de débogage: Outils de débogage moins matures par rapport à JavaScript
- Taille du fichier: Les modules WASM peuvent être plus volumineux que le code JavaScript équivalent

---

# L'avenir de WebAssembly
- Évolution des standards: Nouvelles propositions pour étendre les capacités de WASM (ex. : accès direct au DOM)
- Adoption croissante: Utilisation dans des domaines autres que le web, comme le cloud computing et les applications mobiles
- Communauté et support: Croissance de la communauté des développeurs et amélioration continue des outils de développement

---

# Merci bisou
