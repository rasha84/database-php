<?php
  include_once 'connect.php';

  $sql = "SELECT * FROM clients";
  $requet = $conn->query($sql);

  echo '<form>';
  echo '<table class="centered">
  <th>First Name </th>
  <th>Last Name </th>
  <th> Email</th>
  <th> Website </th>    
  <th>Comment</th>
  <th>Gender</th>';
  
  while ($data = $requet->fetch())
  {
      echo'<tr>
                <td>'. $data['firstname'].'</td>
                <td>'. $data['lastname'].' </td>
                <td>'. $data['email'].' </td>
                <td>'. $data['C_url'].' </td>
                <td>'. $data['comment'].' </td>
                <td>'. $data['gender'].' </td>
                <td><input type="checkbox" name="record" value="'.$data['id'].'"</td>
          </tr>';
  }
  echo '</table>';

  echo '<input type= "submit" name="submit" value="submit">';
  echo'</form>';


  if(isset($_POST['submit']))
  {

  }

  
  function delete(array $id){

    try {
        $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// j'ai pas encore finiiiiiiiit :((  


?>