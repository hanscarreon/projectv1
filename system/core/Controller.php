<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

	public function have_sess_user(){
		$this->nocache();
		if ($this->session->userdata('usr_type') == 'starter' || $this->session->userdata('usr_type') == 'sparkle') {
			return true;
		} else {
			return false;
		}
	}

	public function have_sess_admin(){
		// $this->nocache();
		// return true;
		if ($this->session->userdata('user_role') == 'super admin' && $this->session->userdata('user_status') != 'deleted' 
			|| $this->session->userdata('user_role') == 'admin' && $this->session->userdata('user_status') != 'deleted'
			|| $this->session->userdata('user_role') == 'base' && $this->session->userdata('user_status') != 'deleted') {
			return true;
		} else {
			return false;
		}
	}

	public function have_sess_branch(){
		// $this->nocache();
		if ($this->session->userdata('acc_type') == 'branch' && $this->session->userdata('deb_status') != 'deleted') {
			return true;
		} else {
			return false;
		}
	}

	public function have_sess_superadmin(){
		// $this->nocache();
		if ($this->session->userdata('acc_type') != 'super admin') {
			$this->logout_admin();
		} else {
			return true;
		}
	}

	public function have_sess_main(){
		// $this->nocache();
		if ($this->session->userdata('bra_id') != 1) {
			$this->logout_admin();
		}
	}

	public function logout_user() {
        $this->session->sess_destroy();
        // $this->nocache();    
        redirect('login', 'refresh'); 
    }

    public function logout_admin() {
        $this->session->sess_destroy();
        // $this->nocache();    
        redirect('login', 'refresh'); 
	}
	
	public function logout_branch() {
        $this->session->sess_destroy();
        // $this->nocache();    
        redirect('admin/dealer', 'refresh'); 
    }

	 public function getDatetimeNow() {
	    $tz_object = new DateTimeZone('Asia/Manila');
	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    return $datetime->format('Y\-m\-d\ H:i:s');
	}
	public function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
	
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
	
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
	
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

}
