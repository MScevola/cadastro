<?
include('sql.php');

$busca_atualizacao = mysql_query("SELECT date FROM cadastros WHERE date>'$date' ORDER BY date DESC LIMIT 1");
$encontrou = mysql_num_rows($busca_atualizacao);

if($encontrou!=0){
	
	list($date)=mysql_fetch_row($busca_atualizacao);
	
	$busca_cadastros = mysql_query("SELECT id, nome, sobrenome, endereco FROM cadastros WHERE status!='2'");
	
	$cadastros = '<tr class="header">
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th class="endereco">Endereço</th>
                    <th class="acoes">Ações</th>
                </tr>';
	while(list($id, $nome, $sobrenome, $endereco)=mysql_fetch_row($busca_cadastros)){
		$cadastros .= '<tr id="c_'.$id.'">
			<td>'.$nome.'</td>
			<td>'.$sobrenome.'</td>
			<td>'.$endereco.'</td>
			<td><img src="images/editar.png" width="30" class="editar" data-id="'.$id.'" /> <img src="images/deletar.png" width="30" class="deletar" data-id="'.$id.'" data-toggle="modal" data-target="#confirm-delete" /></td>
		</tr>';
	}
	
	$retorno['atualiza'] = 'ok';
	$retorno['date'] = $date;
	$retorno['cadastros'] = $cadastros;
}else{
	$retorno['atualiza'] = 'false';
}



exit (json_encode($retorno, 128));
?>