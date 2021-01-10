<?php
    
  


    $servername = "";
    $user="";
    $pass="";
    $db_name=""; 
 
 
 
     $conn =  mysqli_connect($servername, $user , $pass, $db_name);
 
 
     if(!empty($_GET['action']) AND $_GET['action'] == 'delete'){
         $id = (int) $_GET['id'];
     $result = mysqli_query($conn , "DELETE FROM pessoas WHERE id_pessoa='{$id}' ");
     }


    $query=  'SELECT id_pessoa, nome, data_admissao FROM pessoas';
    $result=  mysqli_query($conn, $query);
 
    
      
 
     print '<tbody border=1>';
     print '<table>';
     print '<tr>';
     print "<th></th>";
  
     print "<th>Nome</th>";
     print "<th>Data de Admissão</th>";
     print '</tr>';
     print '</thead>';
     print '</tbody>';

     
     function first_name($nome){
        $nome = trim($nome);
        $parts = explode(" ", $nome);
        if(count($parts) > 1){
            $primeiro_nome = array_shift($parts);
        }
        else
        {
            $primeiro_nome = $parts;
        }
        
        return $primeiro_nome;
    }
 
     while ($row = mysqli_fetch_assoc($result)){
         $id = $row['id_pessoa'];
         $primeiro_nome = first_name($row['nome']);
         $data_admissao_sql = $row['data_admissao'];
         $data_admissao_conversao = strtotime($data_admissao_sql);
         $data_admissao_brasil = date('d/m/Y' , $data_admissao_conversao);         
         
        
     
 
         print '<tr>';
         print "<td align='center'>
         <a href='index3.php?action=delete&id={$id}'>
                 <p>X</p>            
                 </a></td>";
         print "<td> {$primeiro_nome}</td>";
         print "<td>  {$data_admissao_brasil}</td>";
         print "</tr>";
 
     }
             
      
    $dados = $_POST;
    $sql = "INSERT INTO pessoas  (nome ,rg ,cpf, data_nascimento , data_admissao)
    VALUES ('$_POST[nome]', '$_POST[rg]', '$_POST[cpf]', '$_POST[data_nascimento]' , '$_POST[data_admissao]')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

 ?>
 

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>
 <body>
   <form action="index.php" method="POST" encytype="">
   
     <!-- <label>Codigo</label>
     <input name="id_pessoa" type="text"> -->
     <label>Nome</label>
     <input name="nome" type="text">
     <label>RG</label>
     <input name="rg" type="text">
     <label>Cpf</label>
     <input name="cpf" type="text">
     <label>Data de Nascimento</label>
     <input name="data_nascimento" type="date">
     <label>Data Admissão</label>
     <input name="data_admissao" type="date"> 
  
    <button type="submit">Enviar</button>  
    

    
    
   
   </form>  
 </body>
 </html>
