	<?php
	error_reporting(0);
	session_start();
	ob_start();

	include 'db_connection.php';
	if(!isset($_SESSION['session_username'])|| (trim($_SESSION['session_username']) == ''))
	{
		header('Location: login.php');
		exit;
	}
	$session_username = $_SESSION['session_username'];
	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		$rank = $_POST['rank_array'];
		foreach ($rank as $key => $value) {
			# code...
			 $query = "UPDATE \"TASK\" set rank = $1 where task_name=$2";
			 $result = pg_prepare($con,"update_rank",$query);
			 $result = pg_execute($con,"update_rank",array($value,$key));
		}
		header('Location:viewTask.php');
	}
	else
	{
		$query = "SELECT task_name,project_name,rank from \"TASK\" where user_name=$1";
		$result = pg_prepare($con,"order_task",$query);
		$result = pg_execute($con,"order_task",array($session_username));

	}

	?>
	<html>
		<head>
			<title>ToodLedo|Rank Tasks</title>
		</head>
		<div class="header-wrap">
			<?php $current_page = "login"; include 'header.php';?>
		</div>
		<section>
			<div class="content">
				<p class="content_header"> Rank Your Tasks </p>
			<form action="orderTask.php" method="POST">
			<br><br>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Project Name</th>
						<th>Task Name</th>
						<th>Rank</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($result)
					{
						
						while($row = pg_fetch_row($result))
						{
							echo "<tr>";
							echo "<td>".$row[1]."</td>";
							echo "<td>".$row[0]."</td>";
							echo "<td>"."<input type=\"text\" size=\"4\" value=\"$row[2]\" name=\"rank_array[$row[0]]\" id=\"".$row[0]."\"/>"."</td>";					
							echo "</tr>";
						}
					}
					?>				

				</tbody>
			</table>
			<br><br>
			<input type="submit" class="button_submit" value="Update Preference"/>
			</form>
		</div>
		</section>

	</body>
	<?php include 'footer.php';?>
	</html>