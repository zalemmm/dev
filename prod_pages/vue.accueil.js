new Vue({

  el: '#tarifs',

  data: {
    menus: {
      menu1: '1',
      menu2: '2',
      menu3: '3',
      menu4: '4'
    },
     menu1: false,
     menu2: false,
     menu3: false,
     menu4: false,
     menu5: false,
     menu6: false,
     menu7: false,
     menu8: false,
     menu9: false,
     menu10: false,
     menu11: false,
     menu12: false,
     menu13: false,
     menu14: false,
     menu15: false,
     menu16: false,

     isInactive: false,

     active1: false,
     active2: false,
     active3: false,
     active4: false,
     active5: false,
     active6: false,
     active7: false,
     active8: false,
     active9: false,
     active10: false,
     active11: false,
     active12: false,
     active13: false,
     active14: false,
     active15: false,
     active16: false,
  }, // fin DATA


  mounted: function () {

  },

  methods: {

    turnIn: function(el) {
        this.isInactive = true;
        if (el == 1) this.menu1 = this.active1 = true;
        if (el == 2) this.active2 = true;
        if (el == 3) this.active3 = true;
        if (el == 4) this.active4 = true;
        if (el == 5) this.active5 = true;
        if (el == 6) this.menu6 = this.active6 = true;
        if (el == 7) this.menu7 = this.active7 = true;
        if (el == 8) this.active8 = true;
        if (el == 9) this.menu9 = this.active9 = true;
        if (el == 10) this.menu10 = this.active10 = true;
        if (el == 11) this.active11 = true;
        if (el == 12) this.menu12 = this.active12 = true;
        if (el == 13) this.active13 = true;
        if (el == 14) this.active14 = true;
        if (el == 15) this.active15 = true;
        if (el == 16) this.active16 = true;

        /*this.menus[el] = this.actives[el] = true;*/
    },
    turnOut: function(el) {
        this.isInactive = false;
        this.menu1 = this.menu2 =this.menu3 = this.menu4 = this.menu5 = this.menu6 = this.menu7 = this.menu8 = this.menu9 = this.menu10 = this.menu11 = this.menu12 = this.menu13 = this.menu14 = this.menu15 = this.menu16 = false;
        this.active1 = this.active2 = this.active3 = this.active4 = this.active5 = this.active6 =this.active7 = this.active8 = this.active9 = this.active10 = this.active11 = this.active12 = this.active13 = this.active14 = this.active15 = this.active16 = false;
    },


  }, // fin méthodes VUE
}); // fin instance VUE
