<?
include('sql.php');
extract($_POST);



function filtra($string){
	$string = addslashes($string);
	$string = str_replace('"', '', $string);
	$string = eregi_replace("#","", $string);
	$string = eregi_replace("SELECT","", $string);
	$string = eregi_replace("UPDATE","", $string);
	$string = eregi_replace("TRUNCATE","", $string);
	$string = eregi_replace("DROP","", $string);
	$string = eregi_replace("INSERT","", $string);
	return $string;
}

if($nome == null){
	$retorno['acao'] = 'alerta';
	$retorno['alerta'] = 'Por favor, digite um nome para o cadastro!';
	exit (json_encode($retorno, 128));
}else{
	$nome = filtra($nome);
}

if($sobrenome == null){
	$retorno['acao'] = 'alerta';
	$retorno['alerta'] = 'Por favor, digite um sobrenome para o cadastro!';
	exit (json_encode($retorno, 128));
}else{
	$sobrenome = filtra($sobrenome);
}

if($endereco == null){
	$retorno['acao'] = 'alerta';
	$retorno['alerta'] = 'Por favor, digite o endereço do cadastro!';
	exit (json_encode($retorno, 128));
}else{
	$endereco = filtra($endereco);
}

$data = date("Y-m-d H:i:s");
$retorno['date'] = $data;

if($id==null){
	
	////////////////////// CADASTRO EM BRANCO ////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	mysql_query("INSERT INTO cadastros VALUES(0, '$nome', '$sobrenome', '$endereco', '', '$data')");
	
	$id = mysql_insert_id();
	$retorno['acao'] = 'novo';
	$retorno['cadastro'] = '<tr id="c_'.$id.'">
		<td>'.$nome.'</td>
		<td>'.$sobrenome.'</td>
		<td>'.$endereco.'</td>
		<td><img src="images/editar.png" width="30" class="editar" data-id="'.$id.'" /> <img src="images/deletar.png" width="30" class="deletar" data-id="'.$id.'" /></td>
	</tr>';
	$retorno['alerta'] = 'Endereço cadastrado com sucesso!';
	
}else{
	
	
	////////////////////// ATUALIZA CADASTRO ////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	mysql_query("UPDATE cadastros SET nome='$nome', sobrenome='$sobrenome', endereco='$endereco', date='$data' WHERE id='$id'");
	$retorno['acao'] = 'editar';
	$retorno['id'] = $id;
	$retorno['cadastro'] = '<td>'.$nome.'</td>
		<td>'.$sobrenome.'</td>
		<td>'.$endereco.'</td>
		<td><img src="images/editar.png" width="30" class="editar" data-id="'.$id.'" /> <img src="images/deletar.png" width="30" class="deletar" data-id="'.$id.'" /></td>';
	$retorno['alerta'] = 'Endereço atualizado com sucesso!';
	
}

exit (json_encode($retorno, 128));
?>