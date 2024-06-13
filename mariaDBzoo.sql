
CREATE TABLE accueil_services (
	id_service INT(11) NOT NULL PRIMARY KEY,
	content TEXT NOT NULL,
	img1 VARCHAR(255) NOT NULL,
	img2 VARCHAR(255) NOT NULL,
	title_btn VARCHAR(255),
	FOREIGN KEY (id_service) REFERENCES services(id_service) ON DELETE CASCADE
);

INSERT INTO accueil_services (id_service, content, img1, img2, title_btn) VALUES
	(1, 'Une balade du domaine en petit train avec notre pilote expérimenté René', './img/accueil/train.png', './img/accueil/rene.jpeg', 'Pour plus d\'info'),
	(2, 'Vous pourrez également visiter les animaux dans leurs habitats et vous balladez avec des animaux inoffensifs, telles que des chèvres, des moutons, des ânes pour le bonheur des petits comme des grands!', './img/accueil/visite1.jpg', './img/accueil/visite2.jpg', 'Pour plus d\'info'),
	(3, 'Venez découvrir nos magnifiques plats concoctés par nos chefs qualifiés. Vous y découvrirez une cuisine authentique, créative mais surtout des plats zéro déchet. Nous utilisons le maximum de produits locaux afin de respecter notre conviction, <i>une planète plus verte.</i>', './img/accueil/resto1.jpg', './img/accueil/resto2.jpg', 'Pour plus d\'info');

CREATE TABLE animals (
	id_animal INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	type VARCHAR(50) NOT NULL,
	race VARCHAR(50) NOT NULL,
	id_location INT(11) NOT NULL,
	id_home INT(11) NOT NULL,
	root VARCHAR(255) NOT NULL,
	commonName VARCHAR(100) NOT NULL,
	FOREIGN KEY (id_location) REFERENCES locations(id_location), 
	FOREIGN KEY (id_home) REFERENCES homes(id_home)
);

INSERT INTO animals (name, type, race, id_location, id_home, root, commonName) VALUES
	('Teddy', 'cerf', 'Cervus elaphus', 2, 1, './img/habitats/cerf.jpg', 'Le cerf'),
	('Peggy', 'cochon', 'Gascon', 1, 1, './img/habitats/cochon.jpg', 'Les cochons'),
	('Dan', 'cochon', 'Gascon', 1, 1, './img/habitats/cochon.jpg', 'Les cochons'),
	('Jayson', 'lapin', 'Bélier Hollandais', 1, 1, './img/habitats/lapin.jpg', 'Les lapins'),
	('Olie', 'lapin', 'Bélier Hollandais', 1, 1, './img/habitats/lapin.jpg', 'Les lapins'),
	('Vinc', 'dain', 'Européen', 1, 1, './img/habitats/dains.jpg', 'Les dains'),
	('Carole', 'dain', 'Européen', 1, 1, './img/habitats/dains.jpg', 'Les dains'),
	('Sabine', 'poule', 'Poules d\'ornement', 1, 1, './img/habitats/poule.jpg', 'Les poules'),
	('Jacky', 'poule', 'Poules d\'ornement', 1, 1, './img/habitats/poule.jpg', 'Les poules'),
	('Banbi', 'chevreuil', 'Capreolus Pygargus', 2, 1, './img/habitats/chevreuil.jpg', 'Les chevreuils'),
	('Harry', 'chevreuil', 'Capreolus Pygargus', 2, 1, './img/habitats/chevreuil.jpg', 'Les chevreuils'),
	('Bino', 'ecureuil', 'Roux d\'Europe', 1, 1, './img/habitats/ecureuil.jpg', 'Les écureuils'),
	('Clark', 'ecureuil', 'Roux d\'Europe', 1, 1, './img/habitats/ecureuil.jpg', 'Les écureuils'),
	('', 'poisson', 'Clown Loach', 2, 2, './img/habitats/poisson.jpg', 'Les poissons Asiatique'),
	('Isa', 'tortue', 'Grecque', 1, 2, './img/habitats/tortue.jpg', 'Les tortues'),
	('Coralie', 'tortue', 'Grecque', 1, 2, './img/habitats/tortue.jpg', 'Les tortues'),
	('', 'flamand rose', 'Phoenicoptéridés', 1, 2, './img/habitats/flamand.jpg', 'Les flamands Rose'),
	('', 'grenouille', 'Rieuse', 1, 2, './img/habitats/grenouille.jpg', 'Les grenouilles'),
	('Billye', 'canard', 'Coureur indien', 2, 2, './img/habitats/canard.jpg', 'Les canards'),
	('Mick', 'canard', 'Coureur indien', 2, 2, './img/habitats/canard.jpg', 'Les canards'),
	('Djo', 'castor', 'Fiber', 1, 2, './img/habitats/castor.jpg', 'Nos castors'),
	('Bill', 'castor', 'Fiber', 1, 2, './img/habitats/castor.jpg', 'Nos castors'),
	('Margaux', 'oie', 'Bourbonnais', 1, 2, './img/habitats/oie.jpg', 'Les oies'),
	('José', 'oie', 'Bourbonnais', 1, 2, './img/habitats/oie.jpg', 'Les oies'),
	('Spider', 'araignée', 'Actinopodidae', 3, 3, './img/habitats/araignee.jpg', 'L\'araignée'),
	('Victor', 'cameleon', 'Furcifer', 4, 3, './img/habitats/cameleon.jpg', 'Le caméléon'),
	('Sniki', 'boa', 'Boa constricteur', 4, 3, './img/habitats/boa.jpg', 'Le boa'),
	('Célio', 'crocodile', 'Crocodile américain', 3, 3, './img/habitats/crocodile.jpg', 'Le crocodile'),
	('Pico', 'python', 'Anchietae Bocage', 4, 3, './img/habitats/python.jpg', 'Le python'),
	('', 'sauterelle', 'Dectique verrucivore', 2, 3, './img/habitats/sauterelle.jpg', 'Les sauterelles'),
	('Sabrola', 'alligator', 'Alligator de Chine', 2, 3, './img/habitats/alligator.jpg', 'L\'alligator'),
	('Willy', 'dauphin', 'Tursiops aduncus', 3, 7, './img/habitats/dauphin.jpg', 'Le dauphin'),
	('Raphael', 'tortue', 'Caouanne', 1, 7, './img/habitats/tortue1.jpg', 'Les tortues'),
	('Michelangelo', 'tortue', 'Caouanne', 1, 7, './img/habitats/tortue1.jpg', 'Les tortues'),
	('César', 'hippocampe', 'Hippocampus kuda', 2, 7, './img/habitats/hippocampe.jpg', 'Les hippocampes'),
	('Juliette', 'hippocampe', 'Hippocampus kuda', 2, 7, './img/habitats/hippocampe.jpg', 'Les hippocampes'),
	('Ben', 'phoque', 'Phoque à capuchon', 5, 7, './img/habitats/phoques.jpg', 'Les phoques'),
	('Istas', 'phoque', 'Phoque à capuchon', 5, 7, './img/habitats/phoques.jpg', 'Les phoques'),
	('Tej', 'pingouin', 'Alca torda', 5, 7, './img/habitats/pingouin.jpg', 'Les pingouins'),
	('Tor', 'pingouin', 'Alca torda', 5, 7, './img/habitats/pingouin.jpg', 'Les pingouins'),
	('Mamy', 'requin', 'Requin du Groenland', 5, 7, './img/habitats/requin.jpg', 'Le requin'),
	('', 'meduse', 'Roux d\'Europe', 1, 7, './img/habitats/meduse.jpg', 'Les méduses'),
	('Reco', 'bison', 'Bison d\'Amérique', 3, 4, './img/habitats/bison.jpg', 'Les bisons'),
	('Cogne', 'bison', 'Bison d\'Amérique', 3, 4, './img/habitats/bison.jpg', 'Les bisons'),
	('Cow', 'vache', 'Watusi', 3, 4, './img/habitats/vache.jpg', 'Les vaches'),
	('Poker', 'vache', 'Watusi', 3, 4, './img/habitats/vache.jpg', 'Les vaches'),
	('Olav', 'girafe', 'Masaï', 4, 4, './img/habitats/girafe.jpg', 'Les girafes'),
	('Béné', 'girafe', 'Masaï', 4, 4, './img/habitats/girafe.jpg', 'Les girafes'),
	('Jayson', 'mouton', 'Roux du Valais', 1, 4, './img/habitats/mouton.jpg', 'Les moutons'),
	('Anne', 'mouton', 'Roux du Valais', 1, 4, './img/habitats/mouton.jpg', 'Les moutons'),
	('Kev', 'antilope', 'Elanp du Cap', 4, 4, './img/habitats/antilope.jpg', 'Les antilopes'),
	('Ana', 'antilope', 'Elanp du Cap', 4, 4, './img/habitats/antilope.jpg', 'Les antilopes'),
	('Tax', 'elephant', 'Elephant d\'Asie', 2, 4, './img/habitats/elephant.jpg', 'Les éléphants'),
	('Dumbo', 'elephant', 'Elephant d\'Asie', 2, 4, './img/habitats/elephant.jpg', 'Les éléphants'),
	('Cindy', 'cheval', 'Camarillo white', 1, 4, './img/habitats/cheval.jpg', 'Les chevaux'),
	('Karl', 'cheval', 'Camarillo white', 1, 4, './img/habitats/cheval.jpg', 'Les chevaux'),
	('Simba', 'lion', 'Lion du Sénégal', 4, 5, './img/habitats/lion.jpg', 'Les lions'),
	('Pumba', 'lion', 'Lion du Sénégal', 4, 5, './img/habitats/lion.jpg', 'Les lions'),
	('Ave', 'rhinoceros', 'Rhinocéros noir', 4, 5, './img/habitats/rhinoceros.jpg', 'Les rhinocéroses'),
	('Steve', 'rhinoceros', 'Rhinocéros noir', 4, 5, './img/habitats/rhinoceros.jpg', 'Les rhinocéros'),
	('Hulk', 'buffle', 'Syncerus caffer', 4, 5, './img/habitats/buffle.jpg', 'Les buffles'),
	('Batman', 'buffle', 'Syncerus caffer', 4, 5, './img/habitats/buffle.jpg', 'Les buffles'),
	('Léo', 'leopard', 'Panthera pardus', 4, 5, './img/habitats/leopard.jpg', 'Les léopards'),
	('Par', 'leopard', 'Panthera pardus', 4, 5, './img/habitats/leopard.jpg', 'Les léopards'),
	('Jola', 'jaguar', 'Jaguar Roux', 2, 5, './img/habitats/jaguar.jpg', 'Les jaguars'),
	('Burdi', 'jaguar', 'Jaguar Roux', 2, 5, './img/habitats/jaguar.jpg', 'Les jaguars'),
	('Louve', 'loup', 'Loup sauvage', 1, 5, './img/habitats/loup.jpg', 'Les loups'),
	('Francis', 'loup', 'Loup sauvage', 1, 5, './img/habitats/loup.jpg', 'Les loups'),
	('Rob', 'chameaux', 'Kharai', 4, 5, './img/habitats/chameau.jpg', 'Les chameaux'),
	('Camal', 'chameaux', 'Kharai', 4, 5, './img/habitats/chameau.jpg', 'Les chameaux'),
	('Daphnée', 'ours brun', 'Ours brun', 2, 6, './img/habitats/ours.jpg', 'Les ours brun'),
	('Yama', 'ours brun', 'Ours brun', 2, 6, './img/habitats/ours.jpg', 'Les ours brun'),
	('Izidor', 'panda', 'Panda Géant', 2, 6, './img/habitats/panda.jpg', 'Les pandas'),
	('Kami', 'panda', 'Panda Géant', 2, 6, './img/habitats/panda.jpg', 'Les pandas'),
	('Mickey', 'oran-outang', 'Pango', 2, 6, './img/habitats/orang-outang.jpg', 'L\'oran-outang'),
	('Val', 'gorille', 'Gorille de l\'Est', 2, 6, './img/habitats/gorille.jpg', 'Les gorilles'),
	('Hicko', 'gorille', 'Gorille de l\'Est', 2, 6, './img/habitats/gorille.jpg', 'Les gorilles'),
	('', 'saimiri', 'Singes-écureuils', 4, 6, './img/habitats/saimiri.jpg', 'Les saïmiris'),
	('Chi', 'kango', 'Kangourou roux', 6, 6, './img/habitats/kangourou.jpg', 'Les kangourous'),
	('Dora', 'kango', 'Kangourou roux', 6, 6, './img/habitats/kangourou.jpg', 'Les kangourous'),
	('Ivo', 'ours blanc', 'Grolar', 5, 6, './img/habitats/ours-polaire.jpg', 'L\'ours polaire'),
	('Rico', 'perroquet', 'Ara', 3, 8, './img/habitats/perroquet.jpg', 'Le perroquet'),
	('Vilo', 'toucan', 'Toco', 3, 8, './img/habitats/toucan.jpg', 'Le toucan'),
	('Jo', 'aigle', 'Royal', 1, 8, './img/habitats/aigle.jpg', 'L\'aigle'),
	('Olivier', 'faucon', 'Lanier', 1, 8, './img/habitats/faucon.jpg', 'Le faucon'),
	('Tia', 'autruche', 'Autruche à nuque rouge', 4, 8, './img/habitats/autruche.jpg', 'Les autruches'),
	('Milo', 'autruche', 'Autruche à nuque rouge', 4, 8, './img/habitats/autruche.jpg', 'Les autruches'),
	('Ken', 'hibou', 'Grand-duc', 2, 8, './img/habitats/hibou.jpg', 'Le hibou'),
	('Bastil', 'chouette', 'Hulotte', 1, 8, './img/habitats/chouette.jpg', 'La chouette');

CREATE TABLE avis (
	id_avis INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255) NOT NULL,
	content TEXT NOT NULL,
	status VARCHAR(10) NOT NULL,
	id_employe INT(11) DEFAULT NULL,
	FOREIGN KEY (id_employe) REFERENCES users(id_user)
);

INSERT INTO avis (id_avis, first_name, content, status, id_employe) VALUES
	('Nathalie', 'Le Zoo d\'Arcadia est un espace où les visiteurs peuvent admirer des milliers d\'animaux dans un immense parc. L\'accueil est bon avec le cadre bienveillant et bien aménagé. Le zoo se distingue par sa grande diversité animalière avec des centaines et des centaines d\'espèces venues de tous les continents. Découverte et émerveillement sont donc les mots qui résument les avis des visiteurs du Zoo de Arcadia.', 'published', 12),
	('Berenice', 'Tres jolie endroit, pleins de couleurs, le restaurant est vraiment tres bon. Les animaux y sont vraiment bien. Je conseille vivement!', 'published', 12),
	('Pierre', '3ieme commentaire', 'pending', 12);


CREATE TABLE foods (
	id_animal INT(11) NOT NULL,
	food VARCHAR(100),
	grams FLOAT,
	date_pass DATETIME,
	id_employed INT(11),
	FOREIGN KEY (id_animal) REFERENCES animals(id_animal) ON DELETE CASCADE, 
	FOREIGN KEY (id_employed) REFERENCES users(id_user)
);

INSERT INTO foods (id_animal, food, grams, date_pass, id_employed) VALUES
	(2, 'Trognon de pommes ', 400, '2023-04-11 15:52:00', 12),
	(3, 'frites', 10, '2023-04-12 00:00:00', 12),
	(4, 'frites', 10, '2023-04-12 00:00:00', 12),
	(5, 'frites', 10, '2023-04-12 00:00:00', 12),
	(6, 'frites', 10, '2023-04-12 00:00:00', 12),
	(7, 'frites', 10, '2023-04-12 00:00:00', 12),
	(8, 'frites', 10, '2023-04-12 00:00:00', 12),
	(9, 'frites', 10, '2023-04-12 00:00:00', 12),
	(10, 'frites', 10, '2023-04-12 00:00:00', 12),
	(11, 'frites', 10, '2023-04-12 00:00:00', 12),
	(12, 'frites', 10, '2023-04-12 00:00:00', 12),
	(13, 'noisettes et camembert', 200, '2023-07-28 00:00:00', 12),
	(14, 'Mis de pain', 300, '2023-06-22 07:48:00', 12),
	(1, 'Du riz et des pommes', 1000, '2023-04-12 12:32:00', 12),
	(75, 'Bananes', 1000, '2023-04-15 15:48:00', 12),
	(43, 'Foins ', 2500, '2023-04-16 11:12:00', 12),
	(84, 'Petites souris', 300, '2023-04-16 11:18:00', 12),
	(15, 'graine pour tortues ', 200, '2024-04-16 11:40:00', 12),
	(64, 'Viande fraiche', 4000, '2024-04-17 15:21:00', 12);

CREATE TABLE homes (
  id_home INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  description TEXT,
  main_root VARCHAR(255) NOT NULL,
  second_root VARCHAR(255) NOT NULL,
  url_img_accueil VARCHAR(255) NOT NULL,
  commonName VARCHAR(255) NOT NULL,
  second_title VARCHAR(255) NOT NULL
);

INSERT INTO homes (name, description, main_root, second_root, url_img_accueil, commonName, second_title) VALUES
	('foret', 'Cette forêt s\'étend sur plus de 3000m² où se cachent de nombreux cervidés ainsi que quelques animaux de la ferme. Vous pouvez vous y balader en toute tranquillité, profiter du calme et des magnifiques hêtres de plus de 80 ans. Ces animaux sont inoffensifs. Merci de respecter le silence et de veiller à leur bien-être.', './img/habitats/foret.jpg', './img/habitats/foret1.jpg', './img/accueil/foret.jpg', 'La fôret', 'La foret d\'Arcadia'),
	('etang', 'Grand bassin d\'eau avec petite île au milieu pour que nos canards puissent se reposer sans être déranger. Notre étang cache des nombreuses espèces. La qualité de l\'eau est controlé hebdomadairement par nos vétérinaire, afin de s\'assurer le bien-être de nos animaux.', './img/habitats/etang.jpg', './img/habitats/etang1.jpg', '../img/accueil/etang.jpg', 'L\'étang', 'La plage'),
	('vivarium', 'Nous appelons la zone de danger le lieu où se situent tous nos vivariums. Nous abritons des animaux pour lesquels une piqûre ou une morsure pourrait être fatale pour l\'homme. Les animaux sont placés dans des vivariums appropriés, avec une température idéale pour chacun.', './img/habitats/vivarium.jpg', './img/habitats/vivarium1.jpg', './img/accueil/terrarium.jpg', 'Le vivarium', 'La zone de danger'),
	('pature', 'Cet immense champs vert ou sont stockés également nos installations pour l\'énergie verte est l\'habitat de beaucoup de gros animaux, autant d\'Afrique que d\'Amérique.', './img/habitats/pature.jpg', './img/habitats/pature1.jpg', './img/accueil/pature.jpeg', 'Les pâtures', 'L\'espace vert'),
	('ranch', 'Vous allez rentrer dans le monde du western, avec les décorations en bois ancien. Vous allez également découvrir le roi de la jungle ainsi que le big Five d\'Afrique.', './img/habitats/ranch.jpg', './img/habitats/ranch1.jpg', './img/accueil/ranch.jpg', 'Le ranch', 'Le west-Arca'),
	('taniere', 'Certains animaux préfèrent rester dans l\'obscurité aux abris des regards. D\'autres justement préfèrent rester au soleil et rentrer dans leur tanière le soir afin de ne pas être à découvert. Vous y découvrirez des animaux venus de tout autour du monde!', './img/habitats/taniere.jpg', './img/habitats/taniere1.jpg', './img/accueil/tanieres.jpg', 'Les tanières', 'La pénombre'),
	('oceanarium', 'Magnifique espace vitrée où se situe également un tunnel de + de 50m de long pour rentrer dans le monde de l\'océan. Cette espace est l\'une de plus grande fierté du patron car il habrite des spécimen rare et très ancien.', './img/habitats/oceanarium.jpg', './img/habitats/oceanarium1.jpg', './img/accueil/oceanarium.jpg', 'L\'océanarium', 'Le sous-marin'),
	('voliere', 'Notre volière accueil jusqu\'à 50 espèces de volatiles différents. Ici, nous allons vous montrez les animaux ayant le plus de succès auprès de nos visiteurs, mais croyez nous, tous, sont en très bonne santé et vivent \'leur best life\'.', './img/habitats/voliere.jpg', './img/habitats/voliere1.jpg', './img/accueil/voliere.jpg', 'La volière', 'Le ciel d\'Arcadia');

CREATE TABLE horaires (
  id_horaire int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  day_week varchar(50) NOT NULL,
  start_time varchar(50),
  end_time varchar(50),
  is_closed tinyint(1) NOT NULL
);

INSERT INTO horaires (`day_week`, `start_time`, `end_time`, `is_closed`) VALUES
	('Lundi', '', '', 1),
	('Mardi', '', '', 1),
	('Mercredi', '10h', '19h', 0),
	('Jeudi', '10h', '19h', 0),
	('Vendredi', '10h', '19h', 0),
	('Samedi', '10h', '19h', 0),
	('Dimanche', '11h', '20h', 0);

CREATE TABLE locations (
  id_location INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VRCHAR(50) NOT NULL
);

INSERT INTO locations (name) VALUES
	('Europe'),
	('Asie'),
	('Amérique'),
	('Afrique'),
	('Antarctique'),
	('Océanie');

CREATE TABLE roles (
  id_role INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);

INSERT INTO roles (name) VALUES
	('administrateur'),
	('veterinaire'),
	('employe');

CREATE TABLE services (
  id_service INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  main_title VARCHAR(255) NOT NULL,
  second_title VARCHAR(255),
  img_root VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  third_title VARCHAR(255),
  second_content TEXT,
  name VARCHAR(255) NOT NULL,
  link_class VARCHAR(255),
  link_url VARCHAR(255),
  img_root_link VARCHAR(255),
  btn_class VARCHAR(255),
  btn_url VARCHAR(255),
  btn_title VARCHAR(255)
);

INSERT INTO services (main_title, second_title, img_root, content, third_title, second_content, name, link_class, link_url, img_root_link, btn_class, btn_url, btn_title) VALUES
	('Petit tour en train', 'Tarifs pour 45min', './img/services/train1.jpg', '-> Adulte: 8€<br />-> Enfant de 4 à 12ans: 5€<br />-> Enfant de - 4ans: Gratuit<br />-> Place réservé pour personne à mobilité reduite', 'Durée :', 'Le train roulera de 11h à 17h. La promenade dure +/- 45min. Le départ se fera à coté de l\'accueil principal. Elle démarrera a toutes les heures pleines de 11h à 18h du mercredi au dimanche. En fonction des conditions climatique, il est possible que le petit train reste au chaud. L\'accueil vous préviendra lors de votre arrivé.', 'train', NULL, NULL, NULL, NULL, NULL, NULL),
	('Visite des habitats', '', './img/services/guide.jpg', 'Rendez-vous avec notre guide Arcadia tous les jours de la semaine de 10h30 à 12h et de 14h à 16h. Vous aurez la chance d\'accéder à notre volière où vivent des centaines de différentes sortent d\'oiseaux. Vous découvrirez sous un autre angle les animaux australiens comme le kangourous, ainsi que quelques animaux africains comme les samïris, la girafe ou les gorilles. <b>Activité gratuite !</b>', '', 'Il est <b>strictement interdit </b> de donner de la nourriture aux animaux pendant la visite. La nourriture est soigneusement préparée et pesée par nos soigneurs. Une quantité trop élévé de nourriture non autorisé peut blesser l\'animal, même pire dans certain cas. Merci d\'écouter attentivement les consignes de sécurité du guide durant la visite.', 'habitat', NULL, NULL, NULL, NULL, NULL, NULL),
	('Restaurant', '', './img/services/restaurant.jpg', 'Notre magnifique restaurant avec 200 places intérieur et 50 places extérieur avec vue sur notre lac, vous accompagne de 11h à 15h tous les jours de la semaine.', '', 'Nous vous proposons une cuisine 0 déchet et où nous favorisons les produits locaux. Des assiettes saine, riche et savoureuse préparé par nos chefs. Le restaurant ressemble à notre physionomie: Mettre tout en notre pouvoir pour contribuer à un planète plus verte pour le biens de nos animaux.', 'resto', 'col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4', './terre.php', './img/accueil/ecologie.jpg', 'col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4', './img/services/carte_restaurant.pdf', 'Découvrez la carte du restaurant');

CREATE TABLE states (
	id_animal INT(11) NOT NULL PRIMARY KEY,
	state TEXT DEFAULT NULL,
	detail TEXT DEFAULT NULL,
	id_vete INT(11) DEFAULT NULL,
	FOREIGN KEY (id_vete) REFERENCES users(id_user),
	FOREIGN KEY (id_animal) REFERENCES animals(id_animal) ON DELETE CASCADE
);

INSERT INTO states (id_animal, state, detail, id_vete) VALUES
	(1, 'Animal en très bonne santé, adore la compagnie', 'Super bois!', 11),
	(2, 'Animal un peu lourd, donner plus d\'eau et des fruits', 'Couper les ongles', 11),
	(3, 'Poids lourd', 'Faire un régime strict', 11),
	(4, 'Poids lourd', 'Faire un régime strict', 11),
	(5, 'Poids lourd', 'Faire un régime strict', 11),
	(6, 'Poids lourd', 'Faire un régime strict', 11),
	(7, 'Poids lourd', 'Faire un régime strict', 11),
	(8, 'Poids lourd', 'Faire un régime strict', 11),
	(9, 'Poids lourd', 'Faire un régime strict', 11),
	(10, 'Poids lourd', 'Faire un régime strict', 11),
	(11, 'Poids lourd', 'Faire un régime strict', 11),
	(12, 'Poids lourd', 'Faire un régime strict', 11),
	(13, 'Bon', 'Surveillez jambe gauche', 11),
	(36, 'Merveilleux animal coloré, quelques espèces encore sur terre. A conserver précieusement', '', 11),
	(43, 'Vérifier ses jambes avant risque d\'infection', 'animal de plus de 30ans', 11),
	(75, 'Animal un peu sale à nettoyer', 'Pelage fort boueux, à nettoyer au savon', 11),
	(85, 'Super animal, très bien apprivoisé', 'Sage sur son bois', 11),
	(86, 'Très grande en taille, attention peut etre parfois dangereuse', 'Rester méfiant', 11),
	(87, 'ok', 'ok', 11),
	(88, 'Très belle animal, agréable et très joviale', '', 11),
	(89, 'Très bon animal, très doux ', 'Pas mal de perte de plumes à faire attention', 11);


CREATE TABLE status_home (
	id_home INT(11) NOT NULL,
	opinion_state TEXT,
	improvement TEXT,
	id_veto INT(11),
	FOREIGN KEY (id_home) REFERENCES homes(id_home) ON DELETE CASCADE,
	FOREIGN KEY (id_veto) REFERENCES users(id_veto)
);


INSERT INTO status_home (id_home, opinion_state, improvement, id_veto) VALUES
	(2, 'Filtrer l\'eau plus régulièrement.', 'Prévoir un planning mensuel du filtrage', 11),
	(4, 'rectif', 'rectifaction', 11),
	(1, 'Magnifique endroit pour s\'y balader. Plusieurs variétés d\'arbres. ', 'Aménager un chemin route plus "safe"', 11);

CREATE TABLE users (
  id_user INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  id_role INT(11) NOT NULL,
  birthday DATE NOT NULL,
  hire DATE NOT NULL,
	FOREIGN KEY id_role REFERENCES roles(id_role)
);

INSERT INTO users (name, first_name, username, email, password, id_role, birthday, hire) VALUES
	('Aldo', 'Jose', 'jose@arcadia.com', 'aldojose@gmail.com', '$2y$10$VecH0xgq.MFlQtTM9tbP4OE.RdgzTWZeNE9FAhJ7V.KYcdLtuAuZq', 1, '1980-05-09', '2000-11-14'),
	('Knoden', 'Lise', 'lise@arcadia.com', 'knodenlise@gmail.com', '$2y$10$0SeyccXi/tAuzn2VilCKz.nEZ8rs1QOf340fxaeB/Z3WmQPMYTBNi', 2, '1996-07-11', '2021-09-13'),
	('Paula', 'Emma', 'emma@arcadia.com', 'paulaemma@gmail.com', '$2y$10$rjnR9DjShS6KdGlS.qc9.uEJF9bjMIKJbsaclf.xHxCtsEZ2opS1G', 3, '1999-02-10', '2024-01-02'),
	('Majerus', 'Pierre', 'pierre@arcadia.com', 'pierre.majerus@outlook.be', '$2y$10$FTm7AAHiQMHDIj8EpAeWsud11yGQ8boinfOkp0CZyNDhdG788dzGi', 3, '1995-04-03', '2015-06-01'),
	('Gillet', 'Annelise', 'annelise@arcadia.com', 'annelise@gmail.com', '$2y$10$XgJSBRtg7wMog7bqwVKUturE9ixQTJLmJUptAUUemKajdHsULMxHu', 2, '1996-03-09', '2023-12-26'),
	('Koeune', 'Antoine', 'antoine@arcadia.com', 'antoine@gmail.com', '$2y$10$60gL9giconY4hbukMenFP.MDh6stjJkSrax514maLdTHCxWy/EQD6', 3, '1994-03-22', '2024-04-17'),
	('Detaille', 'Kevin', 'kevin@arcadia.com', 'kev0304@gmail.com', '$2y$10$qhXCeVMozD0raH/DIOEJMerkc9.Dpk1e/9VUacI6bTPo6nGRNAq/W', 2, '1987-08-12', '2011-09-05');
