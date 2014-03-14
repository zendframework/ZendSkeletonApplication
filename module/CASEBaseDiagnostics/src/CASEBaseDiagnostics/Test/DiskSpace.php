<?php
namespace CASEBaseDiagnostics\Test;

use ZFTool\Diagnostics\Test\AbstractTest;
use ZendDiagnostics\Check\DiskFree;
use ZendDiagnostics\Result\Success;
use ZendDiagnostics\Result\Warning;

class DiskSpace extends AbstractTest
{
    private $size;
    
    public function __construct($size = '10GB')
    {
        $this->size = $size;    
    }
    public function run()
    { 
        $checkSpace = new DiskFree($this->size);
        $result = $checkSpace->check();
        if($result instanceof Success){
            return new \ZFTool\Diagnostics\Result\Success($result->getMessage(), $result->getData());
        } 
        if($result instanceof Warning){
            return new \ZFTool\Diagnostics\Result\Warning($result->getMessage(), $result->getData());
        }
        return new \ZFTool\Diagnostics\Result\Failure($result->getMessage(), $result->getData());
    }
    
}
