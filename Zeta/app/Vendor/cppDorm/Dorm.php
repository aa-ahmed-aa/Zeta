<?php
require_once 'configuration.php';

class Dorm {

    /**
     * this function will create a temp cpp file to run the code and will return the response
     * @param $code => the code cpp or java
     * @return bool => true if the code run successfult, false otherwise
     */
    public static function compile($code)
    {
        $file_name = __DIR__ . DS . 'tmp' . DS .rand(0,100)."_".time().".cpp";
        $executable = __DIR__ . DS . 'tmp' . DS . "ah.exe";
        file_put_contents(  $file_name , $code );
        $command = GCC . " -o ". $executable ." ".$file_name;
        $response = shell_exec($command);
//        Configure::write('debug', 2);
//        die(debug( $command  ) );
        if ( !$response )
            return true;
        else
            return false;
    }
}
?>