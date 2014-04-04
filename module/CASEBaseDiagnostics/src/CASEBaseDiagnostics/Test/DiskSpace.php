<?php
namespace CASEBaseDiagnostics\Test;

use ZendDiagnostics\Check\AbstractCheck;
use ZendDiagnostics\Check\DiskFree;
use ZendDiagnostics\Result\Success;
use ZendDiagnostics\Result\Warning;

class DiskSpace extends AbstractCheck
{
    private $size;
    
    public function __construct($size = '10GB')
    {
        $this->size = $size;    
    }
    public function check()
    { 
        $checkSpace = new DiskFree($this->size);
        $result = $checkSpace->check();
        if($result instanceof Success){
            return new Success($result->getMessage(), $result->getData());
        } 
        if($result instanceof Warning){
            return new Warning($result->getMessage(), $result->getData());
        }
        return new Result\Failure($result->getMessage(), $result->getData());
    }
    
}
