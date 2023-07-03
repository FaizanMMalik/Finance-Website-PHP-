<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
if(isset($_GET['year2']))
{
if(isset($_GET['month2']))
{
  $month = 2;
  $last_day = date("t", strtotime("$_GET[year2]-$_GET[month2]-01"));
}
}



$totalInvestment = "SELECT SUM(p.amount) as investment FROM `purchase` p INNER JOIN partner pa on pa.id=p.partnerId INNER JOIN assets a on a.id=p.assetsId where pa.isActive='1' and a.isActive='1'";
$leftover="SELECT SUM(amount) as investment FROM `sale` s INNER join assets a on a.id=s.assetsId";
$partner="from assets a INNER JOIN purchase p on p.assetsId=a.id INNER JOIN partner pa on pa.id=p.partnerId WHERE pa.isActive='1' and a.isActive='1'";
$partnerSale="from assets a INNER JOIN sale s on s.assetsId=a.id INNER JOIN partner pa on pa.id=s.partnerId WHERE pa.isActive='1' and a.isActive=1";
$assetPurchase="from assets a INNER JOIN purchase p on p.assetsId=a.id WHERE a.isActive='1'";
$assetSale="from assets a INNER JOIN sale s on s.assetsId=a.id WHERE a.isActive='1'";
$assetSaleWithout="a.isActive='1'";
$totalpartner="SELECT COUNT(*) as total FROM `partner` WHERE isActive='1'";
$condition="";
$workerQuerypay = "FROM worker w inner JOIN workersalary ws on ws.workerId=w.id inner JOIN partner p on p.id=ws.partnerid WHERE w.isActive=1";
$totalWorkersallary="SELECT sum(ws.salary) as salary FROM worker w inner JOIN workersalary ws on ws.workerId=w.id WHERE w.isActive=1";
if(isset($_GET['year1'])&&isset($_GET['month1'])&&isset($_GET['year2'])&&isset($_GET['month2']))
{
  $totalInvestment=$totalInvestment." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $leftover=$leftover." WHERE date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $partner=$partner." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $partnerSale=$partnerSale." and s.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $assetPurchase=$assetPurchase." and p.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $assetSale=$assetSale." and s.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $assetSaleWithout=$assetSaleWithout." and s.date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $workerQuerypay=$workerQuerypay." and date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
  $totalWorkersallary=$totalWorkersallary." and date BETWEEN '$_GET[year1]-$_GET[month1]-1' and '$_GET[year2]-$_GET[month2]-$last_day'";
}

else if(isset($_GET['year1'])&&isset($_GET['month1']))
{
  $totalInvestment=$totalInvestment." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $leftover=$leftover." WHERE YEAR(date) = '$_GET[year1]' and month(date)='$_GET[month1]'";
  $partner=$partner." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $partnerSale=$partnerSale." and YEAR(s.date) = '$_GET[year1]' and month(s.date)='$_GET[month1]'";
  $assetPurchase=$assetPurchase." and YEAR(p.date) = '$_GET[year1]' and month(p.date)='$_GET[month1]'";
  $assetSale=$assetSale." and YEAR(s.date) = '$_GET[year1]' and month(s.date)='$_GET[month1]'";
  $assetSaleWithout=$assetSaleWithout." and YEAR(s.date) = '$_GET[year1]' and month(s.date)='$_GET[month1]'";
  $workerQuerypay=$workerQuerypay." and YEAR(date) = '$_GET[year1]' and month(date)='$_GET[month1]'";
  $totalWorkersallary=$totalWorkersallary." and YEAR(date) = '$_GET[year1]' and month(date)='$_GET[month1]'";
}
else if(isset($_GET['year1']))
{
  $totalInvestment=$totalInvestment." and YEAR(p.date) = '$_GET[year1]'";
  $leftover=$leftover." WHERE YEAR(date) = '$_GET[year1]'";
  $partner=$partner." and YEAR(p.date) = '$_GET[year1]'";
  $partnerSale=$partnerSale." and YEAR(s.date) = '$_GET[year1]'";
  $assetPurchase=$assetPurchase." and YEAR(p.date) = '$_GET[year1]'";
  $assetSale=$assetSale." and YEAR(s.date) = '$_GET[year1]'";
  $assetSaleWithout=$assetSaleWithout." and YEAR(s.date) = '$_GET[year1]'";
  $workerQuerypay=$workerQuerypay." and YEAR(date) = '$_GET[year1]'";
  $totalWorkersallary=$totalWorkersallary." and YEAR(date) = '$_GET[year1]'";
}
$leftover=$leftover." and a.isActive=1";
?>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<?php



//Total Investment
 $result = @mysqli_query($conn, $totalInvestment);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
if(mysqli_num_rows($result)>0)
{
 if($row = @mysqli_fetch_assoc($result))
 {
  if($row['investment']!=null)
  {
    $invests=intval($row['investment']);
  }
  else
  {
    $invests=0;
  }
 }
 
}
else
 {
  $invests=0;
 }


//Total Sell
$result = @mysqli_query($conn, $leftover);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
if(mysqli_num_rows($result)>0)
{
 if($row = @mysqli_fetch_assoc($result))
 {
  if($row['investment']!=null)
  {
    $sells=intval($row['investment']);
  }
  else
  {
    $sells=0;
  }
 }
}
else
{
 $sells=0;
}




//Total Partner
$result = @mysqli_query($conn, $totalpartner);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
if(mysqli_num_rows($result)>0)
{
 if($row = @mysqli_fetch_assoc($result))
 {
  if($row['total']!=null)
  {
    $totalpartners=intval($row['total']);
  }
  else
  {
    $totalpartners=1;
  }
 }
}
else
{
 $totalpartners=1;
}




//total worker salay
$result = @mysqli_query($conn, $totalWorkersallary);
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
    $totalsalary=intval($row['salary']);
  }
  else
  {
    $totalsalary=0;
  }
 }
}
else
{
 $totalsalary=0;
}






$perhead=((($invests+$totalsalary)-$sells)/$totalpartners);
$tti=($invests+$totalsalary);


//Partner Table

echo "<table style='background-color: black;width:1000px'>
<tr style='width:500px'><td><label  style='color:yellow;'>Total Balance</label></td>
<td colspan='2'><input type='text' disabled value=".(($invests+$totalsalary)-$sells)." style='font-weight: bold;color:black;background-color:white'></td>
<td ><label  style='color:yellow;'>Total Profit</label></td>
<td colspan='2'><input type='text' disabled value=".($sells-($invests+$totalsalary))." style='font-weight: bold;color:black;background-color:white'></td></tr>
<tr style='width:800px'><td><label  style='color:yellow;'>Per Head Balance</label></td>
<td colspan='2'><input type='text' disabled value=$perhead style='font-weight: bold;color:black;background-color:white'></td><td>
<label  style='color:yellow;'>Per Head Profit</label></td>
<td colspan='2'><input type='text' disabled value=".($sells-($invests+$totalsalary))/$totalpartners." style='font-weight: bold;color:black;background-color:white'></td></tr></table>";

?>

<table border=1px style="width:1000px" >
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Patner Name</th>
    <th style='color:black'>Amount Balance</th>
    <th style='color:black'>Addtional Investment</th>
  </tr>
  <?php
  $partner=$partner." GROUP by p.partnerId";
  $result = @mysqli_query($conn, "SELECT SUM(p.amount) as amount,pa.name,pa.id ".$partner." order by pa.id");
  if(!$result)
  {
    echo "issue";
    exit;
}
//For Invester
$i=0;
 while($row = @mysqli_fetch_assoc($result))
 { 
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>
    <td><a style='color:black;font-size:15px;' href='partnerDetailInvestment.php?id=$row[id]'>".$row['name']."</a></td>";
    $purchase=0;
$sal=0;
$amo=0;
    
    if($row['amount']!=null)
    {
$amo=intval($row['amount']);
    }
    $purchase=$amo+$sal;
    
    $saleResult = @mysqli_query($conn, "SELECT w.id,w.name,SUM(ws.salary) as totalsalary ".$workerQuerypay." and p.id='$row[id]'");
    if($salerow = @mysqli_fetch_assoc($saleResult))
    {
        if($salerow['totalsalary']!=null)
        {
      $sal=intval($salerow['totalsalary']);
        }
    }
    else
    {
      $sal=0;
 }
    $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$partnerSale." and pa.id='$row[id]'");

    if($salerow = @mysqli_fetch_assoc($saleResult))
    {
      $sale=intval($salerow['amount']);
    }
    else
    {
      $sale=0;
 }
$bal=($purchase+$sal)-$sale;
    echo "<td style='color:black'>".($bal)."</td>
    <td style='color:black'>".($bal-$perhead)."</td>";
    echo "</tr>";
 }
 

//without Invester
$partner="SELECT SUM(ws.salary) as salary,p.name,p.id FROM `partner` p left JOIN workersalary ws on ws.partnerId=p.id WHERE p.id not in(SELECT pa.id ".$partner.") and isactive=1 GROUP by p.id";

$result = @mysqli_query($conn, $partner);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black'>" . $i . "</td>

    <td><a  href='partnerDetailInvestment.php?id=$row[id]' style='color:black'>".$row['name']."</a></td>";
    $purchase=0;
$sal=0;
$amo=0;
    
    if($row['amount']!=null)
    {
$amo=intval($row['amount']);
    }
    $purchase=$amo+$sal;
    
    $saleResult = @mysqli_query($conn, "SELECT w.id,w.name,SUM(ws.salary) as totalsalary ".$workerQuerypay." and p.id='$row[id]'");
    if($salerow = @mysqli_fetch_assoc($saleResult))
    {
        if($salerow['totalsalary']!=null)
        {
      $sal=intval($salerow['totalsalary']);
        }
    }
    else
    {
      $sal=0;
 }
    $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$partnerSale." and pa.id='$row[id]'");

    if($salerow = @mysqli_fetch_assoc($saleResult))
    {
      $sale=intval($salerow['amount']);
    }
    else
    {
      $sale=0;
 }

    $bal=($purchase+$sal)-$sale;
    echo "<td style='color:black'>".($bal)."</td>
    <td style='color:black'>".($bal-$perhead)."</td>";
    echo "</tr>";
 }




 
//For worker




    ?>
</table>


<table border=1px style="width:1000px" >
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Worker Name</th>
    <th style='color:black'>Paid Salary</th
  </tr>
  <?php
  $workerresult = @mysqli_query($conn, "SELECT w.id,w.name,SUM(ws.salary) as totalsalary ".$workerQuerypay." group by w.id");
  if(!$workerresult)
  {
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
    
    
    
    <?php
//Assets Sal
echo "<br>";
?>
<table border=1px style="width:1000px ; overflow-x:auto;overflow-y:auto;" >
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Commodity Name</th>
    <th style='color:black'>Amount Sale</th>
    <!--<th style='color:black'>Sale</th>-->
    <!--<th style='color:black'>Profit</th>-->
  </tr>
  <?php
  $assetSale=$assetSale." GROUP by a.id";
  $result = @mysqli_query($conn, "SELECT SUM(s.amount) as amount,name,a.id ".$assetSale);
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

    <td><a style='color:black' href='partnerDetailInvestment.php?assetid=$row[id]'>".$row['name']."</a></td>
    <td style='color:black'>".$row['amount']."</td>";
    echo "</tr>";
 }





    ?>
</table>
    
    
    
    
    
    
    
    
    
    
    
</table>


<?php
//Assets Purchase
echo "<br>";
?>
<table border=1px style="width:1000px ; overflow-x:auto;overflow-y:auto;" >
  <tr>
    <th style='color:black'>S. No.</th>
    <th style='color:black'>Expense Name</th>
    <th style='color:black'>Amount Expense</th>
    <!--<th style='color:black'>Sale</th>-->
    <!--<th style='color:black'>Profit</th>-->
  </tr>
  <?php
  $assetPurchase=$assetPurchase." GROUP by a.id";
  $result = @mysqli_query($conn, "SELECT SUM(p.amount) as amount,name,a.id ".$assetPurchase);
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

    <td><a style='color:black' href='partnerDetailInvestment.php?assetid=$row[id]'>".$row['name']."</a></td>
    <td style='color:black'>".$row['amount']."</td>";
//     $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$assetSale." and a.id='$row[id]'");
//     if($salerow = @mysqli_fetch_assoc($saleResult))
//     {
//       $sale=intval($salerow['amount']);
//     }
//     else
//     {
//       $sale=0;
//  }

//     echo "<td style='color:black'>".$sale."</td>
//     <td style='color:black'>".($sale-intval($row['amount']))."</td>";
    echo "</tr>";
 }







 //without purchase Sale
//  $result = @mysqli_query($conn, "SELECT a.id,a.name,SUM(s.amount) from assets a inner JOIN sale s on s.assetsId=a.id where a.id not in (SELECT a.id $assetPurchase) and $assetSaleWithout GROUP by a.id");
//   if(!$result)
//   {
//     echo "SELECT a.id,a.name,SUM(s.amount) from assets a inner JOIN sale s on s.assetsId=a.id where a.id not in (SELECT a.id $assetPurchase) and $assetSaleWithout GROUP by a.id";
//     exit;
// }

//  while($row = @mysqli_fetch_assoc($result))
//  {
//     $i=$i+1;
//     echo "<tr>
//     <td style='color:black;'>" . $i . "</td>

//     <td><a style='color:black;' href='partnerDetailInvestment.php?assetid=$row[id]'>".$row['name']."</a></td>
//     <td style='color:black;'>0</td>";
//     $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$assetSale." and a.id='$row[id]'");
//     if($salerow = @mysqli_fetch_assoc($saleResult))
//     {
//       $sale=intval($salerow['amount']);
//     }
//     else
//     {
//       $sale=0;
//  }

//     echo "<td style='color:black;'>".$sale."</td>
//     <td style='color:black;'>".$sale."</td>";
//     echo "</tr>";
//  }
// echo "<tr>
//   <td colspan='2' style='color:orange;font-size:25px;text-align:center'>Total</td>
//   <td style='color:orange;font-size:25px'>".$invests."</td>
//   <td style='color:orange;font-size:25px'>".$sells."</td>
//   <td style='color:orange;font-size:25px'>".($sells-$invests)."</td>
// </tr>";

    ?>
</table>















</div>
<?php
echo"<br><br>";
// echo"<label  style='color:yellow;font-size:30px;'>Per Head Investment</label>
// <input type='text' disabled value=".$perhead."><br><br>
// <label  style='color:yellow;font-size:30px;'>Per Head Profit</label>
// <input type='text' disabled value=".($sells-$invests)/$totalpartners."><br>
// ";







// while($row = @mysqli_fetch_assoc($result))
//  {
//     $i=$i+1;
//     echo "<tr>
//     <td>" . $i . "</td>

//     <td><a href='partnerDetailInvestment?id=$row[id]' style='color:orange'>".$row['name']."</a></td>
//     <td>".$row['amount']."</td>";
//     $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$partnerSale." and pa.id='$row[id]'");
//     if($salerow = @mysqli_fetch_assoc($saleResult))
//     {
//       $sale=intval($salerow['amount']);
//     }
//     else
//     {
//       $sale=0;
//  }

//     echo "<td>".$sale."</td>
//     <td>".($sells-$invests)/$totalpartners-intval($row['amount'])."</td>";
//     echo "</tr>";
//  }
 

// //without Invester
// $partner="SELECT * FROM `partner` WHERE id not in(SELECT pa.id ".$partner.") and isactive=1";
//  $result = @mysqli_query($conn, $partner);
//   if(!$result)
//   {
//     echo 'There is an issue with the database';
//     exit;
// }
//  while($row = @mysqli_fetch_assoc($result))
//  {
//     $i=$i+1;
//     echo "<tr>
//     <td>" . $i . "</td>

//     <td><a href='partnerDetailInvestment?id=$row[id]' style='color:orange'>".$row['name']."</a></td>
//     <td>0</td>";
//     $saleResult = @mysqli_query($conn, "SELECT SUM(s.amount) as amount ".$partnerSale." and pa.id='$row[id]'");
//     if($salerow = @mysqli_fetch_assoc($saleResult))
//     {
//       $sale=intval($salerow['amount']);
//     }
//     else
//     {
//       $sale=0;
//  }

//     echo "<td>".$sale."</td>
//     <td>".(0)-$sale-$perhead."</td>";
//     echo "</tr>";
//  }
?>


