function changeCity() {
    document.getElementById("city").style.display = "flex";
    document.getElementById("zip").style.display = "none";
    document.getElementById("warning").style.display = "block";
    document.getElementById("cityButton").style.backgroundColor = "#007bff";
    document.getElementById("cityButton").style.color = "white";
    document.getElementById("zipButton").style.backgroundColor = "white";
    document.getElementById("zipButton").style.color = "#007bff";
}

function changeZip() {
    document.getElementById("zip").style.display = "flex";
    document.getElementById("city").style.display = "none";
    document.getElementById("warning").style.display = "none";
    document.getElementById("zipButton").style.backgroundColor = "#007bff";
    document.getElementById("zipButton").style.color = "white";
    document.getElementById("cityButton").style.backgroundColor = "white";
    document.getElementById("cityButton").style.color = "#007bff";
}
