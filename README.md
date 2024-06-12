# Projet de site pour MavrylArt

## Présentation du projet

Ce projet est un site web pour l'artiste MavrylArt. Cette artiste crée des dessins, aquarelles et autres peintures, que ce soit sur commande ou non. Elle s'inspire notamment de la nature et des animaux.
Elle avait besoin d'un site web afin de pouvoir exposer ses oeuvres sur internet, et ainsi, gagner en visibilité.

Ses autres besoins pour ce site était de pouvoir elle même gérer sa galerie d'images, ainsi que pouvoir recevoir des messages et/ou demande de la part de ses clients, et avoir un endroit pour consulter les messages reçus afin de pouvoir leur répondre par email.

## Guide de déploiement de l'application avec Docker

Ce guide explique comment déployer l'application en utilisant Docker et Docker Compose. Docker est une plateforme logicielle qui simplifie le déploiement et la gestion d'applications dans des conteneurs logiciels. Docker Compose est un outil permettant de définir et de gérer des applications multi-conteneurs.

Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

* Docker : Instructions d'installation
* Docker Compose : Instructions d'installation
  
### Déploiement de l'application

1. Clonez le dépôt Git de l'application :

```bash
git clone https://github.com/CyrilleDeletre/mavrylArts-project.git
```
2. Accédez au répertoire de l'application :

```bash
cd mavrylArts-project
```

3. Ouvrir Docker et VSCode

4. Dans VSCode, ouvrir un Terminal et démarrez les conteneurs de l'application à l'aide de Docker Compose :

```bash
docker-compose up -d
```

5. Accédez à votre application dans un navigateur web en utilisant l'URL :

```arduino
http://localhost:8851
```

### Arrêt et nettoyage
Pour arrêter les conteneurs Docker et nettoyer les ressources associées, utilisez la commande suivante :

```bash
docker-compose down
```

Cela arrêtera et supprimera les conteneurs, les réseaux et les volumes créés par Docker Compose.
