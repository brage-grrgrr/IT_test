function Bilder(x) {
    document.getElementById("myImg").style.visibility = "visible";
    if (x == 0) {
        document.getElementById("myImg").src = "bilder/LHopital1.jpg";
    } else if (x == 1) {
        document.getElementById("myImg").src = "bilder/maxresdefault.jpg";
    } else if (x == 2) {
        document.getElementById("myImg").src = "bilder/maxresdefault.jpg";
    } else if (x == 3) {
        document.getElementById("myImg").src = "bilder/unnamed.gif";
    } else if (x == 4) {
        document.getElementById("myImg").src = "bilder/vendepunkt_teori_0.png";
    } else if (x == 5) {
        document.getElementById("myImg").src = "bilder/images.png";
    }
}