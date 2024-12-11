document.getElementById("btnSave").onclick =(evt)=>{
    //evt.preventDefault()//evita recargar el form
    document.getElementById("form").classList.add('was-validated')

    
}
var botones=document.getElementsByClassName("btnEdit")

for(var i=0;i<botones.length;i++){
  botones[i].onclick=(evt)=>{
    var btn = evt.target
    var email = btn.getAttribute("data-email")
    var name = btn.getAttribute("data-name")
    var id = btn.getAttribute("data-id")
    var telefono = btn.getAttribute("data-tel")
    var direccion = btn.getAttribute("data-dir")
    document.getElementById("txtEmailEdit").value = email
    document.getElementById("txtNameEdit").value = name
    document.getElementById("txtTelefonoEdit").value = telefono
    document.getElementById("txtDireccionEdit").value = direccion
    document.getElementById("txtIdEdit").value = id
  }
}