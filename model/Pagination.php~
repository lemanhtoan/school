<?php
class Pagination{

    public $limit = 2;
    protected $_baseUrl;

    public function __construct(){
        $this->_baseUrl = $_SERVER['REQUEST_URI']; //PHP_SELF
        if (strpos($this->_baseUrl, "_list") !== false) {
            $parts = parse_url($this->_baseUrl);
            parse_str($parts['query'], $query);
            $arrayOp = explode("?", $query['op']);
            $this->_baseUrl = 'index.php?op=' .$arrayOp[0];
        }
    }

    public function start(){
        if(isset($_GET['start'])){
            $start = $_GET['start'];
        }else{
            $start = 0;
        }
        return $start;
    }

    public function totalPages($totalRecord){
        if(isset($_GET['pages'])){
            $totalPages = $_GET['pages'];
        }else{
            $totalPages = ceil($totalRecord/$this->limit);
        }
        return $totalPages;
    }

    public function listPages($totalPages){
        $start = $this->start();
        $limit = $this->limit;
        $listPage = '';

        if($totalPages > 1){
            $current = ($start/$limit) + 1;
            if($current != 1){
                $newstart = $start - $limit;
                $listPage .= "<li><a href='".$this->_baseUrl."?pages=$totalPages&start=$newstart'>Prev</a></li>";
            }

            for($i=1;$i<=$totalPages;$i++){
                $newstart = ($i - 1)*$limit;
                if($i == $current){
                    $listPage .= "<li class='active'><span class='current'>".$i."</span></li>";
                }else{
                    $listPage .= "<li><a href='".$this->_baseUrl."?pages=$totalPages&start=$newstart'>".$i."</a></li>";
                }
            }

            if($current != $totalPages){
                $newstart = $start + $limit;
                $listPage .= "<li><a href='".$this->_baseUrl."?pages=$totalPages&start=$newstart'>Next</a></li>";
            }
        }

        return $listPage;
    }
}

?>