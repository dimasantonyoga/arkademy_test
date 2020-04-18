function createTri(row){
    var cetak = "\n";
   for (var i=1;i<=row;i++){
      for (var j=i;j<=row;j++){
          cetak +="  ";
      }
      for (var k=1;k<=i;k++){
          cetak +="* ";
      }
      for (var l=1;l<=i-1;l++){
          cetak +="* ";
      }
      cetak +="\n";
  }
    return cetak;
}

console.log(createTri(5));