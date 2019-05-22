<?php
/**
 * Created by Taufiq Rahman.
 * Date: 02/05/18
 * Time: 11.34
 */

namespace botman\controllers;

use yii\rest\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return ['status'=>'success','message'=>'botman Web service'];
    }
}
