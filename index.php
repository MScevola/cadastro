<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crossknowledge - teste</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/styles.css"/>






</head>

<body>


<div class="container-fluid jumbotron">
	<div class="row">
    	<div class="col-md-2">
        </div>
        
        
        
        
        
        <!--///// FORM ///////////////////////////////////////////
        //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////-->
        <div class="col-md-3">
        	<?
				include('.ajax/sql.php');
				
				$busca_atualizacao = mysql_query("SELECT date FROM cadastros WHERE date>'$date' ORDER BY date DESC LIMIT 1");
				list($date)=mysql_fetch_row($busca_atualizacao);
				
				mysql_close();
			?>
        	<h4>Cadastro</h4>
            <div class="alert"></div>
        	<form id="form_cadastro">
            	<input type="hidden" name="id" />
                <input type="hidden" name="date" value="<?=$date?>" />
                <input name="nome" class="form-control" type="text" placeholder="Nome" />
                <input name="sobrenome" class="form-control" type="text" placeholder="Sobrenome" />
                <input name="endereco" class="form-control" type="text" placeholder="Endereço" />
            </form>
            <button class="btn btn-primary btn-block" id="salvar">Adicionar cadastro</button>
        </div>
        <!--///// FIM FORM ///////////////////////////////////////////
        ////////////////////////////////////////////////////////-->
        
        
        
        
        
        
        
        
        
        
        <!--///// TABELA ///////////////////////////////////////////
        //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////-->
        <div class="col-md-5">
            <table class="table">
                <tr class="header">
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th class="endereco">Endereço</th>
                    <th class="acoes">Ações</th>
                </tr>
                <?
					include('.ajax/sql.php');
					
					$busca_cadastros = mysql_query("SELECT id, nome, sobrenome, endereco FROM cadastros WHERE status!='2'");
					while(list($id, $nome, $sobrenome, $endereco)=mysql_fetch_row($busca_cadastros)){
						print '<tr id="c_'.$id.'">
							<td>'.$nome.'</td>
							<td>'.$sobrenome.'</td>
							<td>'.$endereco.'</td>
							<td><img src="images/editar.png" width="30" class="editar" data-id="'.$id.'" /> <img src="images/deletar.png" width="30" class="deletar" data-id="'.$id.'" data-toggle="modal" data-target="#confirm-delete" /></td>
						</tr>';
					}
					
					session_start();
					$busca_atualizacao = mysql_query("SELECT date FROM cadastros ORDER BY date DESC LIMIT 1");
					list($ultima_atualizacao)=mysql_fetch_row($busca_atualizacao);
					$_SESSION['ultima_atualizacao']=$ultima_atualizacao;
					
					mysql_close();
				?>                
    		</table>
        </div>
        <!--///// FIM TABELA ///////////////////////////////////////////
        ////////////////////////////////////////////////////////-->
        
        
        
        
        
        
        
        <div class="col-md-2">
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/spin.min.js"></script>
<script type="text/javascript" src="js/jquery.spin.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>