jQuery(function() {
  //////////////////////////////////////////////////////////////////////////////
  function Afficher() {
    divliv = document.getElementById('livraisonrapide');
    if (divliv.style.display == 'none')
    divliv.style.display = 'block';
  }
  function Afficher() {
    divInfo = document.getElementById('delivery-div');
    if (divInfo.style.display == 'none')
    divInfo.style.display = 'block';
  }
  function Masquer() {
    divInfo = document.getElementById('delivery-div');
    if (divInfo.style.display == 'block')
    divInfo.style.display = 'none';
  }

  ////////////////////////////////////////////////////// checkboxes livraison //
  jQuery('#adresse').click(function() {
    if (document.getElementById('adresse').checked) {
      document.getElementById('relais').checked = false;
      document.getElementById('etiquette').checked = false;
    }
  });
  jQuery('#etiquette').click(function() {
    if (document.getElementById('etiquette').checked) {
      document.getElementById('relais').checked = false;
      document.getElementById('adresse').checked = false;
    }
  });
  jQuery('#relais').click(function() {
    if (document.getElementById('relais').checked) {
      document.getElementById('etiquette').checked = false;
      document.getElementById('adresse').checked = false;
    }
  });

  /////////////////////////////////////////////////// calcul des jours ouvrés //
  function AddBusinessDays(weekDaysToAdd) {
    // fonction jours ouvrés
    var curdate = new Date();
    var realDaysToAdd = 0;
    for(i=0; i<weekDaysToAdd; i++){
      curdate.setDate(curdate.getDate()+1);
      var estdt1 = new Date(curdate);
      var n = curdate.getDay();
      if (n == '6' || n == '0') {
        weekDaysToAdd++;
      }
      realDaysToAdd++;
      //check if current day is business day
    }
    return realDaysToAdd;
  }
});
