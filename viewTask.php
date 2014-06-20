<?php
session_start();
include 'db_connection.php';
session_save_path('sessions');
ob_start();

if(!isset($_SESSION['session_username'])|| (trim($_SESSION['session_username']) == ''))
{
		//echo"no";
	header('Location: login.php');
	exit;
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if(isset($_POST['addProject']))
	{
		
		$projectName = $_POST['projectName'];
		$userName = $_SESSION['session_username'];
		$query = "INSERT INTO \"PROJECT\" (user_name,project_name) VALUES($1,$2)";
		$result = pg_prepare($con, "add_project", $query); 
		$result = pg_execute($con, "add_project", array($userName,$projectName));
		if($result)
		{
			echo "<p class=\"message\">Project Added Successfully</p>";
		}
		else
		{
			"<p class=\"message\">Project Not Added</p>";
		}
	}
	else
	{
		
		if(isset($_POST['addTask']))
		{	
			$projectName = $_POST['project_name'];
			//echo "Is".$projectName;
			$taskName = $_POST['taskName'];
			$userName = $_SESSION['session_username'];
			$totalHours = $_POST['totalHours'];
			if(is_numeric($totalHours))
			{
				//$completedHours = 0;
				$query = "INSERT INTO \"TASK\" (user_name,project_name,task_name,total_hours) VALUES($1,$2,$3,$4)";
				$result = pg_prepare($con, "add_project", $query); 
				$result = pg_execute($con, "add_project", array($userName,$projectName,$taskName,$totalHours));
				if($result)
				{
					echo "<p class=\"message\">Task Added Successfully</p>";
				}
				else
				{
					echo "<p class=\"message\">Task Not Added</p>";
				}
			}
			else
			{
				echo "<p class=\"message\">Please enter a valid number</p>";
			}	
			
		}
		else
		{

			{
				$id= $_POST['id'];
			//echo "The id is ".$id;
				if($_POST['complete'])
				{
					$query = "UPDATE \"TASK\" SET completed_hours=completed_hours+1 where id=$1";

					$result = pg_prepare($con, "update_task", $query); 
					$result = pg_execute($con, "update_task", array($id));

				}
				else 
				{
					if($_POST['delete'])
					{					
						$query = "DELETE  FROM \"TASK\" where id=$1";
						$result = pg_prepare($con, "delete_task", $query); 
						$result = pg_execute($con, "delete_task", array($id));
					}
					else if($_POST['undo'])
					{
						$query = "UPDATE \"TASK\" SET completed_hours=completed_hours-1 where id=$1";

						$result = pg_prepare($con, "update_task", $query); 
						$result = pg_execute($con, "update_task", array($id));				

					}
					if($_POST['save'])
					{
						$projectName=$_POST['projectName'];
						$taskName = $_POST['taskName'];
						$totalHours = $_POST['totalHours'];
						$query = "UPDATE \"TASK\" SET project_name=$2, task_name=$3,total_hours=$4 where id=$1";
						$result = pg_prepare($con, "save_task", $query); 
						$result = pg_execute($con, "save_task", array($id,$projectName,$taskName,$totalHours));
					}
				}

			}	
		}
	}

}
?>
<html>
<head>
	<title>ToodLedo|Task</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />		

</head>

<div class="header-wrap">
	<?php $current_page = "viewTask"; include 'header.php';?>
</div>

<section>
	<div class="content">	
		<p class="content_header"> Your Tasks </p>


		<div class="task_content">
			
			

			<table class="table table_task">
				<thead>
					<tr>
						<th>Project Name</th>
						<th>Task Name</th>
						<th>Total Hours</th>
						<th>Progress</th>

					</tr>
				</thead>
				<tbody>
					<?php
					error_reporting(0);
					$userName  = $_SESSION['session_username'];

					$task_query = "SELECT task_name,completed_hours,total_hours,id,project_name from \"TASK\" where user_name=$1 ORDER BY rank ";
					$task_result = pg_prepare($con,"display_taskName",$task_query);
					$task_result = pg_execute($con,"display_taskName",array($userName));
					
					if($task_result)
					{
						
						while($task_row = pg_fetch_row($task_result))
						{
							echo "<tr>";
							echo "<form action=\"viewTask.php\" method=\"post\">";

							echo "<td>"."<input class=\"textbox\" type='text' required=\"required\" name='projectName' value=\"$task_row[4]\"/>"."</td>";
							echo "<td>"."<input class=\"textbox\" type='text' required=\"required\" name='taskName' value=\"$task_row[0]\"/>"."</td>";
							echo "<td>"."<input class=\"textbox_hours\" type='text' required=\"required\" name='totalHours' size=\"4\" value=\"$task_row[2]\"/>"."</td>";
							
							$max = $task_row[2]*2;
							$time_left = $task_row[2]-($task_row[1]/2);
							
							echo "<td><progress value=\"$task_row[1]\" max=\"".$max."\">"."</progress>"."<br>$time_left hours left"."</td>";
							
							echo "<input type=\"hidden\" name=\"id\" value=\"".$task_row[3]."\"/>";
							if($time_left!=0)							
								echo "<td><input type=\"submit\" class=\"button_small\" name=\"complete\" value=\"Complete\"/></td>";
							
							if($task_row[1]>0)
							{
								echo "<td><input type=\"submit\" class=\"button_small\" name=\"undo\" value=\"Undo\" /> </br></td>";
							}
							echo "<td><input type=\"submit\" class=\"button_small\" name=\"delete\" value=\"Delete\"/></td>";
							
							echo "<td><input type=\"submit\" class=\"button_small\" name=\"save\" value=\"Save\"/></td>";
							
							echo "</form>";

							echo "</tr>";
						}
						
					}
					else
					{
						echo "Invalid Task";
					}
					?>
				</tbody>
			</table>
			<form class="project" action="viewTask.php" method="POST">
				<input type="text" class="textbox" required="required" name="projectName" placeholder="Project Name"/>
				<input type="submit" class="button_submit" name="addProject" value="Add Project"/>
			</form>        	
			
			<br><br>
			<form class="task" action="viewTask.php" method="POST">
				<?php
				$userName  = $_SESSION['session_username'];
				$query = "SELECT project_name FROM \"PROJECT\" where user_name=$1;"; 
				$result = pg_prepare($con, "display_projects", $query);
				$result = pg_execute($con, "display_projects", array($userName));
				if($result)
				{
					echo "<select name=\"project_name\">";
					while($row = pg_fetch_row($result))
					{
						echo "<option value=\"".$row[0]."\"/>".$row[0]."</option>";
					}
					echo "</select>";
				}
				?>
				<input type="text" name="taskName" required="required" class="textbox" placeholder="Task Name"/>
				<input type="text" name="totalHours" required="required" class="textbox" placeholder="Number of Hours" />
				<input type="submit" class="button_submit" name="addTask" value="Add Task"/>	</br>
			</form>
		</div>
	</div>
</section>
</body>
<?php include 'footer.php';?>
</html>
