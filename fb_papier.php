<?php

function get_papier_form() {
	$form = '
<div id="buying">
<form class="jotform-form" action="" method="post" name="form_1060900223" id="1060900223" accept-charset="utf-8" onsubmit="JKakemono.cal_papier(); return false;">
    <input type="hidden" name="formID" value="1060900223" />
    <div class="form-all">
        <ul class="form-section">
            <li class="form-line" id="id_1">
                <label class="form-label-left" id="label_1" for="input_1">type:</label>
                    <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="Affiches">Affiches </option>
                        <option value="Cartes">Cartes de visites </option>
                        <option value="Flyers">Flyers </option>
                        <option value="Dépliants">Dépliants </option>
                    </select>
            </li>
            <li class="form-line" id="id_2">
                <label class="form-label-left" id="label_2" for="input_2">format:</label>
                    <select class="form-dropdown validate[required]" id="input_2" name="q2_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1">A6 (10 x 15 cm) Recto | CB. 135g. Coupe | Quadri </option>
                        <option value="2">A6 (10 x 15 cm) Recto/Verso | CB. 135g. Coupe | Quadri </option>
                        <option value="3">A6 (10 x 15 cm) Recto/Verso | CB. 350g. Coupe | Quadri </option>
                        <option value="4">A6 (10 x 15 cm) Recto/Verso | CB. 350g. Coupe, Pelliculage | Quadri </option>
                        <option value="5">10 x 20 cm Recto | CB. 135g. Coupe | Quadri </option>
                        <option value="6">10 x 20 cm Recto/Verso | CB. 135g. Coupe | Quadri </option>
                        <option value="7">10 x 20 cm Recto/Verso | CB. 350g. Coupe | Quadri </option>
                        <option value="8">10 x 20 cm Recto/Verso | CB. 350g. Coupe, Pelliculage | Quadri </option>
                        <option value="9">A5 (15 x 21 cm) Recto | CB. 135g. Coupe | Quadri </option>
                        <option value="10">A5 (15 x 21 cm) Recto/Verso | CB. 135g. Coupe | Quadri </option>
                        <option value="11">A5 (15 x 21 cm) Recto/Verso | CB. 350g. Coupe | Quadri </option>
                        <option value="12">A5 (15 x 21 cm) Recto/Verso | CB. 350g. Coupe, Pelliculage | Quadri </option>
                        <option value="13">20 x 20 cm Recto/Verso | CB. 135g. Coupe | Quadri </option>
                        <option value="14">20 x 20 cm Recto/Verso | CB. 350g. Coupe | Quadri </option>
                        <option value="15">20 x 20 cm Recto/Verso | CB. 350g. Coupe, Pelliculage | Quadri </option>
                        <option value="16">A4 (21 x 29.7 cm) Recto | CB. 135g. Coupe | Quadri </option>
                        <option value="17">A4 (21 x 29.7 cm) Recto/Verso | CB. 135g. Coupe | Quadri </option>
                        <option value="18">A4 (21 x 29.7 cm) Recto/Verso | CB. 350g. Coupe | Quadri </option>
                        <option value="19">A4 (21 x 29.7 cm) Recto/Verso | CB. 350g. Coupe, Pelliculage | Quadri </option>
                    </select>
            </li>
            <li class="form-line" id="id_3">
                <label class="form-label-left" id="label_3" for="input_3">format:</label>
                    <select class="form-dropdown validate[required]" id="input_3" name="q3_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1">A5 (15 x 21 cm) | CB. 135g. / 4 pages | Quadri Recto/Verso Pliage </option>
                        <option value="2">A5 (15 x 21 cm) | CB. 170g. / 4 pages | Quadri Recto/Verso Pliage </option>
                        <option value="3">20 x 20 cm | CB. 135g. / 4 pages | Quadri Recto/Verso Pliage </option>
                        <option value="4">20 x 20 cm | CB. 170g. / 4 pages | Quadri Recto/Verso Pliage </option>
                        <option value="5">A4 (21 x 29.7 cm) | CB. 135g. / 4 ou 6 pages | Quadri Recto/Verso Pliage </option>
                        <option value="6">A4 (21 x 29.7 cm) | CB. 170g. / 4 ou 6 pages | Quadri Recto/Verso Pliage </option>
                        <option value="7">A3 (29.7 x 42 cm) | CB. 135g. / 4 ou 6 pages | Quadri Recto/Verso Pliage </option>
                        <option value="8">A3 (29.7 x 42 cm) | CB. 170g. / 4 ou 6 pages | Quadri Recto/Verso Pliage </option>
                    </select>
            </li>
            <li class="form-line" id="id_4">
                <label class="form-label-left" id="label_4" for="input_4">maquette:</label>
                    <select class="form-dropdown validate[required]" id="input_4" name="q4_maquette4" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="fb">France banderole crée la maquette</option>
                        <option value="user">j’ai déjà crée la maquette </option>
                    </select>
            </li>
            <li class="form-line" id="id_5">
                <label class="form-label-left" id="label_5" for="input_5">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_5" name="q5_maquette5" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2500">2500 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="50000">50000 </option>
                        <option value="75000">75000 </option>
                        <option value="100000">100000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_6">
                <label class="form-label-left" id="label_6" for="input_6">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_6" name="q6_maquette6" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="11000">11000 </option>
                        <option value="12000">12000 </option>
                        <option value="13000">13000 </option>
                        <option value="14000">14000 </option>
                        <option value="15000">15000 </option>
                        <option value="16000">16000 </option>
                        <option value="17000">17000 </option>
                        <option value="18000">18000 </option>
                        <option value="19000">19000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="35000">35000 </option>
                        <option value="40000">40000 </option>
                        <option value="45000">45000 </option>
                        <option value="50000">50000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_7">
                <label class="form-label-left" id="label_7" for="input_7">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_7" name="q7_maquette7" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="7000">7000 </option>
                        <option value="10000">10000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="50000">50000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_8" style="position:relative;float:left;display:inline;width:376px;height:22px;padding-top:13px;color:#272727;border-bottom:1px solid #9fa3a8;">
                <label class="form-label-left" id="label_8" for="input_8">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_8" name="q8_maquette8" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="7000">7000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="50000">50000 </option>
                    </select>
            </li>
            <li id="id_9" class="form-line" style="position:relative;float:left;display:inline;width:376px;height:22px;padding-top:13px;color:#272727;border-bottom:1px solid #9fa3a8;">
                <label class="form-label-left" id="label_9" for="input_9">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_9" name="q9_maquette9" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="11000">11000 </option>
                        <option value="12000">12000 </option>
                        <option value="13000">13000 </option>
                        <option value="14000">14000 </option>
                        <option value="15000">15000 </option>
                        <option value="16000">16000 </option>
                        <option value="17000">17000 </option>
                        <option value="18000">18000 </option>
                        <option value="19000">19000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_10">
                <label class="form-label-left" id="label_10" for="input_10">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_10" name="q10_maquette10" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="50000">50000 </option>
                        <option value="100000">100000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_11">
                <label class="form-label-left" id="label_11" for="input_11">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_11" name="q11_maquette11" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_12">
                <label class="form-label-left" id="label_12" for="input_12">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_12" name="q12_maquette12" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_13">
                <label class="form-label-left" id="label_13" for="input_13">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_13" name="q13_maquette13" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2500">2500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="7000">7000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="35000">35000 </option>
                        <option value="40000">40000 </option>
                        <option value="45000">45000 </option>
                        <option value="50000">50000 </option>
                        <option value="100000">100000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_14">
                <label class="form-label-left" id="label_14" for="input_14">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_14" name="q14_maquette14" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="11000">11000 </option>
                        <option value="12000">12000 </option>
                        <option value="13000">13000 </option>
                        <option value="14000">14000 </option>
                        <option value="15000">15000 </option>
                        <option value="16000">16000 </option>
                        <option value="17000">17000 </option>
                        <option value="18000">18000 </option>
                        <option value="19000">19000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_15">
                <label class="form-label-left" id="label_15" for="input_15">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_15" name="q15_maquette15" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_16">
                <label class="form-label-left" id="label_16" for="input_16">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_16" name="q16_maquette16" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_17">
                <label class="form-label-left" id="label_17" for="input_17">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_17" name="q17_maquette17" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="2500">2500 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="50000">50000 </option>
                        <option value="750000">750000 </option>
                        <option value="100000">100000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_18">
                <label class="form-label-left" id="label_18" for="input_18">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_18" name="q18_maquette18" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_19">
                <label class="form-label-left" id="label_19" for="input_19">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_19" name="q19_maquette19" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_20">
                <label class="form-label-left" id="label_20" for="input_20">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_20" name="q20_maquette20" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="11000">11000 </option>
                        <option value="12000">12000 </option>
                        <option value="13000">13000 </option>
                        <option value="14000">14000 </option>
                        <option value="15000">15000 </option>
                        <option value="16000">16000 </option>
                        <option value="17000">17000 </option>
                        <option value="18000">18000 </option>
                        <option value="19000">19000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_21">
                <label class="form-label-left" id="label_21" for="input_21">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_21" name="q21_maquette21" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2500">2500 </option>
                        <option value="5000">5000 </option>
                        <option value="7000">7000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="25000">25000 </option>
                        <option value="30000">30000 </option>
                        <option value="35000">45000 </option>
                        <option value="40000">40000 </option>
                        <option value="45000">45000 </option>
                        <option value="50000">50000 </option>
                        <option value="75000">75000 </option>
                        <option value="100000">100000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_22">
                <label class="form-label-left" id="label_22" for="input_22">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_22" name="q22_maquette22" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_23">
                <label class="form-label-left" id="label_23" for="input_23">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_23" name="q23_maquette23" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_24">
                <label class="form-label-left" id="label_24" for="input_24">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_24" name="q24_maquette24" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_25">
                <label class="form-label-left" id="label_25" for="input_25">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_25" name="q25_maquette25" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_26">
                <label class="form-label-left" id="label_26" for="input_26">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_26" name="q26_maquette26" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_27">
                <label class="form-label-left" id="label_27" for="input_27">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_27" name="q27_maquette27" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_28">
                <label class="form-label-left" id="label_28" for="input_28">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_28" name="q28_maquette28" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_29">
                <label class="form-label-left" id="label_29" for="input_29">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_29" name="q29_maquette29" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_30">
                <label class="form-label-left" id="label_30" for="input_30">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_30" name="q30_maquette30" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_31">
                <label class="form-label-left" id="label_31" for="input_31">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_31" name="q31_maquette31" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="6000">6000 </option>
                        <option value="7000">7000 </option>
                        <option value="8000">8000 </option>
                        <option value="9000">9000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                    </select>
            </li>




            <li class="form-line" id="id_221">
                <label class="form-label-left" id="label_221" for="input_221">format:</label>
                    <select class="form-dropdown validate[required]" id="input_221" name="q221_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1">17 x 50 cm </option>
                        <option value="2">A4(21 x 29.7 cm) </option>
                        <option value="3">A3 (29.7 x 42 cm) </option>
                        <option value="4">35 x 50 cm </option>
                        <option value="5">A2 (40 x 60 cm) </option>
                        <option value="6">50 x 70 cm </option>
                        <option value="7">A1 (60 x 80 cm) </option>
                        <option value="8">70 x 100 cm </option>
                    </select>
            </li>
            <li class="form-line" id="id_222">
                <label class="form-label-left" id="label_222" for="input_222">maquette:</label>
                    <select class="form-dropdown validate[required]" id="input_222" name="q222_maquette222" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="fb">France banderole crée la maquette</option>
                        <option value="user">j’ai déjà crée la maquette </option>
                    </select>
            </li>
            <li class="form-line" id="id_223">
                <label class="form-label-left" id="label_223" for="input_223">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_223" name="q223_maquette223" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="1500">1500 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="3500">3500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_224">
                <label class="form-label-left" id="label_224" for="input_224">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_224" name="q224_maquette224" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                        <option value="20000">20000 </option>
                        <option value="30000">30000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_225">
                <label class="form-label-left" id="label_225" for="input_225">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_225" name="q225_maquette225" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="3500">3500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_226">
                <label class="form-label-left" id="label_226" for="input_226">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_226" name="q226_maquette226" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="1500">1500 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="3500">3500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_227">
                <label class="form-label-left" id="label_227" for="input_227">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_227" name="q227_maquette227" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="3500">3500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_228">
                <label class="form-label-left" id="label_228" for="input_228">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_228" name="q228_maquette228" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="1500">1500 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_229">
                <label class="form-label-left" id="label_229" for="input_229">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_229" name="q229_maquette229" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="1500">1500 </option>
                        <option value="2000">2000 </option>
                        <option value="2500">2500 </option>
                        <option value="3000">3000 </option>
                        <option value="3500">3500 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                        <option value="10000">10000 </option>
                        <option value="15000">15000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_2210">
                <label class="form-label-left" id="label_2210" for="input_2210">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_2210" name="q2210_maquette2210" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="100">100 </option>
                        <option value="200">200 </option>
                        <option value="300">300 </option>
                        <option value="400">400 </option>
                        <option value="500">500 </option>
                        <option value="600">600 </option>
                        <option value="700">700 </option>
                        <option value="800">800 </option>
                        <option value="900">900 </option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="4000">4000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>


            <li class="form-line" id="id_001">
                <label class="form-label-left" id="label_001" for="input_001">format:</label>
                    <select class="form-dropdown validate[required]" id="input_001" name="q001_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1">5.5 x 8.5 cm. Recto Coupe | Quadri | CM. 350g </option>
                        <option value="2">5.5 x 8.5 cm. Recto/Verso Coupe | Quadri | CM. 350g </option>
                        <option value="3">5.5 x 8.5 cm. Recto/Verso Coupe, Pelliculage | Quadri | CM. 350g </option>
                    </select>
            </li>
            <li class="form-line" id="id_002">
                <label class="form-label-left" id="label_002" for="input_002">maquette:</label>
                    <select class="form-dropdown validate[required]" id="input_002" name="q002_maquette002" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="fb">France banderole crée la maquette</option>
                        <option value="user">j’ai déjà crée la maquette </option>
                    </select>
            </li>
            <li class="form-line" id="id_003">
                <label class="form-label-left" id="label_003" for="input_003">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_003" name="q003_maquette003" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_004">
                <label class="form-label-left" id="label_004" for="input_004">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_004" name="q004_maquette004" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="3000">3000 </option>
                    </select>
            </li>
            <li class="form-line" id="id_005">
                <label class="form-label-left" id="label_005" for="input_005">quantité:</label>
                    <select class="form-dropdown quan validate[required]" id="input_005" name="q005_maquette005" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="1000">1000 </option>
                        <option value="2000">2000 </option>
                        <option value="5000">5000 </option>
                    </select>
            </li>




            <li class="form-line" id="id_26a">
                <div class="form-input-wide">
                <div id="form-button-error2"></div>
                        <button id="input_26" type="submit" class="form-submit-button">Submit Form</button>
                </div>
            </li>
            <li style="display:none">
                Should be Empty:
                <input type="text" name="website" value="" />
            </li>
        </ul>
    </div>
    <input type="hidden" id="simple_spc" name="simple_spc" value="1060900223" />
    <script type="text/javascript">
        document.getElementById("simple_spc").value += "-1060900223";
    </script>
</form>
</div>
<div id="preview">
<span id="preview_name">Imprimerie papier sélectionné:</span>
<div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><span id="lista1"><li style="display:none"></li></span></ul></div>
</div>
';	
	return $form;
}

?>