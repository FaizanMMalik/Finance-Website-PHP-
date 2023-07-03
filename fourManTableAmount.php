<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
?>
<h2 style="color:orange">
  

</h2>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
  <?php
  if(!isset($_GET["id"]))
  {
    echo "<script>window.location.replace('fourman.php');</script>";
  exit;
  }
  $query="select SUM(fa.amountSend) as send,SUM(fa.amountRecieve) as recieve from fourman f inner join fourmanamount fa on fa.fourManId=f.id where f.id='$_GET[id]'";
  $query1="select name from fourman where id='$_GET[id]'";
  $result = @mysqli_query($conn, $query);
  if($row = @mysqli_fetch_assoc($result))
 {
  }
 else
 {
  echo "<script>window.location.replace('fourman.php');</script>";
  exit;
 }
 $result1 = @mysqli_query($conn, $query1);
 if($row1 = @mysqli_fetch_assoc($result1))
 {
  echo "<h1 style='color:orange'>".$row1["name"]."</h1>";
 }
  ?>
<br>
<?php
if($row['send']==null)
{
    $row['send']=0;
}
if($row['recieve']==null)
{
    $row['recieve']=0;
}
echo "<div><table style='background-color:black;margin-top:5px'><tr><td><label  style='color:yellow;font-size:18px;'>Amount Recieved </label></td>
<td colspan='2'><input type='text' disabled value=".$row[send]." style='font-weight: bold;color:black;background-color:white'></td><td>
<label  style='color:yellow;font-size:20px;'>Amount Spent</label></td>
<td colspan='2'><input type='text' disabled value=".$row[recieve]." style='font-weight: bold;color:black;background-color:white'></td>
<td>
<label  style='color:yellow;font-size:20px;'>Amount Balance</label></td>
<td colspan='2'><input type='text' disabled value=".($row[send]-$row[recieve])." style='font-weight: bold;color:black;background-color:white'></td>
</tr>
";
if($_SESSION['admin']==1)
{
  echo "<tr><td colspan='5'><a href='fourManAmountAdd.php?id=$_GET[id]&send=1' class='button-63'>Amount Recieved</a></td><td colspan='4'><a href='fourManAmountAdd.php?id=$_GET[id]&send=0' class='button-63'>Amount Spent</a></td></tr>";
}
?>
<table border=1px style="width:1300px;overflow-x:auto;overflow-y:auto;" >

<?php if($_SESSION['admin']==1)
    {
    
    }?>

  <tr>
    <th style='color:black' style="width:30px" >S. No.</th>
    <th style='color:black;width:120px'>Date</th>
    <th style='color:black;width:400px'>Detail</th>
    
    <th style='color:black;width:180px'>Amount Received</th>
    <th style='color:black'>Amount Spent</th>
    <?php
    if($_SESSION['admin']==1)
    {
      echo "
      <th style='color:black'>Update</th>
      <th style='color:black'>Delete</th>";
    }
    ?>
  </tr>
  <?php
  $query="SELECT fa.id,f.name,fa.amountSend as send,fa.amountRecieve as recieve,fa.date, fa.detail FROM fourman f inner join fourmanamount fa on fa.fourManId=f.id where f.id=$_GET[id] order by fa.id asc";
  $result = @mysqli_query($conn, $query);
$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black' >" . $i . "</td>
    <td style='color:black'>".date('d-m-Y', strtotime($row['date']))."</td>
    <td style='color:black'>$row[detail]</td>
    
    <td style='color:black'>";
    $send=0;
    if($row['send']!="0")
    {
        $send=1;
      echo $row['send'];
    }
    echo "</td>
    <td style='color:black'>";
    if($row['recieve']!="0")
    {
      echo $row['recieve'];
    }
    echo "</td>";
     if($_SESSION['admin']==1)
    {
        echo "
        <td><a style='color:orange' href='fourManAmountUpdate.php?id=$row[id]&send=$send'>Update</a></td>
        <td><a style='color:orange' onclick='deleteNotes($row[id])'>Delete</a></td>";
    }
    echo "</tr>";
 }
 $query="SELECT fa.id,f.name,sum(fa.amountSend) as send,sum(fa.amountRecieve) as recieve,fa.date, fa.detail FROM fourman f inner join fourmanamount fa on fa.fourManId=f.id where f.id=$_GET[id]";
  $result = @mysqli_query($conn, $query);
  if($row = @mysqli_fetch_assoc($result))
 {
  echo "<tr><td colspan=3 style='color:black;text-align:center'>Total</td><td style='color:black'>$row[send]</td><td style='color:black'>$row[recieve]</td></tr>";
 }

    ?>
    
</table>

</div>
