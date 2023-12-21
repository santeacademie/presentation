---
marp: true
title: 'Symfony Messenger Bundle'
author: enzo@santeacademie.com
paginate: true
theme: santeacademie
header: '![height:30px](https://sante.ac/logo-white-label)'
footer: '**Composant Messenger**'

---
<!-- _paginate: skip -->
<!-- _footer: '' -->
<!-- _class: invert top -->


![bg right:33%](https://images.pexels.com/photos/3009205/pexels-photo-3009205.jpeg)

# Symfony Messenger

##### Sommaire

- C'est quoi ce truc ?
- Quand et pourquoi ?
- Un exemple concret.
- Les points négatifs.

---
<!-- _class: invert top -->

# C'est quoi ?

Messenger donne la possibilité d'envoyer des messages, puis de les gérer immédiatement dans votre application ou
de les placer dans une files d'attente pour être traités plus tard de manière synchrone ou asynchrone grâce à un worker.

<br>
<br>

C'est à dire ? ![height:30px](https://emoji.slack-edge.com/T0CM9EXRP/c-est-a-dire/77adb12cf4c86d71.png)

---
<!--
Asynchrone : 
    - Dispatch du message dans le bus
    - Un Worker va le chercher dans la file d'attente le message (grâce Redis par exemple)
    - Re dispatch dans le bus
    - Récupération par un handler

Synchrone:
    - Dispatch dans le bus
    - récupérer par le handler

-->

# Fonctionnement

![](https://jolicode.com/media/cache/content/media/original/2018/04/messenger.webp)

<style scoped>section{text-align:center;} header img {width: 100%} section img {width: 60%}</style>
---
<!--
- Les tests: facile de tester tous les composants de façon isolé (Handler, Middleware, ...)
-->
# Pourquoi messenger ?
- Reduction du temps d'attente pour l'utilisateur lors de longs traitements
- Gestion asynchrone
- Découpage des composants
- Facilité de testabilité
- Dechargement vers les workers via les transports (Redis, RabbitMQ, Doctrine, ...)

---
# Quand utiliser messenger ?
- Upload en masse
- Envoie de mail
- Tout autre traitement long

---

<!--
- Exemple formulaire basique
- Exemple formulaire avec messenger
- Exemple avec serializer JSON
- Serializer déjà existant : https://symfony.com/doc/current/messenger.html#serializing-messages
- Les Stamps
- Les Middleware
- Les Buses
-->

# Passons à la pratique


![](https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExOHhnNGU3amZyYW8xZ3A4emJ3eGJuMDNkajBoaGZuMm5mb2duaGw4ZCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/1UFvC3MSb3BMKO0ENv/giphy.gif)
<style scoped>section{text-align:center;} header img {width: 100%} section img {width: 60%}</style>

---
<!--
Utile pour si on veut par exemple pour certains bus effectuer des actions avant ou après le dispatch du message
-->
# Multiple bus et middleware

```yaml
    messenger:
        buses:
            doctrine_bus:
                middleware:
                  - doctrine_ping_connection
                  - doctrine_close_connection

```
---
<!--
Redis : Gère mal la concurrence de connexion
RabbitMQ : Gère bien la concurrence de connexion
-->
# Les points négatifs

- Concurrence de connexion par les workers (RabitMQ ou Redis ou Doctrine ?)
- Compliquer à débugger
- Asynchrone != rapide
- Gestion non spontanée des erreurs

---
# Des questions ?

