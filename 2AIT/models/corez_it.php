<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* Name:  CoreZ IT
*
* Version: 1.0.3
*
* Author: Tanveer Ahmed Ivan
*
* Created:  07.09.2015
*
* Edited:   21.04.2016
*
* Requirements: PHP5 or above
*
*/

class Corez_it extends CI_Model
{
	
	public function __construct(){
            date_default_timezone_set('Asia/Dacca');
        }


        public function select($select = '*', $escape = NULL){
            $this->db->select($select, $escape);
        }
        public function select_max($select = '', $alias = ''){
            $this->db->select_max($select, $alias);
        }
        public function select_min($select = '', $alias = ''){
            $this->db->select_min($select, $alias);
        }
        public function select_avg($select = '', $alias = ''){
            $this->db->select_avg($select, $alias);
        }
        public function select_sum($select = '', $alias = ''){
            $this->db->select_sum($select, $alias);
        }
        public function join($table, $cond, $type = ''){
            $this->db->join($table, $cond, $type);
        } 
        public function where($key, $value = NULL, $escape = TRUE){
            $this->db->where($key, $value, $escape);
	}
        public function or_where($key, $value = NULL, $escape = TRUE){
            $this->db->where($key, $value, $escape);
	}
        public function where_in($key = NULL, $values = NULL){
            $this->db->where_in($key, $values);
	}
        public function or_where_in($key = NULL, $values = NULL){
            $this->db->or_where_in($key, $values);
	}
        public function where_not_in($key = NULL, $values = NULL){
            $this->db->where_not_in($key, $values);
	}
        public function or_where_not_in($key = NULL, $values = NULL){
            $this->db->or_where_not_in($key, $values);
	}
        public function like($field, $match = '', $side = 'both'){
	    $this->db->like($field, $match, $side);
	}
        public function not_like($field, $match = '', $side = 'both'){
	    $this->db->not_like($field, $match, $side);
	}
        public function or_like($field, $match = '', $side = 'both'){
            $this->db->or_like($field, $match, $side);
	}
        public function or_not_like($field, $match = '', $side = 'both'){
            $this->db->or_not_like($field, $match, $side);
	}
        public function group_by($by){
            $this->db->group_by($by);
        }
        public function distinct($val = TRUE){
	    $this->db->distinct($val);
	}
        public function having($key, $value = '', $escape = TRUE){
            $this->db->having($key, $value, $escape);
	}
        public function or_having($key, $value = '', $escape = TRUE){
            $this->db->or_having($key, $value, $escape);
	}
        public function order_by($orderby, $direction = ''){
            $this->db->order_by($orderby, $direction);
        }
        public function limit($value, $offset = ''){
            $this->db->limit($value, $offset);
        }
        public function offset($offset){
            $this->db->offset($offset);
        }
        public function set($key, $value = '', $escape = TRUE){
            $this->db->set($key, $value, $escape);
        }
        public function get($table = '', $limit = null, $offset = null){
            return $result = $this->db->get($table, $limit, $offset);
        }
        
        /*
         * 
         *  function count_all_results()
         * 
         *  Changed form DB class.
         *  added where option for faster codeing.
         * 
         */        
        
        public function count_all_results($table,$where = NULL){
            if(!empty($where))$this->db->where($where);
            return $total = $this->db->count_all_results($table);
        }
        public function get_where($table = '', $where = null, $limit = null, $offset = null){
            return $result = $this->db->get_where($table, $where, $limit, $offset);
        }
        public function insert_batch($table = '', $values = NULL){
            return $result = $this->db->insert_batch($table, $values);
        }
        public function set_insert_batch($key, $value = '', $escape = TRUE){
            $this->db->set_insert_batch($key, $value, $escape);
        }
        public function insert($table, $values){
            return $result = $this->db->insert($table, $values);
        }
        public function replace($table = '', $set = NULL){
            return $result = $this->db->replace($table, $set);
        }
        public function update($table = '', $values = NULL, $where = NULL, $limit = NULL){
            return $result = $this->db->update($table, $values, $where, $limit);
        }
        public function update_batch($table = '', $values = NULL, $index = NULL){
            return $result = $this->db->update_batch($table, $values, $index);
        }
        public function set_update_batch($key, $index = '', $escape = TRUE){
            return $result = $this->db->set_update_batch($key, $index, $escape);
        }
	public function delete($table = '', $where = '', $limit = NULL, $reset_data = TRUE){
            return $result = $this->db->delete($table, $where, $limit, $reset_data);
        }
              
        

        private function makecomma($input){
            // This function is written by some anonymous person - I got it from Google
            if(strlen($input)<=2)
            { return $input; }
            $length=substr($input,0,strlen($input)-2);
            $formatted_input = $this->makecomma($length).",".substr($input,-2);
            return $formatted_input;
        }

        public function MoneyBDT($num){
            // This is my function
            $pos = strpos((string)$num, ".");
            if ($pos === false) { $decimalpart="00";}
            else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }

            if(strlen($num)>3 & strlen($num) <= 12){
                        $last3digits = substr($num, -3 );
                        $numexceptlastdigits = substr($num, 0, -3 );
                        $formatted = $this->makecomma($numexceptlastdigits);
                        $stringtoreturn = $formatted.",".$last3digits ;
            }elseif(strlen($num)<=3){
                        $stringtoreturn = $num ;
            }elseif(strlen($num)>12){
                        $stringtoreturn = number_format($num, 2);
            }

            if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}

            return $stringtoreturn;
        }
        
        public function TimeDifference($date){
            
            $diff = $date - time();
            if($diff < 1){
                return $value = array('int'=>0,'string'=>'minutes');
            }
            $temp = $diff/86400; 
            $days = floor($temp); 
            if($days > 1){
                return $value = array('int'=>$days,'string'=>'days'); 
            }
            $temp=24*($temp-$days); 
            $hours = floor($temp); 
            if($hours > 1){
                return $value = array('int'=>$hours,'string'=>'hours'); 
            }
            $temp = 60*($temp-$hours); 
            $minutes = floor($temp); 
            if($minutes > 1){
                return $value = array('int'=>$minutes,'string'=>'minutes');
            }
            return $value = array('int'=>1,'string'=>'minute'); 
        }
        
        public function plural( $count, $text ) { 
            $count = floor($count);
            return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
        }
 
        public function ago( $date ) {
            $interval = time() - $date;
            if ( ($interval/(60*60*24*365)) >= 1 ) return $this->plural( $interval/(60*60*24*365), 'year' );
            if ( ($interval/(60*60*24*30)) >= 1 ) return $this->plural( $interval/(60*60*24*30), 'month' );
            if ( ($interval/(60*60*24)) >= 1 ) return $this->plural( $interval/(60*60*24), 'day' );
            if ( ($interval/(60*60)) >= 1 ) return $this->plural( $interval/(60*60), 'hour' );
            if ( ($interval/(60)) >= 1 ) return $this->plural( $interval/(60), 'minute' );
            return $this->plural( $interval, 'second' );
        }
        public function getUrlFriendlyString($str){
                $str = str_replace(" ", "-", trim(str_replace(array('"','$','.','_','+','!','*',"'",'(',')',',','\\',';','/','?',':','@','=','&'), "", $str)));
                return $str;
        }
        
        public function url_check($url = '', $table){
                if (empty($url))
                {
                        return FALSE;
                }
                $url = $this->getUrlFriendlyString($url);
                $original_url = $url;
                for($i = 1; $this->db->where('url', $url)->count_all_results($table) > 0; $i++)$url = $original_url.'-'. $i;
                return $url;
        }
        
        public function _render_backend($view, $data=null, $render=false){

		$viewdata = (empty($data)) ? array() : $data;
                $viewdata['site'] = $this->get('site')->row();
                $viewdata['controller'] = $this->uri->segment(1, 'dashboard');
                $viewdata['method'] = $this->uri->segment(2, 'index');
                $viewdata['user'] = $this->ion_auth->user()->row();
                $view_html = $this->load->view('backend/header', $viewdata, $render);
		$view_html .= $this->load->view($view);
                $view_html .= $this->load->view('backend/footer');

		if (!$render) return $view_html;
	}
        public function _render_frontend($view, $data=null, $render=false){

		$viewdata = (empty($data)) ? array() : $data;
                $viewdata['site'] = $this->get('site')->row();
                $viewdata['controller'] = $this->uri->segment(1, 'home');
                $viewdata['method'] = $this->uri->segment(2, 'index');
                $viewdata['user'] = $this->ion_auth->user()->row();
                $view_html = $this->load->view('frontend/header', $viewdata, $render);
		$view_html .= $this->load->view($view);
                $view_html .= $this->load->view('frontend/footer');

		if (!$render) return $view_html;
	}
        public function send_sms($phone, $text){
                $postUrl = "http://api.bulksms.icombd.com/api/sendsms/xml";
                // XML-formatted data
                $xmlString =
                '<SMS>
                <authentification>
                <username>iearul.abid</username>
                <password>lO8HqYRl</password>
                </authentification>
                <message>
                <sender>CoreZ IT</sender>
                <text>'.$text.'</text>
                </message>
                <recipients>
                <gsm>88'.$phone.'</gsm>
                </recipients>
                </SMS>';
                // previously formatted XML data becomes value of 'XML" POST variable
                $fields = "XML=" . urlencode($xmlString);
                // in this example, POST request was made using PHP's CURL
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $postUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                // response of the POST request
                $res = curl_exec($ch);
                curl_close($ch);
                // write out the response
                //echo $response;

        }
        function random_string($qtd){ 
            $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz0123456789'; 
            $QuantidadeCaracteres = strlen($Caracteres); 
            $QuantidadeCaracteres--; 

            $Hash=NULL; 
                for($x=1;$x<=$qtd;$x++){ 
                    $Posicao = rand(0,$QuantidadeCaracteres); 
                    $Hash .= substr($Caracteres,$Posicao,1); 
                } 

            return $Hash; 
        }
        function convert_number_to_words($number){
                $hyphen      = '-';
                $conjunction = ' and ';
                $separator   = ', ';
                $negative    = 'negative ';
                $decimal     = ' point ';
                $dictionary  = array(
                    0                   => 'zero',
                    1                   => 'one',
                    2                   => 'two',
                    3                   => 'three',
                    4                   => 'four',
                    5                   => 'five',
                    6                   => 'six',
                    7                   => 'seven',
                    8                   => 'eight',
                    9                   => 'nine',
                    10                  => 'ten',
                    11                  => 'eleven',
                    12                  => 'twelve',
                    13                  => 'thirteen',
                    14                  => 'fourteen',
                    15                  => 'fifteen',
                    16                  => 'sixteen',
                    17                  => 'seventeen',
                    18                  => 'eighteen',
                    19                  => 'nineteen',
                    20                  => 'twenty',
                    30                  => 'thirty',
                    40                  => 'fourty',
                    50                  => 'fifty',
                    60                  => 'sixty',
                    70                  => 'seventy',
                    80                  => 'eighty',
                    90                  => 'ninety',
                    100                 => 'hundred',
                    1000                => 'thousand',
                    1000000             => 'million',
                    1000000000          => 'billion',
                    1000000000000       => 'trillion',
                    1000000000000000    => 'quadrillion',
                    1000000000000000000 => 'quintillion'
                );

                if (!is_numeric($number)) {
                    return false;
                }

                if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                    // overflow
                    trigger_error(
                        '$this->convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                        E_USER_WARNING
                    );
                    return false;
                }

                if ($number < 0) {
                    return $negative . $this->convert_number_to_words(abs($number));
                }

                $string = $fraction = null;

                if (strpos($number, '.') !== false) {
                    list($number, $fraction) = explode('.', $number);
                }

                switch (true) {
                    case $number < 21:
                        $string = $dictionary[$number];
                        break;
                    case $number < 100:
                        $tens   = ((int) ($number / 10)) * 10;
                        $units  = $number % 10;
                        $string = $dictionary[$tens];
                        if ($units) {
                            $string .= $hyphen . $dictionary[$units];
                        }
                        break;
                    case $number < 1000:
                        $hundreds  = $number / 100;
                        $remainder = $number % 100;
                        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                        if ($remainder) {
                            $string .= $conjunction . $this->convert_number_to_words($remainder);
                        }
                        break;
                    default:
                        $baseUnit = pow(1000, floor(log($number, 1000)));
                        $numBaseUnits = (int) ($number / $baseUnit);
                        $remainder = $number % $baseUnit;
                        $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                        if ($remainder) {
                            $string .= $remainder < 100 ? $conjunction : $separator;
                            $string .= $this->convert_number_to_words($remainder);
                        }
                        break;
                }

                if (null !== $fraction && is_numeric($fraction)) {
                    $string .= $decimal;
                    $words = array();
                    foreach (str_split((string) $fraction) as $number) {
                        $words[] = $dictionary[$number];
                    }
                    $string .= implode(' ', $words);
                }

                return $string;
        }
}