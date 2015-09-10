
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Mvondo- Espace Tech</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="dashboard.css"/>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project Mvondo - Espace Technique</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Get started</a></li>
                        <li><a href="./documents/" target="_blank">Specs</a></li>
                        <li><a href="./sqldesigner/index.html" target="_blank">SQL Designer</a></li>
                        <li><a href="./maquettes/" target="_blank">Maquettes</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                        <li><a href="#install">Installation du projet</a></li>
                        <li><a href="#symfony">Commandes Symfony II</a></li>
                        <li><a href="http://tilap.net/gitliste-des-commandes-a-connaitre/" target="_blank">Tuto rapide Git</a></li>
                        <li><a href="./detube/" target="_blank">Fichiers du thème</a></li>
                        <li><a href="./arch/symfony.html" target="_blank">Architechture du projet</a></li>
                        <li><a href="./arch/bdd.html" target="_blank">Architechture base de données</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Get started</h1>
                    <p>
                        Ce document présente les inos nécessaire pour la montée rapide sur le projet
                        Mvondo. Il sera mis à jour au fur et à mésure par les différents membres de l'équipe Tech.
                    </p>
                    <div class="alert alert-warning">
                        <strong>SQLdesigner!</strong> Cet outil permet de contruire le schéma E-R d'une base de données.
                        Pour le projet, vous pouvez récupérer le schéma qui est disponible dans le fichier /doc/schema_bdd.xml et l'importer dans l'outil.
                    </div>
                    <div>
                        <h2 id="install" class="sub-header">Installation du projet</h2>
                        <div>
                            <ol>
                                <li>Installer <a href="https://git-scm.com/book/fr/v1/D%C3%A9marrage-rapide-Installation-de-Git">GIT</a> sur la machine si cela n'est pas encore le cas</li>
                                <li>Ouvrir le terminal ou l'Invite de commande depuis Windows et se placer dans le repertoire ou le projet doit être installer</li>
                                <li>lancer les commandes suivantes:
                                    <ul>
                                        <li>Récupération des sources du projet
                                            <pre>git clone https://github.com/fuosseuf/mvondo.git</pre>                                          
                                        </li>
                                        <li>Télécharger Composer
                                            <pre>curl -s http://getcomposer.org/installer | php</pre>
                                        </li>
                                        <li>Mettre à jours les librairies via le composer
                                            <pre>php composer.phar install</pre>
                                        </li>
                                        <li>Modifier les droits des repertoires de cache
                                            <pre>
rm -rf app/cache/*
rm -rf app/logs/*

sudo chmod -R 777 app/cache/*
sudo chmod -R 777 app/logs/*
                                            </pre>
                                        </li>
                                    </ul>
                                </li>
                                <li>Configurer le projet depuis le navigateur via le lien 
                                    <pre>http://localhost/path_repertoire_projet/config.php</pre>
                                </li>
                                <li>Créer les tables de la base de données
                                    <pre>php app/console doctrine:schema:update --force</pre>
                                </li>
                            </ol>
                        </div>
                        <br><br>
                        <h2 id="symfony" class="sub-header"> Commandes Utiles Symfony</h2>
                        <div>
                            <p>Création d'un bundle :</p>
                            <pre>php app/console generate:bundle</pre>
                            <p>Génération des entités :</p>
                            <pre>php app/console doctrine:generate:entities MyApp</pre>
                            <p>Création de la base de donnée :</p>
                            <pre>php app/console doctrine:database:create</pre>
                            <p>Création des tables :</p>
                            <pre>php app/console doctrine:schema:create</pre>
                            <p>Mettre à jour les tables :</p>
                            <pre>php app/console doctrine:schema:update --force</pre>
                            <p>Mettre à jour les CSS, JS et images :</p>
                            <pre>php app/console assets:install web</pre>
                            <p>Vider le cache :</p>
                            <pre>php app/console cache:clear</pre>
                            <p>Création d&rsquo;un utilisateur pour FOSUserBundle :</p>
                            <pre>php app/console fos:user:create username email password</pre>
                            <p>Rendre un utilisateur admin :</p>
                            <pre>php app/console fos:user:promote username<br/>
ROLE_ADMIN</pre>
                            <p>En cas de problème, pour vérifier les entités :</p>
                            <pre>php app/console cache:warmup --env=prod --no-debug</pre>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </body>
</html>
