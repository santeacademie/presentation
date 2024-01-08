---
marp: true
title: 'Les migrations avec Doctrine'
author: daoui@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
class: top teal

---
<!-- _class: teal invert -->
![bg right:30%](https://wallpapercave.com/wp/wp1922450.jpg)

# Les migrations avec Doctrine

##### "DoctrineMigrationsBundle"
---
<style scoped>figure {margin-right: 30px !important}</style>

# Qu'est-ce que Doctrine:
- Introduction à Doctrine
- Eloquent (Laravel), Hibernate (Java), Sequelize(NodeJs)
- Qu'est-ce que les Migrations Doctrine 
<!--
Doctrine est un ensemble d'outils de mappage objet-relationnel (ORM) et de base de données pour PHP. C'est l'un des ORM les plus populaires dans l'écosystème PHP, et il est particulièrement connu pour son intégration avec le framework Symfony, bien qu'il puisse être utilisé avec d'autres frameworks ou même sans framework du tout. Voici les aspects fondamentaux de Doctrine .
Migration doctrine : C'est un outil pour gérer les modifications de schéma de base de données de manière programmée et versionnée.
-->

---
# Avantages des Migrations Doctrine:
- Synchronisation des environnements de dev, de staging et de production
- Réduction des erreurs humains
- Avoir l'historique des changements
- De la revue entre les développeurs
- Pouvoir annuler des changements 
- Quand notre schema diffère il génère tous les up's et down's nécessaires
---
#  STOP doctrine:schema:update et Update directement sur l'env de prod
- Aucun historique sur les modifications apportées
- Peut pas annuler les modifications
---
# Démonstration:
---
# Question:
