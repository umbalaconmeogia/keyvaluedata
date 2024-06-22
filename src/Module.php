<?php
namespace umbalaconmeogia\keyvaluedata;

use Yii;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    /**
     * Message category for translation of this module.
     * @var string
     */
    public $moduleCategory = 'keyvaluedata';

    /**
     * Add configuration for command line.
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();

        // Config for command line.
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'umbalaconmeogia\keyvaluedata\commands';
        }
    }

    public function behaviors()
    {
        $behaviors = [];
        if (! Yii::$app instanceof \yii\console\Application) {
            $behaviors = [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['set-language'],
                            'roles' => ['?'],
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }

        return $behaviors;
    }

    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->moduleCategory] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
            'basePath' => '@common/module/keyvaluedata/messages',
            'fileMap' => [
                $this->moduleCategory => $this->moduleCategory . '.php',
            ],
        ];
    }
}