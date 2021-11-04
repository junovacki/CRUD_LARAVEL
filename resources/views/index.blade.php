<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body id="body">
    <div id="formCadastro">
        <form action="{{ url('/cadastro') }}" method="post">
            @csrf
            <div id="campoNomeCadastro">
                <label id="nomeCadastro">Login:</label><input type="text" name="nomeCadastro" id="nomeCadastro" />
            </div>
            <div id="campoSenhaCadastro">
                <label id="senhaCadastro">Senha:</label><input type="password" name="senhaCadastro" id="senhaCadastro" />
            </div>
            <div id="campoClienteCadastro">
                <label id="clienteCadastro">Nome do cliente:</label><input type="text" name="clienteCadastro" id="clienteCadastro" />
            </div>
            <div id="botaoCadastro">
                <input type="submit" value="Cadastrar" name="cadastrar" id="cadastrar" />
            </div>
        </form>
    </div>
    <div id="formLogin">
        <form action="{{ url('/login') }}" method="post">
            @csrf
            <div id="campoNomeLogin">
                <label>Login:</label><input type="text" name="nomeLogin" id="nomeLogin" />
            </div>
            <div id="campoSenhaLogin">
                <label id="senhaLogin">Senha:</label><input type="password" name="senhaLogin" id="senhaLogin" />
            </div>
            <div id="linkLogin">
                <p onclick="escondeLogin('formLogin')">Clique para se cadastrar</p>
            </div>
            <div id="botaoLogin">
                <input type="submit" value="Login" name="login" id="login" />
            </div>
        </form>
    </div>
</body>
</html>
<script>
    document.getElementById('formCadastro').style.visibility = "hidden";
    function escondeLogin(id) {
        document.getElementById(id).style.visibility = "hidden";
        document.getElementById('formCadastro').style.visibility = "visible";
    }
</script>