form.addEventListener('submit' , (e) =>{
    e.preventDefault();

    checar();
})

function checar (){
    var data = document.getElementById('data').value;
    var number = document.getElementById('number').value;
    var email = document.getElementById('email').value;
    var recado = document.getElementById('recado').value;
    var contato = document.getElementById('contato').value;
    var age = data.split("-");
    var idade = (2022 - age[0]);
    var nome = document.getElementById('username').value;

    document.getElementById('idade').value = idade;

    if(nome == ""){
       alert("Nome inválido!")
       document.getElementById("sem_nome").innerHTML = "Preencha o nome!";
       return false
    }else{
        document.getElementById("sem_nome").innerHTML = "";
    }

    if(data == ""){
        alert("Data inválida!")
       document.getElementById("sem_data").innerHTML = "Preencha a data!";
       return false

    }else if(data != "" && idade == "") {
        document.getElementById("sem_data").innerHTML = "";
        document.getElementById('idade').value = idade;
    }

    if(email == ""){
        alert("Informe um email válido!")
        document.getElementById("sem_email").innerHTML = "Preencha o Email!";
        return false
    }else{
        document.getElementById("sem_email").innerHTML = "";
    }
    if(number == ""){
        alert("Informe um número válido!")
        document.getElementById("sem_number").innerHTML = "Preencha o número!";
        return false
   
    }else{
        document.getElementById("sem_number").innerHTML = "";
    }
    if(recado == ""){
        alert("Informe um recado!")
        document.getElementById("sem_recado").innerHTML = "Preencha o recado!";
        return false
   
    }else{
        document.getElementById("sem_recado").innerHTML = "";
    }


    var dados = {
        "nome": nome,
        "data": data,
        "idade": idade,
        "email": email,
        "recado" : recado,
        "contato": contato,
        "number" : number     
    } 

    let resultado = JSON.stringify(dados);

    document.getElementById("form").innerHTML = resultado;

    return false;

}
