<?php
/**
 * Created by PhpStorm.
 * User: pveb_student
 * Date: 14/12/16
 * Time: 14:01
 */

class Serie {
    public $name;
    public $date;

    public function __construct($name, $date){
        $this->name = $name;
        $this->date = $date;
    }

    /**
     * @return mixed
     */public  function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */public  function getDate(){
        return $this->date;
    }
}

class PagesController extends Controller {

    public function index() {
        echo "Here will be the welcome page";
    }

    public function login() {

    }

    public function view() {
        $params = App::getRouter()->getParams();

        if(isset($params[0])) {
            $alias = strtolower($params[0]);

            echo "Here will be a page with '{$alias}' alias";
        }
    }

    public function preview() {
        $serie1 = new Serie('Got', '1-5-2017');
        $serie2 = new Serie('OITNB', '4-6-2017');
        $serie3 = new Serie('Broad City', '15-8-2017');

        $series = array(
                '0' => $serie1,
                '1' => $serie2,
                '2' => $serie3
                );

        ?>  <html>
            <head></head>
            <body>
                <table>
                    <?php foreach($series as $i => $serie) {
                        ?><tr>
                        <th><?php echo $serie->getDate(); ?> </th>
                        </tr>
                    <?php } ?>
                </table>
            </body>
        </html> <?php
    }

    public function add($name) {

    }
}