# musculation
C'est une tentative d'application web pour suivre ma progression a la muscu en php

## Système d'authentification

L'application dispose maintenant d'un système simple d'inscription et de connexion.
Les utilisateurs créent un compte avec une adresse email, un nom d'utilisateur et un mot de passe.
La connexion se fait uniquement avec le nom d'utilisateur via `/login`. L'inscription s'effectue via `/register`,
et il est possible de se déconnecter via `/logout`.

Les mots de passe sont chiffrés en base de données via `password_hash`.

Toutes les pages (hors inscription et connexion) nécessitent désormais d'être connecté. Les exercices et les performances sont enregistrés pour chaque utilisateur.
