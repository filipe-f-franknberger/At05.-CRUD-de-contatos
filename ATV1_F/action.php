
<?php
define('JSON','cadastros.json');
$destino = "";


function carregaDadosFormParaVetor(){
    $destino = '';
    if (isset($_FILES['image'])){
        $destino = 'imagens/'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$destino);
    }
}

$dados = array( 'id' => isset($_POST['id'])?$_POST['id']:'', 
'nome' => isset($_POST['username'])?$_POST['username']:'',
'dtnasc' => isset($_POST['nascimento'])?$_POST['nascimento']:'',
'email' => isset($_POST['email'])?$_POST['email']:'',
'telefone' => isset($_POST['number'])?$_POST['number']:'',
'sexo' => isset($_POST['sexo'])?$_POST['sexo']:'',
'parente' => isset($_POST['parente'])?$_POST['parente']:'',
'origem' => isset($_POST['contato'])?$_POST['contato']:'',
'recado' => isset($_POST['recado'])?$_POST['recado']:'',
'foto'=>$destino
); 

$arquivo = fopen('cadastros.json','w+');
    fwrite($arquivo,json_encode($dados));
    fclose($arquivo);

function inserir($novocontato){ 

    $dados = carregaDoArquivoParaVetor();
    $novocontato['id'] = nextID($dados);
    if (validaDados($novocontato)){
        if ($dados){ 
            array_push($dados,$novocontato);
        }else{
            $dados[] = $novocontato;
        }
        salvaDadosNoArquivo($dados);
        return true;
    }
    return false;
}

function ApresentaDadosVetor(){
    if (file_exists(JSON)){
        $conteudo = file_get_contents(JSON);
        $contatos = json_decode($conteudo,true);

        return $contatos;
    }
    return null;
}

function salvaDadosNoArquivo($dados){
    file_put_contents(JSON,json_encode($dados));    
}

function nextID($dados){
    $id = 0;
    if ($dados)
        $id = intval($dados[count($dados)-1]['id']);
    return ++$id;
}

function carregaDoArquivoParaVetor(){
    if (file_exists(JSON)){
        $conteudo = file_get_contents(JSON);
        $contatos = json_decode($conteudo,true);
        return $contatos;
    }
    return null;

}

function validaDados($dados){

    foreach($dados as $campo){  
        if ($campo == '')
            return false;
    }
    return true;
}

function excluir($id){
    $dados = carregaDoArquivoParaVetor();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $id)
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1);
    salvaDadosNoArquivo($dados);
}

function buscaContato($id){
    $dados = carregaDoArquivoParaVetor();
    foreach($dados as $contato){
        if ($contato['id'] == $id)
            return $contato;
    }
}

function alterar($alterado){
    $dados = carregaDoArquivoParaVetor();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $alterado['id'])
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1,array($alterado));
    salvaDadosNoArquivo($dados);  
}


$acao = isset($_POST['acao'])?$_POST['acao']:'';

if ($acao =='salvar'){

    $contato = carregaDadosFormParaVetor();
    if ($contato['id'] == 0){
        if (inserir($contato))
            header('location: DEVWEB_ATIVIDADE1.php');
    }else{    
        alterar($contato);
        header('location: DEVWEB_ATIVIDADE1.php');

    }
}
else{

    $acao = isset($_GET['acao'])?$_GET['acao']:'';
    $id = isset($_GET['id'])?$_GET['id']:'';

    if ($acao == 'excluir'){
        excluir($id);
    }else if($acao == 'editar'){
        $contato = buscaContato($id);


    }
}


  