<?php 
  class DocsPage extends Controller{

    private $all_doc_Category;
    public function __construct()
    {
      parent::__construct();
      $this->all_doc_Category = $this->doc_db->getAllDocCategory();
      $this->view_arr = [
          "avatar"   => $this->avatar,
          "all_tuts" => $this->all_tuts,
          "tut_qs"   => $this->tut_qs,
          "all_doc"  => $this->all_doc,

      ];
    }
    private function middlewareDoc(){
      if(!isset($_SESSION['member_id'])){
        if(isset($_COOKIE['member_login']))
          $this->user_db->checkSession($_COOKIE['member_login'], '');
        else
          header('Location:RegisterPage/');
      }
    }


    public function Init($doc_ca_name = 'meo_hay_hoc_tieng_anh'){
      $this->middlewareDoc();
      $all_doc_of_Category = $this->doc_db->getAllDocsOfCategory($doc_ca_name);
      $doc_Category_name   = $this->doc_db->getDocCategoryNameByDocQuery($doc_ca_name);

      $view_more          = [
        "page"              => "content_doc",
        "allDocCategory"    => $this->all_doc_Category,
        "all_doc_page"           => $all_doc_of_Category,
        "doc_ca_name"       => $doc_ca_name,
        "doc_Category_name" => $doc_Category_name,
      ];
      $this->render("master_home",$view_more);
    }

    public function Read($doc_ca_name, $doc_name){
      $this->middlewareDoc();

      $all_doc_of_Category = $this->doc_db->getAllDocsOfCategory($doc_ca_name);
      $doc_name_title           = $this->doc_db->getDocNameByDocQuery($doc_name);

      $view_more          = [
        "page"           => "content_doc",
        "doc_content"    => $this->doc_db->getDocContent($doc_name),
        "all_doc_list"   => $all_doc_of_Category,
        "doc_ca_name"    => $doc_ca_name,
        "doc_name_title" => $doc_name_title,
      ];
      $this->render("master_home", $view_more);
    }


  }


?>