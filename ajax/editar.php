<?
include('sql.php');
extract($_POST);

$busca_cadastro = mysql_query("SELECT nome, sobrenome, endereco FROM cadastros WHERE id='$id'")or die(mysql_error());
list($nome, $sobrenome, $endereco)=mysql_fetch_row($busca_cadastro);

$retorno['id'] = $id;
$retorno['nome'] = $nome;
$retorno['sobrenome'] = $sobrenome;
$retorno['endereco'] = $endereco;

exit (json_encode($retorno, 128));
?>