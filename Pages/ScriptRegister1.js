// Agregar
var modal = document.getElementById('ModalN');
var closeButton = document.getElementsByClassName('close')[0];
var closeButtonE = document.getElementsByClassName('closeM')[0];
var closeButtonN = document.getElementsByClassName('closeN')[0];
var closeButtonP = document.getElementsByClassName('closeP')[0];
var closeButtonD = document.getElementsByClassName('closeD')[0];
var modalE = document.getElementById('ModalEm');
var modalN = document.getElementById('ModalNum');
var modalD = document.getElementById('ModalDir');
var modalP = document.getElementById('ModalPass');
document.getElementById('AddName').addEventListener('click', function() {
    modal.style.display = 'flex';
});
document.getElementById('AddEmail').addEventListener('click',function(){ 
    modalE.style.display = 'flex';
});
document.getElementById('AddNumber').addEventListener('click',function(){
    modalN.style.display = 'flex';
});
document.getElementById('AddDir').addEventListener('click',function(){
    modalD.style.display = 'flex';
    // alert("WW");
});
document.getElementById('AddPassword').addEventListener('click',function(){
    modalP.style.display = 'flex';
});
closeButton.onclick = function() {
  modal.style.display = 'none';
};

closeButtonE.onclick = function(){
    modalE.style.display = 'none';
};

closeButtonN.onclick = function(){
    modalN.style.display = 'none';
};
closeButtonP.onclick = function(){
    modalP.style.display = 'none';
}
closeButtonD.onclick = function(){
    modalD.style.display = 'none';
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};
window.onclick = function(event) {
    if (event.target == modalE) {
      modalE.style.display = 'none';
    }
  };
  window.onclick = function(event) {
    if (event.target == modalN) {
      modalN.style.display = 'none';
    }
  };
  window.onclick = function(event) {
    if (event.target == modalP) {
      modalP.style.display = 'none';
    }
  }; 
  /*
  function VerificarContraseñas(){
var valuePass = document.getElementById('Pass').value;
var valuePassC = document.getElementById('PassC').value;
if(valuePass === valuePassC){
    alert("Bien!!");
}else if (valuePass === '' && valuePassC === ''){
    alert("Llene los campos");
}else if(valuePass != valuePassC){
    alert("MAl");
}
  }
  */