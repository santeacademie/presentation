---
marp: true
title: 'Migration vers Kubernetes'
author: julian@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
class: top teal
---
<!-- _class: teal invert -->
![bg right:33%](https://wallpapercave.com/wp/wp10034196.png)
# Migration vers Kubernetes
---
<style scoped>figure {margin-right: 30px !important}</style>
![bg right:33% height:200px](https://i.pinimg.com/originals/10/7a/97/107a97ca5bd4a571edcebec54a66fc32.jpg)
# Problèmes à mon arrivée
- Environnement de dev non iso
- Difficultés à scaler
- Mise en production manuelle
---
# Travail accompli
- Uniformisation des environnements locaux grâce à la conteneurisation des projets avec Docker/Docker Compose
- Amélioration de super-uploader-bundle afin de le rendre "cloud compatible"
- Migration vers AWS/Kubernetes
- Création de pipelines CI/CD
---
# Ce qui change pour vous
<!-- _class: invert top amber -->
- Vous devenez maître des mises en production
- Vous avez la main sur l'environnement de vos applications (cronjobs, secrets, etc)
---
# Services utilisés
<!-- _class: invert top teal -->
* Terraform (Infrastructure as Code)
* AWS EKS (Kubernetes managé par AWS)
* AWS DynamoDB (DB clé/valeur utilisés pour les sessions)
* Datadog
* AWS EFS (Elastic File System)
* ArgoCD
---
<style scoped>figure {margin-right: 30px !important}</style>
![bg right:33% height:200px](https://res.cloudinary.com/daily-now/image/upload/f_auto,q_auto/v1/posts/0ce6c20931116356d81d8f6876b660ab)
# Kubernetes, késako ?
* Orchestrateur de conteneurs
* Scalable
* Cool
* Trop bien
* Ça tue
---
# Documentations
- Développement
  - [🏗️ Mise en production](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93)
  - [⏰ Ajout de tâches CRON](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93)
  - [🤐 Secrets](https://www.notion.so/santeacademie/Secrets-fb77ad51dc4d47dd9d94a1cd57f073c0)

- Kubernetes (plus technique)
  - [🐙 Argo CD](https://www.notion.so/santeacademie/Argo-CD-0000c8ba96364596b38e8162375a14c1)
  - [📦 Namespaces](https://www.notion.so/santeacademie/Namespaces-1ae35cc9fe124a6f91b8cbe67e619c03)

---
# Démo: mise en production

- [Voir la documentation notion...](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93?pvs=4)
<style scoped>
a {
  color: rgb(255, 255, 255, 60%);
}
</style>
---
# Et après (en 2024) ?
- Monitoring
- Observabilité (APM/Tracing)
- Staging
- Stager

---
<!-- _class: invert flat teal center -->
<!-- _footer: '' -->
<style scoped>section{text-align:center;}</style>

![height:300px](https://media.tenor.com/tvtnW8BmD-YAAAAC/k8s-kubernetes.gif)
