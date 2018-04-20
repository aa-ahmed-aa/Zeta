<?php
require_once 'configuration.php';

class Dorm {
    private $compilationPath;

    /**
     * Set the compilation path and create it if not existed
     * @param $path => path of the compilation folder to can create and maintain inputs and outputs files easily
     */
    public function setCompilationPath($path)
    {
        $this->createFolderIfNotExisted($path);
        $this->compilationPath = $path;
    }

    /**
     * Get the compilation path
     * @return mixed
     */
    public function getCompilationPath()
    {
        return $this->compilationPath;
    }

    /**
     * Create the directory if not existed
     * @param $path => full path of the folder to create
     */
    public function createFolderIfNotExisted($path)
    {
        if(!file_exists($path))
        {
            mkdir($path);
        }
    }

    /**
     * Removes the pathes passed to the function
     * @param $files_to_delete => files to be deleted
     */
    public function cleanCompilationFolder($files_to_delete)
    {
           foreach($files_to_delete as $file)
           {
               unlink($file);
           }
    }

    /**
     * this function will create a temp cpp file to run the code and will return the response
     * @param $code => the code cpp or java
     * @return bool => true if the code run successfult, false otherwise
     */
    public function compile( $code )
    {
        $random_name = rand(0,999999)."_".time();
        $file_name = $this->getCompilationPath() . DS . $random_name . ".cpp";

        file_put_contents($file_name,$code);

        $executable = $this->getCompilationPath() . DS . "program.exe";

        $command = GCC . " -o ". $executable ." ".$file_name." 2>&1";

        exec($command , $output, $status);

//        $this->cleanCompilationFolder([$file_name, $executable]);

        if( empty($output) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $input_file => the input that we will run the code on
     * @param $output_file => the correct output to compare with
     * @return string => return the output of the run "Accepted" or "Wrong Answer" to the
     * matched test cases or "Compilation error" if not compiled
     */
    public function run($input_file , $output_file)
    {
        //write input file to disk
        file_put_contents($this->getCompilationPath() . DS . $input_file['file_name'], $input_file['file_content']);

        //execute the .exe file
        $command = "cd " . $this->getCompilationPath() . DS . " & ";
        $command .= $this->getCompilationPath() . DS . "program.exe 2>&1";
        $output = $this->RunCommand($command);

        if($output == TIME_LIMIT_EXCEEDED)
            return TIME_LIMIT_EXCEEDED;

        //error happened while run
        if( ! empty($output) )
        {
            return WRONG_ANSWER;
        }

        //compare the output file with user output file
        $output_file_name = $this->getCompilationPath() . DS . $output_file['file_name'];
        $user_output = file_get_contents($output_file_name);
        $correct_output = $output_file['file_content'];
        if( $user_output  == $correct_output )
        {
            $this->cleanCompilationFolder([$output_file_name]);
            return ACCEPTED;
        }
        $this->cleanCompilationFolder([$output_file_name]);

        return WRONG_ANSWER;
    }

    /**
     * this function will timeout after 5 second to handle the time limit exceeded
     * @param $command => the command we will run
     * @return string => return the time_limit_exceeded if the time is greater than 5 second
     */
    public function RunCommand($command)
    {
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
            2 => array("file", "error-output.txt", "a") // stderr is a file to write to
        );

        $time = time();
        $output = '';
        $process = proc_open($command, $descriptorspec, $pipes);
            while($s= fgets($pipes[1], 1024)) {
                $output .= $s;
                if(time()-$time>5){
                    system("taskkill /im program.exe /f");
                    return TIME_LIMIT_EXCEEDED;
                }
            }

        return $output;
    }
}
?>