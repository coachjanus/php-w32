<?php

namespace App\Core\Traits;

trait Upload
{
    protected $filename;
    protected $tmp_name;
    public $file = [];
    protected $max_file_size;
    protected $destination;
    protected $default_permissions = 0750;
    protected $root;

    protected function create_new_filename() {
		$filename = sha1(mt_rand(1, 9999) . $this->destination . uniqid()) . time();
		$this->set_filename($filename);
	}

    public function set_filename($filename) {
		$this->filename = $filename;
	}

    protected function save_file() {
		//create & set new filename
		if(empty($this->filename)){
			$this->create_new_filename();
		}

		//set filename
		$this->file['filename']	= $this->filename;
		//set full path
		$this->file['full_path'] = $this->root . $this->destination . $this->filename;
        $this->file['path'] = $this->destination . $this->filename;

        if (move_uploaded_file($this->tmp_name, $this->file['full_path'])){
            return "http://{$_SERVER['HTTP_HOST']}/{$this->file['path']}";
        }else{
            throw new \Exception('Upload: Can\'t upload file.');
        }
	}

    
    public function upload($file, $destination)
    {
        $this->root = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR;
        $this->file = $file;
        $this->tmp_name  = $this->file['tmp_name'];

        if (!$this->set_destination($destination)) {
			throw new \Exception('Upload: Can\'t create destination. '.$this->root . $this->destination);
		}
        
        return $this->save_file();
    }

	protected function set_destination($destination) {
		$this->destination = $destination . DIRECTORY_SEPARATOR;
		return $this->destination_exist() ? TRUE : $this->create_destination();
	}


    protected function destination_exist() {

		return is_writable($this->root . $this->destination);

	}

    protected function create_destination() {
		return mkdir($this->root . $this->destination, $this->default_permissions, true);
	}



    public function check() {

		//execute callbacks (check filesize, mime, also external callbacks
		$this->validate();

		//add error messages
		$this->file['errors'] = $this->get_errors();

		//change file validation status
		$this->file['status'] = empty($this->validation_errors);

		return $this->file['status'];

	}


    protected function validate() {

		//get curent errors
		$errors = $this->get_errors();

		if (empty($errors)) {

			//set data about current file
			$this->set_file_data();

			//execute internal callbacks
			$this->execute_callbacks($this->callbacks, $this);

			//execute external callbacks
			$this->execute_callbacks($this->external_callback_methods, $this->external_callback_object);

		}

	}

    protected function set_file_data() {

		$file_size = $this->get_file_size();

		$this->file = array(
			'status'				=> false,
			'destination'			=> $this->destination,
			'size_in_bytes'			=> $file_size,
			'size_in_mb'			=> $this->bytes_to_mb($file_size),
			'mime'					=> $this->get_file_mime(),
			'original_filename'		=> $this->file_post['name'],
			'tmp_name'				=> $this->file_post['tmp_name'],
			'post_data'				=> $this->file_post,
		);

	}

    protected function check_file_size($object) {

		if (!empty($object->max_file_size)) {

			$file_size_in_mb = $this->bytes_to_mb($object->file['size_in_bytes']);

			if ($object->max_file_size <= $file_size_in_mb) {

				$object->set_error('File is too big.');

			}

		}
    }

    protected function check_file_array($file) {

		return isset($file['error'])
			&& !empty($file['name'])
			&& !empty($file['type'])
			&& !empty($file['tmp_name'])
			&& !empty($file['size']);

	}

    protected function get_file_size() {

		return filesize($this->tmp_name);

	}

    protected function get_file_mime() {

		return $this->finfo->file($this->tmp_name, FILEINFO_MIME_TYPE);

	}


}