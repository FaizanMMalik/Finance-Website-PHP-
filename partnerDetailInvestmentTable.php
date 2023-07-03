<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php')</script>";
  exit;
}
include 'database.php';



$pArray = array();

 
$query = "select p.id as purchaseId,p.amount,p.date,p.description as name,pa.name as pname from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where a.isActive=1";
$tquery = "select sum(p.amount) as total from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where a.isActive=1";
$squery = "select s.id as saleId,s.amount,s.date,s.description as name,pa.name as pname from sale s inner join assets a on a.id=s.assetsId inner join partner pa on pa.id=s.partnerId where a.isActive=1";
$stquery = "select sum(s.amount) as total from sale s inner join assets a on a.id=s.assetsId inner join partner pa on pa.id=s.partnerId where a.isActive=1";



$workerQuerypay = "FROM worker w inner JOIN workersalary ws on ws.workerId=w.id inner JOIN partner pa on pa.id=ws.partnerid WHERE w.isActive=1";
$totalWorkersallary="SELECT sum(ws.salary) as salary FROM worker w inner JOIN workersalary ws on ws.workerId=w.id inner JOIN partner pa on pa.id=ws.partnerId WHERE w.isActive=1";
if(isset($_GET['assetid']))
{
  $query=$query." and a.id=".$_GET['assetid'];
  $tquery=$tquery." and a.id=".$_GET['assetid'];
  $squery=$squery." and a.id=".$_GET['assetid'];
  $stquery=$stquery." and a.id=".$_GET['assetid'];
}
else
{
  $query=$query." and pa.id=".$_GET['id'];
  $tquery=$tquery." and pa.id=".$_GET['id'];
  $squery=$squery." and pa.id=".$_GET['id'];
  $stquery=$stquery." and pa.id=".$_GET['id'];
  $workerQuerypay=$workerQuerypay." and pa.id=".$_GET['id'];
  $totalWorkersallary=$totalWorkersallary." and pa.id=".$_GET['id'];
}
if(isset($_GET['year1'])&&isset($_GET['month1'])&&isset($_GET['day1'])&&isset($_GET['year2'])&&isset($_GET['month2'])&&isset($_GET['day2']))
{
  $query=$query." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $tquery=$tquery." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $squery=$squery." and s.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $stquery=$stquery." and s.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $workerQuerypay=$workerQuerypay." and ws.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
  $totalWorkersallary=$totalWorkersallary." and ws.date BETWEEN '$_GET[year1]-$_GET[month1]-$_GET[day1]' and '$_GET[year2]-$_GET[month2]-$_GET[day2]'";
}
else if(isset($_GET['year1'])&&isset($_GET['month1'])&&isset($_GET['day1']))
{
  $query=$query." and p.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $tquery=$tquery." and p.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $squery=$squery." and s.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $stquery=$stquery." and s.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $workerQuerypay=$workerQuerypay." and ws.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
  $totalWorkersallary=$totalWorkersallary." and ws.date = '$_GET[year1]-$_GET[month1]-$_GET[day1]'";
}
else if(isset($_GET['year1'])&&isset($_GET['month1']))
{
  $query=$query." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $tquery=$tquery." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $squery=$squery." and YEAR(s.date) = '$_GET[year1]' and month(s.date)='$_GET[month1]'";
  $stquery=$stquery." and YEAR(s.date) = '$_GET[year1]' and month(s.date)='$_GET[month1]'";
  $workerQuerypay=$workerQuerypay." and YEAR(ws.date) = '$_GET[year1]' and month(ws.date)='$_GET[month1]'";
  $totalWorkersallary=$totalWorkersallary." and YEAR(ws.date) = '$_GET[year1]' and month(ws.date)='$_GET[month1]'";
}
else if(isset($_GET['year1']))
{
  $query=$query." and YEAR(p.date) = '$_GET[year1]'";
  $tquery=$tquery." and YEAR(p.date) = '$_GET[year1]'";
  $squery=$squery." and YEAR(s.date) = '$_GET[year1]'";
  $stquery=$stquery." and YEAR(s.date) = '$_GET[year1]'";
  $workerQuerypay=$workerQuerypay." and YEAR(s.date) = '$_GET[year1]'";
  $totalWorkersallary=$totalWorkersallary." and YEAR(s.date) = '$_GET[year1]'";
}
//echo $query."<br>".$tquery."<br>".$squery."<br>".$stquery;
?>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
  <?php
  
  //total worker salary
  $result = @mysqli_query($conn, $totalWorkersallary);
$workersalary=0;
if($row = @mysqli_fetch_assoc($result))
{if($row['salary']!=null&&(!isset($_GET['assetid'])))
    {
   $workersalary=$row['salary'];
    }
}
  
  
  $result = @mysqli_query($conn, $query);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
$pArray = array();
 while($row = @mysqli_fetch_assoc($result))
 {
  if(isset($_GET['assetid']))
{
  $name=$row['name'];
}
else
{
  $name=$row['name'];
}
  $a=array("id" => $row['purchaseId'], "name" => $name, "date" => date("d-m-Y", strtotime($row['date'])), "pAmount" => $row['amount'], "sAmount" => "");
  array_push($pArray,$a);
  
 }
 $result = @mysqli_query($conn, $squery);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
 $sArray = array();
 while($row = @mysqli_fetch_assoc($result))
 {
  if(isset($_GET['assetid']))
{
  $name=$row['name'];
}
else
{
  $name=$row['name'];
}
  $a=array("id" => $row['saleId'], "name" => $name, "date" => date("d-m-Y", strtotime($row['date'])), "pAmount" => "", "sAmount" => $row['amount']);
  array_push($sArray,$a);
  
 }

$array = array_merge($pArray, $sArray);
 usort($array, function($a, $b) {
  return strtotime($a["date"]) - strtotime($b["date"]);
});
$result = @mysqli_query($conn, $tquery);
$pTotal=0;
if($row = @mysqli_fetch_assoc($result))
{if($row['total']!=null)
    {
   $pTotal=$row['total'];
    }
}
$result = @mysqli_query($conn, $stquery);
$sTotal=0;
if($row = @mysqli_fetch_assoc($result))
{
    if($row['total']!=null)
    {
   $sTotal=$row['total'];
    }
    
}
echo "<div><table style='background-color:black;margin-top:5px'><tr><td><label  style='color:yellow;font-size:20px;'>Amount Paid </label></td>
<td colspan='2'><input type='text' disabled value=".($pTotal+$workersalary)." style='font-weight: bold;color:black;background-color:white'></td><td>
<label  style='color:yellow;font-size:20px;'>Amount Sale</label></td>
<td colspan='2'><input type='text' disabled value=".($sTotal)." style='font-weight: bold;color:black;background-color:white'></td>
<td>
<label  style='color:yellow;font-size:20px;'>Amount Balance</label></td>
<td colspan='2'><input type='text' disabled value=".($workersalary+$pTotal-$sTotal)." style='font-weight: bold;color:black;background-color:white'></td>
</tr>
";
if($_SESSION['admin']==1)
{
  echo "
  <tr><td colspan='4'style='padding-left:30px;' ><a href='purchaseAdd.php?";
  if(isset($_GET['id']))
  {
    echo "id=$_GET[id]";
  }
  echo "' class='button-63' style='width:50px;padding-top:-30px'>Add Expense</a></td>
  <td colspan='5' style='padding-left:230px'><a href='saleAdd.php?";
  if(isset($_GET['id']))
  {
    echo "id=$_GET[id]";
  }
  echo "' class='button-63' style='width:50px;padding-top:-30px'>Add Sale</a></td></tr>";
}



echo "</table></div><br>";

 $i=0;
 ?>
 <table  style="overflow-x:auto;overflow-y:auto;width:1200px; margin-top:-20px;">
  <tr style='font-size:13px'>
    <th style='color:black;width:80px;'>S. No.</th>
    
    <th style='color:black'>Date</th>
    
    <th style="width:550px;color:black">Details</th>
    <th style='color:black'>Amount Paid</th>
    <th style='color:black'>Amount Sale</th>
    <?php
    if($_SESSION['admin']==1)
    {
    echo "<th style='color:black'>Update</th>
    <th style='color:black'>Delete</th>";
    }
    ?>
    
  </tr>
  <?php
 for($j=0;$j<count($array);$j++)
 {
  $i=$i+1;
  echo "<tr style='font-size:12px'>
    <td style='color:black'>" . $i . "</td>
    
    
    <td style='color:black'>".$array[$j]["date"]."</td>
  
    <td class='detail' style='color:black'>".$array[$j]["name"]."</td>
      <td style='color:black'>".$array[$j]["pAmount"]."</td>
    <td style='color:black'>".$array[$j]["sAmount"]."</td>";
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='";
        if($array[$j]["pAmount"]!="")
        {
          echo "purchase";
        }
        else
        {
          echo "sale";
        }
        echo "Update.php?id=".$array[$j]["id"]."'>Update</a></td>
        <td><a href='";
        if($array[$j]["pAmount"]!="")
        {
          echo "purchase";
        }
        else
        {
          echo "sale";
        }
        echo "Delete.php?id=".$array[$j]["id"]."'>Delete</a></td>";
    }
    echo "</tr>";
 }
 echo "<tr><td></td><td colspan='1' style='color:orange;font-size:20px'>Total</td><td></td>
 <td style='color:orange;font-size:20px'>".$pTotal."</td>
 <td style='color:orange;font-size:20px'>".$sTotal."</td></tr><tr></tr>";
 
 
    ?>
    <?php
    if($workersalary>0&&(!isset($_GET['assetid'])))
    {
    ?>
</table>
<table border=1px style="width:1200px" >
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Worker Name</th>
    <th style='color:black'>Paid Salary</th
  </tr>
  <?php
  $workerresult = @mysqli_query($conn, "SELECT w.id,w.name,SUM(ws.salary) as totalsalary ".$workerQuerypay." group by w.id");
  if(!$workerresult)
  {
      echo $workerresult;
    echo "issue";
    exit;
}

$i=0;
 while($row = @mysqli_fetch_assoc($workerresult))
 { 
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>
    <td style='color:black'>".$row['name']."</td>
    <td style='color:black'>".$row['totalsalary']."</td>";
    echo "</tr>";
 }
 



    ?>
    </table>
    <?php
    }
    ?>
  </div>
<?php

mysqli_close($conn);
?>




