<?php
foreach ($data as $key => $value) {

	$user_registered[]= $value->user_registered;
    $date[]= $value->created_date;
}

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script type="text/javascript">
	var label = <?php echo json_encode($date);?>;
	var data = <?php echo json_encode($user_registered);?>;
	var labelname=<?php echo json_encode($content['labelname']);?>;
</script>
<style >
.container {
  width: 80%;
  margin: 15px auto;
}
</style>

<div class="container">
  <h2 class="head_align"><?php echo $content['header'];?></h2>
  <div>
    <canvas id="myChart"></canvas>
  </div>
</div>

