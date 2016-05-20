<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 28/02/16
     * Time: 12:43
     */
    class Breadcrumb
    {

        var $output;
        var $crumbs = [];
        var $location;


        /*
         * Constructor
         */
        public function Breadcrumb()
        {

            if ($_SESSION['breadcrumb'] != null) {
                $this->crumbs = $_SESSION['breadcrumb'];
            }

        }

        /*
         * Add a crumb to the trail:
         * @param $label - The string to display
         * @param $url - The url underlying the label
         * @param $level - The level of this link.
         *
         */
        public function add($label, $url, $level)
        {

            $crumb = [];
            $crumb['label'] = $label;
            $crumb['url'] = $url;

            if ($crumb['label'] != null && $crumb['url'] != null && isset($level)) {

                while (count($this->crumbs) > $level) {

                    array_pop($this->crumbs); //prune until we reach the $level we've allocated to this page

                }

                if (!isset($this->crumbs[0]) && $level > 0) { //If there's no session data yet, assume a homepage link

                    $this->crumbs[0]['url'] = "/index.php";
                    $this->crumbs[0]['label'] = "Home";

                }

                $this->crumbs[ $level ] = $crumb;

            }

            $_SESSION['breadcrumb'] = $this->crumbs; //Persist the data
            $this->crumbs[ $level ]['url'] = null; //Ditch the underlying url for the current page.
        }

        /*
         * Output a semantic list of links.  See above for sample CSS.  Modify this to suit your design.
         */
        public function output()
        {

            echo "<div id='breadcrumb'><ul><li>Click trail: </li>";

            foreach ($this->crumbs as $crumb) {

                if ($crumb['url'] != null) {

                    echo "<li> > <a href='" . $crumb['url'] . "' title='" . $crumb['label'] . "'>" . $crumb['label'] . "</a></li> ";

                } else {

                    echo "<li> > " . $crumb['label'] . "</li> ";

                }
            }

            echo "</ul></div>";
        }
    }

