function eliminasiNol(angka){
	let number = /^[0-9]+$/;
  	let cetak = "";
  	let arrPecahNol = [];
  	let j = 0;
  	let pecahan = [];
  	
  	let eliminasi = 0;
  	
  	angka += 0;
   	if(angka.match(number)){
   		for (let i = 0; i < angka.length; i++) {
          	eliminasi = angka.substring(i,(1+i));
          	if(eliminasi != 0){
            	cetak += angka.substring(i,(1+i));
            }else if( eliminasi == 0 && cetak != ""){
            	arrPecahNol.push(cetak);
              	cetak = "";
            }
        }
		      	
   	}else{
    	return "error";
    }

  	return arrPecahNol;
}
console.log(eliminasiNol("5956560159466056"));