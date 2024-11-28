   let IconSearch = document.getElementById("SearchIcon");
   let InputSearch = document.getElementById("InputSearch");
   let ResultSearch = document.getElementById("ResultSearch");
   IconSearch.addEventListener("click", function(){
    InputSearch.focus();
   });
    function Sh(productName) {
        var modalId = "Open" + productName;
        var modal = document.getElementById(modalId); 

        if (modal) { 
            modal.style.display = "block"; 
        }
    }
    function OutModalClose(productName){
        document.getElementById('Open' + productName).style.display = 'none';
    }
    
   function openCustomModal(name) {
        document.getElementById('myModal' + name).style.display = 'block';
    }

    function closeCustomModal(name) {
        document.getElementById('myModal' + name).style.display = 'none';
    }

    function openModal(carritoModal) {
        document.getElementById("carritoModal").style.display = "block";
        document.getElementById("ContentModalCarrito").style.display="block";
        InputSearch.style.position = 'static';
        IconSearch.style.display = 'none';
    }

    function closeModal(carritoModal) {
        document.getElementById("carritoModal").style.display = "none";
        document.getElementById("ContentModalCarrito").style.display="none";
        InputSearch.style.position = 'absolute';
        IconSearch.style.display = '';
    }
    document.addEventListener("DOMContentLoaded", function() {
        var inputSearch = document.getElementById("InputSearch");
        var resultSearch = document.getElementById("ResultSearch");
        resultSearch.style.position = "static"; //Estilo que se agrega por aparte y no es afectado por CSS.
        inputSearch.addEventListener("input", function() {
            if (inputSearch.value === "") {
                resultSearch.style.display = "none";
                resultSearch.style.position = "static"; //Estilo que se agrega por aparte y no es afectado por CSS.
            } else{
                resultSearch.style.display = "block";
            }
        });
    });
    

    $(document).ready(function($) {
        $("#InputSearch").on("input", function() {
            var searchTerm = $(this).val();
    
            $.ajax({
                type: "POST",
                url: "Search.php",
                data: { searchTerm: searchTerm },
                success: function(response) {
                    $("#ResultSearch").html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    
        // Se agrego el evento click para mostrar el modal dinámico de los detalles del producto.
        $(document).on("click", ".search-result", function() {
            var productName = $(this).text().trim();
            openCustomModal(productName);
        });
    });