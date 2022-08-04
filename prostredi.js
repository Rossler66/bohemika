const blok_oblasti = document.getElementsByClassName("block_oblasti");
const blok_standard = document.getElementsByClassName("block_standard");
var blok_oblasti_observer = [];
var blok_standard_observer = [];

const oblOptions = {
    root: null,
    threshold: [0.1]
};

const standardOptions = {
    root: null,
    threshold: [0.05]
};

for(var ii = 0; ii < blok_oblasti.length; ii++){
    blok_oblasti_observer[ii] = new IntersectionObserver(call_oblasti, oblOptions);
    blok_oblasti_observer[ii].observe(blok_oblasti[ii]);
}

for(var ii = 0; ii < blok_standard.length; ii++){
    blok_standard_observer[ii] = new IntersectionObserver(call_standard, standardOptions);
    blok_standard_observer[ii].observe(blok_standard[ii]);
}


function call_oblasti(entries) {
    const [entry] = entries;
    console.log(entry);

    var pole = entries[0].target.getElementsByClassName("pole");
    if (entry.isIntersecting && entry.intersectionRatio < 1) {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.remove("banvolby");
        }

    } else {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.add("banvolby");
        }
    }
}

function call_standard(entries) {
    const [entry] = entries;
    console.log(entry);

    var pole = entries[0].target.getElementsByClassName("zoom");
    if (entry.isIntersecting && entry.intersectionRatio < 1) {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.remove("zmensi");
        }

    } else {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.add("zmensi");
        }
    }
}



/*
const blok_oblasti = document.getElementById("oblasti");
const blok_uziti = document.getElementById("uziti");

const objOptions = {
    root: null,
    threshold: [0.1]
};

const uzitiOptions = {
    root: null,
    threshold: [0.25]
};

const blok_oblasti_observer = new IntersectionObserver(call_oblasti, objOptions);
const blok_uziti_observer = new IntersectionObserver(call_uziti, uzitiOptions);
blok_oblasti_observer.observe(blok_oblasti);
blok_uziti_observer.observe(blok_uziti);

function call_oblasti(entries) {
    const [entry] = entries;
    console.log(entry);

    var pole = entries[0].target.getElementsByClassName("pole");
    if (entry.isIntersecting && entry.intersectionRatio < 1) {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.remove("banvolby");
        }

    } else {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.add("banvolby");
        }
    }
}


function call_uziti(entries) {
    const [entry] = entries;
    console.log(entry);

    var pole = entries[0].target.getElementsByClassName("pole");
    if (entry.isIntersecting && entry.intersectionRatio < 1) {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.remove("zmensi");
        }

    } else {
        for (var ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.add("zmensi");
        }
    }
}

*/
function zavridialog(evt) {
    if (evt.srcElement) {
        vstupElement = evt.srcElement;
    }
    if (evt.target) {
        vstupElement = evt.target;
    }


    while (vstupElement.className.indexOf("dialog")) {
        vstupElement = vstupElement.parentElement;
        if (vstupElement == null) {
            return;
        }
    }

    var parrent = vstupElement.parentNode;
    parrent.removeChild(vstupElement);


}

function setCook(evt) {
    var vstupElement;
    var iko;
    if (evt.srcElement) {
        vstupElement = evt.srcElement;
    }
    if (evt.target) {
        vstupElement = evt.target;
    }

    var date = new Date();

    var typ = vstupElement.getAttribute("typ");
    var stav = vstupElement.getAttribute("stav");
    var hod = stav + " " + date.getDate();
    date.setDate(date.getDate() + 800);

    if (typ == "vse") {
        document.cookie = "cok=" + hod + "; expires = " + date;
        document.cookie = "stat=" + hod + "; expires = " + date;
        document.cookie = "rekl=" + hod + "; expires = " + date;
        var cook = document.getElementById("cookiesnas");
        cook.parentNode.removeChild(cook);
        return;
    }

    if (stav == "A")
    {
        stav = "N";
        iko = "./img/iko_vypnuto.svg";
    } else {
        stav = "A";
        iko = "./img/iko_zapnuto.svg";
    }
    vstupElement.setAttribute("stav", stav);
    vstupElement.src = iko;
    document.cookie = typ + "=" + stav + "; expires = " + date;

}

function zavCook(evt) {
    var cook = document.getElementById("cookiesnas");
    cook.parentNode.removeChild(cook);
    return;

}



function detCook(evt) {
    var vstupElement;
    if (evt.srcElement) {
        vstupElement = evt.srcElement;
    }
    if (evt.target) {
        vstupElement = evt.target;
    }
    var detCok = document.getElementById("cokpodrobne");
    if (detCok.className.indexOf("disn") > -1) {
        vstupElement.innerHTML = "Základní nastavení";
        detCok.classList.remove("disn");
    } else {
        vstupElement.innerHTML = "Podrobné nastavení";
        detCok.classList.add("disn");
    }
}