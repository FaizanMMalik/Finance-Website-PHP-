<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$query = "SELECT f.id,f.name,SUM(fa.amountRecieve) as recieve,SUM(fa.amountSend) as send FROM fourman f left join fourmanamount fa on fa.fourManId=f.id";
$totalpay="SELECT SUM(fa.amountSend) as send,SUM(fa.amountRecieve) as recieve FROM fourman f inner JOIN fourmanamount fa on fa.fourManId=f.id";
if(isset($_GET['year'])&&isset($_GET['month']))
{
  $query=$query." WHERE (YEAR(date)='$_GET[year]' and month(date)='$_GET[month]')";
  $totalpay=$totalpay." WHERE (YEAR(date)='$_GET[year]' and month(date)='$_GET[month]')";
}
else if(isset($_GET['year']))
{
  $query=$query." WHERE (YEAR(date)='$_GET[year]')";
  $totalpay=$totalpay." WHERE (YEAR(date)='$_GET[year]')";
}
if(isset($_GET['search']))
{
    if(strpos($totalpay, "WHERE"))
    {
    $query=$query." and f.name like '%$_GET[search]%'";
    $totalpay=$totalpay." and f.name like '%$_GET[search]%'";
    }
    else
    {
        $query=$query." where f.name like '%$_GET[search]%'";
    $totalpay=$totalpay." where f.name like '%$_GET[search]%'";
    }
}
$query=$query." GROUP by f.id";
?>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<table border=1px style="width:1200px;overflow-x:auto;overflow-y:auto;" >

<?php if($_SESSION['admin']==1)
    {
      echo "<tr><td colspan='6'><a href='fourManAdd.php' class='button-63'>Add ForeMan</a>";
    }?>
</td></tr>
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Name</th>
    <th style='color:black'>Amount Recieved</th>
    <th style='color:black'>Amount Spent</th>
    
    
    <?php
     if($_SESSION['admin']==1)
    {
      echo "<th style='color:black'>Update</th>
      <th style='color:black'>Delete</th>";
    }?>
  </tr>
  <?php
  
  $result = @mysqli_query($conn, $query);
$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>
    <td><a  style='color:black' href='fourManDetail.php?id=$row[id]'>$row[name]</a></td>";
   
    echo "<td style='color:black' ><a href='fourManAmount.php?id=$row[id]'>";
    if($row["send"]!=null)
    {
      echo $row['send'];
    }
    else
    {
      echo "0";
    }
   
     echo "</a></td><td style='color:black' ><a href='fourManAmount.php?id=$row[id]'>";
    
     if($row["recieve"]!=null)
    {
      echo $row['recieve'];
    }
    else
    {
      echo "0";
    }
    echo "</a></td>";
      
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='fourManUpdate.php?id=$row[id]'>Update</a></td>
        <td><a href='fourManDelete.php?id=$row[id]'>Delete</a></td>";
    }
    echo "</tr>";
 }
 $result = @mysqli_query($conn, $totalpay);
  if($row = @mysqli_fetch_assoc($result))
 {
  echo "<tr><td colspan=2 style='color:black;text-align:center'>Total</td><td style='color:black'>$row[send]</td><td style='color:black'>$row[recieve]</td></tr>";
 }
    ?>
    
</table>
</div>