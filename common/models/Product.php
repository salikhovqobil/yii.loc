<?php

        namespace common\models;

        use Yii;

        /**
         * This is the model class for table "product".
         *
         * @property int $id
         * @property string|null $name
         * @property int|null $category_id
         * @property string|null $description
         * @property int|null $price
         *
         * @property Category $category
         * @property OrderItems[] $orderItems
         * @property ProductImage[] $productImages
         */
        class Product extends \yii\db\ActiveRecord

        {
            public $imageFile;

            /**
             * {@inheritdoc}
             */
            public static function tableName()
            {
                return 'product';
            }

            /**
             * {@inheritdoc}
             */
            public function rules()
            {
                return [
                    [['category_id', 'price'], 'integer'],
                    [['description'], 'string'],
                    [['name'], 'string', 'max' => 255],
                    [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
                    [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
                ];
            }

            /**
             * {@inheritdoc}
             */
            public function attributeLabels()
            {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'category_id' => 'Category ID',
                    'description' => 'Description',
                    'price' => 'Price',
                ];
            }

            /**
             * Gets query for [[Category]].
             *
             * @return \yii\db\ActiveQuery
             */
            public function getCategory()
            {
                return $this->hasOne(Category::class, ['id' => 'category_id']);
            }

            /**
             * Gets query for [[OrderItems]].
             *
             * @return \yii\db\ActiveQuery
             */
            public function getOrderItems()
            {
                return $this->hasMany(OrderItems::class, ['product_id' => 'id']);
            }

            /**
             * Gets query for [[ProductImages]].
             *
             * @return \yii\db\ActiveQuery
             */
            public function getProductImages()
            {
                return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
            }

        //    public function getProductMainImage()
        //    {
        //        return $this->hasOne(ProductImage::class, ['product_id' => 'id'])->where(['order' => 1]);
        //    }

            public function upload($imageName)
            {
                if ($this->validate()) {
                    $this->imageFile->saveAs('uploads/' . $imageName . '.' . $this->imageFile->extension);

                    return true;
                } else {
                    return false;
                }
            }
        }
