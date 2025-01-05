 <?php 

#conexão com banco de dados

#variaveis

$servername = "localhost";
$dbUsername = "root";
$dbname = "testeBD";
$password ="";

#Criando uma nova estancia de mysqli para poder criar a conexão com o banco de dados
$conn = new mysqli($servername, $dbUsername, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


?>