<?php

namespace uifarm\urlrewriting;
	
class URLRewriter {

	private $flush = false;
    private $urlPattern;
    private $forwardQueryStr;
    private $queryVar;

	function __construct($urlPattern,$forwardQueryStr,$queryVar) {
        $this->urlPattern = $urlPattern;
        $this->forwardQueryStr = $forwardQueryStr;
        $this->queryVar = $queryVar;
    }

    public function getUrlPattern() {
        return $this->urlPattern;
    }

    public function setUrlPattern($urlPattern=null) { 
        $this->urlPattern = $urlPattern; 
    } 

    public function getForwardQueryStr() {
        return $this->forwardQueryStr;
    }

    public function setForwardQueryStr($forwardQueryStr=null) { 
        $this->forwardQueryStr = $forwardQueryStr; 
    } 

    public function getQueryVar() {
        return $this->queryVar;
    }

    public function setQueryVar($queryVar=null) { 
        $this->queryVar = $queryVar; 
    } 

    public function setupRewrite() {

        add_filter('rewrite_rules_array', array($this, 'insertMyRewriteRules'));
        add_filter('query_vars', array($this, 'insertMyRewriteQueryVars'));
        if($this->flush)
            add_filter('init', array($this, 'flushRules'));

    }

    public function flushRules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    // Adding a new rule
    public function insertMyRewriteRules($rules) {
        $newrules = array();
        $newrules[$this->getUrlPattern()] = 'index.php?' . $this->getForwardQueryStr();
        return $newrules + $rules;
    }

    // Adding the id var so that WP recognizes it
    public function insertMyRewriteQueryVars($vars) {
        array_push($vars, $this->getQueryVar());
        return $vars;
    }

}

?>