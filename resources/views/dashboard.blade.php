<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body id="body">
    <div class="topnav" id="myTopnav">
        <a href="/dashboard" class="active">Filmes</a>
        <a href="/dashboard/cadastroFilmes">Cadastro de filmes</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
        <?php 
            use Illuminate\Support\Facades\DB;
            $cont=1;
            $resultset = DB::select("SELECT * FROM filmes WHERE cadastradoPor = ?", [$_COOKIE['login']]);
            
            

            foreach( $resultset as $record) {
    
        ?>
            <main class="py-4 container">
                <div class ="row" id="caixaCard">
                    <div class="col-md-4">
                        <div class="card">
                            <h4 class="card-header" >
                                <a onclick="entregaFilme('formEntrega<?=$cont?>')" class="btn btn-primary" id="btnEntregar">Entregar Filme</a>
                            </h4>
                            <div class="card-body"><?php echo "Título: ".$record->titulo?></div>
                            <br>
                            <div class="card-body"><?php echo "Categoria: ".$record->categoria?></div>
                            <br>
                            <div class="card-body"><?php echo "Data retirada: ".$record->dataInicio?></div>
                            <div class="card-body"><?php echo "Data entrega: ".$record->dataFinal?></div>
                        </div>
                    </div>
                </div>
                
                <div id="formEntrega<?=$cont?>">
                    <div id="teste">
                    <form action="{{ url('/entregaFilme') }}" method="post">
                    @csrf
                        <div id="dataEntrega">
                            <label id="dataInicialCadastro">Entregue dia:</label><input type="date" name="dataEntrega" id="dataEntregaID"  />
                            <input type="submit" value="Entregar" name="entregar" id="entregar" />
                            <input type="hidden" value="<?=$record->id_filmes?>" name="idfilmes" id="idfilmes" />
                        </div>
                        

                    </form>
                    </div>
                </div>
           
         
    </main>


    <?php 
    $cont++;
} ?>
<?php 
if($resultset == []){
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<marquee><h1>CADASTRE UM FILME PARA QUE ELE APAREÇA AQUI</h1></marquee>
<?php }?>
    </div>
</body>
</html>
<script>
    var cont = <?=$cont?>;
    for(var i=1; i<=cont; i++){
        document.getElementById("formEntrega"+i).style.visibility = "hidden";
    }
    function entregaFilme(id){
        document.getElementById(id).style.visibility = "visible";
    }
</script>