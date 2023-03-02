<?php
    $configs = require "../config.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
	require_once $configs['paths']['php'] . "/string.php";
	/** @var PDO $pdo */
    $pdo = require $configs['root'] . "/db.php";

    if(!IsLoggedIn() || !IsAdmin()){
        RedirectTo("/");
        exit();
    }
?>
<?php
	//DATA CREATION

	if(isset($_POST['title'], $_POST['content'])){

		$author = "A csapatunk";

		$id = GetID();

		if(isset($_POST['anonym']) && $_POST['anonym'] != "on"){
			$userQuery = "SELECT `username` as `name` FROM `users` WHERE `ID`=:id;";

			$stmt = $pdo->prepare($userQuery);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
				$author = $row['name'];
		}

		$id = "";

		do{
			$id = RandomString(10);

			$idQuery = "SELECT COUNT(`ID`) FROM `news` WHERE `ID`=:id;";

			$stmt = $pdo->prepare($idQuery);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);

			$stmt->execute();

			if($stmt->fetch(PDO::FETCH_NUM)[0] == 0)
				break;

		}while(true);

		$query =
		"INSERT INTO `news` (`ID`, `author`, `title`, `content`)
			VALUES(:id, :author, :title, :content);";

		$content = nl2br(strip_tags($_POST['content'], ['<br>', '<a>']));

		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":author", $author, PDO::PARAM_STR);
		$stmt->bindParam(":title", str_replace('\n', '', $_POST['title']), PDO::PARAM_STR);
		$stmt->bindParam(":content", nl2br($_POST['content']), PDO::PARAM_STR);
		$stmt->execute();

		RedirectTo("/");
	}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hírkezelő</title>
    <link href="/public/styles/global.css" rel="stylesheet">
	<?php echo $configs['bootstrap']['css']; ?>
	<?php echo $configs['bootstrap']['js']; ?>
    <?php echo $configs['jquery']; ?>
	<?php echo $configs['cookies']; ?>
	<script>
				$(document).ready(() => {

					$(".delete-btn").click((event) => {

						const id = $(event.target).parent().data("id");


						$.post({
							url: "/api/news/delete.php",
							cache: false,
							data:{
								ID: id,
								auth: "<?php echo $_SESSION['user'] ?>"
							},
							success: function(rawData){

								const data = JSON.parse(rawData);

								if(data.success == true) {

									const parent = $(event.target).parent().parent();
									const mainParent = parent.parent();

									parent.remove();

									if(mainParent.children().length == 0){
										mainParent.append(
											'<tr><td> Nincsenek hírek </td><td></td><td></td><td></td></tr>'
											);
									}
								}
								else{
									alert("nem tudjuk törölni");
									console.log(data);
								}

							},
						});

					});
					
				});
			</script>
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0">
        <section id="content" class="gx-0 m-2">
	
		<!-- DATA CREATION -->
		<div class="ms-5">
			<form class="form-inline text-light mb-5" role="form" action="" method="post">
				<div class="form-group w-25 mb-3">
					<label for="form-title">Cím:</label>
					<input id="form-title" class="form-control" name="title" type="text" placeholder="Cím" maxlength="255">
					<label for="form-author">Anonym hír: (a hír készítője "A csapatunk" lesz)</label>
					<input id="form-author" name="anonym" type="checkbox">
				</div>

				<div class="form-group w-50 mb-5">
					<label for="form-content">Tartalom</label>
					<textarea id="form-content" class="form-control" name="content" rows="3"></textarea>
				</div>

				<input type="submit" value="Létrehozás">
			</form>
		</div>

        <?php
            //DATA ECHOING

            $stmt = $pdo->prepare("SELECT * FROM `news` ORDER BY `created` DESC;");
            $stmt->execute();
			echo '<table class="table table-dark">';
			echo '<thead>';
			echo '<tr>';
			echo '<td>Cím</td>';
			echo '<td>Készítő</td>';
			echo '<td>Létrehozva</td>';
			echo '<td>Kezelés</td>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';

			if($stmt->rowCount() == 0){
				echo "<tr>";

				echo '<td> Nincsenek hírek </td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';

				echo "</tr>";
			}else{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

					$date = date("Y. m. d. H:i", strtotime($row['created']));

					echo "<tr>";

					echo '<td>' . $row['title'] . '</td>';
					echo '<td>' . $row['author'] . '</td>';
					echo '<td>' . $date . '</td>';
					echo '<td data-id="' . $row['ID'] . '">';
					echo '<div  class="delete-btn btn btn-dark">Törlés</div>';
					echo '</td>';

					echo "</tr>";
				}
			}

			echo '</tbody>';
			echo '</table>';

            

        ?>

			

        </section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>