---
marp: true
title: 'Migration vers Kubernetes'
author: julian@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
class: top
---
![bg right:33%](https://images.pexels.com/photos/3009205/pexels-photo-3009205.jpeg)
# Migration vers Kubernetes
---
# Problèmes à mon arrivée
- Environnement de dev non iso
- Difficultés à scaler
- Mise en production manuel
---
# Travail accompli
- Uniformisation des environnements locaux grâce à la conteneurisation des projets avec Docker/Docker Compose
- Amélioration de super-uploader-bundle afin de le rendre "cloud compatible"
- Migration vers AWS/Kubernetes
- Création de pipelines CI/CD
---
# Ce qui change pour vous
- Vous devenez maître des mises en production
- Vous avez la main sur l'environnement de vos applications (cronjobs, secrets, etc)
---
# Services utilisés
- Terraform (Infrastructure as Code)
- AWS EKS (Kubernetes managé par AWS)
- AWS DynamoDB (DB clé/valeur utilisés pour les sessions)
- Datadog
- AWS EFS (Elastic File System)
- ArgoCD
---
# Kubernetes, késako ?
- Orchestrateur de conteneurs
- Scalable
---
# Documentations
- [🏗️ Mise en production](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93)
- [⏰ Ajout de tâche crons](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93)
- [🤐 Secrets](https://www.notion.so/santeacademie/Secrets-fb77ad51dc4d47dd9d94a1cd57f073c0)
- Kubernetes (plus technique)
  - [🐙 Argo CD](https://www.notion.so/santeacademie/Argo-CD-0000c8ba96364596b38e8162375a14c1)
  - [🤐 Namespaces](https://www.notion.so/santeacademie/Namespaces-1ae35cc9fe124a6f91b8cbe67e619c03)

---
# Démo: mise en production
[Documentation notion](https://www.notion.so/santeacademie/Mise-en-production-46c62108a5dd4b09a51671b99413af93?pvs=4)
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
<!-- _class: invert flat pink center -->
<!-- _footer: '' -->
<style scoped>section{text-align:center;}</style>

![height:300px](https://i.imgur.com/CVAWdaB.gif)
