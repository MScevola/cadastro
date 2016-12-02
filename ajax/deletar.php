<?
include('sql.php');
extract($_POST);

$data = date("Y-m-d H:i:s");

mysql_query("UPDATE cadastros SET status='2', date='$data' WHERE id='$id'");

$retorno['id'] = $id;
$retorno['date'] = $data;

exit (json_encode($retorno, 128));
?>