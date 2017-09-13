<?php
App::uses('AppController', 'Controller');

/**
 * Submittions Controller
 *
 * @property Submittion $Submittion
 * @property PaginatorComponent $Paginator
 */
class SubmittionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() 
	{
			if( AuthComponent::user('role') == 1 )
			{
				$submittions = $this->Submittion->find('all');

                $this->loadModel('Problem');
                $Problems = $this->Problem->find('all');
				foreach($submittions as $submittion)
				{
					$language = $submittion['Submittion']['language'];
					$code = $submittion['Submittion']['solution'];
					$userID = $submittion['Submittion']['user_id'];
					$submittionID = $submittion['Submittion']['id'];
					$submittionOutFile = $submittion['Submittion']['output'];

                    foreach ($Problems as $Problem)
                    {
                        if($Problem['Problem']['output'] == $submittionOutFile) {
                            $submittionInFile = $Problem['Problem']['input'];
                        }
                    }
					if($language =="C++")
					{
						$compilerResult = $this->compile($code,$language);

						if($compilerResult != "")
						{

                            $submition['Submittion']['response']= $compilerResult;
                            $submition['Submittion']['id']=$submittionID;
							$this->Submittion->save($submition);
                           // echo $submittionID;
                            continue;

						}
						$runResult = $this->run($code, $language, $userID, $submittionID, $submittionOutFile,$submittionInFile);
						if($runResult != "")
						{
                            $submition['Submittion']['response']= $runResult;
                            $submition['Submittion']['id']=$submittionID;
                            $this->Submittion->save($submition);
                           // echo $submittionID;
                            continue;
						}
					}
					if($language =="Java")
					{
						$compilerResult = $this->compile($code,$language);
						if($compilerResult != "")
						{
                            $submition['Submittion']['response']= $compilerResult;
                            $submition['Submittion']['id']=$submittionID;
                            $this->Submittion->save($submition);
                           // echo $submittionID;
                            continue;
						}
                        $runResult = $this->run($code, $language, $userID, $submittionID, $submittionOutFile,$submittionInFile);
						if($runResult != "")
						{
                            $submition['Submittion']['response']= $runResult;
                            $submition['Submittion']['id']=$submittionID;
                            $this->Submittion->save($submition);
                            //echo $submittionID;
                            continue;
						}
					}

				}
									
					//if language equal cpp
						//$result = compile submittion
						//if($result != true)
							//store response and continue
						//$comp= run submittion
						//if($result != true)
							//store response and continue	
					//if language equal java
						//compile submittion
							//if erroe break
						//judge ubmittion	
							//make responde
			}			

			//send problems
			$this->loadModel('Problem');
			$Problems = $this->Problem->find('all');
			$this->set('problems' ,$Problems);
			
			//send users
			$this->loadModel('User');
			$option = array('order' => array('User.rank' => 'desc'));
			$users = $this->User->find('all',$option);
			$this->set('users' ,$users);

			//send submitions
			$submitions = $this->Submittion->find('all');
			$this->set('submitions' ,$submitions);
			

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function account($id = null) {
		if(AuthComponent::user('id') != $id && AuthComponent::user('role') != 1 )
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
		
		//send users
		$this->loadModel('User');
			
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}
		
		$options = array('conditions' => array('Submittion.user_id' => $id));
		$this->set('submittions', $this->Submittion->find('all', $options));
	}
/*
 *  account for showing my submitions 
 *
 */
	public function view($id = null) {
		
			if (!$this->Submittion->exists($id)) {
				throw new NotFoundException(__('Invalid submittion'));
			}
			
			$options = array('conditions' => array('Submittion.' . $this->Submittion->primaryKey => $id));
			$this->set('submittion', $this->Submittion->find('first', $options));
		
	}
	
	
	/*
	*
	*	show teams submittions to be judged 
	*/
	public function judge()
	{
		if(AuthComponent::user('role') == 1) 
		{
			$this->set('submittions', $this->Submittion->find('all'));
		}
		else
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
	}
	
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		//send problems
		//$ProbNamee = $this->Session->read('ProbName');
		//echo ($ProbNamee);
		$this->loadModel('Problem');
		$Problems = $this->Problem->find('all');
		$this->set('problems' ,$Problems);
		
		if ($this->request->is('post')) {
			$this->Submittion->create();
			
			$this->request->data['Submittion']['user_id'] = $this->Auth->user('id');
			$this->request->data['Submittion']['response'] = "--";
            foreach($Problems as $Problem)
            {
                if($this->request->data['Submittion']['problem'] == $Problem['Problem']['name'])
                    $this->request->data['Submittion']['output'] = $Problem['Problem']['output'];
            }
			$id = $this->Auth->user('id');
			$solCode = $this->request->data['Submittion']['solution']; 
			if ($this->Submittion->save($this->request->data)) {
		 		$submID = $this->Submittion->getInsertID();

				$this->Session->setFlash(__('submittion is saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The submittion could not be saved. Please, try again.'));
			}
			
		}
		$users = $this->Submittion->User->find('list');
		$this->set(compact('users'));
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if(AuthComponent::user('role') == 1)
		{
			if (!$this->Submittion->exists($id)) {
				throw new NotFoundException(__('Invalid Submittion'));
			}
			if ($this->request->is(array('post', 'put'))) {
				$this->request->data['Submittion']['id'] = $id;
				 
				if ($this->Submittion->save($this->request->data)) {
					$this->Session->setFlash(__('The Submittion has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Submittion could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Submittion.' . $this->Submittion->primaryKey => $id));
				$this->set('submittion',$this->Submittion->find('first', $options));
				$this->request->data = $this->Submittion->find('first', $options);
			}
		}
		else
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
		
	}

	
	
	public function getMax( $array )
	{
		$max = 0;
		foreach( $array as $k => $v )
		{
			$max = max( array( $max, $v['key1'] ) );
		}
		return $max;
	}
	
	private  function compile($code, $language)
	{
        if($language =="C++"){
            $CC="g++ --std=c++11";
            $filename_code= "output/main.cpp";
            $filename_error="logs/problem_Error.txt";
            $executable="a.out";
            $command=$CC." -lm ".$filename_code;
            $command_error=$command." 2>".$filename_error;
            $check=0;

            $file_code=fopen($filename_code,"w+");
            fwrite($file_code,$code);
            fclose($file_code);
            exec("chmod 777 $executable");
            exec("chmod 777 $filename_error");
            $check=0;
            shell_exec($command_error);
            $error=file_get_contents($filename_error);

            if(trim($error) !="" && strpos($error,"error"))
            {
                $check=1;
            }
            else if(trim($error) !="" && strpos($error,"warning"))
            {
                $check=2;
            }
            if($check==1)
            {
                $error ="Compilation Error";
            }
            else if($check==2)
            {
                $error = "Runtime Error";
            }
            exec("rm $filename_error");
            exec("rm $filename_code");
            exec("rm *.o");
            exec("rm *.txt");
            exec("rm *.cpp");
            exec("rm $executable");
            return $error;
        }
        if($language =="Java")
        {
            $CC="javac";
            $filename_code="output/main.java";
            $filename_error="logs/problem_Error.txt";
            $runtime_file="logs/runtime.txt";
            $executable="*.class";
            $command=$CC." ".$filename_code;
            $command_error=$command." 2>".$filename_error;
            $check=0;

            $file_code=fopen($filename_code,"w+");
            fwrite($file_code,$code);
            fclose($file_code);
            exec("chmod 777 $executable");
            exec("chmod 777 $filename_error");
            exec("chmod 777 $filename_code");

            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);

            if(trim($error) !="" && strpos($error,"error"))
            {
                $check=1;
            }
            else if(trim($error) !="" && strpos($error,"warning"))
            {
                $check=2;
            }

            if($check==1)
            {
                $error ="Compilation Error";
            }
            else if($check==2)
            {
                $error = "Runtime Error";
            }
            exec("rm $runtime_file");
            exec("rm $filename_code");
            exec("rm $filename_error");
            exec("rm *.txt");
            exec("rm $executable");
            return $error;
        }

		//if cpp
			//compile cpp
		//if java 
			//compile java

		// return result
	}
	
	private function run($code, $lanuage, $user_id, $submittion_id, $problem_ouput_file, $submittionInFile)
    {
        if ($lanuage == "C++")
        {

            $CC = "g++ --std=c++11";
            $out = "timeout .30s ./a.out";

            $problem_file_output = "files/problems/" . $problem_ouput_file;
            $filename_code = "output/main.cpp";
            $problem_file_input = "files/problems/" . $submittionInFile;
            $filename_out = "files/users/" . $user_id . "/" . $submittion_id . ".txt";
            $filename_error = "logs/problem_Error.txt";
            $input = file_get_contents($problem_file_input);
            $executable = "a.out";
            $command = $CC . " -lm " . $filename_code;
            $command_error = $command . " 2>" . $filename_error;
            $file_code = fopen($filename_code, "w+");
            fwrite($file_code, $code);
            fclose($file_code);
            exec("chmod 777 $executable");
            exec("chmod 777 $filename_error");
            exec("chmod 777 $filename_code");
            exec("chmod 777 $problem_file_output");
            exec("chmod 777 $problem_file_input");
            shell_exec($command_error);
            $error = file_get_contents($filename_error);
            $executionStartTime = microtime(true);
            if (trim($error) == "" || !strpos($error, "error")) {
                if (trim($input) == "") {
                    $output = shell_exec($out);
                } else {
                    $out = $out . " < " . $problem_file_input;
                    $output = shell_exec($out);
                }
                $file_out = fopen($filename_out, "w+");
                fwrite($file_out, $output);
                fclose($file_out);

            }
            exec("chmod 777 $filename_out");
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            $result = $this->problem_judge($filename_out, $problem_file_output);
            echo $seconds;

            if ($seconds >= 0.30) {
                $error = "Time Limit Exceed";
            } elseif ($result == true) {
                $error = "Accepted";
            } elseif ($result == false) {
                $error = "Wrong Answer";
            }

            //exec("rm $filename_in");
            exec("rm $filename_error");
            exec("rm $filename_code");
            exec("rm *.o");
            exec("rm *.txt");
            exec("rm *.cpp");
            exec("rm $executable");
            return $error;
        } elseif ($lanuage == "Java") {
            $CC="javac";
            $out="timeout .50s java Main";
            $problem_file_output = "files/problems/" . $problem_ouput_file;
            $filename_code = "output/main.java";
            $problem_file_input = "files/problems/" . $submittionInFile;
            $filename_out = "files/users/" . $user_id . "/" . $submittion_id . ".txt";
            $filename_error = "logs/problem_Error.txt";
            $runtime_file="logs/runtime.txt";
            $executable="*.class";
            $input = file_get_contents($problem_file_input);
            $command=$CC." ".$filename_code;
            $command_error=$command." 2>".$filename_error;
            $runtime_error_command=$out." 2>".$runtime_file;
            $check=0;

            $file_code=fopen($filename_code,"w+");
            fwrite($file_code,$code);
            fclose($file_code);
            exec("chmod 777 $executable");
            exec("chmod 777 $filename_error");
            exec("chmod 777 $problem_file_output");
            exec("chmod 777 $problem_file_input");

            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);

            if (trim($error) == "" || !strpos($error, "error"))
            {
                if(trim($input)=="")
                {
                    shell_exec($runtime_error_command);
                    $runtime_error=file_get_contents($runtime_file);
                    $output=shell_exec($out);
                }
                else
                {
                    shell_exec($runtime_error_command);
                    $runtime_error=file_get_contents($runtime_file);
                    $out=$out." < ".$problem_file_input;
                    $output=shell_exec($out);
                }
                $file_out = fopen($filename_out, "w+");
                fwrite($file_out, $output);
                fclose($file_out);
            }
            exec("chmod 777 $filename_out");
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            $result = $this->problem_judge($filename_out, $problem_file_output);
            echo $seconds;

            if ($seconds >= 0.50) {
                $error = "Time Limit Exceed";
            }
            elseif($result==false)
            {
                $error ="Wrong Answer";
            }
            else if($result==true)
            {
                $error ="Accpted";
            }
            exec("rm $runtime_file");
            exec("rm $filename_code");
            exec("rm $filename_error");
            exec("rm *.txt");
            exec("rm $executable");
            return $error;
        }
        //if cpp
        //run cpp with outfile at folder /files/users/$user_id/$user_id_$submittion_id.txt
        //call $result = problem_judge($user_id_$submittion_id.txt, $problem_ouput_file)

        //if java
        //run java with outfile at folder /files/users/$user_id/$user_id_$submittion_id.txt
        //problem_judge($user_id_$submittion_id.txt, $problem_ouput_file)


        //return $result

	}

	private function problem_judge($user_id_submittion_id, $problem_ouput_file)
	{
	    $userFileContants =  file_get_contents($user_id_submittion_id);
	    $probFileContants = file_get_contents($problem_ouput_file);
        $lines1 = explode("\n", $userFileContants);
        $lines2 = explode("\n", $probFileContants);

        if($lines1==$lines2)
           return true;

       return false;
		//compare the
		//return true if matches else return flse 
	}



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Submittion->id = $id;
		if (!$this->Submittion->exists()) {
			throw new NotFoundException(__('Invalid submittion'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Submittion->delete()) {
			$this->Session->setFlash(__('The submittion has been deleted.'));
		} else {
			$this->Session->setFlash(__('The submittion could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/

}
