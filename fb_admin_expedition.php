<?php

/*
  Lecture du code barre 2/5 entrelacé.
  Générateur de code barre 2/5 entrelacé (2 of 5 interleaved) :http://generator.onbarcode.com/online-interleaved-25-barcode-generator.aspx
 */

/**
 * Cree la base de donnees des expedition
 * @global type $wpdb
 */
 
function createTable() {
    global $wpdb;
    $wpdb->show_errors();
    $sql_drop = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "expedition`;";
    $sql_create = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "expedition` ( `id` int AUTO_INCREMENT, `n_cmd` varchar(100) NULL, `nb_t_colis` smallint(11) NULL, `nb_s_colis` smallint(11) NULL, `date_jours` date NULL, `status` int NULL, msgstatus varchar(255), PRIMARY KEY (`id`) );";
    //$wpdb->query($sql_drop); //ATTENTION : cette ligne supprimer la table.
    $wpdb->query($sql_create);
}

/**
 * Affiche un message selon le type
 * @param type $msg
 * @param type $gras
 * @param type $style
 * @param type $type
 */
function addMsg($msg, $gras, $style = "", $type = "") {
    $imagespath = get_bloginfo("url") . '/wp-content/plugins/fbshop/images/';
    switch ($type) {
        case  1: echo "<h1 " . $style . ">" . $msg . "<strong>" . $gras . "</strong></h1>"; break;
        case  2: echo "<h2 " . $style . ">" . $msg . "<strong>" . $gras . "</strong></h2>"; break;
        case  3: echo "<h3 " . $style . ">" . $msg . "<strong>" . $gras . "</strong></h3>"; break;
        case  4: echo "<h4 " . $style . ">" . $msg . "<strong>" . $gras . "</strong></h4>"; break;
        case  5: echo "<h5 " . $style . ">" . $msg . "<strong>" . $gras . "</strong></h5>"; break;
        case  6: echo "<span " . $style . ">" . $msg . "<strong>" . $gras . "</strong></span>"; break;
        case  7: echo "<pre>" . $msg . "</pre>"; break;
        case  8: echo "<img src='" . $imagespath . $msg . "' " . $style . " />"; break;
        default: echo "<p " . $style . ">" . $msg . "<strong>" . $gras . "</strong></p>"; break;
    }
}

/**
 * Renvoi le status de la commande
 * @param type $status => array(style, text)
 * @return type
 */
function getStatus($status) {
    switch ($status) {
        case 0: return array('style' => ' style="background:#FF0000;"', 'text' => "attente"); break;
        case 1: return array('style' => ' style="background:#FF0000;"', 'text' => "attente paiement"); break;
        case 2: return array('style' => ' style="background:#FF0000;"', 'text' => "payé"); break;
        case 3: return array('style' => ' style="background:#03AD1A;"', 'text' => "traitement"); break;
        case 4: return array('style' => ' style="background:#FF0000;"', 'text' => "expédié"); break;
        case 5: return array('style' => ' style="background:#FF0000;"', 'text' => "cloturé"); break;
        case 6: return array('style' => ' style="background:#FF0000;"', 'text' => "annulées"); break;
    }
}

function getStatMsg($status) {
    switch($status) {
        case 0 : return "<span style='font-weight: 700;'>Erreur</span>";
        case 1 : return "<span style='font-weight: 700;'>Nombre de colis incomplet</span>";
        case 2 : return "<span style='font-weight: 700;'>Expédiée</span>";
        case 3 : return "<span style='font-weight: 700;'>Déja expédiée</span>";
            
        case 101 : return "<span style='font-weight: 700;'>Etat : attente</span>";
        case 102 : return "<span style='font-weight: 700;'>Etat : attente paiement</span>";
        case 103 : return "<span style='font-weight: 700;'>Etat : payé</span>";
        case 104 : return "<span style='font-weight: 700;'>Etat : cloturé</span>";
        case 105 : return "<span style='font-weight: 700;'>Etat : annulées</span>";
            
        case 106 : return "<span style='font-weight: 700;'>Nombre de colis incomplet</span>";
        case 107 : return "<span style='font-weight: 700;'>Nombre de colis non renseignée</span>";
            
        case 108 : return "<span style='font-weight: 700;'>Numero de tracking manquant</span>";
    }
}

/**
 * Affiche le tableau du resumer
 * @global type $wpdb
 */
function showTableStat() {
    global $wpdb;
    $wpdb->show_errors();
    $prefix = $wpdb->prefix;
    $sql = " select * from " . $prefix . "expedition where date_jours = DATE(now());";
    $rows = $wpdb->get_results($sql);
    //if (!$rows) return "";
    ?>
        <table class="widefat" style="width: 90%; margin: 0 auto;">
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Date</th>
                    <th>Nombre total de colis</th>
                    <th>Nombre de colis expédié</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows) : ?>
                    <?php foreach($rows as $row) : ?> 
                    <tr style="background-color: <?php if ($row->status != 2) { ?> #FFC0CB <?php } else { ?> #90EE90 <?php } ?>;">
                        <td style="color: #000;"><?php echo $row->n_cmd; ?></td>
                        <td style="color: #000;"><?php echo $row->date_jours; ?></td>
                        <td style="color: #000;"><?php echo $row->nb_t_colis; ?></td>
                        <td style="color: #000;"><?php echo $row->nb_s_colis; ?></td>
                        <td style="color: #000;"><?php echo getStatMsg($row->status); ?></td>
                    </tr>
                    <?php endforeach; ?> 
                <?php else: ?>
                    <tr>
                        <td colspan="4" style='text-align: center; font-weight: 700; color: red;'>Pas d'enregistrement !!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th style="font-weight: bold;">Nombre total de commandes: </th>
                    <th style="font-weight: bold;"><?php echo $wpdb->num_rows; ?></th>
                </tr>
            </tfoot>
        </table>
    <?php
}

/**
 * Ajoute ou Modifier une ligne dans la table des expeditions
 * @global type $wpdb
 * @param type $nCmd
 * @param type $nbTColis
 * @param type $nbSColis
 * @param type $status : 
 *                      1 - En attente
 *                      2 - Expédiée
 *                      3 - Déja expédiée
 *                      0 - Error
 */
function archive($nCmd, $nbTColis, $nbSColis, $status, $msg = "") {
    global $wpdb;
    $wpdb->show_errors();
    $sql1 = "select id from " . $wpdb->prefix . "expedition where n_cmd='" . $nCmd . "' and date_jours = DATE(now()) ";
    //echo $sql1 . "<br/>";
	//mail("contact@tempopasso.com","archive //","nCmd=".$nCmd." // sql1=".$sql1." // number=".$number." ///// ".print_r("",true));	
    if ($id = $wpdb->get_var($sql1)) {
        $sql3 = "update " . $wpdb->prefix . "expedition set nb_t_colis = '" . $nbTColis . "', nb_s_colis = '" . $nbSColis . "', status='" . $status . "' where id='" . $id . "'";
		//mail("contact@tempopasso.com","archive //","nCmd=".$nCmd." // sql3=".$sql3." // number=".$number." ///// ".print_r("",true));
        $wpdb->query($sql3);
        //echo $sql3 . "<br/>";
    } else {
        $sql2 = "insert into " . $wpdb->prefix . "expedition (n_cmd, nb_t_colis, nb_s_colis, date_jours, status) values ('" . $nCmd . "', '" . $nbTColis . "', '" . $nbSColis . "', now(), '" . $status . "')";
		//mail("contact@tempopasso.com","archive //","nCmd=".$nCmd." // sql2=".$sql2." // number=".$number." ///// ".print_r("",true));
        $wpdb->query($sql2);
        //echo $sql2 . "<br/>";
    }
	
}

/**
 * Processus des expéditions
 * @global type $wpdb
 */
function fb_admin_expedition() {

    ob_start();
    createTable();
    global $wpdb;
	$code_fin_expedition = '99999999';
    $prefix = $wpdb->prefix;
    $fb_tablename_order = $prefix . "fbs_order";
    $fb_tablename_prods = $prefix . "fbs_prods";
    $fb_tablename_users = $prefix . "fbs_users";
    $fb_tablename_users_cf = $prefix . "fbs_users_cf";

    $confirmation_ecrasement = false;
    if (isset($_POST['scanbarcode2'])) {
        if (isset($_POST['scanbarcode']) && trim($_POST['scanbarcode2']) == trim($_POST['scanbarcode'])) {
            $confirmation_ecrasement = true;
        } else {
            $_POST['scanbarcode'] = "";
            unset($_POST);
        }
    }
    
    $isFinal = false;
    
    if (isset($_POST['scanbarcode'])) {
        $code = $_POST['scanbarcode'];
		$pos = strpos($code, '000');
		if ($pos !== false) {
			$code = substr($code,1,strlen($code));
		}
		$pos = strpos($code, '0000');
		if ($pos !== false) {
			$code = substr($code,2,strlen($code));
		}		
        if ($code == $code_fin_expedition) {
            //cloture
            addMsg("Clôture : ", date('d/m/Y'));
            showTableStat();
            $isFinal = true;
            goto fin;
        }
        
        addMsg("Le code barre scanné est : ", $code, "", 2);
		
		/* On check que le colis n'a pas déjà été scanné (nb colis expédié = nb total de colis ET Message == 2 */
		$colis_check = $wpdb->get_row("SELECT * from wp_expedition where n_cmd='" . $code . "' and date_jours=DATE(now());");
		if(($colis_check -> nb_t_colis == $colis_check -> nb_s_colis) && ($colis_check -> status == 2) ){
			/* Colis déjà envoyé : tous les cartons nécessaires ont été scannés. */
            addMsg('Ancien statut: ', $stat['text'], "style='background-color: red;'", 2);
            addMsg("Nombre de colis à expédier ", " déjà ATTEINT ", "style='color: red; line-height: 20px;'", 4);
            addMsg("red_cross.png", "", " style='float: right;width:150px;'", 8);
			goto fin;
			
		}
		
		

        //$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE CONVERT(`tnt` USING utf8) LIKE '%%$code%%'");
        $order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE `unique_id` = '$code'");
        //addMsg(print_r($order), "", "", 7);
        if ($order != null) {
            $stat = getStatus($order->status);

            addMsg('Numéro de commande: ', $order->unique_id, "", 2);
            

            if ($order->status == 3 || $confirmation_ecrasement) {
                if ($order->tnt == "" || strlen($order->tnt) < 1) {
                    archive($code, -1, -1, 108);
                    addMsg('Ancien statut: ', $stat['text'], "style='background-color: red;width:150px;'", 2);
                    addMsg("Erreur : Numero de tracking manquant.", "", "style='color:red;width:150px;'", 4);
                    addMsg("red_cross.png", "", " style='float: right;width:150px;'", 8);
                } else {
                    $colis = $wpdb->get_var("select value from wp_fbs_cf where unique_id='" . $code . "' and type='nbcolis'");
                    if ($colis) {
                        if ($colis == 1) {
                            archive($code, $colis, $colis, 2);
                            /* Traitement de la commande en expédié avec les envoi de mails et ajout de commentaires */
                            $number = stripslashes($order->unique_id);
                            $fb_tablename_order = 'wp_fbs_order';
                            $fb_tablename_topic = 'wp_fbs_topic';
                            $fb_tablename_mails = 'wp_fbs_mails';
                            $fb_tablename_comments = 'wp_fbs_comments';
                            $fb_tablename_comments_new = 'wp_fbs_comments_new';
                            $fb_tablename_cf = 'wp_fbs_cf';
                            $fb_tablename_users = 'wp_fbs_users';
                            $fb_tablename_address = 'wp_fbs_address';
                            traitement_passage_expedie($number, $fb_tablename_order, $fb_tablename_topic, $fb_tablename_mails, $fb_tablename_comments, $fb_tablename_comments_new, $fb_tablename_cf, $fb_tablename_users, $fb_tablename_address);
                            addMsg('Ancien statut: ', $stat['text'], $stat['style'], 2);
                            addMsg("Passage au process : ", "Commande Expédiée", "style='color:green; width:150px;'", 2);
                            addMsg("green_tick.png", "", " style='float: right;width:150px;'", 8);
                        } else {
                            $sColis = $wpdb->get_var("select nb_s_colis from wp_expedition where n_cmd='" . $code . "' and date_jours=DATE(now());");
                            if ($sColis) {
                                if (($sColis+1) == $colis) {
                                    archive($code, $colis, $sColis+1, 2);
                                    
                                    /* Traitement de la commande en expédié avec les envoi de mails et ajout de commentaires */
                                    $number = stripslashes($order->unique_id);
                                    $fb_tablename_order = 'wp_fbs_order';
                                    $fb_tablename_topic = 'wp_fbs_topic';
                                    $fb_tablename_mails = 'wp_fbs_mails';
                                    $fb_tablename_comments = 'wp_fbs_comments';
                                    $fb_tablename_comments_new = 'wp_fbs_comments_new';
                                    $fb_tablename_cf = 'wp_fbs_cf';
                                    $fb_tablename_users = 'wp_fbs_users';
                                    $fb_tablename_address = 'wp_fbs_address';
                                    traitement_passage_expedie($number, $fb_tablename_order, $fb_tablename_topic, $fb_tablename_mails, $fb_tablename_comments, $fb_tablename_comments_new, $fb_tablename_cf, $fb_tablename_users, $fb_tablename_address);
                                    
                                } elseif ($sColis < $colis) {
                                    archive($code, $colis, $sColis+1, 1);
                                }
                                addMsg('Ancien statut: ', $stat['text'], $stat['style'], 2);
                                addMsg("Passage au process : ", "Commande Expédiée", "style='color:green;'");
                                addMsg("green_tick.png", "", " style='float: right;width:150px;'", 8);
                            } else {
                                archive($code, $colis, 1, 1);
                                addMsg('Ancien statut: ', $stat['text'], $stat['style'], 2);
                                addMsg("Passage au process : ", "Commande Expédiée", "style='color:green;'");
                                addMsg("green_tick.png", "", " style='float: right;width:150px;'", 8);
                            }
                        }
                    } else {
                        archive($code, -1, -1, 107);
                        addMsg('Ancien statut: ', $stat['text'], "style='background-color: red;'", 2);
                        addMsg("nombre de colis ", " non renseigné ", "style='color: red; line-height: 20px;'", 4);
                        addMsg("red_cross.png", "", " style='float: right;width:150px;'", 8);
                    }
                }
            } else {
                switch ($order->status) {
                    case 0: archive($code, -1, -1, 101); break;
                    case 1: archive($code, -1, -1, 102); break;
                    case 2: archive($code, -1, -1, 103); break;
                    case 5: archive($code, -1, -1, 104); break;
                    case 6: archive($code, -1, -1, 105); break;
                    case 4: archive($code, -1, -1, 3); break;
                    default: archive($code, -1, -1, 0); break;
                }
                addMsg('Ancien statut: ', $stat['text'], $stat['style'], 2);
                addMsg("Erreur : Commande en l'etat ", $stat['text'], $stat['style']);
                addMsg("red_cross.png", "", " style='float: right;width:150px;'", 8);
            }
        } else {
            addMsg("Aucune commande n'est retrouvée avec le numéro de code barre suivant : ", $code, "style='color:red; width:150px; line-height: 20px;'", 3);
            addMsg("red_cross.png", "", " style='float: right;width:150px;'", 8);
        }
    }

    fin:
    if ($isFinal) {
        $data = ob_get_clean();
        $form = file_get_contents(getTplPath('expedition.php'));
        $html = str_replace('$$CONTENT$$', $data, $form);
        
        $page = "<html>
                    <head>
                        <meta charset='UTF-8'/>
                        <title>Clôture : " . date('d/m/Y') . "</title>";
        $page .= "      <style>
                            .widefat td,.widefat th{overflow:hidden;color:#555}.widefat th{font-weight:400}.widefat tfoot tr th,.widefat thead tr th{color:#333}.widefat td p{margin:2px 0 .8em}.widefat ol,.widefat p,.widefat ul{color:#333}.widefat .column-comment p{margin:.6em 0}
                            .postbox table.widefat{-webkit-box-shadow:none;box-shadow:none}#menu-management .menu-edit,#menu-settings-column .accordion-container,.feature-filter,.imgedit-group,.manage-menus,.menu-item-handle,.popular-tags,.stuffbox,.widget-inside,.widget-top,.widgets-holder-wrap,.wp-editor-container,p.popular-tags,table.widefat{border:1px solid #e5e5e5;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.04);box-shadow:0 1px 1px rgba(0,0,0,.04)}.feature-filter,.imgedit-group,.popular-tags,.stuffbox,.widgets-holder-wrap,.wp-editor-container,p.popular-tags,table.widefat{background:#fff}.widefat{border-spacing:0;width:100%;clear:both;margin:0}.widefat *{word-wrap:break-word}.widefat a{text-decoration:none}.widefat td,.widefat th{padding:8px 10px}.widefat thead th{border-bottom:1px solid #e1e1e1}.widefat tfoot th{border-top:1px solid #e1e1e1;border-bottom:none}.widefat .no-items td{border-bottom-width:0}.widefat td{vertical-align:top}.widefat td,.widefat td ol,.widefat td p,.widefat td ul{font-size:13px;line-height:1.5em}.widefat th{text-align:left;line-height:1.3em;font-size:14px}.widefat th input{margin:0 0 0 8px;padding:0;vertical-align:text-top}.widefat .check-column{width:2.2em;padding:6px 0 25px;vertical-align:top}.widefat th input[type=checkbox]{margin-top:-1px}.widefat.media .check-column{padding-top:8px}.widefat tbody th.check-column,.widefat tfoot th.check-column,.widefat thead th.check-column{padding:11px 0 0 3px}.widefat thead th.check-column{padding-top:10px}.update-php div.error,.update-php div.updated{margin-left:0}.no-js .widefat tfoot .check-column input,.no-js .widefat thead .check-column input{display:none}.column-comments,.column-links,.column-posts,.widefat .num{text-align:center}.widefat th#comments{vertical-align:middle}
                            body > p { font-size: 18px; }
                        </style>
                    </head>";
        $page .= "  <body  style='background: #EFEFEE;'>" . $data . "</body>";
        $page .= "</html>";
        
        file_put_contents( WP_PLUGIN_DIR . '/fbshop/expeditions/ST' . date('dmY') . '.html', $page);
        
        wp_mail('info@france-banderole.fr', 'Clôture Expéditions du ' . date('d/m/Y'), $page, array('Content-Type: text/html; charset=UTF-8'));
        
        echo $data;
    } else {
        $form = file_get_contents(getTplPath('expedition.php'));
        $html = str_replace('$$CONTENT$$', ob_get_clean(), $form);
        echo $html;
    }
}

?>