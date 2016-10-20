<?php
/**
 *
 * ファイルタイトル
 *
 * ファイル概要
 *
 * @author      Seiki Koga <seikikoga@gamania.com>
 * @copyright   Gamania.co.jp
 * @license     GPL
 * @version     $Rev$
 * @access      public
 * @since       ファイルやクラスが、パッケージの初リリースの後で加えられた場合、このタグを使用します。
 * @deprecated  ファイルやクラスが、もはや使われなくなっているが、 互換性のため残されている場合にこのタグを使用します。
 */

/**
 * defineタイトル
 *
 * define概要
 *
 * @var integer 1+2の結果
 */
define('THREE', 1+2);


/**
 * classタイトル
 *
 * class概要
 *
 * @package     phpDocumentor
 * @subpackage  phpDocumentor
 * @access      public
 */
class HogeTest extends PHPUnit_Framework_TestCase{
    /**
     * 変数タイトル
     *
     * 変数概要
     *
     * @var string 変数内容
     */
    protected $foo;


    /**
     * methodタイトル
     *
     * method概要
     *
     * @param  void
     * @return void
     * @access public
     */
    public function testHoge(){
    }
}

?>