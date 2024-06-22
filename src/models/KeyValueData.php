<?php

namespace umbalaconmeogia\keyvaluedata\models;

use batsg\models\BaseModel;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "key_value_data".
 *
 * @property int $id
 * @property int|null $data_status
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property string|null $category
 * @property string $key
 * @property string|null $value
 *
 * @property string $keyAndValue
 * @property KeyValueData[] $children
 */
class KeyValueData extends BaseModel
{
    public $count;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'key_value_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['key'], 'required'],
            [['category', 'key', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data_status' => Yii::t('app', 'Data Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'category' => Yii::t('app', 'Category'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @param string $category
     * @param string $key
     * @param string $value
     * @return KeyValueData|null
     */
    public static function ensureExist($category, $key, $value)
    {
        $result = NULL;
        if ($category && $key) {
            $result = self::findSetAttr([
                'category' => $category,
                'key' => $key,
                'value' => $value,
            ], ['category', 'key'], TRUE);
        }
        return $result;
    }

    const SELECT_CATEGORY = '__CATEGORY__';

    private static $cacheKeyValue = [];

    /**
     * @return string[] Mapping between key=>value of specified category.
     */
    public static function categoryOptionArr($prefix = [])
    {
        return array_merge($prefix, self::optionArr(self::SELECT_CATEGORY));
    }

    /**
     * @return Query
     */
    public function getChildren()
    {
        return $this->hasMany(self::class, ['category' => 'key']);
    }

    /**
     * @param string $category Specify NULL to get list of category.
     * @param string $codeSeparator If specify, then display code and name, else display name only.
     * @param string[] $prefixValues
     * @return string[] Mapping between key=>value of specified category.
     */
    public static function optionArr($category = FALSE, $codeSeparator = FALSE, $prefixValues = [])
    {
        if (!isset(self::$cacheKeyValue[$category])) {
            $condition = $category ? ['category' => $category] : [];
            $keyValues = self::find()->where($condition)->orderBy('key')->all();
            self::$cacheKeyValue[$category] = ArrayHelper::map($keyValues, 'key', 'value');
        }
        $result = $prefixValues;
        foreach (self::$cacheKeyValue[$category] as $key => $value) {
            $result[$key] = $codeSeparator === FALSE ? $value : "{$key}{$codeSeparator}{$value}";
        }
        return $result;
    }

    /**
     * @param string $separator
     * @return string
     */
    public function getKeyAndValue($separator = ' - ')
    {
        return self::join([$this->key, $this->value], $separator);
    }

    /**
     * @return string
     */
    public static function getValueOfCatKey($category, $key)
    {
        $keyValueData = KeyValueData::findOne(['category' => $category, 'key' => $key]);
        return $keyValueData ? $keyValueData->value : NULL;
    }

    /**
     * Join all NOT NULL values of an array to a string.
     * @param array $values
     * @param string $separator
     * @return string
     */
    public static function join($values, $separator = ' - ', $exclusiveValue = [])
    {
        $realValue = [];
        foreach ($values as $value) {
            if (!in_array($value, $exclusiveValue)) {
                $realValue[] = $value;
            }
        }
        return join($separator, $realValue);
    }
}
