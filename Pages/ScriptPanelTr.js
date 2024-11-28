let Menú = document.getElementById("Menú");
let MenuInt = document.getElementById("MenuOpc");
let CardProd = document.getElementById("Productos");
var ultimoDesplazamiento = 0;
CardProd.addEventListener("click", function(){
    window.location.href = "GestionProd.php";
    // alert("P");
});
window.addEventListener("scroll", function() {
var desplazamientoActual = window.pageYOffset;

if (desplazamientoActual > ultimoDesplazamiento) {
// Desplazándose hacia abajo
MenuInt.style.display = "none"; // Oculta el menú moviéndolo fuera de la pantalla
} else {
// Desplazándose hacia arriba
//menuDesplegable.style.display = "0"; // Muestra el menú moviéndolo a la posición original
}
ultimoDesplazamiento = desplazamientoActual;
});
Menú.addEventListener('click', function () {
    if (MenuInt.style.display === 'block') {
        MenuInt.style.display = "none";
        Menú.style.background="rgba(0, 0, 0, 0.3)";
        Menú.style.padding= "10px 10px";
        Menú.style.color="black";
        ;
    } else {
        MenuInt.style.display = "block";
        Menú.style.background = "rgba(0, 0, 0, 0.1)";
        Menú.style.color = "rgb(102, 102, 102)";
    }
});