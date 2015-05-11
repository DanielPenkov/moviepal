<?php

class PhonesController extends AppController {
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

    public function index() {
         $this->set('phones', $this->Phone->find('all'));
    }

    public function import() {

       $movies = array();
        $file = $_SERVER['DOCUMENT_ROOT'] .'/file_api.json';

        $json = json_encode(file_get_contents($file));

        array_push($movies,$json);
        $res = $movies[1];

    	//ini_set('max_execution_time', 100000);

    	//$prefix="tt";
    	//$data = null;
    	//$movies = array();
    	
    	//for ($i=2395000; $i <2395427 ; $i++) {
    		
    			//$id = $prefix.(string)$i;

    			//$json = file_get_contents('http://www.omdbapi.com/?i='.(string)$id.'&plot=full&r=json');

    		//if(json_decode($json) != null){

    			//$data = json_decode($json);
    			//array_push($movies,$data);
    		//}
    		
    	//}
		//$data_all = json_encode($movies);

    	// $file = fopen($_SERVER['DOCUMENT_ROOT'] .'/file_api.json','w+');
     //fwrite($file, $data_all);
     //fclose($file);
   


    }






	
	public function add() {
        if ($this->request->is('post')) {
            $this->Phone->create();
            if ($this->Phone->save($this->request->data)) {
                $this->Session->setFlash(__('The phone has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your phone.'));
        }
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid phone'));
        }

        $phone = $this->Phone->findById($id);
        if (!$phone) {
            throw new NotFoundException(__('Invalid phone'));
        }
        $this->set('phone', $phone);
    }
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid phone'));
		}

		$phone = $this->Phone->findById($id);
		if (!$phone) {
			throw new NotFoundException(__('Invalid phone'));
		}

		if ($this->request->is(array('phone', 'put'))) {
			$this->Phone->id = $id;
			if ($this->Phone->save($this->request->data)) {
				$this->Session->setFlash(__('Your phone has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your phone.'));
		}

		if (!$this->request->data) {
			$this->request->data = $phone;
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Phone->delete($id)) {
			$this->Session->setFlash(
				__('The phone with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}