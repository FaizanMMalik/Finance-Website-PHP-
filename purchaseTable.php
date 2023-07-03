<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';

$query = "select p.id,p.amount,p.date,a.name,pa.name as pname from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where a.isActive=1";
$tquery = "select sum(p.amount) as total from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where a.isActive=1";

if(isset($_GET['year1'])&&isset($_GET['month1'])&&isset($_GET['day1'])&&isset($_GET['year2'])&&isset($_GET['month2'])&&isset($_GET['day2']))
{
  $query=$query." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $tquery=$tquery." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
}
else if(isset($_GET['year1'])&&isset($_GET['month1'])&&isset($_GET['day1']))
{
  $query=$query." and p.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $tquery=$tquery." and p.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
}
else if(isset($_GET['year1'])&&isset($_GET['month1']))
{
  $query=$query." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $tquery=$tquery." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
}
else if(isset($_GET['year1']))
{
  $query=$query." and YEAR(p.date) = '$_GET[year1]'";
  $tquery=$tquery." and YEAR(p.date) = '$_GET[year1]'";
}
if(isset($_GET['search']))
{
    $query=$query." and a.name like '%$_GET[search]%'";
    $tquery=$tquery." and a.name like '%$_GET[search]%'";
}
$query=$query." order by p.date desc";
?>


<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<?php

if($_SESSION['admin']==1)
{
  echo "<table style='width:1000px'><tr>
  <td colspan='7'>
  <a href='purchaseAdd.php'  class='button-63'>Add Expense</a></td>
  </tr></table>";
}
?>
<table  border=1px style="width:1000px;overflow-x:auto;"  >

  <tr>
    <th style="color:black;width:60px">S.No</th>
     <th style='color:black;width:130px'>Date</th>
    <th style='color:black;width:190px'>Details</th>
    <th style='color:black'>Assets</th>
      <th style='color:black'>Amount</th>
    <?php
     if($_SESSION['admin']==1)
    {
      echo "<th style='color:black'>Update</th>
      <th style='color:black'>Delete</th>";
    }?>
    
  </tr>
  <?php
  
  $result = @mysqli_query($conn, $query);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>
  <td style='color:black'>".date('d-m-Y', strtotime($row['date']))."</td>
   <td style='color:black'>".$row['pname']."</td>
     <td style='color:black'>".$row['name']."</td>
   <td style='color:black'>".$row['amount']."</td>
  
    ";
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='purchaseUpdate.php?id=$row[id]'>Update</a></td>
        <td><input type='button' style='border:none; background-color:transparent;color:orange' onclick='deletePurchase($row[id])' value='Delete'/></td>";
    }
    echo "</tr>";
 }
 
    ?>
    
</table>
</div>
<?php
$result = @mysqli_query($conn, $tquery);
if($row = @mysqli_fetch_assoc($result))
{
   echo "<h2 style='color:yellow'> Total: ".$row['total']."</h2>";
 
}
mysqli_close($conn);
?>
