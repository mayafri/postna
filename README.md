# Postna : un CMS en PHP et MySQL

![](https://raw.githubusercontent.com/hyakosm/postna/master/postna.png)

**Ce projet, bien que fonctionnel, est devenu une usine à gaz difficile à maintenir. Je l'ai développé il y a quelques années, avant d'entrer à l'IUT de Lyon. Je ne suis pas certain de la sécurité de ce CMS, merci de ne pas l'utiliser. Il existe aussi plein d'autres CMS sur lesquels il vaut mieux se rabattre.**

Postna est un petit système de gestion de contenu écrit en PHP, il est pour le moment conçu pour le système de base de données MariaDB (ou compatible). À l'origine développé pour des besoins particuliers du site d'un de mes frères, j'en ai fait un projet plus général et ouvert. La première version publique n'est pas sortie encore, j'ai toujours quelques trucs à arranger. Il ne reste plus grand chose, mais il me faut le temps de m'y pencher...

## Fonctionnalités

    Édition de billets en texte formaté
    Possibilité d'enregistrer un billet sans le publier

    Classement par catégories imbriquées
    Entêtes de catégories
    Étiquettes (tags)

    Gestion des commentaires imbriqués
    Gestion de la validation des commentaires
    Traitement des commentaires par lot

    Multi-utilisateurs avec gestion des permissions
    Gestion des thèmes
    Navigateur de fichiers
    Moteur de recherche pour le visiteur

## Billets et catégories

Les billets sont classés obligatoirement dans une catégorie. Les catégories peuvent être imbriquées dans d'autres catégories ou être placées à la racine du site. Chaque catégorie a des propriétés spécifiques, notamment le « mode vitrine » qui désactive les commentaires pour la catégorie entière, ou encore un entête, qui apparaitra sur l'espace visiteur et dont l'intérêt est de décrire la partie du site concernée. Une catégorie spéciale existe : c'est la catégorie Brouillon, c'est la seule catégorie est totalement invisible aux yeux du visiteur. Dans l'espace administrateur, on peut attribuer à chaque catégorie une couleur, qui ne sera pas visible publiquement, il s'agit simplement d'une aide visuelle au classement, à l'image des labels Mac OS.

Pour le visiteur, les catégories racine apparaissent dans le menu principal, et les sous-catégories apparaissent dans un men u latéral dédié. Cette configuration sera personnaliable avec un autre type de menu dynamique. Si une catégorie ne contient aucun billet, alors seront affichés par ordre antichronologique tous les billets de toutes les catégories enfant, récursivement. Ainsi, on peut par exemple créer une espace blog, avec une grande catégorie « Blog » toute vide dans laquelle on crée des catégories thématiques. Si le visiteur accède à une catégorie en particulier, il ne verra que les billets correspondant ; mais s'il accède à la catégorie « Blog » vide de billets, eh bien il verra les derniers billets postés dans n'importe quelle sous-catégorie, et peut donc se tenir informé des nouveautés.

Par défaut, les catégories s'affichent par ordre alphabétique mais il est possible de faire un classement manuel.

Un billet peut contenir du texte formaté, des images, du contenu multimédia et tout autres choses permises par le langage HTML. À un billet est associé un auteur, qui peut choisir des co-auteurs : ces derniers auront le droit de participer à l'édition du billet si leurs droits originaux ne leur permettait pas (voir la gestion des droits, plus bas). On peut attacher à un billet des étiquettes (tags). Le visiteur verra chaque étiquette comme un lien cliquable qui lui permettra de voir les autres billets postés avec la même étiquette. Enfin, on peut choisir de désactiver la mise en ligne d'un billet : il est alors stocké dans la base de données et visible dans l'espace d'administation sans toutefois l'être pour les visiteurs.

Actuellement, l'éditeur de texte WYSIWYG est CKEditor, je suis en train de m'occuper de l'implémentation de deux éditeurs natifs : un éditeur en Markdown et un autre en HTML, je ne prévois pas de les rendre WYSIWYG.
Commentaires

Si la configuration l'autorise et si la catégorie n'est pas en mode vitrine, alors un visiteur peut poster un commentaire sur le site. Les commentaires peuvent s'imbriquer : les visiteurs peuvent se répondre entre eux. Selon la configuration choisie, la publication peut être immédiate ou en attente d'une validation, dans ce dernier cas, une notification apparaitra dans l'espace d'administration. Il est possible de valider un commentaire en particulier, de valider tous les commentaires en attente pour un billet en particulier, ou pour tous les billets (sur lesquels on a les droits, bien entendu).

La suppression des commentaires peut aussi se faire distinctement pour : un commentaire en particulier, tous les commentaires d'un billet, tous les commentaires non validés d'un billet, ou tous les commentaires non validés sur tout le blog accessible (c'est à dire pour les billets dont on dispose des droits).
Navigateur de fichiers

Le navigateur de fichiers permet de mettre en ligne tous types de fichiers, à l'exception des fichiers potentiellement dangereux pour la sécurité du serveur (vérification par type MIME et extension), et bien-sûr dans la mesure de la limite de taille définie par le serveur.

Les fichiers d'image aux formats les plus répandus bénéficient de miniatures pour les distinguer facilement. Il est possible d'effectuer toutes les opérations les plus courantes sur les fichiers et les dossiers : la suppression (définitive), le déplacement, la copie, le renommage, ou le téléchargement (pour les fichiers uniquement).

Pour l'éditeur de billets, une version miniaturisée en popup du navigateur de fichiers apparait pour l'insertion facile d'éléments. L'intégration avec CKEditor est assurée.
Moteur de recherche

Le moteur de recherche interne permet au visiteur de retrouver un billet en fonction de mots clés qui sont recherchés dans le titre et le contenu. On peut rentrer des mots séparés par des espaces, mais aussi des expressions définies par des guillements. Les mots et les expressions peuvent être précédées du signe moins pour les exclure des résultats de recherche.
Utilisateurs et permissions

Postna est pensé pour être utilisé par plusieurs utilisateurs, avec une gestion des droits en conséquence. L'utilisateur principal est l'administrateur : il a tous les droits courants, ainsi que la possibilité exclusive de gérer les droits des autres utilisateurs, en créer ou en supprimer un.

Chaque utilisateur se distingue par un identifiant (nécessaire pour la connexion), un nom (qui apparaîtra sur les billets publiés), ainsi qu'une adresse e-mail qui sert pour réinitialiser un mot de passe en cas de perte (l'administrateur n'a pas ce pouvoir).

Les droits sont les suivants :

    Droit de se connecter (pour bannir un utilisateur)
    Droit d'accéder à la page de configuration
    Profil étendu (possibilité de modifier son identifiant et son nom)
    Droits sur les fichiers (aucun / lecture seule / lecture et écriture)
    Droits de catégories (accès total / accès limité)
    Droits de billets (accès total / accès personnel)

Par défaut, il n'est possible d'éditer que ses propres billets, ou les billets pour lesquels on a été désigné co-auteur ; note que dans le dernier cas il est impossible de déplacer le billet, de modifier l'auteur original ou ses camarades co-auteurs. Avec l'accès total aux billets, on peut modifier complètement tous les billets du site. Si l'on est auteur d'un billet, on peut aussi désigner un autre auteur, c'est à dire le donner : dans ce cas, le billet sera en attente de publication pour le nouvel auteur qui recevra une notification.

Pour créer un nouveau billet, il faut avoir l'accès total sur les catégories (on peut alors écrire n'importe où dans le site) ou une autorisation en écriture pour une ou plusieurs catégories individuelles. Ces autorisations en écriture peuvent être données par n'importe quel utilisateur possédant l'accès total sur les catégories.

Pour modifier les propriétés d'une catégorie ou classer son contenu, il faut avoir les droits nécessaires. Les autorisations en écriture ne valent que pour les billets.
Technique

Postna a un fonctionnement modulaire, inspiré par le principe MVC (modèle-vue-contrôleur). L'interface visiteur est séparée de l'interface d'administration, et les deux communiquent avec la base de données (en lecture ou en écriture) à travers une bibliothèque. En remplaçant la bibliothèque par une autre (qui n'existe pas encore), on peut donc changer de SGBD en toute transparence par exemple.

![](https://raw.githubusercontent.com/hyakosm/postna/master/hierarchie.png)

![](https://raw.githubusercontent.com/hyakosm/postna/master/schema.png)

