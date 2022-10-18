<?php
class Content extends  CI_Controller
{
	public function create($id = NULL)
	{
		$data['course'] = $this->CourseModel->get_courses($id);

		if (empty($data['course'])) {
			show_404();
		}


		$course_title = $data['course']['course_name'];
		$course_id = $id;

		$data['section'] = 'Registrar Contenido al curso';
		$data['title'] =  $course_title;


		$this->form_validation->set_rules('title', 'Titlo del contenido', 'required');
		$this->form_validation->set_rules('description', 'Descripcion del contenido', 'required');
		if (empty($_FILES['userfile']['name']))
		{
			$this->form_validation->set_rules('userfile', 'Archivo o Documento', 'required');
		}
		//$this->form_validation->set_rules('video', 'Archivo', 'required');

		$this->form_validation->set_error_delimiters(
			'<div class="alert alert-danger alert-dismissible fade show"><strong>Error&nbsp; </strong><br>',
			' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
		);


		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('templates/topnav');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/wrapper');
			$this->load->view('content/create', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			//check if its video file
			$myfile = strtolower(pathinfo($_FILES["userfile"] ["name"], PATHINFO_EXTENSION));
			if(($myfile == "ppt" || $myfile == "PPT" || $myfile == "PPTX" || $myfile == "pptx"))
			{

				$config['upload_path'] = './uploads';
				$config['allowed_types'] = 'ppt|pptx|PPTX|PPT';
				$config['max_size'] = '20048';

				$this->load->library('upload', $config);

				echo "Error1";

				if(!$this->upload->do_upload())
				{
					echo "Error2";
					$errors = array('error'=>$this->upload->display_errors());
					//$category_image = 'noimage.jpg';
					redirect(base_url() . 'content/create/' . $id);

				}
				else
				{
					echo "Error3";
					$data = array('upload_data'=>$this->upload->data());
					$target_file = $_FILES['userfile']['name'];
					$screenshot = "uploads/screenshots/file.png";

					$this->ContentModel->create($target_file, $screenshot);
					$this->session->set_flashdata('success', 'Contenido registrado correctamente.');
					redirect(base_url() . 'content/create/' . $id);
				}
			}
			else
			{
				$video = $_FILES["userfile"] ["tmp_name"];
				$video_name = $_FILES["userfile"] ["name"];
				$video_name = str_replace(' ', '_', $video_name);
				$screenshot = "uploads/screenshots/" . rand() . $video_name . ".png";
				$target_file = "uploads/" .  rand() . $video_name;

				//checks "uploads/" .
				$uploadOk = 1;
				$error1 = "";
				$error2 = "";
				$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

				if ($_FILES["userfile"]["size"] > 999000000) {
					$error1 = "Solo archivos menores a 999Mb.";
					$uploadOk = 0;
				}

				// formatos
				if ($fileType != "mp4" && $fileType != "MP4" && $fileType != "MKV" && $fileType != "mkv") {
					$error2 = "Solo Archivos MP4 o PowerPoint.";
					$uploadOk = 0;
				}

				if ($uploadOk == 1) {

					$command = "d:/xampp/htdocs/computer_based_training/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
					$cmd = system($command);

					$command2 = "d:/xampp/htdocs/computer_based_training/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:08.435 -vframes 1 $screenshot";
					$cmd2 = system($command2);
				}

				if ($uploadOk == 0)
				{
					$this->session->set_flashdata('error', $error1 . $error2);
					redirect(base_url() . 'content/create/' . $id);
				}
				else
				{
					$target_file = str_replace('uploads/', '', $target_file);
					$this->ContentModel->create($target_file, $screenshot);
					$this->session->set_flashdata('success', 'Contenido registrado correctamente.');
					redirect(base_url() . 'content/create/' . $id);
				}

			}

		}
	}






	public function index()
	{
		$data['title'] = 'Contenido';
		$data['contents'] = $this->ContentModel->get_content();

		$this->load->view('templates/header');
		$this->load->view('templates/topnav');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/wrapper');
		$this->load->view('content/index', $data);
		$this->load->view('templates/footer');
	}






	function orderUpdate(){
		// Get id of the images
		$ids = $this->input->post('ids');

		if(!empty($ids)){
			// Generate ids array
			$idArray = explode(",", $ids);

			$count = 1;
			foreach ($idArray as $id){
				// Update image order by id
				$data = array('order' => $count);
				$update = $this->ContentModel->update($id,$data);
				$count ++;
			}

		}

		return true;
	}



}
