<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';

?>

<table border=1px style="width:1000px;overflow-x:auto;overflow-y:auto;" >
<?php if($_SESSION['admin']==1)
    {
      echo "<tr><td colspan='4'><a href='workerAddNotes.php?id=$_GET[id]' class='button-63'>Add Notes</a></td></tr>";
    }?>

  <tr>
    <th style='color:black' >S. No.</th>
    <th style='color:black'>Name</th>
    <th style='color:black'>Detail</th>
    <?php
    if($_SESSION['admin']==1)
    {
      echo "
      <th style='color:black'>Delete</th>";
    }
    ?>
  </tr>
  <?php
  $query="select w.id as wid,n.id as nid,w.name,n.detail from notes n inner join worker w on n.workerId=w.id where w.id=$_GET[id] order by n.id desc";
  $result = @mysqli_query($conn, $query);

$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black' >" . $i . "</td>
    <td><a  style='color:black' href='workerDetail.php?id=$row[wid]'>$row[name]</a></td>
    <td style='color:black'>".$row['detail']."</td>";
     if($_SESSION['admin']==1)
    {
        echo "
        <td><a style='color:orange' onclick='deleteNotes($row[nid])'>Delete</a></td>";
    }
    echo "</tr>";
 }

    ?>
    
</table>
