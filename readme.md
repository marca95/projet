---


---

<h1 id="zoo-arcadia">Zoo Arcadia</h1>
<p>Ce projet est une application web qui montre les différentes parties du Zoo Arcadia. Vous pourrez y découvrir les différentes habitations ainsi que tous les animaux du zoo. Vous pourrez également consulter les activités, ainsi que les avis des visiteurs. Seul l’administrateur, les vétérinaires et les employés ont un compte pour s’y connecter afin qu’ils puissent mettre à jour leurs documents. Il y a un également un formulaire de contact, qui permet aux visiteurs du site de poser une question au zoo en mentionnant un titre, une adresse mail et une description de la demande.</p>
<p>Lien du déploiement : <a href="https://zoo-arcadia-2024-7efa0677447b.herokuapp.com/">https://zoo-arcadia-2024-7efa0677447b.herokuapp.com/</a></p>
<p>Lien des maquettes avec Figma : <a href="https://www.figma.com/file/iXyHguaEtQRTkp5iiRJqGF/Arcadia?type=design&node-id=0%3A1&mode=design&t=7VZwzasuJpaGJoeR-1">Cliquez-ici</a></p>
<p>Lien de mon gestion de projet avec Trello : <a href="https://trello.com/b/2YBX2Upm/zoo-arcadia" >Cliquez-ici</a></p>
<p>Lien Github : <a href="https://github.com/marca95/projet.git" >Cliquez-ici</a></p>
<h2 id="pré-requis">Pré-requis</h2>
<ul>
<li>Editeur de code.</li>
<li><a href="https://www.php.net/downloads.php#gpg-8.2">Php</a> : Back.</li>
<li><a href="https://getcomposer.org/download/">Composer</a> : Gestionnaire de dépendances PhP.</li>
<li><a href="https://mariadb.org/download/?t=mariadb&amp;p=mariadb&amp;r=11.3.2&amp;os=windows&amp;cpu=x86_64&amp;pkg=msi&amp;mirror=serverion">MariaDB</a> : Base de données relationnelle.</li>
<li><a href="https://www.mongodb.com/try/download/community">MongoDB</a> : Base de données NoSQL.</li>
<li><a href="https://www.apachefriends.org/fr/download.html">XAMPP</a> : Déploiement en local.</li>
<li><a href="https://docs.github.com/en/enterprise-server@3.10/desktop/installing-and-authenticating-to-github-desktop/installing-github-desktop">Github</a> : Plateforme de développement pour un  contrôle de version distribué.</li>
<li><a href="https://help.heroku.com/FZDDCBLB/how-can-i-download-my-code-from-heroku">Heroku</a> : Déploiement de l’application en ligne.</li>
<li><a href="https://www.mongodb.com/fr-fr/lp/cloud/atlas/try4?utm_source=google&amp;utm_campaign=search_gs_pl_evergreen_atlas_core_prosp-brand_gic-null_emea-be_ps-all_desktop_eng_lead&amp;utm_term=mongodb%20atlas%20download&amp;utm_medium=cpc_paid_search&amp;utm_ad=p&amp;utm_ad_campaign_id=12212624380&amp;adgroup=115749707223&amp;cq_cmp=12212624380&amp;gad_source=1&amp;gclid=EAIaIQobChMInYulzK7ahQMVyKmDBx2pbATgEAAYASAAEgI9WfD_BwE?utm_source=google&amp;utm_campaign=search_gs_pl_evergreen_atlas_core_prosp-brand_gic-null_emea-be_ps-all_desktop_eng_lead&amp;utm_term=mongodb%20atlas%20download&amp;utm_medium=cpc_paid_search&amp;utm_ad=p&amp;utm_ad_campaign_id=12212624380&amp;adgroup=115749707223&amp;cq_cmp=12212624380&amp;gad_source=1&amp;gclid=EAIaIQobChMInYulzK7ahQMVyKmDBx2pbATgEAAYASAAEgI9WfD_BwE">MongoDB  Atlas</a> : Hébergeur.</li>
<li><a href="https://elements.heroku.com/addons/jawsdb-maria">JawsDB MariaDB</a> : Hébergeur .</li>
</ul>
<h1 id="installation">Installation</h1>
<ol>
<li>Télécharger Visual Studio code qui est un éditeur de code (texte).</li>
<li>Télécharger XAMPP ( Système d’exploitation, Serveur Apache, Base de<br>
données MySQL, Php, Perl ou languages de programmation) afin de<br>
pouvoir créer un environnement en local.</li>
<li>Créer un fichier local dans le répertoire dans le dossier xampp\htdocs pour une 		meilleure organisation, un accès rapide, une meilleure sécurité et surtout une bonne configuration du serveur XAMPP.</li>
<li>Ouvrez ce fichier qui vient d’être créé dans l’éditeur de code VSCode pour ensuite y créer vos différents fichiers.</li>
<li>Pour sauvegarder vos créations de code, créer un compte github. Ensuite, dans le terminal de votre éditeur de code, tapez :</li>
</ol>
<pre><code>git init 
git add .
git commit -m 'Message'
</code></pre>
<p>Cela va vous créez un fichier caché .git/ dans votre fichier, puis vous ajoutez tous les fichiers modifiés  ou nouvellement créés au suivi de version et enfin vous créez une description de vos modifications.<br>
Connectez vous à votre compte Github, cliquez sur “New” (créer un nouveau dépôt), donnez-lui le nom que vous souhaitez et appuyez sur “Create repository”.</p>
<ol start="6">
<li>Faire la liaison du dépôt local au distant : Sur la page Github, copiez l’URL fournie (par exemple : “<a href="https://github.com/votre-utilisateur/votre-depot.git">https://github.com/votre-utilisateur/votre-depot.git</a>”). Retournez sur votre terminal dans l’éditeur de code et tapez :</li>
</ol>
<pre><code>git remote add origin &lt;URL-du-depot&gt;
git push -u origin master
</code></pre>
<p>Une fois ces étapes terminées, vous aurez créé la liaison entre votre dépôt local et distant, et vous pousserez vos modifications vers le dépôt local au distant à chaque utilisation du git push.</p>
<h2 id="utilisation">Utilisation</h2>
<p>Lors de ce projet, nous avons travaillés sur 2 branches Git :</p>
<ul>
<li>Branch master</li>
<li>Branch developpement</li>
</ul>
<p>Pour switcher d’une branche à l’autre et fusionner une branche avec l’autre, taper dans votre terminal :</p>
<pre><code>git checkout developpement
git pull origin master 
git checkout master
git merge developpement
git push origin master
</code></pre>
<p><strong>Attention</strong>: Vous pouvez créer autant de branches que vous le souhaitez mais en général il est conseillé de travailler avec 2 branches. Le branch master qui est la branch en ligne et la branch developpement qui nous sert à continuer à développer le projet en local.</p>
<p>Si vous souhaitez installer Bootstrap, vous pouvez l’installer en local ou grâce à l’invite de commande :</p>
<pre><code>npm i bootstrap@5.3.3
</code></pre>
<p>Ou en l’incluant via le CND dans les balises <code>&lt;head&gt; &lt;/head&gt;</code> de votre projet :</p>
<pre><code>&lt;link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"&gt;
</code></pre>
<p>Nous pouvons procéder de la même façon pour composer, en tapant dans la ligne de commande :</p>
<pre><code>php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
</code></pre>
<p>Ou en téléchargeant l’exécutable : <a href="https://getcomposer.org/download/">https://getcomposer.org/download/</a> (Composer-Setup.exe).</p>
<p>Dans ce projet, j’ai inclus la bibliothèque PhP-SMTP-Mailer qui m’est fournie dans un lien Github : <a href="https://github.com/halojoy/PHP-SMTP-Mailer">https://github.com/halojoy/PHP-SMTP-Mailer</a>. J’ai préféré utiliser ce procédé pour un contrôle total sur la version ainsi qu’une meilleure sécurité.</p>

<h2 id="images-citations-et-détails">Images, citations et détails</h2>
<p>Toutes les images sont libres de droits et gratuites. Elles viennent du site : <a href="https://pixabay.com/fr/">Pixabay</a>.<br>
La citation à la page d’accueil vient du site <a href="https://citations.ouest-france.fr/citation-francois-mauriac/sert-rien-homme-gagner-lune-32107.html">citations.ouest-france.fr</a>. Cette phrase à été dit par <em>François Mauriac</em>.<br>
Les informations sur les animaux sont des informations fictives. Vous ne devez pas vous baser sur ces informations. Le zoo n’est pas réel, tout a été inventé.</p>
 
