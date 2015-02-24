<?php
/**
 Admin Page Framework v3.5.4b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AdminPageFramework_WPUtility_SystemInformation extends AdminPageFramework_WPUtility_SiteInformation {
    static private $_aMySQLInfo;
    static public function getMySQLInfo() {
        if (isset(self::$_aMySQLInfo)) {
            return self::$_aMySQLInfo;
        }
        global $wpdb;
        $_aOutput = array('Version' => isset($wpdb->use_mysqli) && $wpdb->use_mysqli ? @mysqli_get_server_info($wpdb->dbh) : @mysql_get_server_info(),);
        foreach (( array )$wpdb->get_results("SHOW VARIABLES", ARRAY_A) as $_iIndex => $_aItem) {
            $_aItem = array_values($_aItem);
            $_sKey = array_shift($_aItem);
            $_sValue = array_shift($_aItem);
            $_aOutput[$_sKey] = $_sValue;
        }
        self::$_aMySQLInfo = $_aOutput;
        return self::$_aMySQLInfo;
    }
    static public function getMySQLErrorLogPath() {
        $_aMySQLInfo = self::getMySQLInfo();
        return isset($_aMySQLInfo['log_error']) ? $_aMySQLInfo['log_error'] : '';
    }
    static public function getMySQLErrorLog($iLines = 1) {
        $_sLog = self::getFileTailContents(self::getMySQLErrorLogPath(), $iLines);
        return $_sLog ? $_sLog : '';
    }
}