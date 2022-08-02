/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var bEditace = false;
var editObj = null;
var editpanel = null;



function editmod() {
    var editbod = document.getElementById("editbod");
    var body = document.getElementsByTagName("body")[0];
    var editstranka = document.getElementById("editstranka");
    var nabidka = document.getElementById("nabidka");
    var obsah = document.getElementById("obsah");

    if (bEditace) {
        bEditace = false;
        editbod.style.backgroundColor = "#6666";
        body.removeEventListener("dragover", nastavDrag);
        body.removeEventListener("click", upravPrvek);
        zavriPanel();
        editstranka.style.display="none";
        nabidka.style.display="none";
        editpanel = null;

        
        var smaz = document.getElementsByClassName("ikoedit");
        var blok;
        while (smaz.length > 0) {
            blok = smaz[0].parentNode;
            blok.removeChild(smaz[0]);
        }
        var smaz = document.getElementsByClassName("editace");
        while (smaz.length > 0) {
            smaz[0].classList.remove("editace");
        }
    } else {
        bEditace = true;
        editbod.style.backgroundColor = "#f00a";
        body.addEventListener("dragover", nastavDrag);
        body.addEventListener("click", upravPrvek);
        editstranka.style.display="block";
        var stranka = document.getElementById("obsah");
        var inp = editstranka.getElementsByTagName("INPUT")[0];
        inp.value = stranka.getAttribute("nazev");
        
        obsah.classList.add("editace");
        var bloky = obsah.getElementsByClassName("block");
        var addDiv;
        for (var ii = 0; ii < bloky.length; ii++) {
            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejblok");
            addDiv.addEventListener("click", pridejBlok);
            bloky[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("upravblok");
            addDiv.addEventListener("click", upravBlok);
            bloky[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejpole");
            addDiv.addEventListener("click", pridejPole);
            bloky[ii].appendChild(addDiv);
        }
        var pole = obsah.getElementsByClassName("pole");
        for (var ii = 0; ii < pole.length; ii++) {
            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("upravpole");
            addDiv.addEventListener("click", upravPole);
            pole[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejprvek");
            addDiv.addEventListener("click", pridejPrvek);
            pole[ii].appendChild(addDiv);
        }
    }
}




function zavriPanel() {
    if (editpanel) {
        editpanel.style.display = "none";
        editpanel = null;
    }
}

function pridejBlok(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    aktBlok = aktBlok.parentNode;

    var addBlok = document.createElement("DIV");
    addBlok.classList.add("block");
    addBlok.classList.add("block_standard");
    var addCont = document.createElement("DIV");
    addCont.classList.add("container");
    addBlok.appendChild(addCont);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejblok");
    addDiv.addEventListener("click", pridejBlok);
    addBlok.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("upravblok");
    addDiv.addEventListener("click", upravBlok);
    addBlok.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejpole");
    addDiv.addEventListener("click", pridejPole);
    addBlok.appendChild(addDiv);


    aktBlok.parentNode.insertBefore(addBlok, aktBlok);
}

function blokNahoru(evt) {
    var nadramec = editObj.parentNode;
    var pred = editObj.previousElementSibling;
    if (pred != null) {
        var pomblok = nadramec.removeChild(editObj);
        nadramec.insertBefore(pomblok, pred);
    }
}

function blokDolu(evt) {
    var nadramec = editObj.parentNode;
    var po = editObj.nextElementSibling;
    if (po != null) {
        po = po.nextElementSibling;
        var pomblok = nadramec.removeChild(editObj);
        nadramec.insertBefore(pomblok, po);
    }

}


function blokSmaz(evt) {
    if (!editObj) {
        return;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }

    editObj.remove();
    editObj = null;
    editpanel = null;
}

function upravBlok(evt) {
    var element;
    if (evt.srcElement) {
        element = evt.srcElement;
    }
    if (evt.target) {
        element = evt.target;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }
    editpanel = document.getElementById("editblock");
    if (editObj == element) {
        return;
    }
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = element.parentNode;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
}

function nastavZarovnaniTextu(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var typ = aktBlok.getAttribute("typ");
    if (!typ) {
        return;
    }
    editObj.classList.remove("tal");
    editObj.classList.remove("tac");
    editObj.classList.remove("tar");
    editObj.classList.add(typ);
}


function nastavVelikostTextu(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var typ = aktBlok.getAttribute("hodnota");
    if (!typ) {
        return;
    }
    editObj.classList.remove("txs_xs");
    editObj.classList.remove("txs_s");
    editObj.classList.remove("txs_m");
    editObj.classList.remove("txs_l");
    editObj.classList.remove("txs_xl");
    editObj.classList.add(typ);
}


function nastavBarvuPozadi(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var barva = "bcg_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("bcg_bila");
    editObj.classList.remove("bcg_seda");
    editObj.classList.remove("bcg_bledemodra");
    editObj.classList.remove("bcg_tmavomodra");
    editObj.classList.remove("bcg_transparent");
    editObj.classList.remove("bcg_bila3");
    editObj.classList.remove("bcg_seda3");
    editObj.classList.remove("bcg_bledemodra3");
    editObj.classList.remove("bcg_tmavomodra3");
    editObj.classList.remove("bcg_bila2");
    editObj.classList.remove("bcg_seda2");
    editObj.classList.remove("bcg_bledemodra2");
    editObj.classList.remove("bcg_tmavomodra2");
    editObj.classList.remove("bcg_bila1");
    editObj.classList.remove("bcg_seda1");
    editObj.classList.remove("bcg_bledemodra1");
    editObj.classList.remove("bcg_tmavomodra1");
    editObj.classList.add(barva);
}

function nastavBarvuTextu(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var barva = "col_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("col_bila");
    editObj.classList.remove("col_seda");
    editObj.classList.remove("col_bledemodra");
    editObj.classList.remove("col_tmavomodra");
    editObj.classList.remove("col_transaprent");
    editObj.classList.add(barva);
}


function nastavRamecek(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var barva = "bor_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("bor_bila");
    editObj.classList.remove("bor_seda");
    editObj.classList.remove("bor_bledemodra");
    editObj.classList.remove("bor_tmavomodra");
    editObj.classList.remove("bor_transaprent");
    editObj.classList.add(barva);
}

function nastavStin(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("stin");
    if (hodnota != "---") {
        editObj.classList.add(hodnota);
    }
}

function nastavZoom(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("zoom");
    if (hodnota != "---") {
        editObj.classList.add(hodnota);
    }
}


function nastavTypBloku(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var typ = "block_" + aktBlok.getAttribute("typ");
    if (!typ) {
        return;
    }
    editObj.classList.remove("block_hlava");
    editObj.classList.remove("block_oblasti");
    editObj.classList.remove("block_info");
    editObj.classList.remove("block_standard");
    editObj.classList.add(typ);

}

function pridejPole(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    aktBlok = aktBlok.parentNode.firstElementChild;

    var addPole = document.createElement("DIV");
    addPole.classList.add("pole");
    addPole.classList.add("pole3");
    addPole.classList.add("poleM");
    addPole.classList.add("bcg_seda");
    
    var addA = document.createElement("A");
    addA.classList.add("odkaz");
    addPole.appendChild(addA);

    var addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("upravpole");
    addDiv.addEventListener("click", upravPole);
    addPole.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejprvek");
    addDiv.addEventListener("click", pridejPrvek);
    addPole.appendChild(addDiv);

    aktBlok.appendChild(addPole);
}

function upravPole(evt) {
    var element;
    if (evt.srcElement) {
        element = evt.srcElement;
    }
    if (evt.target) {
        element = evt.target;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }
    editpanel = document.getElementById("editpole");
    if (editObj == element) {
        return;
    }
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = element.parentNode;
    editObj.classList.add("editace");
    editpanel.style.display = "block";

}

function nastavPocetPole(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var hodnota = aktBlok.getAttribute("typ");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("pole1");
    editObj.classList.remove("pole2");
    editObj.classList.remove("pole3");
    editObj.classList.remove("pole4");
    editObj.classList.add(hodnota);

}

function nastavVyskaPole(evt) {
    var aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    var hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("pole_v1");
    editObj.classList.remove("pole_v2");
    editObj.classList.remove("pole_v3");
    editObj.classList.remove("pole_v4");
    editObj.classList.remove("pole_v5");
    editObj.classList.remove("pole_v6");
    editObj.classList.remove("pole_v7");
    editObj.classList.remove("pole_v8");
    editObj.classList.remove("pole_v9");
    if (hodnota != "---") {
        editObj.classList.add(hodnota);
    }
}


function nastavSirkaPole(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var hodnota = aktBlok.getAttribute("typ");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("poleS");
    editObj.classList.remove("poleM");
    editObj.classList.remove("poleL");
    editObj.classList.add(hodnota);

}


function pridejPrvek(evt) {
    zavriPanel();
    editpanel = document.getElementById("pridejprvek");
    editpanel.style.display = "block";
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    editObj = aktBlok.parentNode;

}

function pridejObrazek(evt) {
    var addPrvek = document.createElement("IMG");
    addPrvek.classList.add("prvek");
    editObj.appendChild(addPrvek);
}

function pridejNadpis(evt) {
    var addPrvek = document.createElement("H2");
    addPrvek.classList.add("prvek");
    addPrvek.innerHTML = "Nadpis";
    editObj.appendChild(addPrvek);
}

function pridejText(evt) {
    var addPrvek = document.createElement("P");
    addPrvek.classList.add("prvek");
    addPrvek.innerHTML = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.";
    editObj.appendChild(addPrvek);
}

function pridejMapu(evt){
    var addPrvek = document.createElement("IFRAME");
    addPrvek.classList.add("prvek");
//    addPrvek.src = "https://www.google.com/maps/d/u/4/embed?mid=1wQGyZeagyxXI9NW0e5K5Y32GHuA&amp;ehbc=2E312F";
    addPrvek.src = "https://www.google.com/maps/d/embed?mid=1wQGyZeagyxXI9NW0e5K5Y32GHuA&ehbc=2E312F";
    addPrvek.style="width:100%;height:800px";
    editObj.appendChild(addPrvek);
}

function upravPrvek(evt) {
    var aktPrvek;
    if (evt.srcElement) {
        aktPrvek = evt.srcElement;
    }
    if (evt.target) {
        aktPrvek = evt.target;
    }
    if (aktPrvek.className.indexOf("prvek") < 0) {
        return;
    }

    /*    if (editObj == aktPrvek) {
     return;
     }*/
    if (aktPrvek.tagName == "IMG") {
        upravObrazek(aktPrvek);
    }
    if (aktPrvek.tagName == "H1" || aktPrvek.tagName == "H2" || aktPrvek.tagName == "H3" || aktPrvek.tagName == "H4" || aktPrvek.tagName == "H56" || aktPrvek.tagName == "H6") {
        upravNadpis(aktPrvek);
    }
    if (aktPrvek.tagName == "P") {
        upravText(aktPrvek);
    }
}


function upravObrazek(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editobrazek");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
}

function upravNadpis(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editnadpis");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    editRadek(edOb);
}


function souborDoStranky(data) {
    editObj.src = data.cesta;
}

function souborDoPole(data) {
    var styl = ' background-image: url('+data.cesta+');';
    editObj.setAttribute("style",styl);
}


function editRadek(element) {
    //	var pozice = vratPoziciAbs(element);
    var sirka = element.offsetWidth;
    var vyska = element.offsetHeight;
    var paddingLeft = window.getComputedStyle(element, null).getPropertyValue("padding-left");
    var paddingTop = window.getComputedStyle(element, null).getPropertyValue("padding-top");
    var paddingRight = window.getComputedStyle(element, null).getPropertyValue("padding-right");
    var paddingBottom = window.getComputedStyle(element, null).getPropertyValue("padding-bottom");
    sirka = sirka - parseInt(paddingLeft) - parseInt(paddingRight);
    vyska = vyska - parseInt(paddingTop) - parseInt(paddingBottom);
    input = document.createElement("INPUT");
    input.onblur = opustRadek;
    input.value = element.innerHTML;
    element.innerHTML = "";
    element.appendChild(input);
    input.style.width = sirka + "px";
    input.style.height = vyska + "px";
    input.style.fontFamily = window.getComputedStyle(element, null).getPropertyValue("font-family");
    input.style.fontWeight = window.getComputedStyle(element, null).getPropertyValue("font-weight");
    input.style.fontSize = window.getComputedStyle(element, null).getPropertyValue("font-size");
    input.style.color = window.getComputedStyle(element, null).getPropertyValue("color");
    input.style.textAlign = window.getComputedStyle(element, null).getPropertyValue("text-align");
    input.style.letterSpacing = window.getComputedStyle(element, null).getPropertyValue("letter-spacing");
    input.style.backgroundColor = window.getComputedStyle(element, null).getPropertyValue("background-color");
    input.focus();
}


function opustRadek() {
    if (input == null) {
        return;
    }
    var text = input.value;
    var parrent = input.parentNode;
    parrent.removeChild(input);
    parrent.innerHTML = text;
    input = null;
}

function upravText(edOb) {
    zavriPanel();
    editpanel = document.getElementById("edittext");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    editText(edOb);
}

function editText(element) {
    var sirka = element.offsetWidth;
    var vyska = element.offsetHeight;
    var paddingLeft = window.getComputedStyle(element, null).getPropertyValue("padding-left");
    var paddingTop = window.getComputedStyle(element, null).getPropertyValue("padding-top");
    var paddingRight = window.getComputedStyle(element, null).getPropertyValue("padding-right");
    var paddingBottom = window.getComputedStyle(element, null).getPropertyValue("padding-bottom");
    sirka = sirka - parseInt(paddingLeft) - parseInt(paddingRight);
    vyska = vyska - parseInt(paddingTop) - parseInt(paddingBottom);
    texar = document.createElement("TEXTAREA");
    texar.id = "editext";
    texar.onblur = opustArea;
    var pztxt = element.innerHTML;
    var pctxt = pztxt.replace(/<br>/g, '\n');
    texar.innerHTML = pctxt;
    element.innerHTML = "";
    element.appendChild(texar);
    texar.style.width = sirka + "px";
    texar.style.height = vyska + "px";
    texar.style.fontFamily = window.getComputedStyle(element, null).getPropertyValue("font-family");
    texar.style.fontWeight = window.getComputedStyle(element, null).getPropertyValue("font-weight");
    texar.style.fontSize = window.getComputedStyle(element, null).getPropertyValue("font-size");
    texar.style.color = window.getComputedStyle(element, null).getPropertyValue("color");
    texar.style.textAlign = window.getComputedStyle(element, null).getPropertyValue("text-align");
    texar.style.letterSpacing = window.getComputedStyle(element, null).getPropertyValue("letter-spacing");
    texar.style.backgroundColor = window.getComputedStyle(element, null).getPropertyValue("background-color");
    texar.focus();

}

function opustArea() {
    if (texar == null) {
        return;
    }
    var text = texar.value;
    var parrent = texar.parentNode;
    parrent.removeChild(texar);
    parrent.innerHTML = text.replace(/\n/g, '<br>');
    texar = null;
}

function nastavTagPrvku(evt) {
    var aktBlok;
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    var tag = aktBlok.getAttribute("typ");
    if (!tag) {
        return;
    }
    var novTag = document.createElement(tag);
    novTag.innerHTML = editObj.innerHTML;

    var poc = editObj.classList.length;
    for (var ii = 0; ii < poc; ii++) {
        novTag.classList.add(editObj.classList[ii]);
    }
    var prvNad = editObj.parentNode;
    prvNad.insertBefore(novTag, editObj);
    prvNad.removeChild(editObj);
    editObj = novTag;


}

function nabOdkazy() {
    var par = nulujPar(); //aktuálně načítené parametry
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nabOdkazy";
    PosliPozadavek(JSON.stringify(par));
}

function vlozOdkaz(odkaz){
    var odkA = editObj.getElementsByTagName("A")[0];
    var cesta = "?stranka/obsah/id="+odkaz;
    odkA.href =cesta;
}


function strankaSeznam() {
    editmod();
    var par = nulujPar(); //aktuálně načítené parametry
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nabStranky";
    PosliPozadavek(JSON.stringify(par));
}

function strankaPridej(){
    editmod();
    var stranka = document.getElementById("obsah");
    stranka.setAttribute("idstr", 0);
    stranka.setAttribute("nazev","Nová stránka");
    stranka.innerHTML = '<div class="block block_standard"><div class="container"></div></div>';
    var inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = "Nová stránka";
    editmod();
}

function strankaKopy(){
    editmod();
    var stranka = document.getElementById("obsah");
    stranka.setAttribute("idstr", 0);
    var nazev = stranka.getAttribute("nazev")+" - kopie";
    stranka.setAttribute("nazev",nazev);
    var inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = nazev;
    editmod();
    
}

function strankaUloz(){
    editmod();
    var stranka = document.getElementById("obsah");
    var inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    var par = nulujPar();
    par.data.id = stranka.getAttribute("idstr");
    par.data.nazev = inp.value;
    par.data.obsah = stranka.innerHTML;
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "ulozstranku";
    PosliPozadavek(JSON.stringify(par));
    
}

/*
function zobrazStranku(param){
    var stranka = document.getElementById("stranka");
    stranka.setAttribute("idstr", param.id);
    stranka.setAttribute("nazev",param.nazev);
    stranka.innerHTML = param.obsah;
    var inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = param.nazev;
    editmod();
}
*/

function nactiStranku(evt){
    var aktBlok;
    document.getElementById("nabidka").style.display = "none";
    
    if (evt.srcElement) {
        aktBlok = evt.srcElement;
    }
    if (evt.target) {
        aktBlok = evt.target;
    }
    while(aktBlok.tagName != "TR" && aktBlok != null){
        aktBlok = aktBlok.parentNode;
    }
    if(aktBlok == null){return;}
    var par = nulujPar();
    par.data.id = aktBlok.getAttribute("id");

    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nactistranku";
    PosliPozadavek(JSON.stringify(par));
}

function nabidkaStranek(data){
    var nab = document.getElementById("nabidka");
    nab.innerHTML = data.obsah;
    nab.addEventListener("click", nactiStranku);
   nab.style.display = "block";
    
}

