/* Cette fonction est pour la biographie des artistes */
function hideText(d) { 
    
    if (d.style.overflowY == "hidden") {
        d.style.overflowY = "";
        d.style.height = "auto";
    }
    else {
        d.style.overflowY = "hidden";
        d.style.height = "400px";
    }
}

/* Les fonctions suivantes sont pour le tunnel d'achat */
function cache_finition() {
    if (document.getElementById('format_classique').checked == true) {

        document.getElementById('taille_depart').style.display = 'none';
        document.getElementById('finition_grand_format').style.display = 'none';
        document.getElementById('finition_petit_format').style.display = 'flex';

    } else if(document.getElementById('format_grand').checked == true || document.getElementById('format_géant').checked == true || document.getElementById('format_collector').checked == true){
        

        document.getElementById('taille_depart').style.display = 'none';
        document.getElementById('finition_petit_format').style.display = 'none';
        document.getElementById('finition_grand_format').style.display = 'flex';
    }

};


function cache_cadre() {
    if (document.getElementById('support_passe_partout_noir').checked == true || document.getElementById('support_passe_partout_blanc').checked == true) {

        document.getElementById('finition_petit_format').style.display = 'none';
        document.getElementById('cadre_grand_format').style.display = 'none';
        document.getElementById('cadre_petit_format').style.display = 'flex';

    } else if (document.getElementById('support_aluminium').checked == true || document.getElementById('support_aluminium_verre').checked == true || document.getElementById('support_papier_photo').checked == true) {
        document.getElementById('finition_grand_format').style.display = 'none';
        document.getElementById('cadre_petit_format').style.display = 'none';
        document.getElementById('cadre_grand_format').style.display = 'flex';
    }
};

var taille = '';
var finition = '';
var cadre = '';
var prixFormat = 1;
var prixFinition = 1;
var prixCadre = 1;

function back() {

    document.getElementById('taille_depart').style.display = 'flex';
    document.getElementById('finition_grand_format').style.display = 'none';
    document.getElementById('cadre_grand_format').style.display = 'none';
    document.getElementById('cadre_petit_format').style.display = 'none';
    document.getElementById('finition_petit_format').style.display = 'none';
    document.getElementById('recap_taille').innerHTML ='';
    document.getElementById('recap_finition').innerHTML = '';
    document.getElementById('recap_cadre').innerHTML = '';
    document.getElementById('button_finaliser').style.display = 'none';
    taille = '';
    finition = '';
    cadre = '';
};



function recap(){

    if (document.getElementById('format_grand').checked == true) {
        taille = 'Grand'
        prixFormat = 2
    }else if (document.getElementById('format_géant').checked == true){
        taille = 'Géant'
        prixFormat = 4
    }else if (document.getElementById('format_collector').checked == true){
        taille = 'Collector'
        prixFormat = 10
    }else if (document.getElementById('format_classique').checked == true){
        taille = 'Classique'
        prixFormat = 1
    };


    if (document.getElementById('support_aluminium').checked == true) {
        finition = 'Support aluminium'
        prixFinition = 1.6
    }else if (document.getElementById('support_aluminium_verre').checked == true){
        finition = 'Support aluminium avec verre acrylique'
        prixFinition = 2.35
    }else if (document.getElementById('support_papier_photo').checked == true){
        finition = 'Tirage sur papier photo'
        prixFinition = 0
    }else if (document.getElementById('support_passe_partout_noir').checked == true){
        finition = 'Blackout'
        prixFinition = 0
    }else if (document.getElementById('support_passe_partout_blanc').checked == true){
        finition = 'Artshot'
        prixFinition = 0.4
    };


    if (document.getElementById('sans_encadrement').checked == true) {
        cadre = 'Sans encadrement'
        prixCadre = 0
    }else if (document.getElementById('encadrement_noir_satin').checked == true){
        cadre = 'Encadrement noir satin'
        prixCadre = 0.45
    }else if (document.getElementById('encadrement_blanc_satin').checked == true){
        cadre = 'Encadrement blanc satin'
        prixCadre = 0.45
    }else if (document.getElementById('encadrement_noyer').checked == true){
        cadre = 'Encadrement noyer'
        prixCadre = 0.45
    }else if (document.getElementById('encadrement_chêne').checked == true){
        cadre = 'Encadrement chêne'
        prixCadre = 0.45
    }else if (document.getElementById('aluminium_noir').checked == true){
        cadre = 'Aluminium noir'
        prixCadre = 0
    }else if (document.getElementById('bois_blanc').checked == true){
        cadre = 'Bois blanc'
        prixCadre = 0
    }else if (document.getElementById('acajou_mat').checked == true){
        cadre = 'Acajou mat'
        prixCadre = 0
    }else if (document.getElementById('aluminium_blanc').checked == true){
        cadre = 'Aluminium blanc'
        prixCadre = 0
    };

    document.getElementById('recap_taille').innerHTML = `Taille : ${taille}`;
    document.getElementById('recap_finition').innerHTML = `Finition : ${finition}`;
    document.getElementById('recap_cadre').innerHTML = `Cadre : ${cadre}`;


   if (taille != '' && cadre != '' && finition !=''){
        document.getElementById('button_finaliser').style.display = 'block';
    }
}