<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| LEVEL JABATAN
|--------------------------------------------------------------------------
|
|
|
*/
defined('LEVEL_GUB')                  or define('LEVEL_GUB', 1); // no errorsS
defined('LEVEL_WAKIL_GUB')            or define('LEVEL_WAKIL_GUB', 1); // generic error
defined('LEVEL_SEKDA')                or define('LEVEL_SEKDA', 3); // configuration error
defined('LEVEL_SEKRE_SEKDA')          or define('LEVEL_SEKRE_SEKDA', 4); // file not found
defined('LEVEL_ASISTEN')              or define('LEVEL_ASISTEN', 5); // unknown class
defined('LEVEL_KABIRO')               or define('LEVEL_KABIRO', 6); // unknown class
defined('LEVEL_KABAG_KABID_GUB')      or define('LEVEL_KABAG_KABID_GUB', 7); // unknown class
defined('LEVEL_KADIS')                or define('LEVEL_KADIS', 8); // unknown class
defined('LEVEL_SEKDIS')    			  or define('LEVEL_SEKDIS', 13); // unknown class
defined('LEVEL_KABAG_KABID')   		  or define('LEVEL_KABAG_KABID', 9); // unknown class
defined('LEVEL_KASUBAG_KASIE')        or define('LEVEL_KASUBAG_KASIE', 10); // unknown class
defined('LEVEL_TU')        			  or define('LEVEL_TU', 14); // unknown class
defined('LEVEL_ADMIN')                or define('LEVEL_ADMIN', 11); // unknown class
defined('LEVEL_ADMIN_OPD')            or define('LEVEL_ADMIN_OPD', 12); // unknown class

defined('JABATAN_BIRO_UMUM')          or define('JABATAN_BIRO_UMUM', 6); // unknown class
defined('JABATAN_BIRO_ADMIN')         or define('JABATAN_BIRO_ADMIN', 7); // unknown class

defined('LEVEL_PROVINSI')         	  or define('LEVEL_PROVINSI', array(LEVEL_GUB, LEVEL_WAKIL_GUB, LEVEL_SEKDA, LEVEL_SEKRE_SEKDA, LEVEL_ASISTEN, LEVEL_KABIRO, LEVEL_KABAG_KABID_GUB)); // unknown class
defined('LEVEL_OPD')         	  	  or define('LEVEL_OPD', array(LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE)); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT PERMOHONAN
|--------------------------------------------------------------------------
|
|
|
*/
defined('PERMOHONAN_DRAFT')                        or define('PERMOHONAN_DRAFT', 'DRAFT'); // unknown class
defined('PERMOHONAN_WAITING_APPROVAL_KABAG')       or define('PERMOHONAN_WAITING_APPROVAL_KABAG', 'WAITING_APPROVAL_KABAG'); // unknown class
defined('PERMOHONAN_WAITING_APPROVAL_SEKDIS')      or define('PERMOHONAN_WAITING_APPROVAL_SEKDIS', 'WAITING_APPROVAL_SEKDIS'); // unknown class
defined('PERMOHONAN_WAITING_APPROVAL_KADIS')       or define('PERMOHONAN_WAITING_APPROVAL_KADIS', 'WAITING_APPROVAL_KADIS'); // unknown class
defined('PERMOHONAN_WAITING_NUMBER_TU')       	   or define('PERMOHONAN_WAITING_NUMBER_TU', 'WAITING_NUMBER_TU'); // unknown class
defined('PERMOHONAN_WAITING_APPROVAL_SEKDA')       or define('PERMOHONAN_WAITING_APPROVAL_SEKDA', 'WAITING_APPROVAL_SEKDA'); // unknown class
defined('PERMOHONAN_WAITING_NUMBER_BIRO')          or define('PERMOHONAN_WAITING_NUMBER_BIRO', 'WAITING_NUMBER_BIRO'); // unknown class
defined('PERMOHONAN_APPROVED')                     or define('PERMOHONAN_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SPT
|--------------------------------------------------------------------------
|
|
|
*/
defined('SPT_DRAFT')        or define('SPT_DRAFT', 'DRAFT'); // unknown class
defined('SPT_FINAL')        or define('SPT_FINAL', 'FINAL'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT UNDANGAN
|--------------------------------------------------------------------------
|
|
|
*/
defined('UNDANGAN_DRAFT')                        or define('UNDANGAN_DRAFT', 'DRAFT'); // unknown class
defined('UNDANGAN_WAITING_APPROVAL_BIRO')        or define('UNDANGAN_WAITING_APPROVAL_BIRO', 'WAITING_APPROVAL_BIRO'); // unknown class
defined('UNDANGAN_WAITING_APPROVAL_SEKDA')       or define('UNDANGAN_WAITING_APPROVAL_SEKDA', 'WAITING_APPROVAL_SEKDA'); // unknown class
defined('UNDANGAN_WAITING_NUMBER_BIRO')       	 or define('UNDANGAN_WAITING_NUMBER_BIRO', 'WAITING_NUMBER_BIRO'); // unknown class
defined('UNDANGAN_APPROVED')                     or define('UNDANGAN_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT UNDANGAN LANGSUNG
|--------------------------------------------------------------------------
|
|
|
*/
defined('UNDANGAN_LANGSUNG_DRAFT')                        or define('UNDANGAN_LANGSUNG_DRAFT', 'DRAFT'); // unknown class
defined('UNDANGAN_LANGSUNG_WAITING_APPROVAL_KADIS')       or define('UNDANGAN_LANGSUNG_WAITING_APPROVAL_KADIS', 'WAITING_APPROVAL_KADIS'); // unknown class
defined('UNDANGAN_LANGSUNG_APPROVED')                     or define('UNDANGAN_LANGSUNG_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT PEMBERITAHUAN
|--------------------------------------------------------------------------
|
|
|
*/
defined('PEMBERITAHUAN_DRAFT')                        or define('PEMBERITAHUAN_DRAFT', 'DRAFT'); // unknown class
defined('PEMBERITAHUAN_WAITING_APPROVAL_BIRO')        or define('PEMBERITAHUAN_WAITING_APPROVAL_BIRO', 'WAITING_APPROVAL_BIRO'); // unknown class
defined('PEMBERITAHUAN_WAITING_APPROVAL_SEKDA')       or define('PEMBERITAHUAN_WAITING_APPROVAL_SEKDA', 'WAITING_APPROVAL_SEKDA'); // unknown class
defined('PEMBERITAHUAN_WAITING_NUMBER_BIRO')		  or define('PEMBERITAHUAN_WAITING_NUMBER_BIRO', 'WAITING_NUMBER_BIRO'); // unknown class
defined('PEMBERITAHUAN_APPROVED')                     or define('PEMBERITAHUAN_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT PEMBERITAHUAN LANGSUNG
|--------------------------------------------------------------------------
|
|
|
*/
defined('PEMBERITAHUAN_LANGSUNG_DRAFT')                        or define('PEMBERITAHUAN_LANGSUNG_DRAFT', 'DRAFT'); // unknown class
defined('PEMBERITAHUAN_LANGSUNG_WAITING_APPROVAL_KADIS')       or define('PEMBERITAHUAN_LANGSUNG_WAITING_APPROVAL_KADIS', 'WAITING_APPROVAL_KADIS'); // unknown class
defined('PEMBERITAHUAN_LANGSUNG_APPROVED')                     or define('PEMBERITAHUAN_LANGSUNG_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT BIASA
|--------------------------------------------------------------------------
|
|
|
*/
defined('BIASA_DRAFT')                        or define('BIASA_DRAFT', 'DRAFT'); // unknown class
defined('BIASA_WAITING_APPROVAL_KABAG')       or define('BIASA_WAITING_APPROVAL_KABAG', 'WAITING_APPROVAL_KABAG'); // unknown class
defined('BIASA_WAITING_APPROVAL_SEKDIS')      or define('BIASA_WAITING_APPROVAL_SEKDIS', 'WAITING_APPROVAL_SEKDIS'); // unknown class
defined('BIASA_WAITING_APPROVAL_KADIS')       or define('BIASA_WAITING_APPROVAL_KADIS', 'WAITING_APPROVAL_KADIS'); // unknown class
defined('BIASA_WAITING_APPROVAL_ASISTEN')     or define('BIASA_WAITING_APPROVAL_ASISTEN', 'WAITING_APPROVAL_ASISTEN'); // unknown class
defined('BIASA_WAITING_APPROVAL_SEKDA')       or define('BIASA_WAITING_APPROVAL_SEKDA', 'WAITING_APPROVAL_SEKDA'); // unknown class
defined('BIASA_WAITING_NUMBER_BIRO')       	  or define('BIASA_WAITING_NUMBER_BIRO', 'WAITING_NUMBER_BIRO'); // unknown class
defined('BIASA_WAITING_NUMBER_TU')       	  or define('BIASA_WAITING_NUMBER_TU', 'WAITING_NUMBER_TU'); // unknown class
defined('BIASA_APPROVED')                     or define('BIASA_APPROVED', 'APPROVED'); // unknown class

/*
|--------------------------------------------------------------------------
| STATUS SURAT MASUK
|--------------------------------------------------------------------------
|
|
|
*/
defined('MASUK_DRAFT')       or define('MASUK_DRAFT', 'DRAFT'); // unknown class
defined('MASUK_FINAL')       or define('MASUK_FINAL', 'FINAL'); // unknown class
