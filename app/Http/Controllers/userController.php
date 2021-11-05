<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;


class userController extends Controller
{
    public static function cadastroUsuario(){

        $login = $_POST['nomeCadastro'];
        $senha = ($_POST['senhaCadastro']);
        $nome = $_POST['clienteCadastro'];
        $select = DB::select("SELECT * FROM usuarios WHERE login = ?", [$login]);
        
    
        if($login == "" || $login == null || $nome == "" || $nome == null){
            echo"<script language='javascript' type='text/javascript'>
            alert('O campo login e nome do cliente devem ser preenchidos');
            window.location.href='retornoLogin';</script>";
            die();

        }else{
            if($select != []){

                echo"<script language='javascript' type='text/javascript'>
                alert('Esse login já existe');
                window.location.href='retornoLogin';</script>";
                die();

            }else{
                
                $insert = DB::insert('INSERT INTO usuarios (login,senha, nome) values (?, ?, ?)', [$login, $senha, $nome]);

                if($insert){
                    echo"<script language='javascript' type='text/javascript'>
                    alert('Usuário cadastrado com sucesso!');
                    window.location.href='retornoLogin';</script>";

                }else{
                    echo"<script language='javascript' type='text/javascript'>
                    alert('Não foi possível cadastrar esse usuário');
                    window.location.href='retornoLogin';</script>";

                }
            }
        }
    }

    public static function loginUsuario(){
        $login = $_POST['nomeLogin'];
        $entrar = $_POST['login'];
        $senha = ($_POST['senhaLogin']);
        
        
        if (isset($entrar)) {
        
            $verifica = DB::select("SELECT * FROM usuarios WHERE login = ? AND senha = ?", [$login, $senha]);
            
            
            if ($verifica == []){
                echo"<script language='javascript' type='text/javascript'>
                    alert('Login e/ou senha incorretos');
                    window.location.href='retornoLogin';
                    </script>";
                die();
            }else{
                setcookie("login",$login);
                setcookie("nome",$verifica[0]->nome);
                echo"<script language='javascript' type='text/javascript'>
                    window.location.href='dashboard';
                    </script>";
            }
        }
    }

    public static function cadastroFilme(){
        $titulo = $_POST['tituloFilmeCadastro'];
        $categoria = $_POST['categoriaCadastro'];
        $dataInicial = $_POST['dataInicialCadastro'];
        $dataFinal = $_POST['passarDataFinal'];
        $login = $_COOKIE['login'];

        $verificaLogin = DB::select("SELECT * FROM usuarios WHERE login = ?", [$login]);

        if ($verificaLogin == []){
            echo"<script language='javascript' type='text/javascript'>
                alert('Faça o login para cadastrar um filme!!');
                window.location.href='retornoLogin';
                </script>";
            die();
        }

        if($titulo == null || $titulo == "" || $categoria == null || $categoria == ""){
            echo"<script language='javascript' type='text/javascript'>
            alert('O campo e nome e/ou categoria devem ser preenchidos!!');
            window.location.href='dashboard/cadastroFilmes';</script>";
            die();
        }
        if($dataInicial == null || $dataInicial == ""){
            echo"<script language='javascript' type='text/javascript'>
            alert('Insira uma data de início da locação!!');
            window.location.href='dashboard/cadastroFilmes';</script>";
            die();
        }

        $insert = DB::insert('INSERT INTO filmes (titulo, categoria, cadastradoPor, dataInicio, dataFinal) values (?, ?, ?, ?, ?)', [$titulo, $categoria, $login, $dataInicial, $dataFinal]);

        if($insert){
            echo"<script language='javascript' type='text/javascript'>
            alert('Filme cadastrado com sucesso!');
            window.location.href='dashboard';</script>";

        }else{
            echo"<script language='javascript' type='text/javascript'>
            alert('Não foi possível cadastrar esse filme');
            window.location.href='dashboard/cadastroFilmes';</script>";

        }
    }

    public static function entregaFilme(){
        
        $idFilmes = $_POST['idfilmes'];
        $dataInformada = $_POST['dataEntrega'];
        $dt = new DateTime();
        $dataHoje = $dt->format('Y-m-d');
        $verificaFilme = DB::select("SELECT * FROM filmes WHERE id_filmes = ?", [$idFilmes]);
        $dataEntrega = $verificaFilme[0]->dataFinal;
        
        if($dataInformada == null || $dataInformada == ""){
            echo"<script language='javascript' type='text/javascript'>
            alert('Insira uma data de entrega do filme!!');
            window.location.href='dashboard';</script>";
            die();
        }
        if($dataInformada < $dataEntrega){
            echo"<script language='javascript' type='text/javascript'>
            alert('Entregue o filme no mínimo no dia da data de entrega!!');
            window.location.href='dashboard';</script>";
            die();
        }else{
            DB::delete('DELETE FROM filmes WHERE id_filmes = ?', [$idFilmes]);
            if($dataHoje <= $dataEntrega){
            echo"<script language='javascript' type='text/javascript'>
            alert('Filme entregue sem valor adicional na entrega');
            window.location.href='dashboard';</script>";
            die();
            }else{
            echo"<script language='javascript' type='text/javascript'>
            alert('Pague 10 reais de valor adicional na entrega');
            window.location.href='dashboard';</script>";
            die();
            }
        }
    }
    
}
