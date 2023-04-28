<?php

class  Reports extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $data=[];
        $this->view("admin/reports", $data);
    }

}