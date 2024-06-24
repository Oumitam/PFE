<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>authentification</title>
</head>
<style>


    
</style>
<body>
   <form  method="POST">
   	<center><h2> <b><u>Authentification </u></b></h2>
   		<table>
   			<tr>
   				<td align="right">Login:</td>
   				<td><input type="text" name="nom"></td>
   			</tr>
   			<tr>
   				<td align="right">Mot de passe:</td>
   				<td><input type="password" name="pwd"></td>
   			</tr>
   			<tr>
   				<td></td>
   				<td><input type="submit" name="ok" value="connxion"></td>
   			</tr>

   		</table>
   		</center>
   </form>

   <?php 
   		if (isset($_POST['ok'])){
			$conn = new mysqli('localhost', 'root', '', 'gestionemployee');
			$login=$_POST['nom'];
			$pwd=$_POST['pwd'];

			$req="SELECT * FROM `utilisateurs` WHERE  nom='$login' and pwd='$pwd'";
			$res=$cnx->query($req);
			$data=$res->fetch_assoc();
			if ($data){
				session_start();
				$_SESSION['nom']=$data['nom'];
				header('location:accuiel.php');
			}else{
				echo '<center>Login ou mot de passe sont incorrectes</center>';
			}
   		}
   		
    ?>