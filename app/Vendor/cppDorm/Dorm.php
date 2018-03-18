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

        file_put_contents(  $file_name , $code );

        $command = GCC . " -o ". $executable ." ".$file_name;
        $output = shell_exec($command);

        if(file_exists($executable))
        {
            $this->cleanCompilationFolder([$file_name, $executable]);
            return true;
        }
        else
        {
            $this->cleanCompilationFolder([$file_name, $executable]);
            return false;
        }
    }
}
?>