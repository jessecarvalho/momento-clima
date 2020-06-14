function basicSearch() {
    document.getElementById("advanced").style.display = "none";
    document.getElementById("basic").style.display = "flex";
    document.getElementById("warning").style.display = "block";
    document.getElementById("cityButton").style.backgroundColor = "#007bff";
    document.getElementById("cityButton").style.color = "white";
    document.getElementById("zipButton").style.backgroundColor = "transparent";
    document.getElementById("zipButton").style.color = "#007bff";
}

function advancedSearch() {
    document.getElementById("basic").style.display = "none";
    document.getElementById("advanced").style.display = "flex";
    document.getElementById("warning").style.display = "none";
    document.getElementById("zipButton").style.backgroundColor = "#007bff";
    document.getElementById("zipButton").style.color = "white";
    document.getElementById("cityButton").style.backgroundColor = "transparent";
    document.getElementById("cityButton").style.color = "#007bff";
}

window.onload = function(){
    var div = document.getElementById('preload');
    preload(div, 50);
};
function preload(el, interval){
    var op = 1;
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            el.style.display = 'none';
            el.className = '';
        }
        el.style.opacity = op;
        op -= op * 0.1;
    }, interval);
}
