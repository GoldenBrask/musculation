# musculation
C'est une tentative d'application web pour suivre ma progression a la muscu en php

## Système d'authentification

L'application dispose maintenant d'un système simple d'inscription et de connexion.
Les utilisateurs peuvent s'enregistrer via `/register`, se connecter via `/login`
et se déconnecter via `/logout`.

Les mots de passe sont chiffrés en base de données via `password_hash`.

Toutes les pages (hors inscription et connexion) nécessitent désormais d'être connecté. Les exercices et les performances sont enregistrés pour chaque utilisateur.
