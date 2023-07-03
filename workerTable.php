<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$querypay = "FROM worker w inner JOIN workersalary ws on ws.workerId=w.id WHERE w.isActive=1 and YEAR(date)='$_GET[year]' and YEAR(w.dateJoining)<=$_GET[year]";
$queryTotal="SELECT SUM(w.salary) FROM worker w inner JOIN workersalary ws on ws.workerId=w.id WHERE w.isActive=1 and YEAR(date)='$_GET[year]' and YEAR(w.dateJoining)<=$_GET[year]";
$totalsalary = "SELECT SUM(ws.salary) as totalsalary FROM worker w inner JOIN workersalary ws on ws.workerId=w.id WHERE w.isActive=1 and YEAR(date)='$_GET[year]' and YEAR(w.dateJoining)<=$_GET[year]";

if(isset($_GET['month']))
{
    $querypay=$querypay." and month(date)='$_GET[month]'";
    $totalsalary=$totalsalary." and month(date)='$_GET[month]'";
}
$queryWithoutPay="SELECT w.id,w.name,w.salary,w.notes FROM worker w WHERE id NOT IN (SELECT w.id $querypay) and isActive=1 and YEAR(w.dateJoining)<=$_GET[year]";
$querypay="SELECT w.id,w.name,w.salary,SUM(ws.salary) as totalsalary,w.notes ".$querypay;
if(isset($_GET['search']))
{
    $querypay=$querypay." and w.name like '%$_GET[search]%'";
    $queryWithoutPay=$queryWithoutPay." and w.name like '%$_GET[search]%'";
    $totalsalary=$totalsalary." and w.name like '%$_GET[search]%'";
}
$queryTotal="SELECT SUM(ws.salary)";
$querypay=$querypay." GROUP by ws.workerId";
$queryWithoutPay=$queryWithoutPay." GROUP by w.id";
// echo "<table style='background-color: black'>
// <tr style='width:800px'>
// <td><label  style='color:yellow;'>Total Salary</label></td>
// <td><input type='text' disabled value=";
// if(!isset($_GET['month']))
// {
//     $salary=$salary*12;
// }
// echo ($salary)."></td>
// <td><label  style='color:yellow;'>Paid Salary</label></td>
// <td><input type='text' disabled value=$totalpay></td><td>
// <label  style='color:yellow;'>Balance</label></td>
// <td><input type='text' disabled value=".(intval($salary)-$totalpay)."></td></tr></table>";
?>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<table border=1px style="width:1000px;overflow-x:auto;overflow-y:auto;" >

<?php if($_SESSION['admin']==1)
    {
      echo "<tr><td colspan='5'><a href='workerAdd.php' class='button-63'>Add Worker</a>";
    }?>
</td></tr>
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Name</th>
    <!--<th style='color:black'>Salary</th>-->
    <?php
    // if($_SESSION['admin']==1)
    // {
    //   echo "<th style='color:black'>Paid</th>";
    // }
    ?>
    
    <th style="color:black;">Details</th>
    <?php
     if($_SESSION['admin']==1)
    {
      echo "<th style='color:black'>Update</th>
      <th style='color:black'>Delete</th>";
    }?>
  </tr>
  <?php
  
  $result = @mysqli_query($conn, $querypay);

$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>
    <td><a  style='color:black' href='workerDetail.php?id=$row[id]'>$row[name]</a></td>";
    // echo "<td style='color:black' >".$row['salary']."</td>";
    //  if($_SESSION['admin']==1)
    // {
    //   echo "<td ><a style='color:black' href='workerSalaryAdd.php?id=$row[id]'>".$row['totalsalary']."</a></td>";
    // }
    // echo $queryNotes."$row[id] order by id desc";
    
    
    // echo "<td style='color:black' >".$row['notes']."</td>";
     echo "<td><a href='workersalary.php?id=$row[id]'>Details</a></td>";
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='workerUpdate.php?id=$row[id]'>Update</a></td>
        <td><a href='workerDelete.php?id=$row[id]'>Delete</a></td>";
    }
    echo "</tr>";
 }
 $result = @mysqli_query($conn, $queryWithoutPay);
  while($row = @mysqli_fetch_assoc($result))
  {
     $i=$i+1;
     echo "<tr>
     <td  style='color:black'>" . $i . "</td>
     <td><a style='color:black' href='workerDetail.php?id=$row[id]'>$row[name]</a></td>";
     //echo "<td style='color:black'>".$row['salary']."</td>";
    //   if($_SESSION['admin']==1)
    //  {
    //   echo "<td><a style='color:black' href='workerSalaryAdd.php?id=$row[id]'>0</a></td>";
    //  }
    //echo "<td style='color:black' >".$row['notes']."</td>";
    echo "<td><a href='workersalary.php?id=$row[id]'>Details</a></td>";
     if($_SESSION['admin']==1)
     {
         echo "<td><a href='workerUpdate.php?id=$row[id]'>Update</a></td>
         <td><a href='workerDelete.php?id=$row[id]'>Delete</a></td>";
     }
     echo "</tr>";
  }
  //$result = @mysqli_query($conn, $totalsalary);
//   echo "<tr>
//      <td>Total</td>
//      <td></td>
//      <td></td>";
//   if($row = @mysqli_fetch_assoc($result))
//   {
  
//      echo "<td style='color:black'>$row[totalsalary]</td>";
//   }
//   else
//   {
//   echo "<td style='color:black'>0</td>";
//   }
//   echo "</tr>";
    ?>
    
</table>

</div>


