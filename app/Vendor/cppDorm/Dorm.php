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
        $file_name = $this->getCompilationPath() . DS .rand(0,999999)."_".time().".cpp";

        file_put_contents($file_name,$code);

        $executable = $this->getCompilationPath() . DS . "programe.exe";

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
        //write the input_file to the compilation folder
        file_put_contents($this->getCompilationPath() . DS . $input_file['file_name'], $input_file['file_content']);
        //compile the code to run wth the input file we just created


    }
}
?>