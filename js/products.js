document.getElementById("btnSave").onclick =(evt)=>{
    //evt.preventDefault()//evita recargar el form
    document.getElementById("form").classList.add('was-validated')

    
}
var botones = document.getElementsByClassName("btnEdit");

Array.from(botones).forEach(btn => {
  btn.addEventListener('click', function(evt) {
    var name = btn.getAttribute("data-name") || "";
    var descripcion = btn.getAttribute("data-description") || "";
    var precio = btn.getAttribute("data-precio") || "";
    var marca = btn.getAttribute("data-marca") || "";
    var categoria = btn.getAttribute("data-categoria") || "";
    var stock = btn.getAttribute("data-stock") || "";
    var id = btn.getAttribute("data-id") || "";
    var modelo = btn.getAttribute("data-modelo") || "";


    document.getElementById("txtNameEdit").value = name;
    document.getElementById("txtDescripcionEdit").value = descripcion;
    document.getElementById("txtPrecioEdit").value = precio;
    document.getElementById("txtMarcaEdit").value = marca;
    document.getElementById("txtCategoriaEdit").value = categoria;
    document.getElementById("txtStockEdit").value = stock;
    document.getElementById("txtIdEdit").value = id;
    document.getElementById("txtModeloEdit").value = modelo;
  });
});
