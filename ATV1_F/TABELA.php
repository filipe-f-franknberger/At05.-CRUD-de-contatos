<?php
    include "action.php";
?>
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="CSS.css">
<head>
</head>
<body>
    <h1>Contatos</h1>
    <nav>
        <ul class="MainMenu">
        <a href="FORM_CADASTRO.php"><button type="button" class="btn btn-dark">Realizar Cadastro</button></a>
        </ul>
    </nav>

    <selection>
        <table class="table lista-contatos">
            <thead>
                <tr>
                    <th>id</th><th>nome</th><th>sobrenome</th><th>Contato</th><th>Alterar</th><th>Deletar</th>
                </tr>
            </thead>
            <?php    
                $dados = ApresentaDadosVetor();  
                foreach($dados as $contato){
                    $alterar = "<a href='FORM_CADASTRO.php?acao=editar&Id=".$contato['Id']."'>Alt</a>";
                    $excluir = "<a href='#' onclick=excluir('Tabela.php?acao=excluir&id=".$contato['id']."')>Del</a>";
                    echo "<tr><td>".$contato['id']."</td><td>".$contato['nome']."</td><td>".$contato['sobrenome']."</td><td>"."</td><td>".$alterar."</td><td>".$excluir."</td></tr>";
                }
            ?>
        </table>
    </selection>
</body>