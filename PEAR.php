<?php
if (!defined('PEAR_ERROR_RETURN')) define('PEAR_ERROR_RETURN', 1);
if (!defined('PEAR_ERROR_PRINT')) define('PEAR_ERROR_PRINT', 2);
if (!defined('PEAR_ERROR_TRIGGER')) define('PEAR_ERROR_TRIGGER', 4);
if (!defined('PEAR_ERROR_DIE')) define('PEAR_ERROR_DIE', 8);
if (!defined('PEAR_ERROR_CALLBACK')) define('PEAR_ERROR_CALLBACK', 16);

class PEAR_Error {
    var $message = 'unknown error';
    var $code = null;
    var $mode = PEAR_ERROR_RETURN;
    var $level = E_USER_NOTICE;
    var $userinfo = null;

    function PEAR_Error($message = 'unknown error', $code = null, $mode = PEAR_ERROR_RETURN, $level = E_USER_NOTICE, $userinfo = null) {
        $this->__construct($message, $code, $mode, $level, $userinfo);
    }

    function __construct($message = 'unknown error', $code = null, $mode = PEAR_ERROR_RETURN, $level = E_USER_NOTICE, $userinfo = null) {
        $this->message = $message;
        $this->code = $code;
        $this->mode = $mode;
        $this->level = $level;
        $this->userinfo = $userinfo;
    }

    function getMessage() { return $this->message; }
    function getCode() { return $this->code; }
    function getUserInfo() { return $this->userinfo; }
    function addUserInfo($info) {
        if ($this->userinfo === null || $this->userinfo === '') {
            $this->userinfo = $info;
        } else {
            $this->userinfo .= ' ** ' . $info;
        }
    }
    function toString() { return $this->message; }
}

class PEAR {
    function PEAR() {}
    function __construct() { $this->PEAR(); }

    function raiseError($message = null, $code = null, $mode = null, $options = null, $userinfo = null, $error_class = null, $skipmsg = false) {
        $class = ($error_class && class_exists($error_class)) ? $error_class : 'PEAR_Error';
        if ($class !== 'PEAR_Error') {
            return new $class($code, $mode === null ? PEAR_ERROR_RETURN : $mode, is_int($options) ? $options : E_USER_NOTICE, $userinfo);
        }
        if ($message === null || $message === '') {
            $message = ($userinfo !== null && $userinfo !== '') ? $userinfo : 'PEAR error';
        }
        return new PEAR_Error($message, $code, $mode === null ? PEAR_ERROR_RETURN : $mode, is_int($options) ? $options : E_USER_NOTICE, $userinfo);
    }

    function isError($obj) {
        return is_object($obj) && (is_a($obj, 'PEAR_Error') || is_subclass_of($obj, 'PEAR_Error'));
    }

    function loadExtension($ext) {
        return extension_loaded($ext);
    }
}

function &PEAR_raiseError($message = null, $code = null, $mode = null, $options = null, $userinfo = null, $error_class = null, $skipmsg = false) {
    $p = new PEAR();
    $e = $p->raiseError($message, $code, $mode, $options, $userinfo, $error_class, $skipmsg);
    return $e;
}

function PEAR_isError($obj) {
    $p = new PEAR();
    return $p->isError($obj);
}
?>
