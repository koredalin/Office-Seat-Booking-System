<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];

	public function __construct($config = array()) {
		$this->set_js_files();
		parent::__construct($config);
	}
    

	protected function set_js_files(): void
    {
        $ctrlAct = \Yii::$app->controller->id . '-' . \Yii::$app->controller->action->id;
//            echo $ctrlAct; exit;
        if (in_array($ctrlAct, ['seatbook-create',], true)) {
                $this->js[] = 'js/seatbook_create.js';
        }
	}
}
