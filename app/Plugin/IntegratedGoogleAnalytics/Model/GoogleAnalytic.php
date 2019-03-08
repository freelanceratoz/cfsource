<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */
class GoogleAnalytic extends AppModel
{
    public $useTable = false;
    public function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->filterOptions = array(
            ConstFilterOptions::Loggedin => __l('Loggedin Users') ,
            ConstFilterOptions::Refferred => __l('Refferred Users') ,
            ConstFilterOptions::Followed => __l('Followed Users') ,
            ConstFilterOptions::Voted => __l('Voted Users') ,
            ConstFilterOptions::Commented => __l('Commented Users') ,
            ConstFilterOptions::Funded => __l('Funded Amount Value') ,
            ConstFilterOptions::ProjectPosted => __l('Project Posted Amount Value')
        );
    }
}
?>