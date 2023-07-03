
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$querypay = "select ws.id,ws.salary as pay,ws.date,w.salary,ws.detail,p.name FROM worker w inner JOIN workersalary ws on ws.workerId=w.id inner join partner p on ws.partnerId=p.id WHERE w.isActive=1 and YEAR(date)='$_GET[year]' and w.id='$_GET[id]'";
$queryname = "select name,salary FROM worker w where id='$_GET[id]'";
$querytotal = "select sum(ws.salary) as salary FROM worker w inner JOIN workersalary ws on ws.workerId=w.id WHERE w.isActive=1 and YEAR(date)='$_GET[year]' and w.id='$_GET[id]'";

if(isset($_GET['month']))
{
    $querypay=$querypay." and month(date)='$_GET[month]'";
    $querytotal=$querytotal." and month(date)='$_GET[month]'";
}
$result = @mysqli_query($conn, $queryname);
  if(!$result)
  {
      echo $queryname;
    echo 'There is an issue with the database';
    exit;
}
if(mysqli_num_rows($result)>0)
{
 if($row = @mysqli_fetch_assoc($result))
 {
  
    $name=$row['name'];
    $salary=intval($row['salary']);
 }
 }
 $totalpay=0;
$result = @mysqli_query($conn, $querytotal);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}

if(mysqli_num_rows($result)>0)
{
    
 if($row = @mysqli_fetch_assoc($result))
 {
  if($row['salary']!=null)
  {
    $totalpay=intval($row['salary']);
  }
  else
  {
    $totalpay=0;
  }
 }
 
}
else
 {
  $totalpay=0;
 }
  echo "<h1 style='color:orange'>".$name."</h1>";
echo "<table style='background-color: black'>
<tr style='width:800px'>
<td><label  style='color:yellow;'>Total Salary</label></td>
<td><input type='text' disabled value=";
if(!isset($_GET['month']))
{
    $salary=$salary*12;
}
echo ($salary)."></td>
<td><label  style='color:yellow;'>Paid Salary</label></td>
<td><input type='text' disabled value=$totalpay></td><td>
<label  style='color:yellow;'>Balance</label></td>
<td><input type='text' disabled value=".(intval($salary)-$totalpay)."></td></tr></table>";
?>

<table border=1px style="width:1200px;overflow-x:auto;overflow-y:auto;" >

<?php if($_SESSION['admin']==1)
    {
      echo "<tr><td colspan='6'><a href='workerSalaryAdd.php?id=$_GET[id]' class='button-63'>Pay Salary</a>";
    }?>
</td></tr>
  <tr>
    <th style='color:black; width:30px;'>S. No.</th>
    <th style='color:black'>Date</th>
    <th style="color:black;width:600px;">Details</th>
    <th style='color:black'>Paid Salary</th>
    <!--<th style='color:black'>Paid By</th>-->
    
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
    <td style='color:black'>".date('d-m-Y', strtotime($row['date']))."</td>
    <td style='color:black' >".$row['detail']."</td>
    <td style='color:black' >".$row['pay']."</td>";
    //   <td style='color:black' >".$row['name'].
      echo "</td>";
    
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='workersalaryupdate.php?id=$row[id]'>Update</a></td>
        <td><a href='workersalarydelete.php?id=$row[id]'>Delete</a></td>";
    }
    echo "</tr>";
 }
 ?>
    
</table>
</div>