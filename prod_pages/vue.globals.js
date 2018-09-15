//================================================================================================//
// données partagées par les pages produits :                   DONNEES GLOBALES                  //
//================================================================================================//

var shared = { // variables globales
  //---------------------------------------------------------------------- PATHS
  url: 'https://www.france-banderole.com',
  local: 'http://localhost:8000/wordpress',
  img: '../wp-content/plugins/fbshop/images',

  //----------------------------------------------------------------------- PRIX
  opSIGN: 5,     // option signature

  // maquettes
  maqFB1: 22,    // maquette France Banderole base
  maqFB2: 29,    // maquette France Banderole (stand, enseigne susp...)
  maqFB3: 39,    // maquette France Banderole (tentes...)
  maqBAT: 4,     // maquette client BAT
  maqONL: 6,     // maquette en ligne

  // options livraison
  livRAT: 6/100, // retrait atelier
  livREL: 6,     // relais Colis
  livREV: 5,     // colis revendeur
  livROL: 29,    // livraison roulée

  // délais production / livraison base (excepté roll-up, tentes, oriflammes)
  prodA23: 25,    // prod 2-3j
  prodA11: 45,    // prod 1j
  livrA23: 25,    // livr 2-3j
  livrA11: 45,    // livr 1j


  //------------------------------- tooltips communs à toutes les pages produits
  // sans bat
  btn: '<b>j\'envoie mon fichier, je ne souhaite pas de BAT:</b>Après la réception de votre fichier et de votre paiement, la commande sera mise directement en production. Si votre fichier ne respecte pas nos spécifications, il sera automatiquement adapté par notre service infographie. Supprimer le BAT décharge France Banderole de toutes responsabilités en cas de non conformité de votre fichier (couleur, format, pixellisation, fond perdu, faute orthographique, etc).',

  // avec bat
  bty: '<b>j\'envoie mon fichier, je souhaite un BAT numérique: +4€</b> Vous envoyez votre propre fichier (une fois votre devis enregistré). Ce dernier sera contrôlé par notre service d\'infographie et un <span class="highlight">BAT à valider</span> vous sera transmis dans votre accès client. Votre production commence après la validation de ce BAT',

  // maquette en ligne
  enl: '<b>vous créez votre maquette en ligne: +6€</b> Dans le détail de votre commande vous aurez accès à notre outil de personnalisation en ligne. Simple et axé sur les fonctionnalités essentielles, il vous permettra de composer en quelques clics une maquette aux bonnes dimensions avec vos éléments personnels (logos, images...), du texte et un large choix de polices, couleurs, formes. <span class="highlight">Attention</span> cet outil  est conçu pour être utilisé sur PC/Mac avec un navigateur récent et une <span class="highlight">résolution d\'écran minimum de 1280x720 pixels.</span>',

  // maquette fb à 22 €
  mfb: '<b>france banderole crée votre fichier: +22€</b> Vous fournissez <span class="highlight">de 1 à 6 éléments séparés</span> et un explicatif sur votre souhait. Notre équipe d\'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.',

  // maquette fb à 29 €
  mfb2: '<b>france banderole crée votre fichier: +29€</b> Vous fournissez <span class="highlight">de 1 à 6 éléments séparés</span> et un explicatif sur votre souhait. Notre équipe d\'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.',

  // signature fb :
  psi: '<b>logo france banderole</b> Si vous choisissez l\'option "produit signé" un petit logo sera imprimé en bas de votre visuel <br/> <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/signature.png">',

  // produit neutre :
  pne: '<b>produit neutre: +5€</b> Aucun logo ni référence à France Banderole sur votre produit',
  // livraison adresse :

  lad: 'Pour être livré directement chez vous ou à votre adresse professionnelle. Par défaut votre adresse de facturation sera utilisée, mais vous pourrez spécifier une adresse de livraison dans votre accès client.',

  // retrait atelier :
  lat: 'Retrait de votre commande à l\'atelier de Vitrolles.',

  // relais colis
  lre: 'Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.',

  // colis revendeur :
  crv: 'Vous permet d’avoir une expédition neutre sans étiquetage France banderole. Vous pouvez également transmettre un bon de livraison personnalisé dans votre accès client',

  // livraison roulée / palletisation :
  roll: 'Nos banderoles en dessous de 2x2m sont livrées roulées, au delà elles sont pliées pour des raisons de dimensions de colis. La livraison roulée reste disponible en option pour 20€ et un délai d\'un jour supplémentaire.',

  gfe: '<b>Forfait palettisation: dès 99€ HT</b> Vous souhaitez que votre panneau publicitaire soit livré en un seul morceau le plus grand possible.',

  //--------------------------------------------textes tooltips types de support

  b440: '<b>bâche 440g:</b> bâche PVC 440g légère et texturée. Idéale pour obtenir le meilleur prix',
  b520: '<b>dickson jet 520 M1:</b> bâche pvc enduite anti-feu M1 durable et made in France.',
  beco: '<b>toile 100% écologique M1:</b> Toile 100% polyester M1 sans PVC ni phtalate. Texturée, aspect blanc cassé, type toile de peintre.',
  capo: '<b>capotoile 320 M1:</b> Toile 100% éco-conçue de fabrication française, labellisée ECOCERT ERTS à base de bouchons de bouteille recyclés.',
  t220: '<b>tissu 220g M1:</b> tissu stretch léger 100% polyester 220g traité retardant au feu M1',
  t260: '<b>tissu 260g B1:</b> tissu extensible dos noir 100% polyester 260g traité retardant au feu B1.',
  s220: '<b>tissu 220g M1: utilisation occasionnelle</b> Housse en tissu léger 100% polyester 220g traité retardant au feu M1.',
  s260: '<b>tissu 260g B1: utilisation intensive</b> Housse tissu extensible dos noir 100% polyester 260g traité retardant au feu B1.',
  p300: '<b>PVC 300µ M1: le moins cher !</b> visuel imprimé sur pvc souple à scratcher (scratchs fournis).',
  b300: '<b>PVC 300µ M1: le moins cher !</b> visuel imprimé sur pvc souple.',

  // support banderole avec prix au m2
  ecotm2: '<b>écotoile france banderole: dès 7,80/<sub>m</sub>²</b> Toile écologique et économique sans PVC en PEHD. Communiquez au meilleur prix et proprement !',
  becom2: '<b>toile 100% écologique M1: dès 21,45€/<sub>m</sub>²</b> Toile 100% polyester M1 sans PVC ni phtalate. Texturée, aspect blanc cassé, type toile de peintre.',
  capom2: '<b>capotoile 320 M1: dès 24,20€/<sub>m</sub>²</b> Toile 100% éco-conçue de fabrication française, labellisée ECOCERT ERTS à base de bouchons de bouteille recyclés.',

  b440m2: '<b>bâche 440g: le moins cher dès 4,90€/<sub>m</sub>²</b> bâche PVC 440g légère et texturée. Idéale pour obtenir le meilleur prix',
  b550m2: '<b>dickson jet 550: qualité/prix dès 9,80€/<sub>m</sub>²</b> la bâche française, pour une banderole 100% made in France, résistante dans la durée.',
  microm2: '<b>bâche micro-perforée: dès 6,50€/<sub>m</sub>²</b> Bâche mesh grille pour banderole résistante au vent sur échafaudage, plage...',
  b150m2: '<b>bâche nontissé 150g: légèreté dès 8€/<sub>m</sub>²</b> Toile coton/polyester pour balisage, jupe de palette. courte durée de vie. minimum 24M².',

  b520m2: '<b>dickson jet 520 M1: anti-feu dès 15,30€/<sub>m</sub>²</b> bâche pvc enduite anti-feu M1 durable et made in France.',
  lacom2: '<b>dickson lacopac M2/B1: recto/verso dès 19,90€/<sub>m</sub>²</b> bâche pvc épaisse opaque INT/EXT pour banderole recto verso.',

  t220m2: '<b>tissu 220g M1: dès 12€/<sub>m</sub>²</b> tissu stretch léger 100% polyester 220g traité retardant au feu M1',
  t260m2: '<b>tissu 260g B1: dès 16€/<sub>m</sub>²</b> tissu extensible dos noir 100% polyester 260g traité retardant au feu B1.',

  //--------------------------------------------------- toooltips page banderole

  ourlhb: '<b>ourlet de renfort en haut et en bas: dès 0,50€/<sub>m</sub></b> le plus commun. Repli de 2,5cm de matière soudé en bordure pour renforcer votre banderole. recommandé dès 3m² ou longeur supérieure ou égale à 3m.  lors du choix de la taille <b>ajouter 5<sub>cm</sub> à la hauteur souhaitée de votre banderole.</b>',
  ourlgd: '<b>ourlet de renfort à gauche et à droite: dès 0,50€/<sub>m</sub></b> pour banderole tendue. Repli de 2,5cm de matière soudé en bordure pour renforcer votre banderole. recommandé dès 3m² ou longeur supérieure ou égale à 3m.  lors du choix de la taille <b>ajouter 5<sub>cm</sub> à la largeur souhaitée de votre banderole.</b>',
  ourlpr: '<b>ourlet de renfort périmétrique: dès 0,50€/<sub>m</sub></b> pour un renfort optimal. Repli de 2,5cm de matière soudé en bordure pour renforcer votre banderole. recommandé dès 3m² ou longeur supérieure ou égale à 3m.  lors du choix de la taille <b>ajouter 5<sub>cm</sub> à la hauteur et la largeur de la banderole.</b>',
  fourhb: '<b>fourreaux en haut et en bas: dès 0,75€/m </b> Repli de 10cm de matière soudé en bordure, pour laisser passer une drisse (corde), tourillon, piquet de bois. Diamètre final 3,5cm. Lors du choix de la taille <b>ajouter 20cm à la hauteur de la banderole.</b>',
  fourgd: '<b>fourreaux à gauche et à droite: dès 0,75€/m </b> Repli de 10cm de matière soudé en bordure, pour laisser passer une drisse (corde), tourillon, piquet de bois. Diamètre final 3,5cm. Lors du choix de la taille <b>ajouter 20cm à la largeur de la banderole.</b>',
  scrahb: '<b>finition scratch: dès 2€/m</b> Une fixation scratch est cousue sur les côtés haut/bas de votre banderole. Fourni avec la face scratch opposée de même longueur à coller sur le support de votre choix.',
  scragd: '<b>finition scratch: dès 2€/m</b> Une fixation scratch est cousue sur les côtés gauche/droite de votre banderole. Fourni avec la face scratch opposée de même longueur à coller sur le support de votre choix.',
  scrapr: '<b>finition scratch: dès 2€/m</b>	Une fixation scratch est cousue sur tous les côtés de votre banderole. Fourni avec la face scratch opposée de même longueur à coller sur le support de votre choix.',

  //------------------------------------------------------ tooltips page roll-up

  firl: '<b>kakemono roll-up FIRSTLINE: dès 24€</b> le roll-up économique, léger et facile à installer',
  besl: '<b>kakemono roll-up BESTLINE: dès 40€</b> le kakemono roll-up Mosquito le plus vendu,  meilleur rapport qualité/prix de 60 à 200cm de large.',
  luxl: '<b>kakemono roll-up LUXLINE: dès 60€</b> le roll-up de luxe, plus stable et résistant, de 60 à 200cm jusqu\'à 300cm de haut !',
  dobl: '<b>kakemono roll-up RECTO/VERSO: dès 90€</b>  Rollup avec 2 visuels indépendants montés   ensemble ou seul. De 80 à 100cm de large.',
  mini: '<b>kakemono roll-up MINI: dès 24€</b>  le mini roll-up de comptoir, esthétique  et pas cher, disponible en A4 et A3.',
  mist: '<b>kakemono roll-up MISTRAL: dès 188€</b>  Le roll-up d’extérieur avec une résistance au vent  et possibilité d\'être fixé au sol.',
  visu: '<b>changement de visuel roll-up tous modèles:</b> commander uniquement le visuel imprimé sans la structure.',

  //-------------------------------------------------------- tooltips page totem

  xscr: '<b>Totem intérieur X-screen: Dès 9,90€</b> le X-banner le moins cher du marché, léger, robuste et facile à installer.',
  clip: '<b>Kakemono suspendu Clip\'it: Dès 8,50€</span></b> Toutes les tailles pour toutes vos suspensions, PLV, tête de gondole (crochet + nylon fourni).',
  kakt: '<b>Kakémono tissu: Dès 196,23€</b> Totem tissu avec sa structure en aluminium (grande visibilité des messages).',
  phto: '<b>Photocall: Dès 199,96€</b> Totem tissu ou PVC montage en 5 min sur votre stand structure alu robuste et légère. Sac de transport matelassé inclus !',
  bliz: '<b>Kakemono Extérieur Blizzard: Dès 149,00€</b> structure lestée stable pour visuel 60x160cm ou 80x200cm, pour vent jusqu\'à 40 km/h.',

  //---------------------------------------------------- tooltips page Oriflamme

  aile: '<b>oriflamme aile d\'avion: dès 34,00€</b> Voile personnalisée de forme courbée en haut, droite en bas. Ganse noire élastique renforcée. Vendu avec ou sans pied.',
  gout: '<b>beachflag goutte d\'eau: dès 34,00€</b> Voile imprimée en forme de pétale ou goutte d\'eau. Ganse noire élastique renforcée. Vendu avec ou sans pied.',
  wind: '<b>windflag rectangulaire: dès 29,00€</b> Voile imprimée rectangulaire. Ganse noire teintée masse ou Full graphic à partir de 10 ex. Vendu complet avec son pied.',
  gfvt: '<b>drapeau grand format vertical: dès 23,45€</b> Drapeau personnalisé avec une ganse renforcée à gauche et deux demi-lunes en plastique.',
  gfhz: '<b>drapeau grand format horizontal: dès 23,45€</b> Drapeau personnalisé avec une ganse renforcée à gauche et deux demi-lunes en plastique.',
  drap: '<b>drapeau à agiter: dès 15,90€</span></b> Drapeau personnalisé livré avec petit mât pvc.',

  rect: '<b>Impression recto simple, verso par transparence:</b> l\'impression recto standard avec le verso imprimé traversant par transparence (à l\'envers). Impression la plus répandue.',
  recv: '<b>Impression recto verso double voile :</b> Votre voile sera composé de 2 voiles imprimées + un occultant au centre, qui permet d\'imprimer des recto verso identiques ou différents et entièrement lisibles. <span class="highlight">ATTENTION :</span> de par sa composition la double voile recto/verso est lourde et doit donc être exposée en intérieur ou à de faibles vents en extérieur !',

  feu: 'Voile non inflammable B1',

  //------------------------------------------------------- tooltips page stands

  stdd: '<b>Stand tissu EasyQuick droit: - de 240€ en 3x3</b> LE meilleur stand parapluie textile 220g ou 260g robuste et facile à monter. Traité retardement feu, livré avec sac de transport à roulettes',
  stdc: '<b>Stand tissu EasyQuick courbé: - de 320€ en 3x3</b> stand parapluie textile courbé 220g ou 260g robuste et facile à monter. Traité retardement feu, livré avec sac de transport à roulettes',
  stde: '<b>Stand ExpoBag: Dès 530€</span></b> stand complet avec un mur d\'image 200x220cm en bâche PVC 520g M1 ou en tissu 220g M1 avec visuel 220x240cm + 2 roll-up + valise - comptoir d\'accueil avec tablette (visuel en tissu 220gr M1 ou en PVC 300µ) + présentoir documents 4 poches.',
  comp: '<b>Comptoir tissu EasyQuick: Dès 196€ !!!</b> Comptoir parapluie tissu léger, compact, facile à monter, textile prémonté qui reste en place lorsque la structure est repliée. Livré avec son sac de transport.',
  vali: '<b>Valise transformable: Dès 269€</b> valise à roulettes pouvant contenir un stand parapluie jusqu\'à 3x5. Avec sa tablette et un visuel personnalisé, elle se transforme en bank d\'accueil.',

  //------------------------------------------------------- tooltips page cadres

  cstd: '<b>Cadre tissu standard: Moins de 95,00 € livré</b> Le cadre tissu standard est composé de la structure et du visuel imprimé.',
  clum: '<b>cadre tissu lumineux: Dès 510,00€</b> Le cadre tissu lumineux est composé de la structure, du visuel imprimé et des LED.',
  cstr: '<b>Cadre stucture seule: Dès 61,00€</b> Stucture avec connecteur',
  ctis: '<b>Visuel (tissu imprimé): Dès 12,00€</b> Tissu imprimé avec jonc',

  //-------------------------------------------------------- tooltips page tente

  tent: '<b>Tente publicitaire personnalisable: </b> livrée complète : structure + toit + 4 frontons + sac de transport à roulette et tous les mur(s) et demi-mur(s) au choix. Professionnelle, légère, solide et facile à installer. Le barnum publicitaire sera teinté dans la couleur de base choisie : le toit, le frontons, les murs et demi-murs. Couleur bleue : proche pantone 286C, couleur rouge proche pantone 485C <b>Au choix de 2x2m au 3x6m : Dès 289,00€ impression + livraison comprises !</b>',

  mur1: '<b>Demi-mur supplémentaire: Dès 47,00€</b> 1/2 mur latéral personnalisable fourni avec barre de suspension.',
  mur2: '<b>Mur entier supplémentaire: Dès 29,00€</b> mur complet supplémentaire latéral personnalisable.',
  mur3: '<b>1 mur et 1 demi-mur en plus: Dès 66,00€</b> 1 mur complet + 1 demi-mur supplémentaires latéraux personnalisables fourni avec barre de suspension.',
  murx: '<b>Supprimer le mur de fond de base: </b> vous ne souhaitez que la structure, le toit, les frontons, et le sac de transport, sans mur.',
  murf: '<b>Sans option: </b> vous souhaitez la structure, le toit, les frontons, le mur de fond et le sac de transport sans mur supplémentaire.',

  pmfd: '<b>mur de fond personnalisé: Dès 147,00€</b> mur entier ou mur de fond imprimé en plus de la couleur de base.',
  pmdm: '<b>murs et demi-murs personnalisés: Dès 237,00€</b> Tous les murs et 1/2 murs seront imprimés en plus de la couleur de base',
  pful: '<b>tente publicitaire full graphic: Dès 332,00€</b>  Toute la tente publicitaire est personnalisable y compris les 4 frontons',


  gmfd: '<b>mur de fond personnalisé recto/verso: </b> mur entier ou mur de fond imprimé des deux côtés intérieur / extérieur.',
  gmdm: '<b>murs et demi-murs personnalisés recto/verso: </b> Tous les murs et 1/2 murs seront imprimés des deux côtés intérieur / extérieur',
  gful: '<b>tente publicitaire full graphic recto/verso: </b> Tous les murs et 1/2 murs seront imprimés des deux côtés intérieur / extérieur, les 4 frontons sont imprimés extérieur.',

  pfro: '<b>personnalisation frontons: Dès 121,00€</b> Personnalisez les 4 frontons de votre tente publicitaire.',
  pnop: '<b>pas de personnalisation: </b> Toute la tente publicitaire sera livrée dans la couleur choisie.',

  //--------------------------------------------------------- tooltips enseignes

  fxhd: '<b>Impression Haute définition :</b> impression directe UV HD 1200x1200Dpi. Pour une impression parfaite même de très près.',
  fxsd: '<b>Impression standard :</b> impression directe UV 600x600Dpi. Pour une impression pas cher de très bonne qualité à 1 mètre.',
  prca: '<b>Perçage:</b>	Nous perçons votre panneau forex pour faciliter sa pose.',
  lami: '<b>Pelliculage:</b> Nous posons un film de protecttion sur votre panneau forex. Ce pelliculage offre à votre support d’impression une protection optimale contre les éléments climatiques (abrasion, UV, rayures, vandalisme…). Vous aurez le choix entre une pelliculage brillant, mate, ou anti graffiti',
  pbri: '<b>Pelliculage brillant:</b> Le pelliculage brillant offre des couleurs plus vives et plus éclatantes.',
  pmat: '<b>Pelliculage mat:</b>	Le pelliculage mat rend les couleurs plus chaudes et évite les reflets au soleil ou aux néons.',
  pgrf: '<b>Pelliculage laqué brillant anti graffiti:</b>Composé à 100% de polyester d’une épaisseur de 36µ, ce pelliculage haut de gamme brillant offre à votre support d’impression une protection renforcé contre tous les éléments climatiques et extérieurs.',

  //------------------------------------------------------------ tooltips akilux

  oeil: '<b>Oeillets en nickel: Dès 0,1€</b> Oeillet laiton ou nickelé, ne rouille pas.',
  croc: '<b>Crochets invisibles: Dès 0,1€</b> crochet adhésif transparent pour intérieur.',
  risl: '<b>Rislans: Dès 0,02€</b> mini collier plastique blanc 34x140mm.',
  tape: '<b>Double face: Dès 0,3€</b> 4 rectangles double face au dos dans les coins.',
  rain: '<br />Le rainage ou rainurage est une suppression ou écrasement de matière pour créer une pliure droite dans un matériau.',
  rai1: '<b>1 rainage: dès 0,25€</b> pour panneaux akilux sandwichs.',
  rai2: '<b>2 rainages: dès 0,25€</b> pour faire des triptyques.',
  rai3: '<b>3 rainages: dès 0,25€</b> pour faire des encadrements.',

  //---------------------------------------------------------- tooltips stickers

  vype: '<b>vinyle blanc permanent 95μ monomère garanti 3 ans</b>', // permanent
  vysp: '<b>vinyle blanc semi-permanent 95μ monomère garanti 2 ans</b>', // semi permanent
  vymp: '<b>vinyle micro-perforé M1 dos noir garanti 2 ans</b>', // micro perforé
  vy75: '<b>vinyle blanc permanent 75μ polymère garanti 5 ans</b>', // 75 microns
  vymg: '<b>vinyle magnétique 500μ</b>', // magnétique
  vytr: '<b>vinyle transparent</b>', // transparent
  vyst: '<b>Stickytex</b> Support indéchirable et imperméable pouvant être retiré et repositionné sans endommager le mur ni laisser aucun résidu.',
  decs: '<b>Découpe simple: Dès 60€/m²</b> votre sticker est prédécoupé suivant une forme simple, carrée ou rectangulaire.',
  decc: '<b>Découpe contour: Dès 75€/m²</b> votre sticker est prédécoupé suivant le contour du motif.',

  //------------------------------------------------------------ tooltips papier

  port: 'votre gabarit apparaitra au format portrait (vertical) dans l\'application de création de maquette en ligne',
  pays: 'votre gabarit apparaitra au format paysage (horizontal) dans l\'application de création de maquette en ligne',

  flyr: '<b>Flyer:</b> Flyer A7 A6 A5 A4 A3 DinLong recto ou recto/verso - Impression quadri CMJN',
  depl: '<b>Dépliant:</b> 1 pli ou 2 plis - Impression quadri CMJN',
  // types de papier
  p80g: '<b>papier 80g/m²:  Dès 3,72€ les 500ex</b> papier type imprimante 80g/m², mat.',
  p135: '<b>papier 135g/m²: Dès 4,81€ les 500ex</b> le meilleur papier flyer pas cher.',
  p170: '<b>papier 170g/m²: Dès 5,91€ les 500ex</b> papier flyers légers haut de gamme.',
  p250: '<b>papier 250g/m²: Dès 7,00€ les 500ex</b> papier flyers épais haut de gamme.',
  p350: '<b>papier 350g/m²: Dès 8,09€ les 500ex</b> papier flyer cartonné haut de gamme.',
  // indéchirable
  i120: '',
  i270: '',
  i350: '',
};

//================================================================================================//
// fonctions partagées par les pages produits :               FONCTIONS GLOBALES                  //
//================================================================================================//

// fonction globale :                                       calculs jours ouvrés
//==============================================================================
function AddBusinessDays(weekDaysToAdd) {
    var curdate = new Date();
    var realDaysToAdd = 0;
    for (i=0; i<weekDaysToAdd; i++) {
      curdate.setDate(curdate.getDate()+1);
      var estdt1 = new Date(curdate);
      var n = curdate.getDay();
      if (n == '6' || n == '0') {
        weekDaysToAdd++;
      }
      realDaysToAdd++;
    }
    return realDaysToAdd;
}

// fonction globale :                            conversion blob to base64 image
//==============================================================================
function saveBlobAsFile(blob, fileName) {
    return new Promise(function (resolve, reject) {
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onload = function () {
        return resolve(reader.result);
      };
      reader.onerror = function (error) {
        return reject(error);
      };
      return Promise.resolve(reader.result);
    });
}

// fonction globale :                                      générer image produit
//==============================================================================
function genImg() {
  $('.helpMenu').css('display','none');

    var clone = document.getElementById('previewImg').cloneNode(true);
    clone.setAttribute("style", "width: 160px; height: 160px; padding: 0;");
    document.body.appendChild(clone);

    if(!document.documentMode){ // ne pas charger ce script sous IE
      domtoimage.toBlob(clone).then(function (blob) {
        clone.remove();
        saveBlobAsFile(blob, "XX.png").then(function (data) {
          var cartForm = document.getElementById('cartData');
          var input = document.createElement("input");
          input.setAttribute("type", "hidden");
          input.setAttribute("name", "image");
          input.setAttribute("value", data);
          cartForm.appendChild(input);
          //console.log(input);
        });
      });
    }
}


jQuery(document).ready(function ($) {

  // fonction globale ($)                                            zoom images
  //============================================================================

  $('#zoomImg')
    .on('mouseover', function(){
      $('#zoomImg').css({'transform': 'scale(2.5)', 'transition': '.2s'});
  })
    .on('mouseout', function(){
      $('#zoomImg').css({'transform': 'scale(1)', 'transition': '.2s'});
  })
    .on('mousemove', function(e){
      $('#zoomImg').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
  });

  // fonction globale ($)                  fly to cart : effet image vers panier
  //============================================================================
  function flyToElement(flyer, flyingTo) {

    var $func = $(this);
    var divider = 3;
    var flyerClone = $(flyer).clone();
    var startpoint = '#submit_cart';

    $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;

    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyer).width()/divider,
        height: $(flyer).height()/divider
    }, 1000,

    function () {
        $(flyingTo).fadeOut('fast', function () {
            $(flyingTo).fadeIn('fast', function () {
                $(flyerClone).fadeOut('fast', function () {
                    $(flyerClone).remove();
                });
            });
        });
    });
  } // fin fly to cart

// fonction globale (ajax)                                     ajouter au panier
//==============================================================================
  var frm = $('#cartData');
  frm.submit(function (e) {
      e.preventDefault();
      //-------- Selectionner une image pour la faire glisser vers le panier

      var itemImg = $('#previewImg');

      flyToElement($(itemImg), $('.menu-client--panier'));
      $('.loader').show();

      $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),

        success: function (data) {

          //--------------------------------------------------------- update dom
          $("#nomp").load("index.php #nomp");
          $("#menuPanier").load("index.php #menuPanier");
        },

        complete: function(data) {
          $('.loader').hide();
          // --------------------------------- afficher la popup de confrimation
          setTimeout(function(){
            $.magnificPopup.open({
                  items: {
                      src: '#cartConfirm',
                  },
                  type: 'inline'
            });
          }, 700);
        },

        error: function (data) {
          alert('une erreur s\'est produite, veuillez réessayer.');
        },
      });
  }); // fin submit cart
}); // fin doc ready
