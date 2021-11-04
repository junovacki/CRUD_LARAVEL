<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de filmes</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/cadastroFilmes.css') }}">
</head>
<body id="body">
    <div class="topnav" id="myTopnav">
        <a href="/dashboard">Filmes</a>
        <a href="/dashboard/cadastroFilmes" class="active">Cadastro de filmes</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div id="formCadastroFilmes">
        <form action="{{ url('/cadastroFilme') }}" method="post">
            @csrf
            <div id="campoCadastroTituloFilme">
                <label id="tituloFilmeCadastro">Título do filme:</label><input type="text" name="tituloFilmeCadastro" id="tituloFilmeCadastro" />
            </div>
            <div id="campoCadastroCategoriaFilme">
                <label id="categoriaCadastro">Categoria:</label><input type="text" name="categoriaCadastro" id="categoriaCadastro" />
            </div>
            <div id="campoCadastroDataInicialFilme">
                <label id="dataInicialCadastro">Data de início da locação:</label><input type="date" name="dataInicialCadastro" id="dataInicialCadastroID" onchange="trocarData()" />
            </div>
            <div id="campoCadastroDataFinalFilme">
                <label id="dataFinalCadastro">Data de entrega do filme:</label><input type="date" name="dataFinalCadastro" id="dataFinalCadastroID" disabled="disabled"/>
            </div>
            <div id="botaoCadastro">
                <input type="submit" value="Cadastrar" name="cadastrar" id="cadastrar" />
            </div>
            <input type="hidden" name="passarDataFinal" id="passarDataFinal" />
        </form>
    </div>
</body>
</html>
<script>
    function trocarData(){
        var date = new Date();
        var dataFinal = new Date(document.getElementById("dataInicialCadastroID").value);
        dataFinal.setDate(dataFinal.getDate()+7);
        var currentDate = date.toISOString().substring(0,10);
        var finalDate = dataFinal.toISOString().substring(0,10);
        var dataInicial = document.getElementById("dataInicialCadastroID").value;
        
        if(currentDate <= dataInicial){
            document.getElementById("dataFinalCadastroID").value = finalDate;
            document.getElementById("passarDataFinal").value = finalDate;
        }else{
            document.getElementById("dataInicialCadastroID").value=null;
            alert("Você só pode cadastrar filmes a partir da data de hoje!!");
        }
    }
    function habilitaFinal(){
        document.getElementById("dataInicialCadastroID").disabled = false;
    }
</script>