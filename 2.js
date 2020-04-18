function usernameCheck(username){
    cekUsername = false;
    if(username.length <= 12 && username.length >= 2 && username.substring(0,1) == "@"){
        cekUsername = true;
    }
    return cekUsername;
}

function passwordCheck(password){
    cekPassword = false;
    let number = /^[0-9]+$/;
    if(password.match(number) && password.length == 6){
        cekPassword = true;
    }
    return cekPassword;

}

console.log(usernameCheck("@koders"));
console.log(passwordCheck("212223"));