<?php
    // Simple page redirect
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }
	
	function redirectCurrent(){
		header('location: '. REFERER);
	}