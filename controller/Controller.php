<?php

namespace JBlog\Controller;

use JBlog\SQLTool;

class Controller
{
    /**
     * @var SQLTool
     */
    protected $sql_tool;

    public function __construct(SQLTool $sqltool)
    {
        $this->sql_tool = $sqltool;
    }
}