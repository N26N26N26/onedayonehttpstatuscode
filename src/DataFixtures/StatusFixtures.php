<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{

    const STATUS = [
        ['Code' => 100, 'Message' => "Continue", 'Signification' => "Attente de la suite de la requête."],
        ['Code' => 101, 'Message' => "Switching Protocols", 'Signification' => "Acceptation du changement de protocole."],
        ['Code' => 102, 'Message' => "Processing", 'Signification' => "WebDAV RFC 25183,4: Traitement en cours (évite que le client dépasse le temps d’attente limite)."],
        ['Code' => 103, 'Message' => "Early Hints", 'Signification' => "RFC 82975 : (Expérimental) Dans l'attente de la réponse définitive, le serveur retourne des liens que le client peut commencer à télécharger."],
        ['Code' => 200, 'Message' => "OK", 'Signification' => "Requête traitée avec succès. La réponse dépendra de la méthode de requête utilisée."],
        ['Code' => 201, 'Message' => "Created", 'Signification' => "Requête traitée avec succès et création d’un document."],
        ['Code' => 202, 'Message' => "Accepted", 'Signification' => "Requête traitée, mais sans garantie de résultat."],
        ['Code' => 203, 'Message' => "Non-Authoritative Information	", 'Signification' => "Information retournée, mais générée par une source non certifiée."],
        ['Code' => 204, 'Message' => "No Content", 'Signification' => "Requête traitée avec succès mais pas d’information à renvoyer."],
        ['Code' => 205, 'Message' => "Reset Content", 'Signification' => "Requête traitée avec succès, la page courante peut être effacée."],
        ['Code' => 206, 'Message' => "Partial Content", 'Signification' => "Une partie seulement de la ressource a été transmise."],
        ['Code' => 207, 'Message' => "Multi-Status", 'Signification' => "WebDAV : Réponse multiple."],
        ['Code' => 208, 'Message' => "Already Reported", 'Signification' => "WebDAV : Le document a été envoyé précédemment dans cette collection."],
        ['Code' => 210, 'Message' => "Content Different", 'Signification' => "WebDAV : La copie de la ressource côté client diffère de celle du serveur (contenu ou propriétés)."],
        ['Code' => 226, 'Message' => "IM Used", 'Signification' => "RFC 32296 : Le serveur a accompli la requête pour la ressource, et la réponse est une représentation du résultat d'une ou plusieurs manipulations d'instances appliquées à l'instance actuelle."],
        ['Code' => 300, 'Message' => "Multiple Choices", 'Signification' => "L’URI demandée se rapporte à plusieurs ressources."],
        ['Code' => 301, 'Message' => "Moved Permanently", 'Signification' => "Document déplacé de façon permanente."],
        ['Code' => 302, 'Message' => "Found", 'Signification' => "	Document déplacé de façon temporaire."],
        ['Code' => 303, 'Message' => "See Other", 'Signification' => "La réponse à cette requête est ailleurs."],
        ['Code' => 304, 'Message' => "Not Modified", 'Signification' => "Document non modifié depuis la dernière requête."],
        ['Code' => 305, 'Message' => "Use Proxy (depuis HTTP/1.1)", 'Signification' => "La requête doit être ré-adressée au proxy."],
        ['Code' => 306, 'Message' => "Switch Proxy", 'Signification' => "Code utilisé par une ancienne version de la RFC 26167, à présent réservé. Elle signifiait « Les requêtes suivantes doivent utiliser le proxy spécifié »."],
        ['Code' => 307, 'Message' => "Temporary Redirect", 'Signification' => "La requête doit être redirigée temporairement vers l’URI spécifiée."],
        ['Code' => 308, 'Message' => "Permanent Redirect", 'Signification' => "La requête doit être redirigée définitivement vers l’URI spécifiée."],
        ['Code' => 310, 'Message' => "Too many Redirects", 'Signification' => "La requête doit être redirigée de trop nombreuses fois, ou est victime d’une boucle de redirection."],
        ['Code' => 400, 'Message' => "Bad Request", 'Signification' => "La syntaxe de la requête est erronée."],
        ['Code' => 401, 'Message' => "Unauthorized	", 'Signification' => "Une authentification est nécessaire pour accéder à la ressource."],
        ['Code' => 402, 'Message' => "Payment Required", 'Signification' => "Paiement requis pour accéder à la ressource."],
        ['Code' => 403, 'Message' => "Forbidden", 'Signification' => "Le serveur a compris la requête, mais refuse de l'exécuter. Contrairement à l'erreur 401, s'authentifier ne fera aucune différence. Sur les serveurs où l'authentification est requise, cela signifie généralement que l'authentification a été acceptée mais que les droits d'accès ne permettent pas au client d'accéder à la ressource."],
        ['Code' => 404, 'Message' => "Not Found", 'Signification' => "Ressource non trouvée."],
        ['Code' => 405, 'Message' => "Method Not Allowed", 'Signification' => "Méthode de requête non autorisée."],
        ['Code' => 406, 'Message' => "Not Acceptable", 'Signification' => "La ressource demandée n'est pas disponible dans un format qui respecterait les en-têtes « Accept » de la requête."],
        ['Code' => 407, 'Message' => "Proxy Authentication Required", 'Signification' => "Accès à la ressource autorisé par identification avec le proxy."],
        ['Code' => 408, 'Message' => "Request Time-out", 'Signification' => "Temps d’attente d’une requête du client, écoulé côté serveur. D'après les spécifications HTTP : « Le client n'a pas produit de requête dans le délai que le serveur était prêt à attendre. Le client PEUT répéter la demande sans modifications à tout moment ultérieur »."],
        ['Code' => 409, 'Message' => "Conflict", 'Signification' => "La requête ne peut être traitée en l’état actuel."],
        ['Code' => 410, 'Message' => "Gone", 'Signification' => "La ressource n'est plus disponible et aucune adresse de redirection n’est connue."],
        ['Code' => 411, 'Message' => "Length Required", 'Signification' => "La longueur de la requête n’a pas été précisée."],
        ['Code' => 412, 'Message' => "Precondition Failed", 'Signification' => "Préconditions envoyées par la requête non vérifiées."],
        ['Code' => 413, 'Message' => "Request Entity Too Large	", 'Signification' => "Traitement abandonné dû à une requête trop importante."],
        ['Code' => 414, 'Message' => "Request-URI Too Long", 'Signification' => "URI trop longue."],
        ['Code' => 415, 'Message' => "Unsupported Media Type", 'Signification' => "Format de requête non supporté pour une méthode et une ressource données."],
        ['Code' => 416, 'Message' => "Requested range unsatisfiable", 'Signification' => "Champs d’en-tête de requête « range » incorrect."],
        ['Code' => 417, 'Message' => "Expectation failed", 'Signification' => "Comportement attendu et défini dans l’en-tête de la requête insatisfaisante."],
        ['Code' => 418, 'Message' => "I’m a teapot", 'Signification' => "« Je suis une théière » : Ce code est défini dans la RFC 2324 datée du 1er avril 1998, Hyper Text Coffee Pot Control Protocol."],
        ['Code' => 421, 'Message' => "Bad mapping / Misdirected Request", 'Signification' => "La requête a été envoyée à un serveur qui n'est pas capable de produire une réponse (par exemple, car une connexion a été réutilisée)."],
        ['Code' => 422, 'Message' => "Unprocessable entity", 'Signification' => "WebDAV : L’entité fournie avec la requête est incompréhensible ou incomplète."],
        ['Code' => 423, 'Message' => "Locked", 'Signification' => "WebDAV : L’opération ne peut avoir lieu car la ressource est verrouillée."],
        ['Code' => 424, 'Message' => "Method failure", 'Signification' => "WebDAV : Une méthode de la transaction a échoué."],
        ['Code' => 425, 'Message' => "Too Early", 'Signification' => "RFC 8470 : le serveur ne peut traiter la demande car elle risque d'être rejouée."],
        ['Code' => 426, 'Message' => "Upgrade Required", 'Signification' => "RFC 2817 : Le client devrait changer de protocole, par exemple au profit de TLS/1.0."],
        ['Code' => 428, 'Message' => "Precondition Required	", 'Signification' => "RFC 6585 : La requête doit être conditionnelle."],
        ['Code' => 429, 'Message' => "Too Many Requests	", 'Signification' => "RFC 6585 : le client a émis trop de requêtes dans un délai donné."],
        ['Code' => 431, 'Message' => "Request Header Fields Too Large	", 'Signification' => "RFC 6585 : Les entêtes HTTP émises dépassent la taille maximale admise par le serveur."],
        ['Code' => 449, 'Message' => "Retry With", 'Signification' => "Code défini par Microsoft. La requête devrait être renvoyée après avoir effectué une action."],
        ['Code' => 450, 'Message' => "Blocked by Windows Parental Controls", 'Signification' => "Code défini par Microsoft. Cette erreur est produite lorsque les outils de contrôle parental de Windows sont activés et bloquent l’accès à la page."],
        ['Code' => 451, 'Message' => "Unavailable For Legal Reasons", 'Signification' => "Ce code d'erreur indique que la ressource demandée est inaccessible pour des raisons d'ordre légal."],
        ['Code' => 456, 'Message' => "Unrecoverable Error", 'Signification' => "WebDAV : Erreur irrécupérable."],
        ['Code' => 444, 'Message' => "No Response", 'Signification' => "Indique que le serveur n'a retourné aucune information vers le client et a fermé la connexion. Visible seulement dans les journaux du serveur Nginx."],
        ['Code' => 495, 'Message' => "SSL Certificate Error", 'Signification' => "Une extension de l'erreur 400 Bad Request, utilisée lorsque le client a fourni un certificat invalide."],
        ['Code' => 496, 'Message' => "SSL Certificate Required", 'Signification' => "Une extension de l'erreur 400 Bad Request, utilisée lorsqu'un certificat client requis n'est pas fourni."],
        ['Code' => 497, 'Message' => "HTTP Request Sent to HTTPS Port", 'Signification' => "Une extension de l'erreur 400 Bad Request, utilisée lorsque le client envoie une requête HTTP vers le port 443 normalement destiné aux requêtes HTTPS."],
        ['Code' => 498, 'Message' => "Token expired/invalid", 'Signification' => "Le jeton a expiré ou est invalide."],
        ['Code' => 499, 'Message' => "Client Closed Request", 'Signification' => "Le client a fermé la connexion avant de recevoir la réponse. Cette erreur se produit quand le traitement est trop long côté serveur."],
        ['Code' => 500, 'Message' => "Internal Server Error", 'Signification' => "Erreur interne du serveur."],
        ['Code' => 501, 'Message' => "Not Implemented", 'Signification' => "Fonctionnalité réclamée non supportée par le serveur."],
        ['Code' => 502, 'Message' => "Bad Gateway ou Proxy Error", 'Signification' => "En agissant en tant que serveur proxy ou passerelle, le serveur a reçu une réponse invalide depuis le serveur distant."],
        ['Code' => 503, 'Message' => "Service Unavailable", 'Signification' => "Service temporairement indisponible ou en maintenance."],
        ['Code' => 504, 'Message' => "Gateway Time-out", 'Signification' => "Temps d’attente d’une réponse d’un serveur à un serveur intermédiaire écoulé."],
        ['Code' => 505, 'Message' => "HTTP Version not supported", 'Signification' => "Version HTTP non gérée par le serveur."],
        ['Code' => 506, 'Message' => "Variant Also Negotiates", 'Signification' => "RFC 2295 : Erreur de négociation. Transparent content negociation."],
        ['Code' => 507, 'Message' => "Insufficient storage", 'Signification' => "WebDAV : Espace insuffisant pour modifier les propriétés ou construire la collection."],
        ['Code' => 508, 'Message' => "Loop detected", 'Signification' => "WebDAV : Boucle dans une mise en relation de ressources (RFC 5842)."],
        ['Code' => 509, 'Message' => "Bandwidth Limit Exceeded", 'Signification' => "Utilisé par de nombreux serveurs pour indiquer un dépassement de quota."],
        ['Code' => 510, 'Message' => "Not extended", 'Signification' => "RFC 2774 : La requête ne respecte pas la politique d'accès aux ressources HTTP étendues."],
        ['Code' => 511, 'Message' => "Network authentication required", 'Signification' => "RFC 6585 : Le client doit s'authentifier pour accéder au réseau. Utilisé par les portails captifs pour rediriger les clients vers la page d'authentification."],
        ['Code' => 520, 'Message' => "Unknown Error	", 'Signification' => "L'erreur 520 est utilisé en tant que réponse générique lorsque le serveur d'origine retourne un résultat imprévu."],
        ['Code' => 521, 'Message' => "Web Server Is Down", 'Signification' => "Le serveur a refusé la connexion depuis Cloudflare."],
        ['Code' => 522, 'Message' => "Connection Timed Out", 'Signification' => "Cloudflare n'a pas pu négocier un TCP handshake avec le serveur d'origine."],
        ['Code' => 523, 'Message' => "Origin Is Unreachable", 'Signification' => "Cloudflare n'a pas réussi à joindre le serveur d'origine. Cela peut se produire en cas d'échec de résolution de nom de serveur DNS."],
        ['Code' => 524, 'Message' => "A Timeout Occurred", 'Signification' => "Cloudflare a établi une connexion TCP avec le serveur d'origine mais n'a pas reçu de réponse HTTP avant l'expiration du délai de connexion."],
        ['Code' => 525, 'Message' => "SSL Handshake Failed", 'Signification' => "Cloudflare n'a pas pu négocier un SSL/TLS handshake avec le serveur d'origine."],
        ['Code' => 526, 'Message' => "Invalid SSL Certificate", 'Signification' => "Cloudflare n'a pas pu valider le certificat SSL présenté par le serveur d'origine."],
        ['Code' => 537, 'Message' => "Railgun Error", 'Signification' => "L'erreur 527 indique que la requête a dépassé le délai de connexion ou a échoué après que la connexion WAN a été établie."],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STATUS as $oneStatus) {
            $status = new Status();
            $status->setCode($oneStatus['Code']);
            $status->setMessage($oneStatus['Message']);
            $status->setSignification($oneStatus['Signification']);
            $manager->persist($status);
        }

        $manager->flush();
    }
}
