<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);


function settings()
{
	global $connection;

	if (isset($_POST['submit'])) {
		$target_file = "";
		$update = 0;
		$previous = "SELECT * FROM settings";
		$run = mysqli_query($connection, $previous);
		if (mysqli_num_rows($run) > 0) {
			$update = 1;
		}

		$app_name = $_POST['app_name'];
		$app_refresh = $_POST['app_refresh'] * 1000;

		if (empty($_FILES['app_logo'] ['name'])) {
			$empty = 1;

			if ($update == 1) {
				$query = "UPDATE settings  SET app_name = '$app_name', app_refresh = '$app_refresh'";
			} else {
				$query = "INSERT INTO settings (app_name, app_refresh) VALUES ('$app_name', '$app_refresh')";
			}

		} else {

			$empty = 0;

			$uploadOk = 1;
			$target_dir = "uploads/app/";
			$target_file = $target_dir . rand() . basename($_FILES["app_logo"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// repetido
			if (file_exists($target_file)) {
				//$this->errors[] = "File exists";
				$uploadOk = 0;
			}
			// peso
			if ($_FILES["app_logo"]["size"] > 2000000) {
				//$this->errors[] = "Your file is too big, 2MB max";
				$uploadOk = 0;
			}

			// formatos
			if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "JPEG"
				&& $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "png"
				&& $imageFileType != "gif" && $imageFileType != "GIF") {
				//$this->errors[] = "Only jpg, png and gif formats are supported.";
			}

			if ($uploadOk == 1) {

				if (move_uploaded_file($_FILES["app_logo"]["tmp_name"], $target_file)) {
					$uploadOk = 1;
					$status_ok = 1;
				} else {
					$uploadOk = 0;
					$status_ok = 0;
				}
			}

			if ($update == 1) {
				$query = "UPDATE settings SET app_name = '$app_name', app_refresh = '$app_refresh', app_logo = '$target_file'";
			} else {
				$query = "INSERT INTO settings (app_name, app_refresh, app_logo) VALUES ('$app_name', '$app_refresh', '$target_file')";
			}
		}


		$result = mysqli_query($connection, $query);

		if ($result) {
			//echo "sesapp".$_SESSION['app'];
			//echo "<Br>$app_name";
			header("Location: index.php?page=settings&success=1");
		} else {
			header("Location: index.php?page=settings&success=0");
		}
	}
}


//AGREGAR CATEGORIAS
function addCat()
{
	global $connection;

	if (isset($_POST['save_category'])) {
		$name = $_POST['name'];

		$query = "INSERT INTO categorias (name) VALUES ('$name')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=categories&success=true");
		} else {
			header("Location: index.php?page=categories&success=false&q=$query");
		}
	}
}

//EIDTAR CATEGORIAS
function editCat()
{
	global $connection;

	if (isset($_POST['edit_category'])) {
		$id = $_GET['id'];
		$name = $_POST['name'];

		$query = "UPDATE categorias SET name='$name' WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=categories&success=true");
		} else {
			header("Location: index.php?page=categories&success=false&q=$query");
		}
	}
}


//BORRAR CATEGORIAS
function deleteCat()
{
	global $connection;

	if (isset($_POST['delete_category'])) {
		$id = $_GET['id'];

		$query = "DELETE FROM categorias WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=categories&success=true");
		} else {
			header("Location: index.php?page=categories&success=false&q=$query");
		}
	}
}


//AGREGAR DEPARTAMENTOS
function addDep()
{
	global $connection;

	if (isset($_POST['save_dep'])) {

		$name = $_POST['name'];

		$query = "INSERT INTO departamentos (name) VALUES ('$name')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=departments&success=true");
		} else {
			header("Location: index.php?page=departments&success=false&q=$query");
		}
	}
}


//EDITAR DEPARTAMENTOS
function editDep()
{
	global $connection;

	if (isset($_POST['edit_dep'])) {
		$id = $_GET['id'];
		$name = $_POST['name'];

		$query = "UPDATE departamentos SET name='$name' WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=departments&success=true");
		} else {
			header("Location: index.php?page=departments&success=false&q=$query");
		}
	}
}

//BORRAR DEPARTAMENTOS
function deleteDep()
{
	global $connection;

	if (isset($_POST['delete_dep'])) {
		$id = $_GET['id'];

		$query = "DELETE FROM departamentos WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=departments&success=true");
		} else {
			header("Location: index.php?page=departments&success=false&q=$query");
		}
	}
}

/*********************************************************************VIDEOS */

//VIDEOS CON COMPRESION POR FFMPEG
function uploadVideo()
{
	global $connection;

	if (isset($_POST['upload_video'])) {
		//VIDEO UPLOAD HANDLER FFMPEG COMPRESSION
		if (empty($_FILES['video'] ['name'])) {
			$uploadOk = 0;
			$error1_1 = "";
			$error1_2 = "";
		} else {
			$video = $_FILES["video"] ["tmp_name"];
			$video_name = $_FILES["video"] ["name"];
			$screenshot = "uploads/screenshots/" . rand() . $video_name . ".png";
			$target_file = "uploads/" . rand() . $video_name;
			$bitrate = $_POST['bitrate'];

			//checks
			$uploadOk = 1;
			$error1 = "";
			$error2 = "";
			$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			if ($_FILES["video"]["size"] > 999000000) {
				$error1_1 = "Solo archivos menores a 999Mb.";
				$uploadOk = 0;
			}

			// formatos
			if ($fileType != "mp4" && $fileType != "MP4" && $fileType != "MKV" && $fileType != "mkv") {
				$error1_2 = "Solo Archivos MP4.";
				$uploadOk = 0;
			}

			if ($uploadOk == 1) {
				//ultrafast, superfast, veryfast, faster, fast, medium, slow, slower, veryslow
				//$command = "uploads/ffmpeg/bin/ffmpeg -i $video -b:v $bitrate -bufsize output.mp4";
				//$command = "c:/xampp/htdocs/tutorials/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -b:v $bitrate -bufsize $bitrate output.mp4";
				$command = "c:/xampp/htdocs/cbt/smart_framework/smart_framework/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
				$cmd = system($command);

				$command2 = "c:/xampp/htdocs/cbt/smart_framework/smart_framework/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
				$cmd2 = system($command2);
			}

		}
		//si todo salio bien se inserta en db
		if ($uploadOk == 1) {
			//insert to database

			$url = $target_file;
			$title = mysqli_real_escape_string($connection, $_POST['title']);
			$description = mysqli_real_escape_string($connection, $_POST['description']);
			$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
			$department_id = mysqli_real_escape_string($connection, $_POST['department_id']);
			$test = mysqli_real_escape_string($connection, $_POST['test']);
			$owner = $_SESSION['cbt_user_name'];
			$date_uploaded = date("Y-m-d H:i:s");


			$query = "INSERT INTO videos (url, title, description, category_id, department_id, owner, test, screen, date_uploaded)
             VALUES ('$url', '$title', '$description', '$category_id', '$department_id', '$owner', '$test', '$screenshot', '$date_uploaded')";

			$result = mysqli_query($connection, $query);

			if (!$result) {
				echo "Error: " . $query;
			} else {
				//last id de video insertado
				$last_id = mysqli_insert_id($connection);
				//start to insert departments
				if (!empty($_POST['check_list'])) {
					// Loop to store and display values of individual checked checkbox.
					foreach ($_POST['check_list'] as $selected) {
						//echo $selected;
						$insert_departments = "INSERT INTO video_department (video_id, department_id) VALUES ('$last_id', '$selected')";
						$run_insert_departments = mysqli_query($connection, $insert_departments);
					}
				}//insert departments end

				if ($test == 1) {
					header("Location: index.php?page=questions&video_id=$last_id");
				} else {
					header("Location: index.php?page=manage_uploads&success=true");
				}
			}

			//insert to database end of video
		} else {
			header("Location: index.php?page=upload_form&error=upload&e11=$error1_1&e12=$error1_2");
		}
	}
}


//VIDEOS SIN COMPRESION (PLAN B)
function uploadVideo2()
{

	global $connection;

	if (isset($_POST['upload_video'])) {
		$target_dir = "uploads/";
		$target_file = $target_dir . rand() . basename($_FILES["video"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


		// repetido
		if (file_exists($target_file)) {
			echo "Ya existe.";
			$uploadOk = 0;
		}
		// peso
		if ($_FILES["video"]["size"] > 999000000) {
			echo "Solo archivos menores a 99Mb.";
			$uploadOk = 0;
		}

		// formatos
		if ($imageFileType != "mp4" && $imageFileType != "MP4" && $imageFileType != "MKV" && $imageFileType != "mkv") {
			echo "Solo Archivos MP4.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {

		} else {
			$uploadOk = 1;
			if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
				echo "El archivo:  " . basename($_FILES["video"]["name"]) . " fue cargado.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		}

		if ($uploadOk == 1) {


			$url = $target_file;
			$title = mysqli_real_escape_string($connection, $_POST['title']);
			$description = mysqli_real_escape_string($connection, $_POST['description']);
			$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
			$department_id = mysqli_real_escape_string($connection, $_POST['department_id']);
			$test = mysqli_real_escape_string($connection, $_POST['test']);
			$owner = $_SESSION['cbt_user_name'];


			$query = "INSERT INTO videos (url, title, description, category_id, department_id, owner, test) VALUES ('$url', '$title', '$description', '$category_id', '$department_id', '$owner', '$test')";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				echo "Error: " . $query;
			} else {
				$last_id = mysqli_insert_id($connection);
				if ($test == 1) {
					header("Location: index.php?page=cuestionario&video_id=$last_id");
				} else {
					header("Location: index.php?page=admin_myvids&success=true");
				}
			}
		} else {
			//echo "Error";
			header("Location: index.php?page=upload_form&title=$title&success=false");

		}
		//file end
	}
}


function deleteVideo()
{
	global $connection;

	if (isset($_POST['delete_video'])) {


		$id = $_POST['video_id'];

		//borrar archivo anterior para guardar espacio
		$query_delete = "SELECT * FROM videos WHERE id = $id";
		$run_delete = mysqli_query($connection, $query_delete);
		$row_delete = mysqli_fetch_array($run_delete);

		$archivo_borrar = $row_delete['url'];
		unlink($archivo_borrar);
		//termina borrado de archivo


		//borrar de la tabla video_department
		$query_delete_relationship = "DELETE FROM video_department WHERE video_id = $id";
		$run_delete_relationship = mysqli_query($connection, $query_delete_relationship);


		$query = "DELETE FROM videos WHERE id = $id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("Location: index.php?page=manage_uploads&success=true");

		} else {
			header("Location: index.php?page=manage_uploads&success=false");

		}

	}

}


function editVideo()
{
	global $connection;

	if (isset($_POST['edit_video'])) {
		//echo "<h1>hola {$_GET['video_id']}</h1>";
		$video_id = $_GET['video_id'];

		$date_uploaded = date("Y-m-d H:i:s");

		$title = mysqli_real_escape_string($connection, $_POST['title']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
		$department_id = mysqli_real_escape_string($connection, $_POST['department_id']);
		$test = mysqli_real_escape_string($connection, $_POST['test']);
		$owner = $_SESSION['cbt_user_name'];

		if (empty($_FILES['video'] ['name'])) {
			//no hay video dejar igual
			$query = "UPDATE videos SET title = '$title', description = '$description',
            category_id = '$category_id', department_id = '$department_id', owner = '$owner',
            date_uploaded = '$date_uploaded' WHERE id = $video_id";

			$result = mysqli_query($connection, $query);
			if (!$result) {
				echo "Error: " . $query;
			} else {
				//start to insert departments
				if (!empty($_POST['check_list'])) {
					//first delete everything
					$query_delete_checks = "DELETE FROM video_department WHERE video_id = $video_id";
					$run_delete_checks = mysqli_query($connection, $query_delete_checks);


					// Loop to store and display values of individual checked checkbox.
					foreach ($_POST['check_list'] as $selected) {
						//echo $selected;
						$insert_departments = "INSERT INTO video_department (video_id, department_id) VALUES ('$video_id', '$selected')";
						$run_insert_departments = mysqli_query($connection, $insert_departments);
					}
				}//insert departments end

				if ($test == 1) {
					header("Location: index.php?page=questions&video_id=$video_id&edit=true");
				} else {
					header("Location: index.php?page=manage_uploads&success=true");
				}
			}
			//no video end

		}//end if
		else {

			//echo "si hay archivo <br>";
			//si hay video o archivo

			//BORRANDO ARCHIVO ANTERIOR
			$query_delete = "SELECT * FROM videos WHERE id = $video_id";
			$run_delete = mysqli_query($connection, $query_delete);
			$row_delete = mysqli_fetch_array($run_delete);

			$archivo_borrar = $row_delete['url'];
			unlink($archivo_borrar);
			//BORRADO END


			//SUBIENDO ARCHIVO

			$video = $_FILES["video"] ["tmp_name"];
			$video_name = $_FILES["video"] ["name"];
			$screenshot = "uploads/screenshots/" . rand() . $video_name . ".png";
			$target_file = "uploads/" . rand() . $video_name;


			//checks
			$uploadOk = 1;
			$error1 = "";
			$error2 = "";
			$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			if ($fileType == "mp4" || $fileType == "MP4" && $fileType != "MKV" && $fileType != "mkv") {
				echo "es video <br>";
				//el archivo es video.
				if ($_FILES["video"]["size"] > 999000000) {
					$error1_1 = "Solo archivos menores a 999Mb.";
					$uploadOk = 0;
				}

				// formatos
				if ($fileType != "mp4" && $fileType != "MP4" && $fileType != "MKV" && $fileType != "mkv") {
					$error1_2 = "Solo Archivos MP4.";
					$uploadOk = 0;
				}

				if ($uploadOk == 1) {
					$command = "c:/xampp/htdocs/cbt/smart_framework/smart_framework/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
					$cmd = system($command);

					$command2 = "c:/xampp/htdocs/cbt/smart_framework/smart_framework/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
					$cmd2 = system($command2);

					$update_video = "UPDATE videos SET title = '$title', description = '$description',
                    category_id = '$category_id', department_id = '$department_id', owner = '$owner',
                    date_uploaded = '$date_uploaded', url = '$target_file', screen = '$screenshot' WHERE id = $video_id";

					$run_update = mysqli_query($connection, $update_video);
					if (!$run_update) {
						echo $update_video;
					} else {
						//start to insert departments
						if (!empty($_POST['check_list'])) {
							//first delete everything
							$query_delete_checks = "DELETE FROM video_department WHERE video_id = $video_id";
							$run_delete_checks = mysqli_query($connection, $query_delete_checks);


							// Loop to store and display values of individual checked checkbox.
							foreach ($_POST['check_list'] as $selected) {
								//echo $selected;
								$insert_departments = "INSERT INTO video_department (video_id, department_id) VALUES ('$video_id', '$selected')";
								$run_insert_departments = mysqli_query($connection, $insert_departments);
							}
						}//insert departments end

					}


					header("Location: index.php?page=edit_training&success=true&line=983");


				} else {
					header("Location: index.php?page=edit_training&success=false&line=944");
				}
			}//end files mp4

			elseif ($fileType == "pptx" || $fileType == "PPTX" || $fileType == "pdf" || $fileType == "PDF" || $fileType == "ppt" || $fileType == "PPT") {

				$target_file = "uploads/docs" . rand() . $video_name;
				//update documento


				if (file_exists($target_file)) {
					echo "Ya existe.";
					$uploadOk = 0;
				}
				// peso
				if ($_FILES["video"]["size"] > 100000000) {
					echo "Solo archivos menores a 99Mb.";
					$uploadOk = 0;
				}

				// formatos
				if ($fileType != "pptx" && $fileType != "PPTX" && $fileType != "pdf" && $fileType != "PDF"
					&& $fileType != "ppt" && $fileType != "PPT" && $fileType != "ppsx" && $fileType != "PPSX") {
					echo "Solo Archivos MP4 o presentaciones Power Point.";
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					//echo "El archivo fue cargado.";
					// todo salio bien subir el archivo
					//header("Location: index.php?page=upload_form&title=$tile&success=false&error=upload");
				} else {
					$uploadOk = 1;
					if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
						echo "El archivo:  " . basename($_FILES["video"]["name"]) . " fue cargado.";
					} else {
						echo "Hubo un error al subir el archivo.";
					}
				}

				if ($uploadOk == 1) {


					$url = "No video";
					$title = mysqli_real_escape_string($connection, $_POST['title']);
					$description = mysqli_real_escape_string($connection, $_POST['description']);
					$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
					$department_id = mysqli_real_escape_string($connection, $_POST['department_id']);
					$test = mysqli_real_escape_string($connection, $_POST['test']);
					$owner = $_SESSION['cbt_user_name'];
					$link = $target_file;
					$screen = "assets/img/docicon.png";
					$date_uploaded = date("Y-m-d H:i:s");


					$query = "UPDATE videos SET url = '$url', title = '$title', description = '$description',
 category_id = '$category_id', department_id = '$department_id', owner = '$owner',
  link = '$target_file', screen = '$screen', date_uploaded = '$date_uploaded' WHERE  id = $video_id";

					$result = mysqli_query($connection, $query);
					if (!$result) {
						echo "Error: " . $query;
					} else {
						//last id de ultimo documento
						//$last_id = mysqli_insert_id($connection);


						//start to insert departments
						if (!empty($_POST['check_list'])) {

							//first delete everything
							$query_delete_checks = "DELETE FROM video_department WHERE video_id = $video_id";
							$run_delete_checks = mysqli_query($connection, $query_delete_checks);

							// Loop to store and display values of individual checked checkbox.
							foreach ($_POST['check_list'] as $selected) {
								//echo $selected;
								$insert_departments = "INSERT INTO video_department (video_id, department_id) VALUES ('$video_id', '$selected')";
								$run_insert_departments = mysqli_query($connection, $insert_departments);
							}
						}//insert departments end

					}
				}
				//update documento end
			} else {
				$error1_2 = "Solo Archivos MP4.";
				$uploadOk = 0;
				header("Location: index.php?pge=edit_training&success=false&error=$error1_2");
			}
			//SUBIENDO ARCHIVO END
			//si ha video o archivo end
		}
	}
}


function setNumber()
{
	global $connection;
	if (isset($_POST['setnumber'])) {
		$number = $_POST['number'];
		$video_id = $_GET['video_id'];

		header("Location: index.php?page=questions&video_id=$video_id&number=$number");

	}
}


function saveQuestions()
{
	global $connection;
	if (isset($_POST['save_questions'])) {
		$number = $_POST['question_number'];
		$video_id = $_GET['video_id'];

		for ($x = 1; $x <= $number; $x++) {
			$question = $_POST['question_' . $x];


			$option1 = ${'option' . $x . '1'} = $_POST['option_' . $x . '_1'];
			$option2 = ${'option' . $x . '2'} = $_POST['option_' . $x . '_2'];
			$option3 = ${'option' . $x . '3'} = $_POST['option_' . $x . '_3'];


			$answer = $_POST['answer_' . $x];

			$query = "INSERT INTO questions (video_id, question, option1, option2, option3, correct)
            VALUES ('$video_id', '$question', '$option1', '$option2', '$option3', $answer)";

			$result = mysqli_query($connection, $query);
			if ($result) {
				//header("Location: index.php?page=questions&video_id=$video_id&number=$number&success=true");
				header("Location: index.php?page=manage_uploads&success=true");
			} else {
				echo $query;
			}
		}
	}
}


function editQuestions()
{
	global $connection;
	if (isset($_POST['edit_questions'])) {
		$question_id = $_POST['question_id'];
		$video_id = $_GET['video_id'];

		$question = $_POST['question'];
		$option1 = $_POST['option1'];
		$option2 = $_POST['option2'];
		$option3 = $_POST['option3'];
		$correct = $_POST['correct'];

		$update = "UPDATE questions SET question = '$question', option1 = '$option1', option2 = '$option2', option3 = '$option3', correct = '$correct'
        WHERE id = $question_id";

		$run = mysqli_query($connection, $update);

		if ($run) {
			header("Location: index.php?page=edit_questions&video_id=$video_id&succces=true");
		} else {
			header("Location: index.php?page=edit_questions&video_id=$video_id&succces=false");
		}

	}
}


function saveAnswers()
{
	global $connection;
	if (isset($_POST['save_answers'])) {
		$number = $_POST['numero'];
		$video_id = $_POST['video_id'];
		$user = $_SESSION['cbt_user_name'];

		$insert_test = "INSERT INTO user_test (video_id, user_name) VALUES ('$video_id','$user')";
		$run_insert = mysqli_query($connection, $insert_test);
		$test_id = mysqli_insert_id($connection);

		for ($x = 1; $x <= $number; $x++) {
			$question_id = $_POST['question_id_' . $x];
			$answer = $_POST['answer_' . $x];

			$get_question = "SELECT * FROM questions WHERE id = $question_id";
			$run_get_question = mysqli_query($connection, $get_question);
			$row = mysqli_fetch_array($run_get_question);
			$correct = $row['correct'];
			if ($correct == 1) {
				$option_text = $row['option1'];
			} elseif ($correct == 2) {
				$option_text = $row['option2'];
			} elseif ($correct == 3) {
				$option_text = $row['option3'];
			}

			if ($answer == $correct) {
				$correct_answers = 1;
			} else {
				$correct_answers = 0;
			}

			$query = "INSERT INTO test (test_id,video_id, question_id, option_chosen, correct, option_text, correct_answers, user_name)
            VALUES ('$test_id','$video_id', '$question_id', '$answer', '$correct', '$option_text', '$correct_answers', '$user')";

			$result = mysqli_query($connection, $query);
			if ($result) {
				header("Location: index.php?page=play&p=t&test=$test_id&video_id=$video_id&key=B07RA11R0k5");
			} else {
				echo $query;
			}
		}
	}
}


//DOCUMENTOS PDF Y PPTX
function uploadDoc()
{

	global $connection;

	if (isset($_POST['upload_video'])) {
		$target_dir = "uploads/docs/";
		$target_file = $target_dir . rand() . basename($_FILES["document"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


		// repetido
		if (file_exists($target_file)) {
			echo "Ya existe.";
			$uploadOk = 0;
		}
		// peso
		if ($_FILES["document"]["size"] > 100000000) {
			echo "Solo archivos menores a 99Mb.";
			$uploadOk = 0;
		}

		// formatos
		if ($imageFileType != "pptx" && $imageFileType != "PPTX" && $imageFileType != "pdf" && $imageFileType != "PDF"
			&& $imageFileType != "ppt" && $imageFileType != "PPT" && $imageFileType != "ppsx" && $imageFileType != "PPSX") {
			echo "Solo Archivos MP4 o presentaciones Power Point.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {

		} else {
			$uploadOk = 1;
			if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
				echo "El archivo:  " . basename($_FILES["document"]["name"]) . " fue cargado.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		}

		if ($uploadOk == 1) {


			$url = "No video";
			$title = mysqli_real_escape_string($connection, $_POST['title']);
			$description = mysqli_real_escape_string($connection, $_POST['description']);
			$category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
			$department_id = mysqli_real_escape_string($connection, $_POST['department_id']);
			$test = mysqli_real_escape_string($connection, $_POST['test']);
			$owner = $_SESSION['cbt_user_name'];
			$link = $target_file;
			$screen = "assets/img/docicon.png";
			$date_uploaded = date("Y-m-d H:i:s");


			$query = "INSERT INTO videos (url, title, description, category_id, department_id, owner, test, link, screen, date_uploaded)
            VALUES ('$url', '$title', '$description', '$category_id', '$department_id', '$owner', '$test', '$link', '$screen', '$date_uploaded')";
			$result = mysqli_query($connection, $query);
			if (!$result) {
				echo "Error: " . $query;
			} else {
				//last id de ultimo documento
				$last_id = mysqli_insert_id($connection);


				//start to insert departments
				if (!empty($_POST['check_list'])) {
					// Loop to store and display values of individual checked checkbox.
					foreach ($_POST['check_list'] as $selected) {
						//echo $selected;
						$insert_departments = "INSERT INTO video_department (video_id, department_id) VALUES ('$last_id', '$selected')";
						$run_insert_departments = mysqli_query($connection, $insert_departments);
					}
				}//insert departments end


				if ($test == 1) {
					header("Location: index.php?page=questions&video_id=$last_id");
				} else {
					header("Location: index.php?page=manage_uploads&success=true");
				}
			}
		} else {
			//echo "Error";
			header("Location: index.php?page=upload_form&success=false");

		}
		//file end
	}
}


function saveMessage()
{

	global $connection;

	if (isset($_POST['send_message'])) {
		$message = $_POST['message'];
		$department_id = $_POST['department_id'];
		$user_name = $_POST['user_name'];

		$date = date("Y-m-d");

		$query = "INSERT INTO messages (message, department_id, date, user_name)VALUES('$message', '$department_id', '$date', '$user_name')";
		$result = mysqli_query($connection, $query);
		$last_id = mysqli_insert_id($connection);

		//start to insert departments
		if (!empty($_POST['check_list'])) {
			foreach ($_POST['check_list'] as $selected) {
				$insert_departments = "INSERT INTO message_department (message_id, department_id) VALUES ('$last_id', '$selected')";
				$run_insert_departments = mysqli_query($connection, $insert_departments);
			}
		} else {
			$insert_departments = "INSERT INTO message_department (message_id, department_id) VALUES ('$last_id', '$department_id')";
			$run_insert_departments = mysqli_query($connection, $insert_departments);
		}

		header("Location: index.php?page=admin_group_message&success=true");

	}
}


function setYesNo()
{

	global $connection;

	if (isset($_POST['set_qa'])) {
		$video_id = $_GET['video_id'];
		$yesno = $_POST['yesno'];


		$query = "UPDATE videos SET test = '$yesno' WHERE id = $video_id";
		$result = mysqli_query($connection, $query);

		if ($result) {
			header("Location: index.php?page=add_questions&video_id=$video_id&success=true");

		} else {
			header("Location: index.php?page=add_questions&video_id=$video_id&success=false");

		}
	}
}
