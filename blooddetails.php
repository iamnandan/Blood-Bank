<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body style="background-color: bisque;">
<?php include 'master.php';?>	

<div class="container text-center">
  <h2>Blood availbility in the bank</h2>
  <p>Please find below all blood groups and quantity available in our bank</p>          <br>                                                                            

<div id="bloodgroup_chart" data-sort="false" data-width="400" data-x_label="Blood quantity in liters" class="jChart chart-lg" name="Blood Bank statistics" >
<?php
        $bloodGrp1='O+';
		$bloodGrpResult1=printBloodResults($bloodGrp1);
		$bloodGrp2='O-';
		$bloodGrpResult2=printBloodResults($bloodGrp2);
		$bloodGrp3='A+';
		$bloodGrpResult3=printBloodResults($bloodGrp3);
		$bloodGrp4='A-';
		$bloodGrpResult4=printBloodResults($bloodGrp4);
		$bloodGrp5='B+';
		$bloodGrpResult5=printBloodResults($bloodGrp5);
		$bloodGrp6='B-';
		$bloodGrpResult6=printBloodResults($bloodGrp6);
		$bloodGrp6='AB+';
		$bloodGrpResult7=printBloodResults($bloodGrp6);
		$bloodGrp6='AB-';
		$bloodGrpResult8=printBloodResults($bloodGrp6);
		echo "$bloodGrpResult1";
echo '<div class="define-chart-row" data-color="#84d6ff" title="O+ve">'.$bloodGrpResult1.'</div>
	<div class="define-chart-row" data-color="#38BCFF" title="O-ve">'.$bloodGrpResult2.'</div>
	<div class="define-chart-row" data-color="#00A9FF" title="A+ve">'.$bloodGrpResult3.'</div>
	<div class="define-chart-row" data-color="#008DD3" title="A-ve">'.$bloodGrpResult4.'</div>
	<div class="define-chart-row" data-color="#0074AA" title="B+ve">'.$bloodGrpResult5.'</div>
	<div class="define-chart-row" data-color="#005882" title="B-ve">'.$bloodGrpResult6.'</div>
	<div class="define-chart-row" data-color="#005882" title="AB+ve">'.$bloodGrpResult7.'</div>
	<div class="define-chart-row" data-color="#005882" title="AB-ve">'.$bloodGrpResult8.'</div>';
?>
	<div class="define-chart-footer">0</div>
	<div class="define-chart-footer">25</div>
	<div class="define-chart-footer">50</div>
	<div class="define-chart-footer">75</div>
	<div class="define-chart-footer">100</div>
</div>

</div>
<br/>
<br/>
<?php include 'footer.php';?>


</body>
</html>
		